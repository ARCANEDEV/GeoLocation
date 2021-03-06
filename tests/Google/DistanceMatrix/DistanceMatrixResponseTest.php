<?php namespace Arcanedev\GeoLocation\Tests\Google\DistanceMatrix;

use Arcanedev\GeoLocation\Google\DistanceMatrix\DistanceMatrixResponse;
use Arcanedev\GeoLocation\Tests\TestCase;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class     DistanceMatrixResponseTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Google\DistanceMatrix
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DistanceMatrixResponseTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoLocation\Google\DistanceMatrix\DistanceMatrixResponse */
    protected $response;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    protected function setUp()
    {
        parent::setUp();

        $this->response = new DistanceMatrixResponse(
            $this->getServiceResponse()
        );
    }

    protected function tearDown()
    {
        unset($this->response);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Illuminate\Contracts\Support\Arrayable::class,
            \Illuminate\Contracts\Support\Jsonable::class,
            \JsonSerializable::class,
            \Arcanedev\GeoLocation\Google\AbstractResponse::class,
            \Arcanedev\GeoLocation\Google\DistanceMatrix\DistanceMatrixResponse::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->response);
        }
    }

    /** @test */
    public function it_can_get_raw_data()
    {
        static::assertSame($this->getServiceResponse(), $this->response->getRaw());
    }

    /** @test */
    public function it_can_get_original_addresses()
    {
        $expected = '17 Hudson River Waterfront Walk, Jersey City, NJ 07305, USA';

        static::assertSame([$expected], $this->response->getOriginAddresses());
        static::assertSame($expected, $this->response->getOriginAddress());
    }

    /** @test */
    public function it_can_get_destination_addresses()
    {
        $expected = 'Mount Lee Dr, Los Angeles, CA 90068, USA';

        static::assertSame([$expected], $this->response->getDestinationAddresses());
        static::assertSame($expected, $this->response->getDestinationAddress());
    }

    /** @test */
    public function it_can_get_distance()
    {
        static::assertSame('4,508 km', $this->response->distance());
        static::assertSame(4508227, $this->response->distance(false));
    }

    /** @test */
    public function it_can_get_duration()
    {
        static::assertSame('1 day 17 hours', $this->response->duration());
        static::assertSame(146292, $this->response->duration(false));
    }

    /** @test */
    public function it_can_check_if_response_is_ok()
    {
        static::assertTrue($this->response->isOk());

        $this->response = new DistanceMatrixResponse([]);

        static::assertFalse($this->response->isOk());
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $expected = $this->expectedArray();

        static::assertSame($expected, $this->response->toArray());
    }

    /** @test */
    public function it_can_convert_to_json()
    {
        $json = json_encode($this->response);

        static::assertJson($json);
        static::assertSame(json_encode($this->expectedArray()), $json);

        $json = $this->response->toJson();

        static::assertJson($json);
        static::assertSame(json_encode($this->expectedArray()), $json);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    public function getServiceResponse()
    {
        return [
            'destination_addresses' => [
                'Mount Lee Dr, Los Angeles, CA 90068, USA',
            ],
            'origin_addresses' => [
                '17 Hudson River Waterfront Walk, Jersey City, NJ 07305, USA',
            ],
            'rows' => [
                [
                    'elements' => [
                        [
                            'distance' => [
                                'text' => '4,508 km',
                                'value' => 4508227,
                            ],
                            'duration' => [
                                'text' => '1 day 17 hours',
                                'value' => 146292,
                            ],
                            'status' => 'OK',
                        ],
                    ],
                ],
            ],
            'status' => 'OK',
        ];
    }

    private function expectedArray()
    {
        return [
            'origin'      => '17 Hudson River Waterfront Walk, Jersey City, NJ 07305, USA',
            'destination' => 'Mount Lee Dr, Los Angeles, CA 90068, USA',
            'distance'    => [
                'text'  => '4,508 km',
                'value' => 4508227,
            ],
            'duration'    => [
                'text'  => '1 day 17 hours',
                'value' => 146292,
            ],
        ];
    }
}
