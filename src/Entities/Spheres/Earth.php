<?php namespace Arcanedev\GeoLocation\Entities\Spheres;

/**
 * Class     Earth
 *
 * @package  Arcanedev\GeoLocation\Entities\Spheres
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Earth extends AbstractSphere
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
    protected $radius = 6371000.0;
}
