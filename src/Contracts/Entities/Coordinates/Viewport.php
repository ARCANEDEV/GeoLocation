<?php namespace Arcanedev\GeoLocation\Contracts\Entities\Coordinates;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

/**
 * Interface     Viewport
 *
 * @package  Arcanedev\GeoLocation\Contracts\Entities\Coordinates
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Viewport extends Arrayable, Jsonable, JsonSerializable
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the North/East coordinates.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    public function getNorthEast();

    /**
     * Set the North/East coordinates.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $northeast
     *
     * @return self
     */
    public function setNorthEast(Position $northeast);

    /**
     * Get the South/West coordinates.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    public function getSouthWest();

    /**
     * Set the South/West coordinates.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $southwest
     *
     * @return self
     */
    public function setSouthWest(Position $southwest);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create a new viewport instance.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $northeast
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $southwest
     *
     * @return self
     */
    public static function create(Position $northeast, Position $southwest);
}
