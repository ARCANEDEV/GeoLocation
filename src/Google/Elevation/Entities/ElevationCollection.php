<?php namespace Arcanedev\GeoLocation\Google\Elevation\Entities;

use Illuminate\Support\Collection;

/**
 * Class     ElevationCollection
 *
 * @package  Arcanedev\GeoLocation\Google\Elevation\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ElevationCollection extends Collection
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Load the elevations data.
     *
     * @param  array  $elevations
     *
     * @return self
     */
    public static function load(array $elevations)
    {
        $collect = new static;

        foreach ($elevations as $elevation) {
            $collect->push(new Elevation($elevation));
        }

        return $collect;
    }
}
