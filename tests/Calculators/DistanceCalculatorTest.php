<?php namespace Arcanedev\GeoLocation\Tests\Calculators;

use Arcanedev\GeoLocation\Calculators\DistanceCalculator;
use Arcanedev\GeoLocation\Entities\Position;
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
            $this->assertInstanceOf($expected, $calculator);
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
            $this->assertInstanceOf($expected, $calculator);
        }
    }

    /** @test */
    public function it_can_calculate()
    {
        $calc  = DistanceCalculator::create();
        $start = Position::create(31.7917,7.0926);  // Morocco
        $end   = Position::create(46.2276, 2.2137); // France

        $this->assertSame(0.0, $calc->calculate($start, $start)->getValue());

        $this->assertSame(1658771.9796656023, $calc->calculate($start, $end)->getValue());
        $this->assertSame(1658771.98, $calc->calculate($start, $end)->value());

        $this->assertSame(1658771.9796656023, $calc->calculate($end, $start)->getValue());
        $this->assertSame(1658771.98, $calc->calculate($end, $start)->value());
    }

    /** @test */
    public function it_can_calculate_rounded_distance()
    {
        $calc  = DistanceCalculator::create();
        $start = Position::create(31.7917,7.0926);  // Morocco
        $end   = Position::create(46.2276, 2.2137); // France

        $this->assertSame(1658771.98, $calc->distance($start, $end));
        $this->assertSame(1658771.98, $calc->distance($end, $start));

        $this->assertSame(1658772.0, $calc->distance($start, $end, 0));
        $this->assertSame(1658772.0, $calc->distance($end, $start, 0));
    }
}
