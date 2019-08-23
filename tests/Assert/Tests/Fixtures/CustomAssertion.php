<?php

/**
 * Assert
 *
 * LICENSE
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.txt.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to kontakt@beberlei.de so I can send you a copy immediately.
 */

namespace Assert\Tests\Fixtures;

use Assert\Assertion;

class CustomAssertion extends Assertion
{
    protected static $exceptionClass = CustomException::class;
    private static $calls = [];

    public static function clearCalls()
    {
        self::$calls = [];
    }

    public static function getCalls()
    {
        return self::$calls;
    }

    public static function string($value, $message = null, string $propertyPath = null): bool
    {
        self::$calls[] = ['string', $value];

        return parent::string($value, $message, $propertyPath);
    }
}
