<?php namespace Arcanedev\GeoLocation\Google\Geocoding;

use Arcanedev\GeoLocation\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Entities\Coordinates\Viewport;
use Arcanedev\GeoLocation\Google\AbstractResponse;

/**
 * Class     GeocodingResponse
 *
 * @package  Arcanedev\GeoLocation\Google\Geocoding
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeocodingResponse extends AbstractResponse
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

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
     * @return \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position
     */
    public function getLocationPosition()
    {
        return Position::createFromArray(
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
     * @return \Arcanedev\GeoLocation\Entities\Coordinates\Viewport
     */
    public function getViewport()
    {
        return Viewport::create(
            Position::createFromArray($this->get('results.0.geometry.viewport.northeast', [])),
            Position::createFromArray($this->get('results.0.geometry.viewport.southwest', []))
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
}
