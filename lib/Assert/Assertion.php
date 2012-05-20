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

    /**
     * Assert that value is a php integer.
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function integer($value, $message = null)
    {
        if ( ! is_int($value)) {
            throw new InvalidArgumentException($message, self::INVALID_INTEGER);
        }
    }

    /**
     * Assert that value is a php integer'ish.
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function integerish($value, $message = null)
    {
        if (strval(intval($value)) != $value || is_bool($value) || is_null($value)) {
            throw new InvalidArgumentException($message, self::INVALID_INTEGERISH);
        }
    }

    /**
     * Assert that value is php boolean
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function boolean($value, $message = null)
    {
        if ( ! is_bool($value)) {
            throw new InvalidArgumentException($message, self::INVALID_BOOLEAN);
        }
    }

    /**
     * Assert that value is not empty
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function notEmpty($value, $message = null)
    {
        if (empty($value)) {
            throw new InvalidArgumentException($message, self::VALUE_EMPTY);
        }
    }

    /**
     * Assert that value is not null
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function notNull($value, $message = null)
    {
        if ($value === null) {
            throw new InvalidArgumentException($message, self::VALUE_NULL);
        }
    }

    /**
     * Assert that value is a string
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function string($value, $message = null)
    {
        if ( ! is_string($value)) {
            throw new InvalidArgumentException($message, self::INVALID_STRING);
        }
    }

    /**
     * Assert that value matches a regex
     *
     * @param mixed $value
     * @param string $regex
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function regex($value, $regex, $message = null)
    {
        self::string($value, $message);

        if ( ! preg_match($regex, $value)) {
            throw new InvalidArgumentException($message, self::INVALID_REGEX );
        }
    }

    /**
     * Assert that string value is at least of a minimum length.
     *
     * @param mixed $value
     * @param string $minLength
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function minLength($value, $minLength, $message = null)
    {
        self::string($value, $message);

        if (strlen($value) < $minLength) {
            throw new InvalidArgumentException($message, self::INVALID_MIN_LENGTH);
        }
    }

    /**
     * Assert that string value is at least of a minimum length.
     *
     * @param mixed $value
     * @param integer $minLength
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function maxLength($value, $minLength, $message = null)
    {
        self::string($value, $message);

        if (strlen($value) > $minLength) {
            throw new InvalidArgumentException($message, self::INVALID_MAX_LENGTH);
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
     * @throws Assert\InvalidArgumentException
     */
    static public function betweenLength($value, $minLength, $maxLength, $message = null)
    {
        self::string($value, $message);

        if (strlen($value) < $minLength) {
            throw new InvalidArgumentException($message, self::INVALID_MIN_LENGTH);
        }

        if (strlen($value) > $maxLength) {
            throw new InvalidArgumentException($message, self::INVALID_MAX_LENGTH);
        }
    }

    /**
     * Assert that string starts with a sequence of chars.
     *
     * @param mixed $value
     * @param string $needle
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function startsWith($string, $needle, $message = null)
    {
        self::string($string);

        if (strpos($string, $needle) !== 0) {
            throw new InvalidArgumentException($message, self::INVALID_STRING_START);
        }
    }

    /**
     * Assert that string contains a sequence of chars.
     *
     * @param mixed $value
     * @param string $needle
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function contains($string, $needle, $message = null)
    {
        self::string($string);

        if (strpos($string, $needle) === false) {
            throw new InvalidArgumentException($message, self::INVALID_STRING_CONTAINS);
        }
    }

    /**
     * Assert that string contains a sequence of chars.
     *
     * @param mixed $value
     * @param array $choices
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function choice($value, array $choices, $message = null)
    {
        if ( ! in_array($value, $choices, true)) {
            throw new InvalidArgumentException($message, self::INVALID_CHOICE);
        }
    }

    /**
     * Assert that value is numeric.
     *
     * @param mixed $value
     * @param string $message;
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function numeric($value, $message = null)
    {
        if ( ! is_numeric($value)) {
            throw new InvalidArgumentException($message, self::INVALID_NUMERIC);
        }
    }

    /**
     * Assert that value is array.
     *
     * @param mixed $value
     * @param string $message;
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function isArray($value, $message = null)
    {
        if ( ! is_array($value)) {
            throw new InvalidArgumentException($message, self::INVALID_ARRAY);
        }
    }

    /**
     * Assert that key exists in array
     *
     * @param mixed $value
     * @param string|integer $key
     * @param string $message;
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function keyExists($value, $key, $message = null)
    {
        self::isArray($value);

        if ( ! array_key_exists($key, $value)) {
            throw new InvalidArgumentException($message, self::INVALID_KEY_EXISTS);
        }
    }

    /**
     * Assert that value is not blank
     *
     * @param mixed $value
     * @param string $message;
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function notBlank($value, $message = null)
    {
        if (false === $value || (empty($value) && '0' != $value)) {
            throw new InvalidArgumentException($message, self::INVALID_NOT_BLANK);
        }
    }

    /**
     * Assert that value is instance of given class-name.
     *
     * @param mixed $value
     * @param string $className
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function isInstanceOf($value, $className, $message = null)
    {
        if ( ! ($value instanceof $className)) {
            throw new InvalidArgumentException($message, self::INVALID_INSTANCE_OF);
        }
    }

    /**
     * Assert that value is subclass of given class-name.
     *
     * @param mixed $value
     * @param string $className
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function subclassOf($value, $className, $message = null)
    {
        if ( ! is_subclass_of($value, $className)) {
            throw new InvalidArgumentException($message, self::INVALID_SUBCLASS_OF);
        }
    }
}

