<?php namespace Arcanedev\GeoLocation\Calculators;

use Arcanedev\GeoLocation\Contracts\Calculators\DistanceCalculator as DistanceCalculatorContract;
use Arcanedev\GeoLocation\Contracts\Entities\Position;
use Arcanedev\GeoLocation\Contracts\Entities\Sphere;
use Arcanedev\GeoLocation\Entities\Spheres\Earth;

/**
 * Class     DistanceCalculator
 *
 * @package  Arcanedev\GeoLocation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DistanceCalculator implements DistanceCalculatorContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoLocation\Contracts\Entities\Sphere */
    private $sphere;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DistanceCalculator constructor.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Sphere  $sphere
     */
    public function __construct(Sphere $sphere)
    {
        $this->sphere = $sphere;
    }

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
    public static function create($sphere = null)
    {
        return new static($sphere ?: new Earth);
    }

    /**
     * Calculate the distance between two positions.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $start
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $end
     *
     * @return \Arcanedev\GeoLocation\Contracts\Calculators\Distance
     */
    public function calculate(Position $start, Position $end)
    {
        $deltaLatitude  = deg2rad(
            $start->lat()->value() - $end->lat()->value()
        );

        $deltaLongitude = deg2rad(
            $start->long()->value() - $end->long()->value()
        );

        $angle = asin(
            sqrt(
                pow(sin($deltaLatitude * 0.5), 2)
                + cos(deg2rad($start->lat()->value()))
                * cos(deg2rad($end->lat()->value()))
                * pow(sin($deltaLongitude * 0.5), 2)
            )
        ) * 2;

        return new Distance(
            $angle * $this->sphere->radius()
        );
    }

    /**
     * Calculate the numeric distance between two positions.
     *
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $start
     * @param  \Arcanedev\GeoLocation\Contracts\Entities\Position  $end
     * @param  int                                                 $precision
     *
     * @return float
     */
    public function distance(Position $start, Position $end, $precision = 2)
    {
        return $this->calculate($start, $end)->value($precision);
    }
}
