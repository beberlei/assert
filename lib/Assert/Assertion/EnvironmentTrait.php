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

const INVALID_EXTENSION = 222;
const INVALID_VERSION = 223;
const INVALID_CONSTANT = 221;

trait EnvironmentTrait
{
    /**
     * Assert on PHP version.
     *
     * @param string               $operator
     * @param mixed                $version
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function phpVersion($operator, $version, $message = null, $propertyPath = null)
    {
        static::defined('PHP_VERSION');

        return static::version(PHP_VERSION, $operator, $version, $message, $propertyPath);
    }

    /**
     * Assert that a constant is defined.
     *
     * @param mixed                $constant
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function defined($constant, $message = null, $propertyPath = null)
    {
        if (!\defined($constant)) {
            $message = \sprintf(static::generateMessage($message) ?: 'Value "%s" expected to be a defined constant.',
                $constant);

            throw static::createException($constant, $message, INVALID_CONSTANT, $propertyPath);
        }

        return true;
    }

    /**
     * Assert comparison of two versions.
     *
     * @param string               $version1
     * @param string               $operator
     * @param string               $version2
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function version($version1, $operator, $version2, $message = null, $propertyPath = null)
    {
        static::notEmpty($operator, 'versionCompare operator is required and cannot be empty.');

        if (\version_compare($version1, $version2, $operator) !== true) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Version "%s" is not "%s" version "%s".',
                static::stringify($version1),
                static::stringify($operator),
                static::stringify($version2)
            );

            throw static::createException($version1, $message, INVALID_VERSION, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that extension is loaded and a specific version is installed.
     *
     * @param string               $extension
     * @param string               $operator
     * @param mixed                $version
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function extensionVersion($extension, $operator, $version, $message = null, $propertyPath = null)
    {
        static::extensionLoaded($extension, $message, $propertyPath);

        return static::version(\phpversion($extension), $operator, $version, $message, $propertyPath);
    }

    /**
     * Assert that extension is loaded.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function extensionLoaded($value, $message = null, $propertyPath = null)
    {
        if (!\extension_loaded($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Extension "%s" is required.',
                static::stringify($value)
            );

            throw static::createException($value, $message, INVALID_EXTENSION, $propertyPath);
        }

        return true;
    }
}
