<?php namespace Arcanedev\GeoLocation\Google\Geocoding;

use Arcanedev\GeoLocation\Entities\Position;
use Arcanedev\GeoLocation\Entities\Viewport;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use JsonSerializable;

/**
 * Class     GeocodingResponse
 *
 * @package  Arcanedev\GeoLocation\Google\Geocoding
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeocodingResponse implements Arrayable, Jsonable, JsonSerializable
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The response's data.
     *
     * @var  array
     */
    protected $data = [];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DistanceMatrixResponse constructor.
     *
     * @param  array  $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the raw response.
     *
     * @return array
     */
    public function getRaw()
    {
        return $this->data;
    }

    /**
     * Get a data with a given key.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return Arr::get($this->getRaw(), $key, $default);
    }

    /**
     * Get the formatted address.
     *
     * @return string|null
     */
    public function getFormattedAddress()
    {
        return $this->get('results.0.formatted_address');
    }

    /**
     * Get the separate address components.
     *
     * @return array
     */
    public function getAddressComponents()
    {
        return $this->get('results.0.address_components', []);
    }

    /**
     * Get the location's position.
     *
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Position
     */
    public function getLocationPosition()
    {
        return $this->createPosition(
            $this->get('results.0.geometry.location', [])
        );
    }

    /**
     * Get the location's type.
     *
     * @return string
     */
    public function getLocationType()
    {
        return $this->get('results.0.geometry.location_type');
    }

    /**
     * Get the viewport coordinates.
     *
     * @return \Arcanedev\GeoLocation\Entities\Viewport
     */
    public function getViewport()
    {
        return Viewport::create(
            $this->createPosition($this->get('results.0.geometry.viewport.northeast', [])),
            $this->createPosition($this->get('results.0.geometry.viewport.southwest', []))
        );
    }

    /**
     * Get the place id.
     *
     * @return string|null
     */
    public function getPlaceId()
    {
        return $this->get('results.0.place_id');
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

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
     * Convert the object to array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'formatted_address'  => $this->getFormattedAddress(),
            'address_components' => $this->getAddressComponents(),
            'location_position'  => $this->getLocationPosition()->toArray(),
            'location_type'      => $this->getLocationType(),
            'viewport'           => $this->getViewport()->toArray(),
            'place_id'           => $this->getPlaceId(),
        ];
    }

    /**
     * Check if the response's status is OK.
     *
     * @return bool
     */
    public function isOk()
    {
        return $this->get('status') === 'OK';
    }

    /**
     * Create the position instance.
     *
     * @param  array  $coordinates
     *
     * @return \Arcanedev\GeoLocation\Entities\Position
     */
    protected function createPosition(array $coordinates)
    {
        return Position::create(
            Arr::get($coordinates, 'lat', 0.0),
            Arr::get($coordinates, 'lng', 0.0)
        );
    }
}
