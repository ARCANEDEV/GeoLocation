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
            $this->assertInstanceOf($expected, $this->service);
        }
    }

    /** @test */
    public function it_can_get_elevation_with_a_single_location()
    {
        $location = Position::create(40.714728, -73.998672);
        $response = $this->service->location($location);

        $this->assertTrue($response->isOk());

        $elevations = $response->elevations();

        $this->assertInstanceOf(\Arcanedev\GeoLocation\Google\Elevation\Entities\ElevationCollection::class, $elevations);
        $this->assertCount(1, $elevations);

        /** @var  \Arcanedev\GeoLocation\Google\Elevation\Entities\Elevation  $elevation */
        $elevation = $elevations->first();

        $this->assertGreaterThan(0, $elevation->value());
        $this->assertSame($location->lat()->value(), $elevation->location()->lat()->value());
        $this->assertSame($location->lng()->value(), $elevation->location()->lng()->value());
        $this->assertGreaterThan(0, $elevation->resolution());
    }

    /** @test */
    public function it_can_elevation_with_a_multiple_location_aka_path()
    {
        $one = Position::create(40.714728, -73.998672);
        $two = Position::create(-34.397,150.644);

        $response = $this->service->path([$one, $two]);

        $this->assertTrue($response->isOk());

        $elevations = $response->elevations();

        $this->assertInstanceOf(\Arcanedev\GeoLocation\Google\Elevation\Entities\ElevationCollection::class, $elevations);
        $this->assertCount(2, $elevations);

        /** @var  \Arcanedev\GeoLocation\Google\Elevation\Entities\Elevation  $elevation */
        $elevation = $elevations->first();

        $this->assertGreaterThan(0, $elevation->value());
        $this->assertSame($one->lat()->value(), $elevation->location()->lat()->value());
        $this->assertSame($one->lng()->value(), $elevation->location()->lng()->value());
        $this->assertGreaterThan(0, $elevation->resolution());

        /** @var  \Arcanedev\GeoLocation\Google\Elevation\Entities\Elevation  $elevation */
        $elevation = $elevations->last();

        $this->assertGreaterThan(0, $elevation->value());
        $this->assertSame($two->lat()->value(), $elevation->location()->lat()->value());
        $this->assertSame($two->lng()->value(), $elevation->location()->lng()->value());
        $this->assertGreaterThan(0, $elevation->resolution());
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $location = Position::create(40.714728, -73.998672);
        $response = $this->service->location($location);

        $this->assertTrue($response->isOk());

        $array = $response->toArray();

        $this->assertInternalType('array', $array[0]);

        $first = $array[0];

        $this->assertArrayHasKey('elevation',  $first);
        $this->assertArrayHasKey('location',   $first);
        $this->assertArrayHasKey('resolution', $first);
    }
}
