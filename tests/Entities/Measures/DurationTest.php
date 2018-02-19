<?php namespace Arcanedev\GeoLocation\Tests\Entities\Measures;

use Arcanedev\GeoLocation\Entities\Measures\Duration;
use Arcanedev\GeoLocation\Tests\TestCase;

/**
 * Class     DurationTest
 *
 * @package  Arcanedev\GeoLocation\Tests\Entities\Measures
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DurationTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $distance = new Duration('1 hour', 60);

        $expectations = [
            \Illuminate\Contracts\Support\Arrayable::class,
            \Illuminate\Contracts\Support\Jsonable::class,
            \JsonSerializable::class,
            \Arcanedev\GeoLocation\Entities\Measures\Duration::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $distance);
        }
    }

    /** @test */
    public function it_can_make()
    {
        $distance = Duration::make('1 hour', 60);

        $expectations = [
            \Illuminate\Contracts\Support\Arrayable::class,
            \Illuminate\Contracts\Support\Jsonable::class,
            \JsonSerializable::class,
            \Arcanedev\GeoLocation\Entities\Measures\Duration::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $distance);
        }
    }

    /** @test */
    public function it_can_make_from_array()
    {
        $distance = Duration::makeFromArray(['text' => '1 hour', 'value' => 60]);

        $expectations = [
            \Illuminate\Contracts\Support\Arrayable::class,
            \Illuminate\Contracts\Support\Jsonable::class,
            \JsonSerializable::class,
            \Arcanedev\GeoLocation\Entities\Measures\Duration::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $distance);
        }
    }

    /** @test */
    public function it_can_get_value_or_text()
    {
        $distance = Duration::make('1 hour', 60);

        static::assertSame(60, $distance->value());
        static::assertSame(60, $distance->getValue());

        static::assertSame('1 hour', $distance->text());
        static::assertSame('1 hour', $distance->getText());
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $distance = Duration::make('1 hour', 60);

        static::assertSame(['text' => '1 hour', 'value' => 60], $distance->toArray());
    }

    /** @test */
    public function it_can_convert_to_json()
    {
        $distance = Duration::makeFromArray(
            $data = ['text' => '1 hour', 'value' => 60]
        );

        $expected = json_encode($data);

        static::assertSame($expected, $distance->toJson());
        static::assertSame($expected, json_encode($distance));
    }
}
