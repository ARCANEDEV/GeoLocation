<?php namespace Arcanedev\GeoLocation\Contracts\Entities;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

/**
 * Interface     Viewport
 *
 * @package  Arcanedev\GeoLocation\Contracts\Entities
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
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Position
     */
    public function getNorthEast();

    /**
     * Set the North/East coordinates.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $northeast
     *
     * @return self
     */
    public function setNorthEast(Position $northeast);

    /**
     * Get the South/West coordinates.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Position
     */
    public function getSouthWest();

    /**
     * Set the South/West coordinates.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $southwest
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
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $northeast
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $southwest
     *
     * @return self
     */
    public static function create(Position $northeast, Position $southwest);
}
