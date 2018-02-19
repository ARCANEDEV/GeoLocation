<?php namespace Arcanedev\GeoLocation\Tests\Google\Geocoding;

use Arcanedev\GeoLocation\Tests\Google\TestCase;

/**
 * Class     GeocodingServiceTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Google\Geocoding
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeocodingServiceTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoLocation\Google\Geocoding\GeocodingService */
    protected $service;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    protected function setUp()
    {
        parent::setUp();

        $this->service = $this->manager()->createGeocodingDriver();
    }

    protected function tearDown()
    {
        unset($this->service);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\GeoLocation\Google\AbstractService::class,
            \Arcanedev\GeoLocation\Google\Geocoding\GeocodingService::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->service);
        }
    }

    /** @test */
    public function it_can_geocode()
    {
        $address  = 'Champ de Mars, 5 Avenue Anatole France, 75007 Paris, France';
        $response = $this->service->geocode($address);

        static::assertInstanceOf(
            \Arcanedev\GeoLocation\Google\Geocoding\GeocodingResponse::class,
            $response
        );

        static::assertTrue($response->isOk());

        $position = $response->getLocationPosition();

        static::assertGreaterThanOrEqual(48.85, $position->lat()->value());
        static::assertGreaterThanOrEqual(2.29, $position->lng()->value());
    }

    /** @test */
    public function it_can_reverse()
    {
        $response = $this->service->reversePosition(48.8556475, 2.2986304);

        static::assertTrue($response->isOk());

        static::assertContains(
            'Anatole France, 75007 Paris, France',
            $response->getFormattedAddress()
        );
    }
}
