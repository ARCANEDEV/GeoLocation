<?php namespace Arcanedev\GeoLocation\Google\DistanceMatrix;

use Arcanedev\GeoLocation\Entities\Measures\Distance;
use Arcanedev\GeoLocation\Entities\Measures\Duration;
use Arcanedev\GeoLocation\Google\AbstractResponse;
use Illuminate\Support\Arr;

/**
 * Class     DistanceMatrixResponse
 *
 * @package  Arcanedev\GeoLocation\Google\DistanceMatrix
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DistanceMatrixResponse extends AbstractResponse
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

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
    public function distance($text = true)
    {
        return $text
            ? $this->getDistance()->text()
            : $this->getDistance()->value();
    }

    /**
     * Get the distance.
     *
     * @return \Arcanedev\GeoLocation\Entities\Measures\Distance
     */
    public function getDistance()
    {
        return Distance::makeFromArray(
            $this->get('rows.0.elements.0.distance')
        );
    }

    /**
     * Get the duration (text or value).
     *
     * @param  bool  $text
     *
     * @return string|int
     */
    public function duration($text = true)
    {
        return $text
            ? $this->getDuration()->text()
            : $this->getDuration()->value();
    }

    /**
     * Get the duration (text or value).
     *
     * @return \Arcanedev\GeoLocation\Entities\Measures\Duration
     */
    public function getDuration()
    {
        return Duration::makeFromArray(
            $this->get('rows.0.elements.0.duration')
        );
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

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
            'distance'    => $this->getDistance()->toArray(),
            'duration'    => $this->getDuration()->toArray(),
        ];
    }
}
