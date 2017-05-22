<?php namespace Arcanedev\GeoLocation\Entities;

use Arcanedev\GeoLocation\Contracts\Entities\Coordinate;
use Arcanedev\GeoLocation\Contracts\Entities\Position as PositionContract;

/**
 * Class     Position
 *
 * @package  Arcanedev\GeoLocation\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Position implements PositionContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The latitude coordinate.
     *
     * @var  \Arcanedev\GeoLocation\Contracts\Entities\Coordinate
     */
    protected $latitude;

    /**
     * The longitude coordinate.
     *
     * @var  \Arcanedev\GeoLocation\Contracts\Entities\Coordinate
     */
    protected $longitude;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Position constructor.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinate  $latitude
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinate  $longitude
     */
    public function __construct(Coordinate $latitude, Coordinate $longitude)
    {
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the latitude coordinate.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinate
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Get the latitude coordinate (alias).
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinate
     */
    public function lat()
    {
        return $this->getLatitude();
    }

    /**
     * Set the latitude coordinate.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinate  $latitude
     *
     * @return self
     */
    public function setLatitude(Coordinate $latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get the longitude coordinate.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinate
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Get the longitude coordinate (alias).
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinate
     */
    public function long()
    {
        return $this->getLongitude();
    }

    /**
     * Set the longitude coordinate.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinate  $longitude
     *
     * @return self
     */
    public function setLongitude(Coordinate $longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

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
    public static function create($latitude, $longitude)
    {
        return new static(
            new Latitude($latitude),
            new Longitude($longitude)
        );
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
            'latitude'  => $this->getLatitude()->value(),
            'longitude' => $this->getLongitude()->value(),
        ];
    }
}
