<?php namespace Arcanedev\GeoLocation\Google\Directions;

use Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Google\AbstractService;
use Psr\Http\Message\ResponseInterface;

/**
 * Class     DirectionsService
 *
 * @package  Arcanedev\GeoLocation\Google\Directions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @link     https://developers.google.com/maps/documentation/directions/intro
 */
class DirectionsService extends AbstractService
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const BASE_URL = 'https://maps.googleapis.com/maps/api/directions/json';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Start point.
     *
     * @var string
     */
    protected $origin;

    /**
     * End point.
     *
     * @var string
     */
    protected $destination;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the start point.
     *
     * @param  string  $origin
     *
     * @return self
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Set the origin point with an address (alias).
     *
     * @param  string  $address
     *
     * @return self
     */
    public function from($address)
    {
        return $this->setOrigin($address);
    }

    /**
     * Set the origin point with position object.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $position
     *
     * @return self
     */
    public function fromPosition(Position $position)
    {
        return $this->fromCoordinates(
            $position->lat()->value(),
            $position->lng()->value()
        );
    }

    /**
     * Set the origin point with coordinates.
     *
     * @param  float  $lat
     * @param  float  $long
     *
     * @return self
     */
    public function fromCoordinates($lat, $long)
    {
        return $this->setOrigin("{$lat},{$long}");
    }

    /**
     * Set the origin point with place id.
     *
     * @param  string  $placeId
     *
     * @return self
     */
    public function fromPlace($placeId)
    {
        return $this->setOrigin("place_id:{$placeId}");
    }

    /**
     * Set the end point.
     *
     * @param  string  $destination
     *
     * @return self
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Set the destination point with an address.
     *
     * @param  string  $address
     *
     * @return self
     */
    public function to($address)
    {
        return $this->setDestination($address);
    }

    /**
     * Set the destination point with position object.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $position
     *
     * @return self
     */
    public function toPosition(Position $position)
    {
        return $this->toCoordinates(
            $position->lat()->value(),
            $position->lng()->value()
        );
    }

    /**
     * Set the destination point with coordinates.
     *
     * @param  float  $lat
     * @param  float  $long
     *
     * @return self
     */
    public function toCoordinates($lat, $long)
    {
        return $this->setDestination("{$lat},{$long}");
    }

    /**
     * Set the destination point with place id.
     *
     * @param  string  $placeId
     *
     * @return self
     */
    public function toPlace($placeId)
    {
        return $this->setDestination("place_id:{$placeId}");
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the directions.
     *
     * @param  array  $options
     *
     * @return \Arcanedev\GeoLocation\Google\Directions\DirectionsResponse
     */
    public function directions(array $options = [])
    {
        $url = static::BASE_URL.$this->prepareQuery([
            'origin'      => $this->origin,
            'destination' => $this->destination,
        ]);

        return $this->get($url, $options);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Prepare the response.
     *
     * @param  \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Arcanedev\GeoLocation\Google\Directions\DirectionsResponse
     */
    protected function prepareResponse(ResponseInterface $response)
    {
        return new DirectionsResponse(
            json_decode($response->getBody(), true)
        );
    }
}
