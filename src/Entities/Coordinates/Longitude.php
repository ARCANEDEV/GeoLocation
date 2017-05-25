<?php namespace Arcanedev\GeoLocation\Entities\Coordinates;

/**
 * Class     Longitude
 *
 * @package  Arcanedev\GeoLocation\Entities\Coordinates
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Longitude extends AbstractCoordinate
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    /**
     * Get minimum value.
     *
     * @return float
     */
    public static function getMin()
    {
        return -180.0;
    }

    /**
     * Get maximum value.
     *
     * @return float
     */
    public static function getMax()
    {
        return 180.0;
    }
}
