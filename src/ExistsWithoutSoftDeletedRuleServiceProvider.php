<?php

namespace Thtg88\ExistsWithoutSoftDeletedRule;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class ExistsWithoutSoftDeletedRuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../resources/lang' => Container::getInstance()
                ->resourcePath('lang/vendor/exists-without-soft-deleted-rule'),
        ], 'exists-without-soft-deleted-rule-translations');

        $this->loadTranslationsFrom(
            __DIR__.'/../resources/lang',
            'exists-without-soft-deleted-rule'
        );

        // Config
        // $this->publishes([
        //     __DIR__.'/../config/exists-without-soft-deleted-rule.php' => Container::getInstance()
        //         ->configPath('exists-without-soft-deleted-rule.php'),
        // ], 'exists-without-soft-deleted-rule-config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        // $this->mergeConfigFrom(
        //     __DIR__.'/../config/exists-without-soft-deleted-rule.php',
        //     'exists-without-soft-deleted-rule'
        // );
    }
}
