<?php namespace Arcanedev\GeoLocation\Tests;

use Arcanedev\GeoLocation\Entities\Latitude;
use Arcanedev\GeoLocation\Entities\Longitude;
use Arcanedev\GeoLocation\Entities\Position;
use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class     TestCase
 *
 * @package  Arcanedev\GeoLocation\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Arcanedev\GeoLocation\GeoLocationServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            //
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        //
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create a position object.
     *
     * @return \Arcanedev\GeoLocation\Entities\Position
     */
    protected function createPosition()
    {
        return new Position(
            $this->createLatitude(),
            $this->createLongitude()
        );
    }

    /**
     * Create a latitude object.
     *
     * @param  float  $value
     *
     * @return \Arcanedev\GeoLocation\Entities\Latitude
     */
    protected function createLatitude($value = 31.7917)
    {
        return new Latitude($value);
    }

    /**
     * Create a longitude object.
     *
     * @param  float  $value
     *
     * @return \Arcanedev\GeoLocation\Entities\Longitude
     */
    protected function createLongitude($value = 7.0926)
    {
        return new Longitude($value);
    }

    /* -----------------------------------------------------------------
     |  Custom Assertions
     | -----------------------------------------------------------------
     */

    /**
     * Assert the given object is a coordinate instance.
     *
     * @param  mixed  $coordinate
     */
    protected function assertCoordinateInstance($coordinate)
    {
        $expectations = [
            \Arcanedev\GeoLocation\Contracts\Entities\Coordinate::class,
            \Arcanedev\GeoLocation\Entities\AbstractCoordinate::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $coordinate);
        }
    }
}
