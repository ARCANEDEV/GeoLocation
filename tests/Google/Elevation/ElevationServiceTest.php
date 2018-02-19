<?php namespace Arcanedev\GeoLocation\Tests\Google\Elevation;

use Arcanedev\GeoLocation\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Google\Elevation\ElevationService;
use Arcanedev\GeoLocation\Tests\TestCase;
use GuzzleHttp\Client;

/**
 * Class     ElevationServiceTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Google\Elavation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ElevationServiceTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoLocation\Google\Elevation\ElevationService */
    protected $service;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    protected function setUp()
    {
        parent::setUp();

        $this->service = new ElevationService(new Client);
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
            \Arcanedev\GeoLocation\Google\Elevation\ElevationService::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->service);
        }
    }

    /** @test */
    public function it_can_get_elevation_with_a_single_location()
    {
        $location = Position::create(40.714728, -73.998672);
        $response = $this->service->location($location);

        static::assertTrue($response->isOk());

        $elevations = $response->elevations();

        static::assertInstanceOf(\Arcanedev\GeoLocation\Google\Elevation\Entities\ElevationCollection::class, $elevations);
        static::assertCount(1, $elevations);

        /** @var  \Arcanedev\GeoLocation\Google\Elevation\Entities\Elevation  $elevation */
        $elevation = $elevations->first();

        static::assertGreaterThan(0, $elevation->value());
        static::assertSame($location->lat()->value(), $elevation->location()->lat()->value());
        static::assertSame($location->lng()->value(), $elevation->location()->lng()->value());
        static::assertGreaterThan(0, $elevation->resolution());
    }

    /** @test */
    public function it_can_elevation_with_a_multiple_location_aka_path()
    {
        $one = Position::create(40.714728, -73.998672);
        $two = Position::create(-34.397,150.644);

        $response = $this->service->path([$one, $two]);

        static::assertTrue($response->isOk());

        $elevations = $response->elevations();

        static::assertInstanceOf(\Arcanedev\GeoLocation\Google\Elevation\Entities\ElevationCollection::class, $elevations);
        static::assertCount(2, $elevations);

        /** @var  \Arcanedev\GeoLocation\Google\Elevation\Entities\Elevation  $elevation */
        $elevation = $elevations->first();

        static::assertGreaterThan(0, $elevation->value());
        static::assertSame($one->lat()->value(), $elevation->location()->lat()->value());
        static::assertSame($one->lng()->value(), $elevation->location()->lng()->value());
        static::assertGreaterThan(0, $elevation->resolution());

        /** @var  \Arcanedev\GeoLocation\Google\Elevation\Entities\Elevation  $elevation */
        $elevation = $elevations->last();

        static::assertGreaterThan(0, $elevation->value());
        static::assertSame($two->lat()->value(), $elevation->location()->lat()->value());
        static::assertSame($two->lng()->value(), $elevation->location()->lng()->value());
        static::assertGreaterThan(0, $elevation->resolution());
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $location = Position::create(40.714728, -73.998672);
        $response = $this->service->location($location);

        static::assertTrue($response->isOk());

        $array = $response->toArray();

        static::assertInternalType('array', $array[0]);

        $first = $array[0];

        static::assertArrayHasKey('elevation',  $first);
        static::assertArrayHasKey('location',   $first);
        static::assertArrayHasKey('resolution', $first);
    }
}
