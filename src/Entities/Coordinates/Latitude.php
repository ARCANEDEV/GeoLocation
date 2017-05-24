<?php namespace Arcanedev\GeoLocation\Entities\Coordinates;

/**
 * Class     Latitude
 *
 * @package  Arcanedev\GeoLocation\Entities\Coordinates
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Latitude extends AbstractCoordinate
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get minimum value.
     *
     * @return float
     */
    public static function getMin()
    {
        return -90.0;
    }

    /**
     * Get maximum value.
     *
     * @return float
     */
    public static function getMax()
    {
        return 90.0;
    }
}
