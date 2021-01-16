<?php

namespace Thtg88\ExistsWithoutSoftDeletedRule\Tests\Unit;

use Thtg88\ExistsWithoutSoftDeletedRule\Rules\ExistsWithoutSoftDeletedRule;
use Thtg88\ExistsWithoutSoftDeletedRule\Tests\TestCase;
use Thtg88\ExistsWithoutSoftDeletedRule\Tests\TestClasses\Models\TestModel;

class ExistsWithoutSoftDeletedRuleTest extends TestCase
{
    /** @test */
    public function it_will_return_true_if_all_model_ids_exist()
    {
        $rule = new ExistsWithoutSoftDeletedRule(TestModel::class);

        $this->assertTrue($rule->passes('id', []));

        $this->assertFalse($rule->passes('id', [1]));

        factory(TestModel::class)->create(['id' => 1]);
        $this->assertTrue($rule->passes('id', [1]));

        $this->assertFalse($rule->passes('id', [1, 2]));

        factory(TestModel::class)->create(['id' => 2]);
        $this->assertTrue($rule->passes('id', [1, 2]));
        $this->assertTrue($rule->passes('id', [1]));
    }

    /** @test */
    public function it_can_validate_existence_of_models_by_column()
    {
        $rule = new ExistsWithoutSoftDeletedRule(TestModel::class, 'name');

        $this->assertTrue($rule->passes('name', []));

        $this->assertFalse($rule->passes('name', ['John Smith']));

        factory(TestModel::class)->create(['name' => 'John Smith']);
        $this->assertTrue($rule->passes('name', ['John Smith']));
    }

    /** @test */
    public function it_passes_relevant_data_to_the_validation_message()
    {
        $rule = new ExistsWithoutSoftDeletedRule(TestModel::class, 'id');

        $rule->passes('id', [1, 2]);

        $this->assertEquals('The selected id is invalid.', $rule->message());
    }
}
