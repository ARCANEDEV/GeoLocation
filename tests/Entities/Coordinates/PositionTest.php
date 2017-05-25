<?php namespace Arcanedev\GeoLocation\Tests\Entities\Coordinates;

use Arcanedev\GeoLocation\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     PositionTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Entities\Coordinates
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PositionTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $position = $this->createPosition();

        $expectations = [
            \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position::class,
            \Arcanedev\GeoLocation\Entities\Coordinates\Position::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $position);
        }
    }

    /** @test */
    public function it_can_create()
    {
        $position = Position::create(
            $lat  = 31.7917,
            $long = 7.0926
        );

        $expectations = [
            \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position::class,
            \Arcanedev\GeoLocation\Entities\Coordinates\Position::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $position);
        }

        $this->assertSame($lat, $position->lat()->value());
        $this->assertSame($long, $position->lng()->value());
    }

    /** @test */
    public function it_can_set_and_get_latitude()
    {
        $position = $this->createPosition();

        $this->assertCoordinateInstance($position->getLatitude());
        $this->assertCoordinateInstance($position->lat());

        $this->assertSame(31.7917, $position->getLatitude()->value());
        $this->assertSame(31.7917, $position->lat()->value());

        $lat = $this->createLongitude(12.3456);

        $position->setLatitude($lat);

        $this->assertSame(12.3456, $position->getLatitude()->value());
        $this->assertSame(12.3456, $position->lat()->value());
    }

    /** @test */
    public function it_can_set_and_get_longitude()
    {
        $position = $this->createPosition();

        $this->assertCoordinateInstance($position->getLongitude());
        $this->assertCoordinateInstance($position->lng());

        $this->assertSame(7.0926, $position->getLongitude()->value());
        $this->assertSame(7.0926, $position->lng()->value());

        $long = $this->createLongitude(12.3456);

        $position->setLongitude($long);

        $this->assertSame(12.3456, $position->getLongitude()->value());
        $this->assertSame(12.3456, $position->lng()->value());
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $position = $this->createPosition();

        $expected = [
            'lat' => 31.7917,
            'lng' => 7.0926,
        ];

        $this->assertSame($expected, $position->toArray());
    }

    /** @test */
    public function it_can_convert_to_json()
    {
        $position = $this->createPosition();
        $expected = '{"lat":31.7917,"lng":7.0926}';

        $this->assertJson($position->toJson());

        $this->assertSame($expected, $position->toJson());
        $this->assertSame($expected, json_encode($position));
    }
}
