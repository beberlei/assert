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

const INVALID_DIRECTORY = 101;
const INVALID_FILE = 102;
const INVALID_READABLE = 103;
const INVALID_WRITEABLE = 104;
const INVALID_RESOURCE = 225;

trait FileSystemTrait
{
    /**
     * Assert that a file exists.
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function file($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);
        static::notEmpty($value, $message, $propertyPath);

        if (!\is_file($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'File "%s" was expected to exist.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_FILE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that a directory exists.
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function directory($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        if (!\is_dir($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Path "%s" was expected to be a directory.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_DIRECTORY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is something readable.
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function readable($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        if (!\is_readable($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Path "%s" was expected to be readable.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_READABLE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is something writeable.
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function writeable($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        if (!\is_writable($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Path "%s" was expected to be writeable.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_WRITEABLE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is a resource.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function isResource($value, $message = null, $propertyPath = null)
    {
        if (!\is_resource($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not a resource.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_RESOURCE, $propertyPath);
        }

        return true;
    }
}
