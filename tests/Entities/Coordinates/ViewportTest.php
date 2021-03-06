<?php namespace Arcanedev\GeoLocation\Tests\Entities\Coordinates;

use Arcanedev\GeoLocation\Entities\Coordinates\Viewport;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     ViewportTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Entities\Coordinates
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewportTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $position = $this->createPosition();
        $viewport = new Viewport($position, $position);

        $expectations = [
            \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Viewport::class,
            \Arcanedev\GeoLocation\Entities\Coordinates\Viewport::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $viewport);
        }
    }

    /** @test */
    public function it_can_create()
    {
        $position = $this->createPosition();
        $viewport = Viewport::create($position, $position);

        $expectations = [
            \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Viewport::class,
            \Arcanedev\GeoLocation\Entities\Coordinates\Viewport::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $viewport);
        }

        static::assertSame($position->lat()->value(),  $viewport->getNorthEast()->lat()->value());
        static::assertSame($position->lng()->value(), $viewport->getNorthEast()->lng()->value());

        static::assertSame($position->lat()->value(),  $viewport->getSouthWest()->lat()->value());
        static::assertSame($position->lng()->value(), $viewport->getSouthWest()->lng()->value());
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $position = $this->createPosition();
        $viewport = Viewport::create($position, $position);

        $expected = [
            'northeast' => $position->toArray(),
            'southwest' => $position->toArray(),
        ];

        static::assertSame($expected, $viewport->toArray());
    }

    /** @test */
    public function it_can_convert_to_json()
    {
        $position = $this->createPosition();
        $viewport = Viewport::create($position, $position);

        $expected = '{"northeast":{"lat":31.7917,"lng":7.0926},"southwest":{"lat":31.7917,"lng":7.0926}}';

        static::assertJson($viewport->toJson());

        static::assertSame($expected, $viewport->toJson());
        static::assertSame($expected, json_encode($viewport));
    }
}
