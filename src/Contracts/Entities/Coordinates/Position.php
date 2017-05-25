<?php namespace Arcanedev\GeoLocation\Contracts\Entities\Coordinates;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

/**
 * Interface     Position
 *
 * @package  Arcanedev\GeoLocation\Contracts\Entities\Coordinates
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
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate
     */
    public function getLatitude();

    /**
     * Get the latitude coordinate (alias).
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate
     */
    public function lat();

    /**
     * Set the latitude coordinate.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate  $latitude
     *
     * @return self
     */
    public function setLatitude(Coordinate $latitude);

    /**
     * Get the longitude coordinate.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate
     */
    public function getLongitude();

    /**
     * Get the longitude coordinate (alias).
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate
     */
    public function lng();

    /**
     * Set the longitude coordinate.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate  $longitude
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

    /**
     * Create position instance from array.
     *
     * @param  array  $location
     *
     * @return self
     */
    public static function createFromArray(array $location);
}
