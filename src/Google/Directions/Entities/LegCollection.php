<?php namespace Arcanedev\GeoLocation\Google\Directions\Entities;

use Illuminate\Support\Collection;

/**
 * Class     LegCollection
 *
 * @package  Arcanedev\GeoLocation\Google\Directions\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LegCollection extends Collection
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Load the legs data.
     *
     * @param  array  $legs
     *
     * @return self
     */
    public static function load(array $legs)
    {
        $collect = new static;

        foreach ($legs as $leg) {
            $collect->push(new Leg($leg));
        }

        return $collect;
    }
}
