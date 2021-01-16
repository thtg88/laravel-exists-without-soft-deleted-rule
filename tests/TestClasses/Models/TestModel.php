<?php

namespace Thtg88\ExistsWithoutSoftDeletedRule\Tests\TestClasses\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestModel extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}
