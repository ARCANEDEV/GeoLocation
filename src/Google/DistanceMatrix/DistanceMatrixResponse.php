<?php namespace Arcanedev\GeoLocation\Google\DistanceMatrix;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use JsonSerializable;

class DistanceMatrixResponse implements Arrayable, Jsonable, JsonSerializable
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
     * Get the first origin address.
     *
     * @return string|null
     */
    public function getOriginAddress()
    {
        return Arr::first($this->getOriginAddresses(), null, null);
    }

    /**
     * Get the original addresses.
     *
     * @return array
     */
    public function getOriginAddresses()
    {
        return $this->get('origin_addresses', []);
    }

    /**
     * Get the first destination address.
     *
     * @return string|null
     */
    public function getDestinationAddress()
    {
        return Arr::first($this->getDestinationAddresses(), null, null);
    }

    /**
     * Get the destination addresses.
     *
     * @return array
     */
    public function getDestinationAddresses()
    {
        return $this->get('destination_addresses', []);
    }

    /**
     * Get the distance (text or value).
     *
     * @param  bool  $text
     *
     * @return string|int
     */
    public function getDistance($text = true)
    {
        return $this->get('rows.0.elements.0.distance.'. ($text ? 'text' : 'value'));
    }

    /**
     * Get the duration (text or value).
     *
     * @param  bool  $text
     *
     * @return string|int
     */
    public function getDuration($text = true)
    {
        return $this->get('rows.0.elements.0.duration.'. ($text ? 'text' : 'value'));
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
            'origin'      => $this->getOriginAddress(),
            'destination' => $this->getDestinationAddress(),
            'distance'    => [
                'text'  => $this->getDistance(),
                'value' => $this->getDistance(false),
            ],
            'duration'    => [
                'text'  => $this->getDuration(),
                'value' => $this->getDuration(false),
            ],
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
}
