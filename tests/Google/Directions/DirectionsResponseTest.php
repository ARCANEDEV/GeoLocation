<?php namespace Arcanedev\GeoLocation\Tests\Google\Directions;

use Arcanedev\GeoLocation\Google\Directions\DirectionsResponse;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     DirectionsResponseTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Google\Directions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DirectionsResponseTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $response = new DirectionsResponse;
        $expectations = [
            \Illuminate\Contracts\Support\Arrayable::class,
            \Illuminate\Contracts\Support\Jsonable::class,
            \JsonSerializable::class,
            \Arcanedev\GeoLocation\Google\AbstractResponse::class,
            \Arcanedev\GeoLocation\Google\Directions\DirectionsResponse::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $response);
        }

        static::assertFalse($response->isOk());
    }

    /** @test */
    public function it_can_get_data()
    {
        $response = $this->createResponse();

        static::assertTrue($response->isOk());

        static::assertCount(1, $response->getRoutes());

        /** @var \Arcanedev\GeoLocation\Google\Directions\Entities\Route $route */
        $route = $response->getRoutes()->first();

        static::assertSame('A6 and A7', $route->summary());
        static::assertSame('Map data ©2017 Google', $route->copyrights());
        static::assertInstanceOf(
            \Arcanedev\GeoLocation\Entities\Coordinates\Viewport::class,
            $route->bounds()
        );

        $legs = $route->legs();

        static::assertCount(1, $legs);

        /** @var  \Arcanedev\GeoLocation\Google\Directions\Entities\Leg  $leg */
        $leg = $legs->first();

        static::assertSame('Paris, France', $leg->startAddress());
        static::assertInstanceOf(\Arcanedev\GeoLocation\Entities\Coordinates\Position::class, $leg->startLocation());

        static::assertSame('Marseille, France', $leg->endAddress());
        static::assertInstanceOf(\Arcanedev\GeoLocation\Entities\Coordinates\Position::class, $leg->endLocation());

        static::assertInstanceOf(\Arcanedev\GeoLocation\Entities\Measures\Distance::class, $leg->distance());
        static::assertInstanceOf(\Arcanedev\GeoLocation\Entities\Measures\Duration::class, $leg->duration());
        static::assertSame([], $leg->trafficSpeedEntry());
        static::assertSame([], $leg->viaWaypoint());

        $steps = $leg->steps();

        static::assertCount(39, $steps);

        /** @var  \Arcanedev\GeoLocation\Google\Directions\Entities\Step  $step */
        $step = $steps->first();

        static::assertInstanceOf(\Arcanedev\GeoLocation\Entities\Coordinates\Position::class, $step->start());
        static::assertInstanceOf(\Arcanedev\GeoLocation\Entities\Coordinates\Position::class, $step->end());
        static::assertInstanceOf(\Arcanedev\GeoLocation\Entities\Measures\Distance::class, $step->distance());
        static::assertInstanceOf(\Arcanedev\GeoLocation\Entities\Measures\Duration::class, $step->duration());
        static::assertSame('DRIVING', $step->mode());
        static::assertSame(
            'Head <b>west</b> on <b>Rue de Rivoli</b> toward <b>Quai de l\'Hôtel de ville</b>',
            $step->instructions()
        );
        static::assertSame(["points" => "cmeiHmmjMCPGt@Kr@O|@Mh@"], $step->polyline());
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $response = $this->createResponse();

        static::assertArrayHasKey('geocoded_waypoints', $response->toArray());
        static::assertArrayHasKey('routes', $response->toArray());
    }

    /** @test */
    public function it_can_convert_to_json()
    {
        $response = $this->createResponse();

        static::assertJson($response->toJson());
        static::assertJson(json_encode($response));
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create the directions response.
     *
     * @return \Arcanedev\GeoLocation\Google\Directions\DirectionsResponse
     */
    private function createResponse()
    {
        return new DirectionsResponse(
            $this->getFixtureResponseData()
        );
    }

    /**
     * Get the json response (fixture).
     *
     * @param  string  $filename
     *
     * @return array
     */
    protected function getFixtureResponseData($filename = 'paris-to-marseille-directions')
    {
        $path = $this->getFixturePath() . "/google/directions/{$filename}.json";

        return json_decode(file_get_contents($path), true);
    }
}
