<?php namespace Arcanedev\GeoLocation\Contracts\Entities;

/**
 * Interface     Sphere
 *
 * @package  Arcanedev\GeoLocation\Contracts\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Sphere
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the radius of the sphere in meters.
     *
     * @return float
     */
    public function radius();
}
