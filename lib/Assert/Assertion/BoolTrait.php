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

namespace Assert\Assertion;

trait BoolTrait
{
    /**
     * Assert that value is php boolean.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function boolean($value, $message = null, $propertyPath = null)
    {
        if (!\is_bool($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not a boolean.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_BOOLEAN, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is boolean True.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function true($value, $message = null, $propertyPath = null)
    {
        if ($value !== true) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not TRUE.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_TRUE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is boolean False.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function false($value, $message = null, $propertyPath = null)
    {
        if ($value !== false) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not FALSE.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_FALSE, $propertyPath);
        }

        return true;
    }
}
