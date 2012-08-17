<?php
/**
 * Assert
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to kontakt@beberlei.de so I can send you a copy immediately.
 */

namespace Assert;

/**
 * Assert library
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 */
class Assertion
{
    const INVALID_INTEGER         = 10;
    const INVALID_DIGIT           = 11;
    const INVALID_INTEGERISH      = 12;
    const INVALID_BOOLEAN         = 13;
    const VALUE_EMPTY             = 14;
    const VALUE_NULL              = 15;
    const INVALID_STRING          = 16;
    const INVALID_REGEX           = 17;
    const INVALID_MIN_LENGTH      = 18;
    const INVALID_MAX_LENGTH      = 19;
    const INVALID_STRING_START    = 20;
    const INVALID_STRING_CONTAINS = 21;
    const INVALID_CHOICE          = 22;
    const INVALID_NUMERIC         = 23;
    const INVALID_ARRAY           = 24;
    const INVALID_KEY_EXISTS      = 26;
    const INVALID_NOT_BLANK       = 27;
    const INVALID_INSTANCE_OF     = 28;
    const INVALID_SUBCLASS_OF     = 29;
    const INVALID_RANGE           = 30;
    const INVALID_ALNUM           = 31;
    const INVALID_TRUE            = 32;
    const INVALID_EQ              = 33;
    const INVALID_SAME            = 34;
    const INVALID_MIN             = 35;
    const INVALID_MAX             = 36;
    const INVALID_LENGTH          = 37;
    const INVALID_DIRECTORY       = 101;
    const INVALID_FILE            = 102;
    const INVALID_READABLE        = 103;
    const INVALID_WRITEABLE       = 104;
    const INVALID_CLASS           = 105;
    const INVALID_EMAIL           = 201;

    /**
     * Assert that two values are equal (using == ).
     *
     * @param mixed $value
     * @param mixed $value2
     * @param string $message
     * @param string $propertyPath
     *
     * @throws AssertionFailedException
     */
    static public function eq($value, $value2, $message = null, $propertyPath = null)
    {
        if ($value != $value2) {
            throw new AssertionFailedException($message, self::INVALID_EQ, $propertyPath);
        }
    }

    /**
     * Assert that two values are the same (using ===).
     *
     * @param mixed $value
     * @param mixed $value2
     * @param string $message
     * @param string $propertyPath
     *
     * @throws AssertionFailedException
     */
    static public function same($value, $value2, $message = null, $propertyPath = null)
    {
        if ($value !== $value2) {
            throw new AssertionFailedException($message, self::INVALID_SAME, $propertyPath);
        }
    }

    /**
     * Assert that value is a php integer.
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function integer($value, $message = null, $propertyPath = null)
    {
        if ( ! is_int($value)) {
            throw new AssertionFailedException($message, self::INVALID_INTEGER, $propertyPath);
        }
    }

    /**
     * Validates if an integer or integerish is a digit.
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function digit($value, $message = null, $propertyPath = null)
    {
        if ( ! ctype_digit((string)$value)) {
            throw new AssertionFailedException($message, self::INVALID_DIGIT, $propertyPath);
        }
    }

    /**
     * Assert that value is a php integer'ish.
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function integerish($value, $message = null, $propertyPath = null)
    {
        if (strval(intval($value)) != $value || is_bool($value) || is_null($value)) {
            throw new AssertionFailedException($message, self::INVALID_INTEGERISH, $propertyPath);
        }
    }

    /**
     * Assert that value is php boolean
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function boolean($value, $message = null, $propertyPath = null)
    {
        if ( ! is_bool($value)) {
            throw new AssertionFailedException($message, self::INVALID_BOOLEAN, $propertyPath);
        }
    }

    /**
     * Assert that value is not empty
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function notEmpty($value, $message = null, $propertyPath = null)
    {
        if (empty($value)) {
            throw new AssertionFailedException($message, self::VALUE_EMPTY, $propertyPath);
        }
    }

    /**
     * Assert that value is not null
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function notNull($value, $message = null, $propertyPath = null)
    {
        if ($value === null) {
            throw new AssertionFailedException($message, self::VALUE_NULL, $propertyPath);
        }
    }

    /**
     * Assert that value is a string
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function string($value, $message = null, $propertyPath = null)
    {
        if ( ! is_string($value)) {
            throw new AssertionFailedException($message, self::INVALID_STRING, $propertyPath);
        }
    }

    /**
     * Assert that value matches a regex
     *
     * @param mixed $value
     * @param string $regex
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function regex($value, $regex, $message = null, $propertyPath = null)
    {
        self::string($value, $message);

        if ( ! preg_match($regex, $value)) {
            throw new AssertionFailedException($message, self::INVALID_REGEX , $propertyPath);
        }
    }

    /**
     * Assert that string has a given length.
     *
     * @param mixed $value
     * @param int $length
     * @param string $message
     * @param string $message
     *
     * @throws Assert\AssertionFailedException
     */
    static public function length($value, $length, $message = null, $propertyPath = null)
    {
        self::string($value, $message);

        if (strlen($value) != $length) {
            throw new AssertionFailedException($message, self::INVALID_LENGTH, $propertyPath);
        }
    }

