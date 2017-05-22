<?php namespace Arcanedev\GeoLocation\Tests\Entities\Spheres;

use Arcanedev\GeoLocation\Entities\Spheres\Mars;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     MarsTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Entities\Spheres
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MarsTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $sphere = new Mars;

        $expectations = [
            \Arcanedev\GeoLocation\Contracts\Entities\Sphere::class,
            \Arcanedev\GeoLocation\Entities\Spheres\Mars::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $sphere);
        }
    }

    /** @test */
    public function it_can_get_radius()
    {
        $sphere = new Mars;

        $this->assertSame(3390000.0, $sphere->radius());
    }
}
