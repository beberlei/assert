<?php

namespace Assert\Tests\Fixtures;

use Assert\Assertion;

class PR142_OverrideStringify extends Assertion
{
    protected static function stringify($value)
    {
        return '***'.parent::stringify($value).'***';
    }
}
