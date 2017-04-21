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

const INVALID_VALUE_IN_ARRAY = 47;
const INVALID_CHOICE = 22;
const INVALID_TRAVERSABLE = 44;
const INVALID_ARRAY = 24;
const INVALID_KEY_EXISTS = 26;
const INVALID_KEY_NOT_EXISTS = 216;
const INVALID_COUNT = 41;
const INVALID_KEY_ISSET = 46;
const INVALID_ARRAY_ACCESSIBLE = 45;

trait ArrayTrait
{
    /**
     * Assert that value is not in array of choices.
     *
     * @param mixed                $value
     * @param array                $choices
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notInArray($value, array $choices, $message = null, $propertyPath = null)
    {
        if (\in_array($value, $choices) === true) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is in given "%s".',
                static::stringify($value),
                static::stringify($choices)
            );
            throw static::createException($value, $message, INVALID_VALUE_IN_ARRAY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is in array of choices.
     * This is an alias of {@see choice()}.
     *
     * @aliasOf choice()
     *
     * @param mixed                $value
     * @param array                $choices
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function inArray($value, array $choices, $message = null, $propertyPath = null)
    {
        return static::choice($value, $choices, $message, $propertyPath);
    }

    /**
     * Assert that value is in array of choices.
     *
     * @param mixed                $value
     * @param array                $choices
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function choice($value, array $choices, $message = null, $propertyPath = null)
    {
        if (!\in_array($value, $choices, true)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not an element of the valid values: %s',
                static::stringify($value),
                \implode(', ', \array_map([\get_called_class(), 'stringify'], $choices))
            );

            throw static::createException($value, $message, INVALID_CHOICE, $propertyPath,
                ['choices' => $choices]);
        }

        return true;
    }

    /**
     * Assert that value is an array or a traversable object.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function isTraversable($value, $message = null, $propertyPath = null)
    {
        if (!\is_array($value) && !$value instanceof \Traversable) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not an array and does not implement Traversable.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_TRAVERSABLE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that key exists in an array.
     *
     * @param mixed                $value
     * @param string|int           $key
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function keyExists($value, $key, $message = null, $propertyPath = null)
    {
        static::isArray($value, $message, $propertyPath);

        if (!\array_key_exists($key, $value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Array does not contain an element with key "%s"',
                static::stringify($key)
            );

            throw static::createException($value, $message, INVALID_KEY_EXISTS, $propertyPath, ['key' => $key]);
        }

        return true;
    }

    /**
     * Assert that value is an array.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function isArray($value, $message = null, $propertyPath = null)
    {
        if (!\is_array($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not an array.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_ARRAY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that key does not exist in an array.
     *
     * @param mixed                $value
     * @param string|int           $key
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function keyNotExists($value, $key, $message = null, $propertyPath = null)
    {
        static::isArray($value, $message, $propertyPath);

        if (\array_key_exists($key, $value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Array contains an element with key "%s"',
                static::stringify($key)
            );

            throw static::createException($value, $message, INVALID_KEY_NOT_EXISTS, $propertyPath,
                ['key' => $key]);
        }

        return true;
    }

    /**
     * Assert that the count of countable is equal to count.
     *
     * @param array|\Countable $countable
     * @param int              $count
     * @param string|null      $message
     * @param string|null      $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function count($countable, $count, $message = null, $propertyPath = null)
    {
        if ($count !== \count($countable)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'List does not contain exactly "%d" elements.',
                static::stringify($count)
            );

            throw static::createException($countable, $message, INVALID_COUNT, $propertyPath,
                ['count' => $count]);
        }

        return true;
    }

    /**
     * Determines if the values array has every choice as key and that this choice has content.
     *
     * @param array                $values
     * @param array                $choices
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function choicesNotEmpty(array $values, array $choices, $message = null, $propertyPath = null)
    {
        static::notEmpty($values, $message, $propertyPath);

        foreach ($choices as $choice) {
            static::notEmptyKey($values, $choice, $message, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that key exists in an array/array-accessible object and its value is not empty.
     *
     * @param mixed                $value
     * @param string|int           $key
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notEmptyKey($value, $key, $message = null, $propertyPath = null)
    {
        static::keyIsset($value, $key, $message, $propertyPath);
        static::notEmpty($value[$key], $message, $propertyPath);

        return true;
    }

    /**
     * Assert that key exists in an array/array-accessible object using isset().
     *
     * @param mixed                $value
     * @param string|int           $key
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function keyIsset($value, $key, $message = null, $propertyPath = null)
    {
        static::isArrayAccessible($value, $message, $propertyPath);

        if (!isset($value[$key])) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'The element with key "%s" was not found',
                static::stringify($key)
            );

            throw static::createException($value, $message, INVALID_KEY_ISSET, $propertyPath, ['key' => $key]);
        }

        return true;
    }

    /**
     * Assert that value is an array or an array-accessible object.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function isArrayAccessible($value, $message = null, $propertyPath = null)
    {
        if (!\is_array($value) && !$value instanceof \ArrayAccess) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not an array and does not implement ArrayAccess.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_ARRAY_ACCESSIBLE, $propertyPath);
        }

        return true;
    }
}
