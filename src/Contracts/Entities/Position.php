<?php namespace Arcanedev\GeoLocation\Contracts\Entities;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

/**
 * Interface     Position
 *
 * @package  Arcanedev\GeoLocation\Contracts\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Position extends Arrayable, Jsonable, JsonSerializable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the latitude coordinate.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinate
     */
    public function getLatitude();

    /**
     * Get the latitude coordinate (alias).
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinate
     */
    public function lat();

    /**
     * Set the latitude coordinate.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinate  $latitude
     *
     * @return self
     */
    public function setLatitude(Coordinate $latitude);

    /**
     * Get the longitude coordinate.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinate
     */
    public function getLongitude();

    /**
     * Get the longitude coordinate (alias).
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinate
     */
    public function long();

    /**
     * Set the longitude coordinate.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinate  $longitude
     *
     * @return self
     */
    public function setLongitude(Coordinate $longitude);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create the position.
     *
     * @param  float  $latitude
     * @param  float  $longitude
     *
     * @return self
     */
    public static function create($latitude, $longitude);
}
