<?php

namespace MoonbaseLabs\NeverBounce;

use NeverBounce\Auth;
use NeverBounce\Single;
use Illuminate\Support\ServiceProvider;

class NeverBounceServiceProvider extends ServiceProvider
{
    protected $suggestion;
    protected $error;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $validator = $this->app->make(Validator::class);

        $this->app->validator->extend('neverbounce', function ($attribute, $value) use ($validator) {
            return $validator->validate($value);
        });

        $this->app->validator->replacer('neverbounce', function ($message) use ($validator) {
            $suggestion = $validator::$correction;
            $error = $validator::$error;

            if (!$suggestion) {
                return str_replace([':suggestion', ':error'], '', $message);
            }

            if ($suggestion) {
                return str_replace(
                    [':suggestion', ':error'],
                    ["Did you mean {$suggestion}?", ''],
                    $message
                );
            }

            if ($error) {
                return str_replace(
                    [':error', ':suggestion', 'The email is not valid. '],
                    ["There was an error. {$error}", '', ''],
                    $message
                );
            }
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $config = $this->app->config['services']['neverbounce'];

        Auth::setApiKey($config['api_key']);

        $this->app->singleton(Validator::class, function () {
            return new Validator(new Single);
        });
    }
}
