<?php namespace Arcanedev\GeoLocation\Tests\Calculators;

use Arcanedev\GeoLocation\Calculators\Distance;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     DistanceTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Calculators
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DistanceTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $distance = new Distance(0);

        $expectations = [
            \Arcanedev\GeoLocation\Contracts\Calculators\Distance::class,
            \Arcanedev\GeoLocation\Calculators\Distance::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $distance);
        }
    }

    /** @test */
    public function it_can_get_value()
    {
        $distance = new Distance($value = 1234.5678);

        $this->assertSame($value, $distance->getValue());
    }

    /** @test */
    public function it_can_get_rounded_value()
    {
        $distance = new Distance($value = 1234.5678);

        $this->assertSame(1234.57, $distance->value());

        $this->assertSame(1235.0, $distance->value(0));
        $this->assertSame(1234.568, $distance->value(3));
    }

    /** @test */
    public function it_can_get_default_unit()
    {
        $distance = new Distance(0);

        $this->assertSame('meters', $distance->getUnit());
    }
}
