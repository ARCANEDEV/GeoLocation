<?php namespace Arcanedev\GeoLocation\Tests\Google\Geocoding;

use Arcanedev\GeoLocation\Google\Geocoding\GeocodingService;
use Arcanedev\GeoLocation\Tests\TestCase;
use GuzzleHttp\Client;

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

        $this->service = new GeocodingService(new Client);
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
            \Arcanedev\GeoLocation\Google\Geocoding\GeocodingService::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->service);
        }
    }

    /** @test */
    public function it_can_geocode()
    {
        $address  = 'Champ de Mars, 5 Avenue Anatole France, 75007 Paris, France';
        $response = $this->service->geocode($address);

        $this->assertInstanceOf(
            \Arcanedev\GeoLocation\Google\Geocoding\GeocodingResponse::class,
            $response
        );

        $this->assertTrue($response->isOk());
    }
}
