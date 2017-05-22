<?php namespace Arcanedev\GeoLocation\Tests\Entities;

use Arcanedev\GeoLocation\Entities\Latitude;

/**
 * Class     LatitudeTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LatitudeTest extends AbstractCoordinateTest
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $lat = $this->createLatitude();

        $this->assertCoordinateInstance($lat);
        $this->assertInstanceOf(\Arcanedev\GeoLocation\Entities\Latitude::class, $lat);
    }

    /** @test */
    public function it_can_get_and_set_value()
    {
        $lat   = $this->createLatitude();
        $value = 31.7917;

        $this->assertSame($value, $lat->getValue());
        $this->assertSame($value, $lat->value());

        $lat->setValue(0);

        $this->assertSame(0.0, $lat->getValue());
        $this->assertSame(0.0, $lat->value());
    }

    /** @test */
    public function it_can_get_min_and_max_values()
    {
        $this->assertSame(-90.0, Latitude::getMin());
        $this->assertSame(90.0, Latitude::getMax());
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\GeoLocation\Exceptions\InvalidCoordinateException
     * @expectedExceptionMessage  The coordinate value must be numeric.
     */
    public function it_must_throw_exception_on_invalid_value_type()
    {
        $this->createLatitude('Hello');
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\GeoLocation\Exceptions\InvalidCoordinateException
     * @expectedExceptionMessage  The coordinate value must be between `-90` & `90`, `9000` was given.
     */
    public function it_must_throw_exception_on_invalid_value_boundaries()
    {
        $this->createLatitude(9000);
    }
}
