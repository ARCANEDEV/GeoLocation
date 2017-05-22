<?php namespace Arcanedev\GeoLocation\Contracts\Calculators;

use Arcanedev\GeoLocation\Contracts\Entities\Position;

/**
 * Interface     DistanceCalculator
 *
 * @package  Arcanedev\GeoLocation\Contracts\Calculators
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface DistanceCalculator
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create a metric distance calculator, using earth as base sphere.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Sphere|null  $sphere
     *
     * @return self
     */
    public static function create($sphere = null);

    /**
     * Calculate the distance between two positions.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $start
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $end
     *
     * @return \Arcanedev\GeoLocation\Contracts\Calculators\Distance
     */
    public function calculate(Position $start, Position $end);

    /**
     * Calculate the numeric distance between two positions.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $start
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $end
     * @param  int                                                 $precision
     *
     * @return float
     */
    public function distance(Position $start, Position $end, $precision = 2);
}
