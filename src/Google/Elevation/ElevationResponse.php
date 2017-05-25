<?php namespace Arcanedev\GeoLocation\Google\Elevation;

use Arcanedev\GeoLocation\Google\AbstractResponse;

/**
 * Class     ElevationResponse
 *
 * @package  Arcanedev\GeoLocation\Google\Elevation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ElevationResponse extends AbstractResponse
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The elevations collection.
     *
     * @var \Arcanedev\GeoLocation\Google\Elevation\Entities\ElevationCollection
     */
    protected $elevations;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the elevations collection.
     *
     * @return \Arcanedev\GeoLocation\Google\Elevation\Entities\ElevationCollection
     */
    public function elevations()
    {
        if (is_null($this->elevations)) {
            $this->elevations = Entities\ElevationCollection::load(
                $this->get('results', [])
            );
        }

        return $this->elevations;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->elevations()->toArray();
    }
}
