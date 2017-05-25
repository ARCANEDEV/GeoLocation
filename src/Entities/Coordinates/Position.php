<?php namespace Arcanedev\GeoLocation\Entities\Coordinates;

use Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate;
use Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position as PositionContract;
use Arcanedev\GeoLocation\Entities\Coordinates\Latitude;
use Arcanedev\GeoLocation\Entities\Coordinates\Longitude;
use Arcanedev\GeoLocation\Traits\CanBeJsonable;

/**
 * Class     Position
 *
 * @package  Arcanedev\GeoLocation\Entities\Coordinates
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Position implements PositionContract
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

    /**
     * The latitude coordinate.
     *
     * @var  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate
     */
    protected $latitude;

    /**
     * The longitude coordinate.
     *
     * @var  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate
     */
    protected $longitude;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Position constructor.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate  $latitude
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate  $longitude
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
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Get the latitude coordinate (alias).
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate
     */
    public function lat()
    {
        return $this->getLatitude();
    }

    /**
     * Set the latitude coordinate.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate  $latitude
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
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Get the longitude coordinate (alias).
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate
     */
    public function lng()
    {
        return $this->getLongitude();
    }

    /**
     * Set the longitude coordinate.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Coordinate  $longitude
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
     * Create position instance from array.
     *
     * @param  array  $location
     *
     * @return self
     */
    public static function createFromArray(array $location)
    {
        return static::create($location['lat'], $location['lng']);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'lat' => $this->getLatitude()->value(),
            'lng' => $this->getLongitude()->value(),
        ];
    }
}
