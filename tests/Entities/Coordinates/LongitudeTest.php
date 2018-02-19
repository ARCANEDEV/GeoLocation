<?php namespace Arcanedev\GeoLocation\Tests\Entities\Coordinates;

use Arcanedev\GeoLocation\Entities\Coordinates\Longitude;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     LongitudeTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Entities\Coordinates
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LongitudeTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $long = $this->createLongitude();

        static::assertCoordinateInstance($long);
        static::assertInstanceOf(\Arcanedev\GeoLocation\Entities\Coordinates\Longitude::class, $long);
    }

    /** @test */
    public function it_can_get_and_set_value()
    {
        $long  = $this->createLongitude();
        $value = 7.0926;

        static::assertSame($value, $long->getValue());
        static::assertSame($value, $long->value());

        $long->setValue(0);

        static::assertSame(0.0, $long->getValue());
        static::assertSame(0.0, $long->value());
    }

    /** @test */
    public function it_can_get_min_and_max_values()
    {
        static::assertSame(-180.0, Longitude::getMin());
        static::assertSame(180.0, Longitude::getMax());
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\GeoLocation\Exceptions\InvalidCoordinateException
     * @expectedExceptionMessage  The coordinate value must be numeric.
     */
    public function it_must_throw_exception_on_invalid_value_type()
    {
        $this->createLongitude('Hello');
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\GeoLocation\Exceptions\InvalidCoordinateException
     * @expectedExceptionMessage  The coordinate value must be between `-180` & `180`, `9000` was given.
     */
    public function it_must_throw_exception_on_invalid_value_boundaries()
    {
        $this->createLongitude(9000);
    }
}