    /**
     * Assert that string value is at least of a minimum length.
     *
     * @param mixed $value
     * @param int $minLength
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function minLength($value, $minLength, $message = null, $propertyPath = null)
    {
        self::string($value, $message);

        if (strlen($value) < $minLength) {
            throw new AssertionFailedException($message, self::INVALID_MIN_LENGTH, $propertyPath);
        }
    }

    /**
     * Assert that string value is not longer than a maximum length.
     *
     * @param mixed $value
     * @param integer $maxLength
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function maxLength($value, $maxLength, $message = null, $propertyPath = null)
    {
        self::string($value, $message);

        if (strlen($value) > $maxLength) {
            throw new AssertionFailedException($message, self::INVALID_MAX_LENGTH, $propertyPath);
        }
    }

    /**
     * Assert that string length is between min,max lengths.
     *
     * @param mixed $value
     * @param integer $minLength
     * @param integer $maxLength
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function betweenLength($value, $minLength, $maxLength, $message = null, $propertyPath = null)
    {
        self::string($value, $message);

        if (strlen($value) < $minLength) {
            throw new AssertionFailedException($message, self::INVALID_MIN_LENGTH, $propertyPath);
        }

        if (strlen($value) > $maxLength) {
            throw new AssertionFailedException($message, self::INVALID_MAX_LENGTH);
        }
    }

    /**
     * Assert that string starts with a sequence of chars.
     *
     * @param mixed $string
     * @param string $needle
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function startsWith($string, $needle, $message = null, $propertyPath = null)
    {
        self::string($string);

        if (strpos($string, $needle) !== 0) {
            throw new AssertionFailedException($message, self::INVALID_STRING_START, $propertyPath);
        }
    }

    /**
     * Assert that string contains a sequence of chars.
     *
     * @param mixed $string
     * @param string $needle
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function contains($string, $needle, $message = null, $propertyPath = null)
    {
        self::string($string);

        if (strpos($string, $needle) === false) {
            throw new AssertionFailedException($message, self::INVALID_STRING_CONTAINS, $propertyPath);
        }
    }

    /**
     * Assert that string contains a sequence of chars.
     *
     * @param mixed $value
     * @param array $choices
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function choice($value, array $choices, $message = null, $propertyPath = null)
    {
        if ( ! in_array($value, $choices, true)) {
            throw new AssertionFailedException($message, self::INVALID_CHOICE, $propertyPath);
        }
    }

    /**
     * Alias of {@see choice()}
     *
     * @throws Assert\AssertionFailedException
     */
    static public function inArray($value, array $choices, $message = null, $propertyPath = null)
    {
        self::choice($value, $choices, $message);
    }

