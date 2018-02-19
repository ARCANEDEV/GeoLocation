<?php namespace Arcanedev\GeoLocation\Google\Elevation;

use Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position as PositionContract;
use Arcanedev\GeoLocation\Google\AbstractService;
use Psr\Http\Message\ResponseInterface;

/**
 * Class     ElevationService
 *
 * @package  Arcanedev\GeoLocation\Google\Elevation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ElevationService extends AbstractService
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const BASE_URL = 'https://maps.googleapis.com/maps/api/elevation/json';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the geocoding response.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Coordinates\Position  $position
     * @param  array   $options
     *
     * @return \Arcanedev\GeoLocation\Google\Elevation\ElevationResponse
     */
    public function location(PositionContract $position, array $options = [])
    {
        $url = static::BASE_URL.$this->prepareQuery([
            'locations' => $this->parsePosition($position),
        ]);

        return $this->get($url, $options);
    }

    /**
     * Reverse geocoding (address lookup).
     *
     * @param  array  $positions
     * @param  array  $options
     *
     * @return \Arcanedev\GeoLocation\Google\Elevation\ElevationResponse
     */
    public function path(array $positions, array $options = [])
    {
        $positions = array_map(function (PositionContract $position) {
            return $this->parsePosition($position);
        }, $positions);

        $url = static::BASE_URL.$this->prepareQuery([
            'locations' => implode('|', $positions),
        ]);

        return $this->get($url, $options);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Prepare the response.
     *
     * @param  \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Arcanedev\GeoLocation\Google\AbstractResponse
     */
    protected function prepareResponse(ResponseInterface $response)
    {
        return new ElevationResponse(
            json_decode($response->getBody(), true)
        );
    }
}
