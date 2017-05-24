<?php namespace Arcanedev\GeoLocation\Tests\Entities;

use Arcanedev\GeoLocation\Entities\Viewport;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     ViewportTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Entities
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
            \Arcanedev\GeoLocation\Contracts\Entities\Viewport::class,
            \Arcanedev\GeoLocation\Entities\Viewport::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $viewport);
        }
    }

    /** @test */
    public function it_can_create()
    {
        $position = $this->createPosition();
        $viewport = Viewport::create($position, $position);

        $expectations = [
            \Arcanedev\GeoLocation\Contracts\Entities\Viewport::class,
            \Arcanedev\GeoLocation\Entities\Viewport::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $viewport);
        }

        $this->assertSame($position->lat()->value(),  $viewport->getNorthEast()->lat()->value());
        $this->assertSame($position->long()->value(), $viewport->getNorthEast()->long()->value());

        $this->assertSame($position->lat()->value(),  $viewport->getSouthWest()->lat()->value());
        $this->assertSame($position->long()->value(), $viewport->getSouthWest()->long()->value());
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

        $this->assertSame($expected, $viewport->toArray());
    }

    /** @test */
    public function it_can_convert_to_json()
    {
        $position = $this->createPosition();
        $viewport = Viewport::create($position, $position);

        $expected = '{"northeast":{"latitude":31.7917,"longitude":7.0926},"southwest":{"latitude":31.7917,"longitude":7.0926}}';

        $this->assertJson($viewport->toJson());

        $this->assertSame($expected, $viewport->toJson());
        $this->assertSame($expected, json_encode($viewport));
    }
}