    /**
     * Assert that value is numeric.
     *
     * @param mixed $value
     * @param string $message;
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function numeric($value, $message = null, $propertyPath = null)
    {
        if ( ! is_numeric($value)) {
            throw new AssertionFailedException($message, self::INVALID_NUMERIC, $propertyPath);
        }
    }

    /**
     * Assert that value is array.
     *
     * @param mixed $value
     * @param string $message;
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function isArray($value, $message = null, $propertyPath = null)
    {
        if ( ! is_array($value)) {
            throw new AssertionFailedException($message, self::INVALID_ARRAY, $propertyPath);
        }
    }

    /**
     * Assert that key exists in array
     *
     * @param mixed $value
     * @param string|integer $key
     * @param string $message;
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function keyExists($value, $key, $message = null, $propertyPath = null)
    {
        self::isArray($value);

        if ( ! array_key_exists($key, $value)) {
            throw new AssertionFailedException($message, self::INVALID_KEY_EXISTS, $propertyPath);
        }
    }

    /**
     * Assert that value is not blank
     *
     * @param mixed $value
     * @param string $message;
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function notBlank($value, $message = null, $propertyPath = null)
    {
        if (false === $value || (empty($value) && '0' != $value)) {
            throw new AssertionFailedException($message, self::INVALID_NOT_BLANK, $propertyPath);
        }
    }

    /**
     * Assert that value is instance of given class-name.
     *
     * @param mixed $value
     * @param string $className
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function isInstanceOf($value, $className, $message = null, $propertyPath = null)
    {
        if ( ! ($value instanceof $className)) {
            throw new AssertionFailedException($message, self::INVALID_INSTANCE_OF, $propertyPath);
        }
    }

    /**
     * Assert that value is subclass of given class-name.
     *
     * @param mixed $value
     * @param string $className
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function subclassOf($value, $className, $message = null, $propertyPath = null)
    {
        if ( ! is_subclass_of($value, $className)) {
            throw new AssertionFailedException($message, self::INVALID_SUBCLASS_OF, $propertyPath);
        }
    }

    /**
     * Assert that value is in range of integers.
     *
     * @param mixed $value
     * @param integer $minValue
     * @param integer $maxValue
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function range($value, $minValue, $maxValue, $message = null, $propertyPath = null)
    {
        self::integer($value);

        if ($value < $minValue || $value > $maxValue) {
            throw new AssertionFailedException($message, self::INVALID_RANGE, $propertyPath);
        }
    }

    static public function min($value, $minValue, $message = null, $propertyPath = null)
    {
        self::integer($value);

        if ($value < $minValue) {
            throw new AssertionFailedException($message, self::INVALID_MIN, $propertyPath);
        }
    }

    static public function max($value, $maxValue, $message = null, $propertyPath = null)
    {
        self::integer($value);

        if ($value > $maxValue) {
            throw new AssertionFailedException($message, self::INVALID_MAX, $propertyPath);
        }
    }

    static public function file($value, $message = null, $propertyPath = null)
    {
        self::string($value, $message);

        if ( ! is_file($value)) {
            throw new AssertionFailedException($message, self::INVALID_FILE);
        }
    }

    static public function directory($value, $message = null, $propertyPath = null)
    {
        self::string($value, $message);

        if ( ! is_dir($value)) {
            throw new AssertionFailedException($message, self::INVALID_DIRECTORY);
        }
    }

    static public function readable($value, $message = null, $propertyPath = null)
    {
        self::string($value, $message);

        if ( ! is_readable($value)) {
            throw new AssertionFailedException($message, self::INVALID_READABLE, $propertyPath);
        }
    }

    static public function writeable($value, $message = null, $propertyPath = null)
    {
        self::string($value, $message);

        if ( ! is_writeable($value)) {
            throw new AssertionFailedException($message, self::INVALID_WRITEABLE);
        }
    }

    /**
     * Assert that value is an email adress (using
     * input_filter/FILTER_VALIDATE_EMAIL).
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function email($value, $message = null, $propertyPath = null)
    {
        self::string($value, $message);

        if ( ! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new AssertionFailedException($message, self::INVALID_EMAIL, $propertyPath);
        } else {
            $host = substr($value, strpos($value, '@') + 1);

            if (version_compare(PHP_VERSION, '5.3.3', '<') && strpos($host, '.') === false) {
                // Likely not a FQDN, bug in PHP FILTER_VALIDATE_EMAIL prior to PHP 5.3.3
                throw new AssertionFailedException($message, self::INVALID_EMAIL);
            }
        }
    }

    /**
     * Assert that value is alphanumeric.
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function alnum($value, $message = null, $propertyPath = null)
    {
        self::regex($value, '(^([a-zA-Z]{1}[a-zA-Z0-9]?)$)', $message);
    }

    /**
     * Assert that the value is boolean True.
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function true($value, $message = null, $propertyPath = null)
    {
        if ($value !== true) {
            throw new AssertionFailedException($message, self::INVALID_TRUE, $propertyPath);
        }
    }

    /**
     * Assert that the class exists.
     *
     * @param mixed $value
     * @param string $message
     * @param string $propertyPath
     * @return void
     * @throws Assert\AssertionFailedException
     */
    static public function classExists($value, $message = null, $propertyPath = null)
    {
        if ( ! class_exists($value)) {
            throw new AssertionFailedException($message, self::INVALID_CLASS, $propertyPath);
        }
    }

    /**
     * static call handler to implement "null or assertion" delegation.
     */
    static public function __callStatic($method, $args)
    {
        if (strpos($method, "nullOr") === 0) {
            $method = substr($method, 6);

            if ($args[0] === null) {
                return;
            }

            return call_user_func_array(array(get_called_class(), $method), $args);
        }

        throw new \BadMethodCallException("No assertion Assertion#" . $method . " exists.");
    }
}

