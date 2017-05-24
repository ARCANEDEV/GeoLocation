<?php namespace Arcanedev\GeoLocation\Google\Geocoding;

use GuzzleHttp\ClientInterface;

/**
 * Class     GeocodingService
 *
 * @package  Arcanedev\GeoLocation\Google\Geocoding
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @link     https://developers.google.com/maps/documentation/geocoding/intro
 */
class GeocodingService
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const BASE_URL = 'https://maps.googleapis.com/maps/api/geocode/json';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \GuzzleHttp\ClientInterface */
    protected $client;

    /** @var string|null */
    protected $key = null;

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
        $this->setHttpClient($client);
        $this->setKey(getenv('GOOGLE_MAPS_GEOCODING_KEY'));
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the HTTP Client.
     *
     * @param  \GuzzleHttp\ClientInterface  $client
     *
     * @return self
     */
    public function setHttpClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Set the API Key.
     *
     * @param  string  $key
     *
     * @return self
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
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
        $url = static::BASE_URL.'?'.$this->prepareQuery($address);

        $result = $this->client->request('GET', $url, $options);

        return new GeocodingResponse(
            json_decode($result->getBody(), true)
        );
    }

    /**
     * Prepare the URL query.
     *
     * @param  string  $address
     *
     * @return string
     */
    private function prepareQuery($address)
    {
        $queryData = array_filter([
            'address' => urlencode($address),
            'key'     => $this->key,
        ]);

        return urldecode(http_build_query($queryData));
    }
}
