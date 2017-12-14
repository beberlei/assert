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

const INVALID_CALLABLE = 215;
const INVALID_SATISFY = 217;

trait CallableTrait
{
    /**
     * Assert that the provided value is valid according to a callback.
     * If the callback returns `false` the assertion will fail.
     *
     * @param mixed                $value
     * @param callable             $callback
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function satisfy($value, $callback, $message = null, $propertyPath = null)
    {
        self::isCallable($callback);

        if (\call_user_func($callback, $value) === false) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Provided "%s" is invalid according to custom rule.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_SATISFY, $propertyPath);
        }

        return true;
    }

    /**
     * Determines that the provided value is callable.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function isCallable($value, $message = null, $propertyPath = null)
    {
        if (!\is_callable($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Provided "%s" is not a callable.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_CALLABLE, $propertyPath);
        }

        return true;
    }
}
