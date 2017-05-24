<?php namespace Arcanedev\GeoLocation\Google\Directions\Entities;

use Illuminate\Support\Collection;

/**
 * Class     StepCollection
 *
 * @package  Arcanedev\GeoLocation\Google\Directions\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class StepCollection extends Collection
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Load the steps data into the collection.
     *
     * @param  array  $steps
     *
     * @return self
     */
    public static function load(array $steps)
    {
        $collect = new static();

        foreach ($steps as $step) {
            $collect->push(new Step($step));
        }
        return $collect;
    }
}
