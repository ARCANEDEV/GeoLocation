<?php namespace Arcanedev\GeoLocation\Google\DistanceMatrix;

use Arcanedev\GeoLocation\Contracts\Entities\Position;
use GuzzleHttp\ClientInterface;
use InvalidArgumentException;

/**
 * Class     DistanceMatrixService
 *
 * @package  Arcanedev\GeoLocation\Google\DistanceMatrix
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @link     https://developers.google.com/maps/documentation/distance-matrix/intro
 */
class DistanceMatrixService
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const BASE_URL = 'https://maps.googleapis.com/maps/api/distancematrix/json';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \GuzzleHttp\ClientInterface */
    protected $client;

    /** @var string|null */
    protected $key = null;

    /** @var string */
    protected $language = 'en';

    /** @var string */
    protected $mode = 'driving';

    /** @var string */
    protected $units = 'metric';

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
        $this->setKey(getenv('GOOGLE_MAPS_DISTANCE_MATRIX_KEY'));
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

    /**
     * Set the language.
     *
     * @param  string  $language
     *
     * @return self
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Set the mode of transport.
     *
     * @param  string  $mode
     *
     * @return self
     */
    public function setMode($mode)
    {
        $this->mode = $this->checkMode($mode);

        return $this;
    }

    /**
     * Set the unit system.
     *
     * @param  string  $units
     *
     * @return self
     */
    public function setUnits($units)
    {
        $this->units = $this->checkUnits($units);

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the distance.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $start
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $end
     * @param  array                                               $options
     *
     * @return \Arcanedev\GeoLocation\Google\DistanceMatrix\DistanceMatrixResponse
     */
    public function calculate(Position $start, Position $end, array $options = [])
    {
        // https://developers.google.com/maps/documentation/distance-matrix/intro

        $url = static::BASE_URL.'?'.$this->prepareQuery($start, $end);

        $result = $this->client->request('GET', $url, $options);

        return new DistanceMatrixResponse(
            json_decode($result->getBody(), true)
        );
    }

    /**
     * Prepare the URL query.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $start
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $end
     *
     * @return string
     */
    private function prepareQuery(Position $start, Position $end)
    {
        $queryData = array_filter([
            'origins'      => $this->parsePosition($start),
            'destinations' => $this->parsePosition($end),
            'mode'         => $this->mode,
            'language'     => $this->language,
            'units'        => $this->units,
            'key'          => $this->key,
        ]);

        return urldecode(http_build_query($queryData));
    }

    /**
     * Parse the position object.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $position
     *
     * @return string
     */
    private function parsePosition(Position $position)
    {
        return $position->lat()->value().','.$position->long()->value();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the mode of transport.
     *
     * @param  string  $mode
     *
     * @return string
     */
    private function checkMode($mode)
    {
        $mode = strtolower($mode);

        if ( ! in_array($mode, ['driving', 'walking', 'bicycling', 'transit'])) {
            throw new InvalidArgumentException(
                "The given mode of transport [{$mode}] is invalid. Please check the supported travel modes: ".
                "https://developers.google.com/maps/documentation/distance-matrix/intro#travel_modes"
            );
        }

        return $mode;
    }

    /**
     * Check the unit system.
     *
     * @param  string  $units
     *
     * @return string
     */
    private function checkUnits($units)
    {
        $units = strtolower($units);

        if ( ! in_array($units, ['metric', 'imperial'])) {
            throw new InvalidArgumentException(
                "The given unit system [{$units}] is invalid. Please check the supported units: ".
                "https://developers.google.com/maps/documentation/distance-matrix/intro#unit_systems"
            );
        }

        return $units;
    }
}
