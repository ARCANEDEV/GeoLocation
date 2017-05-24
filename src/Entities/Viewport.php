<?php namespace Arcanedev\GeoLocation\Entities;

use Arcanedev\GeoLocation\Contracts\Entities\Position as PositionContract;
use Arcanedev\GeoLocation\Contracts\Entities\Viewport as ViewportContract;

/**
 * Class     Viewport
 *
 * @package  Arcanedev\GeoLocation\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Viewport implements ViewportContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoLocation\Contracts\Entities\Position */
    protected $northeast;

    /** @var  \Arcanedev\GeoLocation\Contracts\Entities\Position */
    protected $southwest;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Viewport constructor.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $northeast
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $southwest
     */
    public function __construct(PositionContract $northeast, PositionContract $southwest)
    {
        $this->setNorthEast($northeast)->setSouthWest($southwest);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the North/East coordinates.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Position
     */
    public function getNorthEast()
    {
        return $this->northeast;
    }

    /**
     * Set the North/East coordinates.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $northeast
     *
     * @return self
     */
    public function setNorthEast(PositionContract $northeast)
    {
        $this->northeast = $northeast;

        return $this;
    }

    /**
     * Get the South/West coordinates.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Position
     */
    public function getSouthWest()
    {
        return $this->southwest;
    }

    /**
     * Set the South/West coordinates.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $southwest
     *
     * @return self
     */
    public function setSouthWest(PositionContract $southwest)
    {
        $this->southwest = $southwest;

        return $this;
    }

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
    public static function create(PositionContract $northeast, PositionContract $southwest)
    {
        return new static($northeast, $southwest);
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     *
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'northeast' => $this->northeast->toArray(),
            'southwest' => $this->southwest->toArray(),
        ];
    }
}
