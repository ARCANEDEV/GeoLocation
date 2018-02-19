<?php namespace Arcanedev\GeoLocation\Tests\Entities\Spheres;

use Arcanedev\GeoLocation\Entities\Spheres\Earth;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     EarthTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Entities\Spheres
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EarthTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $sphere = new Earth;

        $expectations = [
            \Arcanedev\GeoLocation\Contracts\Entities\Sphere::class,
            \Arcanedev\GeoLocation\Entities\Spheres\Earth::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $sphere);
        }
    }

    /** @test */
    public function it_can_get_radius()
    {
        $sphere = new Earth;

        static::assertSame(6371000.0, $sphere->radius());
    }
}
