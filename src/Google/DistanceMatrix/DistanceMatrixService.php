<?php namespace Arcanedev\GeoLocation\Google\DistanceMatrix;

use Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position;
use Arcanedev\GeoLocation\Google\AbstractService;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class     DistanceMatrixService
 *
 * @package  Arcanedev\GeoLocation\Google\DistanceMatrix
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @link     https://developers.google.com/maps/documentation/distance-matrix/intro
 */
class DistanceMatrixService extends AbstractService
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

    /** @var string */
    protected $language = 'en';

    /** @var string */
    protected $mode = 'driving';

    /** @var string */
    protected $units = 'metric';

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

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
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $start
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $end
     * @param  array                                               $options
     *
     * @return \Arcanedev\GeoLocation\Google\DistanceMatrix\DistanceMatrixResponse
     */
    public function calculate(Position $start, Position $end, array $options = [])
    {
        $url = static::BASE_URL.$this->prepareQuery([
            'origins'      => $this->parsePosition($start),
            'destinations' => $this->parsePosition($end),
        ]);

        return $this->get($url, $options);
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
        return array_merge([
            'mode'     => $this->mode,
            'language' => $this->language,
            'units'    => $this->units,
        ], parent::getDefaultQueryParams());
    }

    /**
     * Prepare the response.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $response
     *
     * @return \Arcanedev\GeoLocation\Google\DistanceMatrix\DistanceMatrixResponse
     */
    protected function prepareResponse(ResponseInterface $response)
    {
        return new DistanceMatrixResponse(
            json_decode($response->getBody(), true)
        );
    }

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
