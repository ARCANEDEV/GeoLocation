<?php namespace Arcanedev\GeoLocation\Contracts\Entities;

/**
 * Interface     Coordinate
 *
 * @package  Arcanedev\GeoLocation\Contracts\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Coordinate
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the coordinate's value (alias).
     */
    public function value();

    /**
     * Get the coordinate's value.
     *
     * @return float
     */
    public function getValue();

    /**
     * Set the coordinate value.
     *
     * @param  float  $value
     *
     * @return self
     */
    public function setValue($value);

    /**
     * Get minimum value.
     *
     * @return float
     */
    public static function getMin();

    /**
     * Get maximum value.
     *
     * @return float
     */
    public static function getMax();
}
