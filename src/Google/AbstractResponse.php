<?php namespace Arcanedev\GeoLocation\Google;

use Arcanedev\GeoLocation\Traits\CanBeJsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use JsonSerializable;

/**
 * Class     AbstractResponse
 *
 * @package  Arcanedev\GeoLocation\Google
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AbstractResponse implements Arrayable, Jsonable, JsonSerializable
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const STATUS_OK           = 'OK';
    const STATUS_ZERO_RESULTS = 'ZERO_RESULTS';

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
     * The response's data.
     *
     * @var  array
     */
    protected $data = [];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AbstractResponse constructor.
     *
     * @param  array  $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the raw response.
     *
     * @return array
     */
    public function getRaw()
    {
        return $this->data;
    }

    /**
     * Get the status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get a data with a given key.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return Arr::get($this->getRaw(), $key, $default);
    }

    /**
     * Check if the response's status is OK.
     *
     * @return bool
     */
    public function isOk()
    {
        return in_array($this->getStatus(), [
            static::STATUS_OK,
            static::STATUS_ZERO_RESULTS,
        ]);
    }
}
