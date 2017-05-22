<?php namespace Arcanedev\GeoLocation\Entities\Spheres;

use Arcanedev\GeoLocation\Contracts\Entities\Sphere;

/**
 * Class     AbstractSphere
 *
 * @package  Arcanedev\GeoLocation\Entities\Spheres
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AbstractSphere implements Sphere
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The radius of the sphere in meters
     *
     * @var float
     */
    protected $radius = 0.0;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the radius of the sphere in meters.
     *
     * @return float
     */
    public function radius()
    {
        return $this->radius;
    }
}
