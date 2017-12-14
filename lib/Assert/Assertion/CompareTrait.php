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

const VALUE_EMPTY = 14;
const VALUE_NULL = 15;
const VALUE_NOT_NULL = 25;
const INVALID_EQ = 33;
const INVALID_SAME = 34;
const INVALID_NOT_EQ = 42;
const INVALID_NOT_SAME = 43;
const VALUE_NOT_EMPTY = 205;
const INVALID_NOT_BLANK = 27;

trait CompareTrait
{
    /**
     * Assert that two values are equal (using == ).
     *
     * @param mixed                $value
     * @param mixed                $value2
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function eq($value, $value2, $message = null, $propertyPath = null)
    {
        if ($value != $value2) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" does not equal expected value "%s".',
                static::stringify($value),
                static::stringify($value2)
            );

            throw static::createException($value, $message, INVALID_EQ, $propertyPath, ['expected' => $value2]);
        }

        return true;
    }

    /**
     * Assert that two values are the same (using ===).
     *
     * @param mixed                $value
     * @param mixed                $value2
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function same($value, $value2, $message = null, $propertyPath = null)
    {
        if ($value !== $value2) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not the same as expected value "%s".',
                static::stringify($value),
                static::stringify($value2)
            );

            throw static::createException($value, $message, INVALID_SAME, $propertyPath,
                ['expected' => $value2]);
        }

        return true;
    }

    /**
     * Assert that two values are not equal (using == ).
     *
     * @param mixed                $value1
     * @param mixed                $value2
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notEq($value1, $value2, $message = null, $propertyPath = null)
    {
        if ($value1 == $value2) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is equal to expected value "%s".',
                static::stringify($value1),
                static::stringify($value2)
            );
            throw static::createException($value1, $message, INVALID_NOT_EQ, $propertyPath,
                ['expected' => $value2]);
        }

        return true;
    }

    /**
     * Assert that two values are not the same (using === ).
     *
     * @param mixed                $value1
     * @param mixed                $value2
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notSame($value1, $value2, $message = null, $propertyPath = null)
    {
        if ($value1 === $value2) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is the same as expected value "%s".',
                static::stringify($value1),
                static::stringify($value2)
            );
            throw static::createException($value1, $message, INVALID_NOT_SAME, $propertyPath,
                ['expected' => $value2]);
        }

        return true;
    }

    /**
     * Assert that value is not empty.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notEmpty($value, $message = null, $propertyPath = null)
    {
        if (empty($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is empty, but non empty value was expected.',
                static::stringify($value)
            );

            throw static::createException($value, $message, VALUE_EMPTY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is empty.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function noContent($value, $message = null, $propertyPath = null)
    {
        if (!empty($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not empty, but empty value was expected.',
                static::stringify($value)
            );

            throw static::createException($value, $message, VALUE_NOT_EMPTY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is null.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function null($value, $message = null, $propertyPath = null)
    {
        if ($value !== null) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not null, but null value was expected.',
                static::stringify($value)
            );

            throw static::createException($value, $message, VALUE_NOT_NULL, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is not null.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notNull($value, $message = null, $propertyPath = null)
    {
        if ($value === null) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is null, but non null value was expected.',
                static::stringify($value)
            );

            throw static::createException($value, $message, VALUE_NULL, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is not blank.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notBlank($value, $message = null, $propertyPath = null)
    {
        if (false === $value || (empty($value) && '0' != $value) || (\is_string($value) && '' === \trim($value))) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is blank, but was expected to contain a value.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_NOT_BLANK, $propertyPath);
        }

        return true;
    }
}
