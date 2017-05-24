<?php namespace Arcanedev\GeoLocation\Google\Geocoding;

use Arcanedev\GeoLocation\Contracts\Entities\Position as PositionContract;
use Arcanedev\GeoLocation\Entities\Position;
use Arcanedev\GeoLocation\Google\AbstractWebService;
use GuzzleHttp\ClientInterface;

/**
 * Class     GeocodingService
 *
 * @package  Arcanedev\GeoLocation\Google\Geocoding
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @link     https://developers.google.com/maps/documentation/geocoding/intro
 */
class GeocodingService extends AbstractWebService
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const BASE_URL = 'https://maps.googleapis.com/maps/api/geocode/json';

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * GoogleDistanceMatrix constructor.
     *
     * @param  \GuzzleHttp\ClientInterface  $client
     */
    public function __construct(ClientInterface $client)
    {
        parent::__construct($client);

        $this->setKey(getenv('GOOGLE_MAPS_GEOCODING_KEY'));
    }

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
        $url = static::BASE_URL.'?'.$this->prepareQuery([
            'address' => urlencode($address)
        ]);

        $response = $this->client->request('GET', $url, $options);

        return $this->prepareResponse($response);
    }

    /**
     * Reverse geocoding (address lookup).
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $position
     * @param  array                                               $options
     *
     * @return \Arcanedev\GeoLocation\Google\Geocoding\GeocodingResponse
     */
    public function reverse(PositionContract $position, array $options = [])
    {
        $url = static::BASE_URL.'?'.$this->prepareQuery([
            'latlng' => $this->parsePosition($position),
        ]);

        $response = $this->client->request('GET', $url, $options);

        return $this->prepareResponse($response);
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
     * Get the default query params.
     *
     * @return array
     */
    protected function getDefaultQueryParams()
    {
        return [
            'key' => $this->key,
        ];
    }

    /**
     * Prepare the response.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $response
     *
     * @return \Arcanedev\GeoLocation\Google\Geocoding\GeocodingResponse
     */
    private function prepareResponse($response)
    {
        return new GeocodingResponse(
            json_decode($response->getBody(), true)
        );
    }
}
