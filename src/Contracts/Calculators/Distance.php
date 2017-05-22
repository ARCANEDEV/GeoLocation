<?php namespace Arcanedev\GeoLocation\Contracts\Calculators;

/**
 * Interface     Distance
 *
 * @package  Arcanedev\GeoLocation\Contracts\Calculators
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Distance
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the length of the distance.
     *
     * @return float
     */
    public function getValue();

    /**
     * Get the rounded distance value.
     *
     * @param  int  $precision
     *
     * @return float
     */
    public function value($precision = 2);

    /**
     * Get the unit in which the length of the distance is expressed.
     *
     * @return string
     */
    public function getUnit();
}
