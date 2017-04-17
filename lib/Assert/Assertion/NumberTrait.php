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

trait NumberTrait
{
    /**
     * Assert that value is a php integer.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function integer($value, $message = null, $propertyPath = null)
    {
        if (!\is_int($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not an integer.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_INTEGER, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is a php float.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function float($value, $message = null, $propertyPath = null)
    {
        if (!\is_float($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not a float.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_FLOAT, $propertyPath);
        }

        return true;
    }

    /**
     * Validates if an integer or integerish is a digit.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function digit($value, $message = null, $propertyPath = null)
    {
        if (!\ctype_digit((string) $value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not a digit.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_DIGIT, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is a php integer'ish.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function integerish($value, $message = null, $propertyPath = null)
    {
        if (\is_resource($value) || \is_object($value) || \strval(\intval($value)) != $value || \is_bool($value)
            || \is_null($value)
        ) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not an integer or a number castable to integer.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_INTEGERISH, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is in range of numbers.
     *
     * @param mixed                $value
     * @param mixed                $minValue
     * @param mixed                $maxValue
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function range($value, $minValue, $maxValue, $message = null, $propertyPath = null)
    {
        static::numeric($value, $message, $propertyPath);

        if ($value < $minValue || $value > $maxValue) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Number "%s" was expected to be at least "%d" and at most "%d".',
                static::stringify($value),
                static::stringify($minValue),
                static::stringify($maxValue)
            );

            throw static::createException($value, $message, static::INVALID_RANGE, $propertyPath,
                ['min' => $minValue, 'max' => $maxValue]);
        }

        return true;
    }

    /**
     * Assert that value is numeric.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function numeric($value, $message = null, $propertyPath = null)
    {
        if (!\is_numeric($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not numeric.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_NUMERIC, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that a value is at least as big as a given limit.
     *
     * @param mixed                $value
     * @param mixed                $minValue
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function min($value, $minValue, $message = null, $propertyPath = null)
    {
        static::numeric($value, $message, $propertyPath);

        if ($value < $minValue) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Number "%s" was expected to be at least "%s".',
                static::stringify($value),
                static::stringify($minValue)
            );

            throw static::createException($value, $message, static::INVALID_MIN, $propertyPath, ['min' => $minValue]);
        }

        return true;
    }

    /**
     * Assert that a number is smaller as a given limit.
     *
     * @param mixed                $value
     * @param mixed                $maxValue
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function max($value, $maxValue, $message = null, $propertyPath = null)
    {
        static::numeric($value, $message, $propertyPath);

        if ($value > $maxValue) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Number "%s" was expected to be at most "%s".',
                static::stringify($value),
                static::stringify($maxValue)
            );

            throw static::createException($value, $message, static::INVALID_MAX, $propertyPath, ['max' => $maxValue]);
        }

        return true;
    }

    /**
     * Determines if the value is less than given limit.
     *
     * @param mixed                $value
     * @param mixed                $limit
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function lessThan($value, $limit, $message = null, $propertyPath = null)
    {
        if ($value >= $limit) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Provided "%s" is not less than "%s".',
                static::stringify($value),
                static::stringify($limit)
            );

            throw static::createException($value, $message, static::INVALID_LESS, $propertyPath);
        }

        return true;
    }

    /**
     * Determines if the value is less or than given limit.
     *
     * @param mixed                $value
     * @param mixed                $limit
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function lessOrEqualThan($value, $limit, $message = null, $propertyPath = null)
    {
        if ($value > $limit) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Provided "%s" is not less or equal than "%s".',
                static::stringify($value),
                static::stringify($limit)
            );

            throw static::createException($value, $message, static::INVALID_LESS_OR_EQUAL, $propertyPath);
        }

        return true;
    }

    /**
     * Determines if the value is greater than given limit.
     *
     * @param mixed                $value
     * @param mixed                $limit
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function greaterThan($value, $limit, $message = null, $propertyPath = null)
    {
        if ($value <= $limit) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Provided "%s" is not greater than "%s".',
                static::stringify($value),
                static::stringify($limit)
            );

            throw static::createException($value, $message, static::INVALID_GREATER, $propertyPath);
        }

        return true;
    }

    /**
     * Determines if the value is greater or equal than given limit.
     *
     * @param mixed                $value
     * @param mixed                $limit
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function greaterOrEqualThan($value, $limit, $message = null, $propertyPath = null)
    {
        if ($value < $limit) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Provided "%s" is not greater or equal than "%s".',
                static::stringify($value),
                static::stringify($limit)
            );

            throw static::createException($value, $message, static::INVALID_GREATER_OR_EQUAL, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that a value is greater or equal than a lower limit, and less than or equal to an upper limit.
     *
     * @param mixed  $value
     * @param mixed  $lowerLimit
     * @param mixed  $upperLimit
     * @param string $message
     * @param string $propertyPath
     *
     * @return bool
     */
    public static function between($value, $lowerLimit, $upperLimit, $message = null, $propertyPath = null)
    {
        if ($lowerLimit > $value || $value > $upperLimit) {
            $message = \sprintf(
                static::generateMessage($message)
                    ?: 'Provided "%s" is neither greater than or equal to "%s" nor less than or equal to "%s".',
                static::stringify($value),
                static::stringify($lowerLimit),
                static::stringify($upperLimit)
            );

            throw static::createException($value, $message, static::INVALID_BETWEEN, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that a value is greater than a lower limit, and less than an upper limit.
     *
     * @param mixed  $value
     * @param mixed  $lowerLimit
     * @param mixed  $upperLimit
     * @param string $message
     * @param string $propertyPath
     *
     * @return bool
     */
    public static function betweenExclusive($value, $lowerLimit, $upperLimit, $message = null, $propertyPath = null)
    {
        if ($lowerLimit >= $value || $value >= $upperLimit) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Provided "%s" is neither greater than "%s" nor less than "%s".',
                static::stringify($value),
                static::stringify($lowerLimit),
                static::stringify($upperLimit)
            );

            throw static::createException($value, $message, static::INVALID_BETWEEN_EXCLUSIVE, $propertyPath);
        }

        return true;
    }
}
