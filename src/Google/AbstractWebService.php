<?php namespace Arcanedev\GeoLocation\Google;

use Arcanedev\GeoLocation\Contracts\Entities\Position;
use GuzzleHttp\ClientInterface;

/**
 * Class     AbstractWebService
 *
 * @package  Arcanedev\GeoLocation\Google
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AbstractWebService
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
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Prepare the URL query.
     *
     * @param  array  $params
     *
     * @return string
     */
    protected function prepareQuery(array $params)
    {
        $params = array_merge($params, $this->getDefaultQueryParams());

        return http_build_query(array_filter($params));
    }

    /**
     * Get the default query params.
     *
     * @return array
     */
    abstract protected function getDefaultQueryParams();

    /**
     * Parse the position object for the query.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $position
     *
     * @return string
     */
    protected function parsePosition(Position $position)
    {
        return $position->lat()->value().','.$position->long()->value();
    }
}
