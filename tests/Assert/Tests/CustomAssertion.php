<?php

namespace Assert\Tests;

use Assert\Assertion;

class CustomAssertion extends Assertion
{
    const INVALID_CUSTOM = 10001;

    public static function customAssert($value, $message = null, $propertyPath = null)
    {
        if (!$value) {
            $message = sprintf(
                $message ?: 'Value "%s" doesn\'t pass.',
                self::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_CUSTOM, $propertyPath);
        }
    }
}
