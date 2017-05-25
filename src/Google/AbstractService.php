<?php namespace Arcanedev\GeoLocation\Google;

use Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class     AbstractService
 *
 * @package  Arcanedev\GeoLocation\Google
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AbstractService
{
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
     |  Common Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a GET request.
     *
     * @param  string  $url
     * @param  array   $options
     *
     * @return mixed
     */
    protected function get($url, array $options)
    {
        $response = $this->client->request('GET', $url, $options);

        return $this->prepareResponse($response);
    }

    /**
     * Prepare the URL query.
     *
     * @param  array  $params
     *
     * @return string
     */
    protected function prepareQuery(array $params)
    {
        $query = http_build_query(array_filter(
            array_merge($params, $this->getDefaultQueryParams())
        ));

        return empty($query) ? '' : '?'.$query;
    }

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
     * @return \Arcanedev\GeoLocation\Google\AbstractResponse
     */
    abstract protected function prepareResponse(ResponseInterface $response);

    /**
     * Parse the position object for the query.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $position
     *
     * @return string
     */
    protected function parsePosition(Position $position)
    {
        return $position->lat()->value().','.$position->lng()->value();
    }
}
