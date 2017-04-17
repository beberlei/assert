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

trait ClassTrait
{
    /**
     * Assert that value is subclass of given class-name.
     *
     * @param mixed                $value
     * @param string               $className
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function subclassOf($value, $className, $message = null, $propertyPath = null)
    {
        if (!\is_subclass_of($value, $className)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Class "%s" was expected to be subclass of "%s".',
                static::stringify($value),
                $className
            );

            throw static::createException($value, $message, static::INVALID_SUBCLASS_OF, $propertyPath,
                ['class' => $className]);
        }

        return true;
    }

    /**
     * Assert that the class exists.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function classExists($value, $message = null, $propertyPath = null)
    {
        if (!\class_exists($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Class "%s" does not exist.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_CLASS, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the interface exists.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function interfaceExists($value, $message = null, $propertyPath = null)
    {
        if (!\interface_exists($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Interface "%s" does not exist.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_INTERFACE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the class implements the interface.
     *
     * @param mixed                $class
     * @param string               $interfaceName
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function implementsInterface($class, $interfaceName, $message = null, $propertyPath = null)
    {
        $reflection = new \ReflectionClass($class);
        if (!$reflection->implementsInterface($interfaceName)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Class "%s" does not implement interface "%s".',
                static::stringify($class),
                static::stringify($interfaceName)
            );

            throw static::createException($class, $message, static::INTERFACE_NOT_IMPLEMENTED, $propertyPath,
                ['interface' => $interfaceName]);
        }

        return true;
    }

    /**
     * Assert that value is instance of given class-name.
     *
     * @param mixed                $value
     * @param string               $className
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function isInstanceOf($value, $className, $message = null, $propertyPath = null)
    {
        if (!($value instanceof $className)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Class "%s" was expected to be instanceof of "%s" but is not.',
                static::stringify($value),
                $className
            );

            throw static::createException($value, $message, static::INVALID_INSTANCE_OF, $propertyPath,
                ['class' => $className]);
        }

        return true;
    }

    /**
     * Assert that value is not instance of given class-name.
     *
     * @param mixed                $value
     * @param string               $className
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notIsInstanceOf($value, $className, $message = null, $propertyPath = null)
    {
        if ($value instanceof $className) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Class "%s" was not expected to be instanceof of "%s".',
                static::stringify($value),
                $className
            );

            throw static::createException($value, $message, static::INVALID_NOT_INSTANCE_OF, $propertyPath,
                ['class' => $className]);
        }

        return true;
    }
}
