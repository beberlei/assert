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

use Assert\AssertionFailedException;

trait StringTrait
{
    /**
     * Assert that string has a given length.
     *
     * @param mixed                $value
     * @param int                  $length
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function length($value, $length, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($value, $message, $propertyPath);

        if (\mb_strlen($value, $encoding) !== $length) {
            $message = \sprintf(
                static::generateMessage($message)
                    ?: 'Value "%s" has to be %d exactly characters long, but length is %d.',
                static::stringify($value),
                $length,
                \mb_strlen($value, $encoding)
            );

            $constraints = ['length' => $length, 'encoding' => $encoding];
            throw static::createException($value, $message, static::INVALID_LENGTH, $propertyPath, $constraints);
        }

        return true;
    }

    /**
     * Assert that value is a string.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function string($value, $message = null, $propertyPath = null)
    {
        if (!\is_string($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" expected to be string, type %s given.',
                static::stringify($value),
                \gettype($value)
            );

            throw static::createException($value, $message, static::INVALID_STRING, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that string length is between min,max lengths.
     *
     * @param mixed                $value
     * @param int                  $minLength
     * @param int                  $maxLength
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function betweenLength(
        $value, $minLength, $maxLength, $message = null, $propertyPath = null, $encoding = 'utf8'
    ) {
        static::string($value, $message, $propertyPath);
        static::minLength($value, $minLength, $message, $propertyPath, $encoding);
        static::maxLength($value, $maxLength, $message, $propertyPath, $encoding);

        return true;
    }

    /**
     * Assert that a string is at least $minLength chars long.
     *
     * @param mixed                $value
     * @param int                  $minLength
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function minLength($value, $minLength, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($value, $message, $propertyPath);

        if (\mb_strlen($value, $encoding) < $minLength) {
            $message = \sprintf(
                static::generateMessage($message)
                    ?: 'Value "%s" is too short, it should have at least %d characters, but only has %d characters.',
                static::stringify($value),
                $minLength,
                \mb_strlen($value, $encoding)
            );

            $constraints = ['min_length' => $minLength, 'encoding' => $encoding];
            throw static::createException($value, $message, static::INVALID_MIN_LENGTH, $propertyPath, $constraints);
        }

        return true;
    }

    /**
     * Assert that string value is not longer than $maxLength chars.
     *
     * @param mixed                $value
     * @param int                  $maxLength
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function maxLength($value, $maxLength, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($value, $message, $propertyPath);

        if (\mb_strlen($value, $encoding) > $maxLength) {
            $message = \sprintf(
                static::generateMessage($message)
                    ?: 'Value "%s" is too long, it should have no more than %d characters, but has %d characters.',
                static::stringify($value),
                $maxLength,
                \mb_strlen($value, $encoding)
            );

            $constraints = ['max_length' => $maxLength, 'encoding' => $encoding];
            throw static::createException($value, $message, static::INVALID_MAX_LENGTH, $propertyPath, $constraints);
        }

        return true;
    }

    /**
     * Assert that string starts with a sequence of chars.
     *
     * @param mixed                $string
     * @param string               $needle
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function startsWith($string, $needle, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($string, $message, $propertyPath);

        if (\mb_strpos($string, $needle, null, $encoding) !== 0) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" does not start with "%s".',
                static::stringify($string),
                static::stringify($needle)
            );

            $constraints = ['needle' => $needle, 'encoding' => $encoding];
            throw static::createException($string, $message, static::INVALID_STRING_START, $propertyPath, $constraints);
        }

        return true;
    }

    /**
     * Assert that string ends with a sequence of chars.
     *
     * @param mixed                $string
     * @param string               $needle
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function endsWith($string, $needle, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($string, $message, $propertyPath);

        $stringPosition = \mb_strlen($string, $encoding) - \mb_strlen($needle, $encoding);

        if (\mb_strripos($string, $needle, null, $encoding) !== $stringPosition) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" does not end with "%s".',
                static::stringify($string),
                static::stringify($needle)
            );

            $constraints = ['needle' => $needle, 'encoding' => $encoding];
            throw static::createException($string, $message, static::INVALID_STRING_END, $propertyPath, $constraints);
        }

        return true;
    }

    /**
     * Assert that string contains a sequence of chars.
     *
     * @param mixed                $string
     * @param string               $needle
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function contains($string, $needle, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($string, $message, $propertyPath);

        if (\mb_strpos($string, $needle, null, $encoding) === false) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" does not contain "%s".',
                static::stringify($string),
                static::stringify($needle)
            );

            $constraints = ['needle' => $needle, 'encoding' => $encoding];
            throw static::createException($string, $message, static::INVALID_STRING_CONTAINS, $propertyPath,
                $constraints);
        }

        return true;
    }

    /**
     * Assert that value is an email adress (using input_filter/FILTER_VALIDATE_EMAIL).
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function email($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        if (!\filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" was expected to be a valid e-mail address.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_EMAIL, $propertyPath);
        } else {
            $host = \substr($value, \strpos($value, '@') + 1);

            // Likely not a FQDN, bug in PHP FILTER_VALIDATE_EMAIL prior to PHP 5.3.3
            if (\version_compare(PHP_VERSION, '5.3.3', '<') && \strpos($host, '.') === false) {
                $message = \sprintf(
                    static::generateMessage($message) ?: 'Value "%s" was expected to be a valid e-mail address.',
                    static::stringify($value)
                );

                throw static::createException($value, $message, static::INVALID_EMAIL, $propertyPath);
            }
        }

        return true;
    }

    /**
     * Assert that value is an URL.
     * This code snipped was taken from the Symfony project and modified to the special demands of this method.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     *
     * @see https://github.com/symfony/Validator/blob/master/Constraints/UrlValidator.php
     * @see https://github.com/symfony/Validator/blob/master/Constraints/Url.php
     */
    public static function url($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        $protocols = ['http', 'https'];

        $pattern = '~^
            (%s)://                                 # protocol
            (([\pL\pN-]+:)?([\pL\pN-]+)@)?          # basic auth
            (
                ([\pL\pN\pS-\.])+(\.?([\pL\pN]|xn\-\-[\pL\pN-]+)+\.?) # a domain name
                   |                                                # or
                \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}                    # an IP address
                   |                                                # or
                \[
                    (?:(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){6})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:::(?:(?:(?:[0-9a-f]{1,4})):){5})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){4})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,1}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){3})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,2}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){2})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,3}(?:(?:[0-9a-f]{1,4})))?::(?:(?:[0-9a-f]{1,4})):)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,4}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,5}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,6}(?:(?:[0-9a-f]{1,4})))?::))))
                \]  # an IPv6 address
            )
            (:[0-9]+)?                              # a port (optional)
            (/?|/\S+|\?\S*|\#\S*)                   # a /, nothing, a / with something, a query or a fragment
        $~ixu';

        $pattern = \sprintf($pattern, \implode('|', $protocols));

        if (!\preg_match($pattern, $value)) {
            $message = \sprintf(
                static::generateMessage($message)
                    ?: 'Value "%s" was expected to be a valid URL starting with http or https',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_URL, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is alphanumeric.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function alnum($value, $message = null, $propertyPath = null)
    {
        try {
            static::regex($value, '(^([a-zA-Z]{1}[a-zA-Z0-9]*)$)', $message, $propertyPath);
        } catch (AssertionFailedException $e) {
            $message = \sprintf(
                static::generateMessage($message)
                    ?: 'Value "%s" is not alphanumeric, starting with letters and containing only letters and numbers.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_ALNUM, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value matches a regex.
     *
     * @param mixed                $value
     * @param string               $pattern
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function regex($value, $pattern, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        if (!\preg_match($pattern, $value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" does not match expression.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_REGEX, $propertyPath,
                ['pattern' => $pattern]);
        }

        return true;
    }

    /**
     * Assert that the given string is a valid json string.
     * NOTICE:
     * Since this does a json_decode to determine its validity
     * you probably should consider, when using the variable
     * content afterwards, just to decode and check for yourself instead
     * of using this assertion.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function isJsonString($value, $message = null, $propertyPath = null)
    {
        if (null === \json_decode($value) && JSON_ERROR_NONE !== \json_last_error()) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not a valid JSON string.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_JSON_STRING, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the given string is a valid UUID.
     * Uses code from {@link https://github.com/ramsey/uuid} that is MIT licensed.
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function uuid($value, $message = null, $propertyPath = null)
    {
        $value = \str_replace(['urn:', 'uuid:', '{', '}'], '', $value);

        if ($value === '00000000-0000-0000-0000-000000000000') {
            return true;
        }

        if (!\preg_match('/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$/', $value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not a valid UUID.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_UUID, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the given string is a valid E164 Phone Number.
     *
     * @see https://en.wikipedia.org/wiki/E.164
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function e164($value, $message = null, $propertyPath = null)
    {
        if (!\preg_match('/^\+?[1-9]\d{1,14}$/', $value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not a valid E164.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_E164, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is an IPv4 address
     * (using input_filter/FILTER_VALIDATE_IP).
     *
     * @param string               $value
     * @param null|int             $flag
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @see http://php.net/manual/filter.filters.flags.php
     */
    public static function ipv4($value, $flag = null, $message = null, $propertyPath = null)
    {
        static::ip($value, $flag | FILTER_FLAG_IPV4,
            static::generateMessage($message) ?: 'Value "%s" was expected to be a valid IPv4 address.', $propertyPath);

        return true;
    }

    /**
     * Assert that value is an IPv4 or IPv6 address
     * (using input_filter/FILTER_VALIDATE_IP).
     *
     * @param string               $value
     * @param null|int             $flag
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @see http://php.net/manual/filter.filters.flags.php
     */
    public static function ip($value, $flag = null, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);
        if (!\filter_var($value, FILTER_VALIDATE_IP, $flag)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" was expected to be a valid IP address.',
                static::stringify($value)
            );
            throw static::createException($value, $message, static::INVALID_IP, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is an IPv6 address
     * (using input_filter/FILTER_VALIDATE_IP).
     *
     * @param string               $value
     * @param null|int             $flag
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @see http://php.net/manual/filter.filters.flags.php
     */
    public static function ipv6($value, $flag = null, $message = null, $propertyPath = null)
    {
        static::ip($value, $flag | FILTER_FLAG_IPV6,
            static::generateMessage($message) ?: 'Value "%s" was expected to be a valid IPv6 address.', $propertyPath);

        return true;
    }

    /**
     * Assert that date is valid and corresponds to the given format.
     *
     * @param string               $value
     * @param string               $format       supports all of the options date(), except for the following:
     *                                           N, w, W, t, L, o, B, a, A, g, h, I, O, P, Z, c, r
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @see http://php.net/manual/function.date.php#refsect1-function.date-parameters
     */
    public static function date($value, $format, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);
        static::string($format, $message, $propertyPath);

        $dateTime = \DateTime::createFromFormat($format, $value);

        if (false === $dateTime || $value !== $dateTime->format($format)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Date "%s" is invalid or does not match format "%s".',
                static::stringify($value),
                static::stringify($format)
            );

            throw static::createException($value, $message, static::INVALID_DATE, $propertyPath, ['format' => $format]);
        }

        return true;
    }
}
