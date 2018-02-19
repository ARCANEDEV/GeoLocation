<?php namespace Arcanedev\GeoLocation\Google\Geocoding;

use Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position as PositionContract;
use Arcanedev\GeoLocation\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Google\AbstractService;
use Psr\Http\Message\ResponseInterface;

/**
 * Class     GeocodingService
 *
 * @package  Arcanedev\GeoLocation\Google\Geocoding
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @link     https://developers.google.com/maps/documentation/geocoding/intro
 */
class GeocodingService extends AbstractService
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const BASE_URL = 'https://maps.googleapis.com/maps/api/geocode/json';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the geocoding response.
     *
     * @param  string  $address
     * @param  array   $options
     *
     * @return \Arcanedev\GeoLocation\Google\Geocoding\GeocodingResponse
     */
    public function geocode($address, array $options = [])
    {
        $url = static::BASE_URL.$this->prepareQuery([
            'address' => urlencode($address)
        ]);

        return $this->get($url, $options);
    }

    /**
     * Reverse geocoding (address lookup).
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $position
     * @param  array                                               $options
     *
     * @return \Arcanedev\GeoLocation\Google\Geocoding\GeocodingResponse
     */
    public function reverse(PositionContract $position, array $options = [])
    {
        $url = static::BASE_URL.$this->prepareQuery([
            'latlng' => $this->parsePosition($position),
        ]);

        return $this->get($url, $options);
    }

    /**
     * Reverse geocoding (address lookup & simplified).
     *
     * @param  float  $lat
     * @param  float  $long
     * @param  array  $options
     *
     * @return \Arcanedev\GeoLocation\Google\Geocoding\GeocodingResponse
     */
    public function reversePosition($lat, $long, array $options = [])
    {
        return $this->reverse(Position::create($lat, $long), $options);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Prepare the response.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $response
     *
     * @return \Arcanedev\GeoLocation\Google\Geocoding\GeocodingResponse
     */
    protected function prepareResponse(ResponseInterface $response)
    {
        return new GeocodingResponse(
            json_decode($response->getBody(), true)
        );
    }
}
