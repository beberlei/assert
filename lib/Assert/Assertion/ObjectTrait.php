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

const INVALID_OBJECT = 207;
const INVALID_METHOD = 208;
const INVALID_PROPERTY = 224;

trait ObjectTrait
{
    /**
     * Determines that the named method is defined in the provided object.
     *
     * @param string               $value
     * @param mixed                $object
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function methodExists($value, $object, $message = null, $propertyPath = null)
    {
        static::isObject($object, $message, $propertyPath);

        if (!\method_exists($object, $value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Expected "%s" does not exist in provided object.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_METHOD, $propertyPath);
        }

        return true;
    }

    /**
     * Determines that the provided value is an object.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function isObject($value, $message = null, $propertyPath = null)
    {
        if (!\is_object($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Provided "%s" is not a valid object.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_OBJECT, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is an object or class, and that the property exists.
     *
     * @param mixed                $value
     * @param string               $property
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function propertyExists($value, $property, $message = null, $propertyPath = null)
    {
        static::objectOrClass($value);

        if (!\property_exists($value, $property)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Class "%s" does not have property "%s".',
                static::stringify($value),
                static::stringify($property)
            );

            throw static::createException($value, $message, INVALID_PROPERTY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is an object, or a class that exists.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function objectOrClass($value, $message = null, $propertyPath = null)
    {
        if (!\is_object($value)) {
            static::classExists($value, $message, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is an object or class, and that the properties all exist.
     *
     * @param mixed                $value
     * @param array                $properties
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function propertiesExist($value, array $properties, $message = null, $propertyPath = null)
    {
        static::objectOrClass($value);
        static::allString($properties, $message, $propertyPath);

        $invalidProperties = [];
        foreach ($properties as $property) {
            if (!\property_exists($value, $property)) {
                $invalidProperties[] = $property;
            }
        }

        if ($invalidProperties) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Class "%s" does not have these properties: %s.',
                static::stringify($value),
                static::stringify(\implode(', ', $invalidProperties))
            );

            throw static::createException($value, $message, INVALID_PROPERTY, $propertyPath);
        }

        return true;
    }
}
