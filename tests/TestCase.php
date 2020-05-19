<?php

namespace Thtg88\LaravelExistsWithoutSoftDeletedRule\Tests;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;
use Thtg88\LaravelExistsWithoutSoftDeletedRule\LaravelExistsWithoutSoftDeletedRuleServiceProvider;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();

        $this->app->make(EloquentFactory::class)->load(__DIR__.'/factories');
    }

    protected function getPackageProviders($app): array
    {
        return [LaravelExistsWithoutSoftDeletedRuleServiceProvider::class];
    }

    protected function setUpDatabase(): void
    {
        Schema::create('test_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }
}
