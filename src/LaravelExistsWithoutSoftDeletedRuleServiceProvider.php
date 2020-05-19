<?php

namespace Thtg88\LaravelExistsWithoutSoftDeletedRule;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class LaravelExistsWithoutSoftDeletedRuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path(
                'lang/vendor/laravel-exists-without-soft-deleted-rule'
            ),
        ]);
        $this->loadTranslationsFrom(
            __DIR__.'/../resources/lang/',
            'laravel-exists-without-soft-deleted-rule'
        );

        // Config
        // $this->publishes([
        //     __DIR__.'/../config/laravel-exists-without-soft-deleted-rule.php' => Container::getInstance()
        //         ->configPath('laravel-exists-without-soft-deleted-rule.php'),
        // ], 'laravel-exists-without-soft-deleted-rule-config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        // $this->mergeConfigFrom(
        //     __DIR__.'/../config/laravel-exists-without-soft-deleted-rule.php',
        //     'laravel-exists-without-soft-deleted-rule'
        // );
    }
}
