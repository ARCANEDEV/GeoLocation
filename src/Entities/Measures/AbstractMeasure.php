<?php namespace Arcanedev\GeoLocation\Entities\Measures;

use Arcanedev\GeoLocation\Traits\CanBeJsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

/**
 * Class     AbstractMeasure
 *
 * @package  Arcanedev\GeoLocation\Entities\Measures
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AbstractMeasure implements Arrayable, Jsonable, JsonSerializable
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use CanBeJsonable;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The text value.
     *
     * @var string
     */
    protected $text;

    /**
     * The numeric value.
     *
     * @var int
     */
    protected $value;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * AbstractMeasure constructor.
     *
     * @param  string     $text
     * @param  float|int  $value
     */
    public function __construct($text, $value)
    {
        $this->text  = $text;
        $this->value = $value;
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the text (alias).
     *
     * @see getText
     *
     * @return string
     */
    public function text()
    {
        return $this->getText();
    }

    /**
     * Get the text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get the value (alias).
     *
     * @see getValue
     *
     * @return float|int
     */
    public function value()
    {
        return $this->getValue();
    }

    /**
     * Get the value.
     *
     * @return float|int
     */
    public function getValue()
    {
        return $this->value;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a distance instance.
     *
     * @param  string  $text
     * @param  int     $value
     *
     * @return static
     */
    public static function make($text, $value)
    {
        return new static($text, $value);
    }

    /**
     * Make a distance instance from array.
     *
     * @param  array  $data
     *
     * @return static
     */
    public static function makeFromArray(array $data)
    {
        return static::make($data['text'], $data['value']);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'text'  => $this->text(),
            'value' => $this->value(),
        ];
    }
}
