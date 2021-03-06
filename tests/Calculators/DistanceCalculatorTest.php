<?php namespace Arcanedev\GeoLocation\Tests\Calculators;

use Arcanedev\GeoLocation\Calculators\DistanceCalculator;
use Arcanedev\GeoLocation\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Entities\Spheres\Earth;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     DistanceCalculatorTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Calculators
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DistanceCalculatorTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $calculator = new DistanceCalculator(new Earth);

        $expectations = [
            \Arcanedev\GeoLocation\Contracts\Calculators\DistanceCalculator::class,
            \Arcanedev\GeoLocation\Calculators\DistanceCalculator::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $calculator);
        }
    }

    /** @test */
    public function it_can_create_calculator()
    {
        $calculator = DistanceCalculator::create();

        $expectations = [
            \Arcanedev\GeoLocation\Contracts\Calculators\DistanceCalculator::class,
            \Arcanedev\GeoLocation\Calculators\DistanceCalculator::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $calculator);
        }
    }

    /** @test */
    public function it_can_calculate()
    {
        $calc  = DistanceCalculator::create();
        $start = Position::create(31.7917,7.0926);  // Morocco
        $end   = Position::create(46.2276, 2.2137); // France

        $expected = 0.0;

        static::assertSame($expected, $calc->calculate($start, $start)->getValue());
        static::assertSame($expected, $calc->calculate($start, $start)->value());

        static::assertSame($expected, $calc->calculate($end, $end)->getValue());
        static::assertSame($expected, $calc->calculate($end, $end)->value());

        $expected = 1658771.9796656023;

        static::assertSame($expected, $calc->calculate($start, $end)->getValue());
        static::assertSame($expected, $calc->calculate($start, $end)->value());

        static::assertSame($expected, $calc->calculate($end, $start)->getValue());
        static::assertSame($expected, $calc->calculate($end, $start)->value());
    }

    /** @test */
    public function it_can_calculate_rounded_distance()
    {
        $calc  = DistanceCalculator::create();
        $start = Position::create(31.7917,7.0926);  // Morocco
        $end   = Position::create(46.2276, 2.2137); // France

        static::assertSame(1658771.98, $calc->distance($start, $end));
        static::assertSame(1658771.98, $calc->distance($end, $start));

        static::assertSame(1658772.0, $calc->distance($start, $end, 0));
        static::assertSame(1658772.0, $calc->distance($end, $start, 0));
    }
}
