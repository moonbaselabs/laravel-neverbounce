<?php

namespace MoonbaseLabs\NeverBounce;

use NeverBounce\Single;

class Validator
{
    protected $client;

    public static $correction;
    public static $error;

    public function __construct(Single $client)
    {
        $this->client = $client;
    }

    public function validate($value)
    {
        try {
            $response = $this->client->check($value, true, true, 5);
            self::$correction = $response->suggested_correction;
        } catch (Exception $e) {
            self::$error = $e->message;
        }

        return $response->result_integer === 0;
    }
}
