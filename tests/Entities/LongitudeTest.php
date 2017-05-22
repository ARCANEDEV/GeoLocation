<?php namespace Arcanedev\GeoLocation\Tests\Entities;

use Arcanedev\GeoLocation\Entities\Longitude;

/**
 * Class     LongitudeTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LongitudeTest extends AbstractCoordinateTest
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $long = $this->createLongitude();

        $this->assertCoordinateInstance($long);
        $this->assertInstanceOf(\Arcanedev\GeoLocation\Entities\Longitude::class, $long);
    }

    /** @test */
    public function it_can_get_and_set_value()
    {
        $long  = $this->createLongitude();
        $value = 7.0926;

        $this->assertSame($value, $long->getValue());
        $this->assertSame($value, $long->value());

        $long->setValue(0);

        $this->assertSame(0.0, $long->getValue());
        $this->assertSame(0.0, $long->value());
    }

    /** @test */
    public function it_can_get_min_and_max_values()
    {
        $this->assertSame(-180.0, Longitude::getMin());
        $this->assertSame(180.0, Longitude::getMax());
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
