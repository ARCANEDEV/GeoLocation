<?php namespace Arcanedev\GeoLocation\Entities\Coordinates;

use Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position as PositionContract;
use Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Viewport as ViewportContract;
use Arcanedev\GeoLocation\Traits\CanBeJsonable;

/**
 * Class     Viewport
 *
 * @package  Arcanedev\GeoLocation\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Viewport implements ViewportContract
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use CanBeJsonable;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position */
    protected $northeast;

    /** @var  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position */
    protected $southwest;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Viewport constructor.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $northeast
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $southwest
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
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    public function getNorthEast()
    {
        return $this->northeast;
    }

    /**
     * Set the North/East coordinates.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $northeast
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
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    public function getSouthWest()
    {
        return $this->southwest;
    }

    /**
     * Set the South/West coordinates.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $southwest
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
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $northeast
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $southwest
     *
     * @return self
     */
    public static function create(PositionContract $northeast, PositionContract $southwest)
    {
        return new static($northeast, $southwest);
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
