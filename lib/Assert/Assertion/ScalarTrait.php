<?php

declare(strict_types=1);

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

namespace Assert\Assertion;

const INVALID_SCALAR = 209;

trait ScalarTrait
{
    use BoolTrait;
    use NumberTrait;
    use StringTrait;

    /**
     * Assert that value is a PHP scalar.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function scalar($value, $message = null, $propertyPath = null)
    {
        if (!\is_scalar($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not a scalar.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_SCALAR, $propertyPath);
        }

        return true;
    }
}
