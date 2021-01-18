<?php

namespace Thtg88\ExistsWithoutSoftDeletedRule\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Rules\Exists;

/**
 * Validate the existence of an attribute value in a case-insensitive way,
 * in a database table.
 *
 * If a database column is not specified, the attribute will be used.
 */
class ExistsWithoutSoftDeletedRule extends Exists implements Rule
{
    use ValidatesAttributes;

    /**
     * The attribute under validation.
     *
     * @var string
     */
    protected $attribute;

    /** @var array */
    protected $implicitAttributes = [];

    /**
     * Validate the existence of an attribute value in a case-insensitive way,
     * in a database table.
     *
     * @param string $attribute
     * @param mixed  $value
     * @param array  $parameters
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        $parameters = $this->getParameters();

        $this->requireParameterCount(
            1,
            $parameters,
            'exists-without-soft-deleted-rule::exists_without_soft_deleted'
        );

        [$connection, $table] = $this->parseTable($this->table);

        // The second parameter position holds the name of the column that should be
        // verified as existing. If this parameter is not specified we will guess
        // that the columns being "verified" shares the given attribute's name.
        $column = $this->getQueryColumn($parameters, $attribute);

        $expected = is_array($value) ? count(array_unique($value)) : 1;

        $verifier = app('validation.presence');

        $extra = [
            static function ($query) {
                $query->whereNull('deleted_at');
            },
        ];

        $extra = array_merge(
            $extra,
            $this->getExtraConditions(
                array_values(array_slice($parameters, 2))
            ),
            $this->queryCallbacks()
        );

        if (is_array($value)) {
            return $verifier->getMultiCount(
                $table,
                $column,
                $value,
                $extra
            ) >= $expected;
        }

        return $verifier->getCount(
            $table,
            $column,
            $value,
            null,
            null,
            $extra
        ) >= $expected;
    }

    public function message(): string
    {
        return __('exists-without-soft-deleted-rule::validation.exists_without_soft_deleted', [
            'attribute' => str_replace('_', ' ', Str::snake($this->attribute)),
        ]);
    }

    /**
     * Convert the rule to a validation string.
     *
     * @return string
     */
    public function __toString()
    {
        return rtrim(sprintf(
            'exists-without-soft-deleted-rule::exists_without_soft_deleted:%s,%s,%s',
            $this->table,
            $this->column,
            $this->formatWheres()
        ), ',');
    }

    /**
     * Return the validation rule parameters.
     *
     * @return array
     */
    protected function getParameters(): array
    {
        $formatted_wheres = $this->formatWheres();

        $parameters = [$this->table, $this->column];

        if ($formatted_wheres !== '') {
            $parameters[] = $formatted_wheres;
        }

        return $parameters;
    }
}
