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

namespace Assert;

use LogicException;

/**
 * Chaining builder for lazy assertions.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 *
 * @method $this alnum(string|callable $message = null, string $propertyPath = null) Assert that value is alphanumeric.
 * @method $this base64(string|callable $message = null, string $propertyPath = null) Assert that a constant is defined.
 * @method $this between(mixed $lowerLimit, mixed $upperLimit, string $message = null, string $propertyPath = null) Assert that a value is greater or equal than a lower limit, and less than or equal to an upper limit.
 * @method $this betweenExclusive(mixed $lowerLimit, mixed $upperLimit, string $message = null, string $propertyPath = null) Assert that a value is greater than a lower limit, and less than an upper limit.
 * @method $this betweenLength(int $minLength, int $maxLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string length is between min and max lengths.
 * @method $this boolean(string|callable $message = null, string $propertyPath = null) Assert that value is php boolean.
 * @method $this choice(array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is in array of choices.
 * @method $this choicesNotEmpty(array $choices, string|callable $message = null, string $propertyPath = null) Determines if the values array has every choice as key and that this choice has content.
 * @method $this classExists(string|callable $message = null, string $propertyPath = null) Assert that the class exists.
 * @method $this contains(string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string contains a sequence of chars.
 * @method $this count(int $count, string $message = null, string $propertyPath = null) Assert that the count of countable is equal to count.
 * @method $this date(string $format, string|callable $message = null, string $propertyPath = null) Assert that date is valid and corresponds to the given format.
 * @method $this defined(string|callable $message = null, string $propertyPath = null) Assert that a constant is defined.
 * @method $this digit(string|callable $message = null, string $propertyPath = null) Validates if an integer or integerish is a digit.
 * @method $this directory(string|callable $message = null, string $propertyPath = null) Assert that a directory exists.
 * @method $this e164(string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid E164 Phone Number.
 * @method $this email(string|callable $message = null, string $propertyPath = null) Assert that value is an email address (using input_filter/FILTER_VALIDATE_EMAIL).
 * @method $this endsWith(string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string ends with a sequence of chars.
 * @method $this eq(mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are equal (using ==).
 * @method $this eqArraySubset(mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that the array contains the subset.
 * @method $this extensionLoaded(string|callable $message = null, string $propertyPath = null) Assert that extension is loaded.
 * @method $this extensionVersion(string $operator, mixed $version, string|callable $message = null, string $propertyPath = null) Assert that extension is loaded and a specific version is installed.
 * @method $this false(string|callable $message = null, string $propertyPath = null) Assert that the value is boolean False.
 * @method $this file(string|callable $message = null, string $propertyPath = null) Assert that a file exists.
 * @method $this float(string|callable $message = null, string $propertyPath = null) Assert that value is a php float.
 * @method $this greaterOrEqualThan(mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is greater or equal than given limit.
 * @method $this greaterThan(mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is greater than given limit.
 * @method $this implementsInterface(string $interfaceName, string|callable $message = null, string $propertyPath = null) Assert that the class implements the interface.
 * @method $this inArray(array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is in array of choices. This is an alias of Assertion::choice().
 * @method $this integer(string|callable $message = null, string $propertyPath = null) Assert that value is a php integer.
 * @method $this integerish(string|callable $message = null, string $propertyPath = null) Assert that value is a php integer'ish.
 * @method $this interfaceExists(string|callable $message = null, string $propertyPath = null) Assert that the interface exists.
 * @method $this ip(int $flag = null, string|callable $message = null, string $propertyPath = null) Assert that value is an IPv4 or IPv6 address.
 * @method $this ipv4(int $flag = null, string|callable $message = null, string $propertyPath = null) Assert that value is an IPv4 address.
 * @method $this ipv6(int $flag = null, string|callable $message = null, string $propertyPath = null) Assert that value is an IPv6 address.
 * @method $this isArray(string|callable $message = null, string $propertyPath = null) Assert that value is an array.
 * @method $this isArrayAccessible(string|callable $message = null, string $propertyPath = null) Assert that value is an array or an array-accessible object.
 * @method $this isCallable(string|callable $message = null, string $propertyPath = null) Determines that the provided value is callable.
 * @method $this isCountable(string|callable $message = null, string $propertyPath = null) Assert that value is countable.
 * @method $this isInstanceOf(string $className, string|callable $message = null, string $propertyPath = null) Assert that value is instance of given class-name.
 * @method $this isJsonString(string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid json string.
 * @method $this isObject(string|callable $message = null, string $propertyPath = null) Determines that the provided value is an object.
 * @method $this isResource(string|callable $message = null, string $propertyPath = null) Assert that value is a resource.
 * @method $this isTraversable(string|callable $message = null, string $propertyPath = null) Assert that value is an array or a traversable object.
 * @method $this keyExists(string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key exists in an array.
 * @method $this keyIsset(string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key exists in an array/array-accessible object using isset().
 * @method $this keyNotExists(string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key does not exist in an array.
 * @method $this length(int $length, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string has a given length.
 * @method $this lessOrEqualThan(mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is less or equal than given limit.
 * @method $this lessThan(mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is less than given limit.
 * @method $this max(mixed $maxValue, string|callable $message = null, string $propertyPath = null) Assert that a number is smaller as a given limit.
 * @method $this maxCount(int $count, string $message = null, string $propertyPath = null) Assert that the countable have at most $count elements.
 * @method $this maxLength(int $maxLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string value is not longer than $maxLength chars.
 * @method $this methodExists(mixed $object, string|callable $message = null, string $propertyPath = null) Determines that the named method is defined in the provided object.
 * @method $this min(mixed $minValue, string|callable $message = null, string $propertyPath = null) Assert that a value is at least as big as a given limit.
 * @method $this minCount(int $count, string $message = null, string $propertyPath = null) Assert that the countable have at least $count elements.
 * @method $this minLength(int $minLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that a string is at least $minLength chars long.
 * @method $this noContent(string|callable $message = null, string $propertyPath = null) Assert that value is empty.
 * @method $this notBlank(string|callable $message = null, string $propertyPath = null) Assert that value is not blank.
 * @method $this notContains(string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string does not contains a sequence of chars.
 * @method $this notEmpty(string|callable $message = null, string $propertyPath = null) Assert that value is not empty.
 * @method $this notEmptyKey(string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key exists in an array/array-accessible object and its value is not empty.
 * @method $this notEq(mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are not equal (using == ).
 * @method $this notInArray(array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is not in array of choices.
 * @method $this notIsInstanceOf(string $className, string|callable $message = null, string $propertyPath = null) Assert that value is not instance of given class-name.
 * @method $this notNull(string|callable $message = null, string $propertyPath = null) Assert that value is not null.
 * @method $this notRegex(string $pattern, string|callable $message = null, string $propertyPath = null) Assert that value does not match a regex.
 * @method $this notSame(mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are not the same (using === ).
 * @method $this null(string|callable $message = null, string $propertyPath = null) Assert that value is null.
 * @method $this numeric(string|callable $message = null, string $propertyPath = null) Assert that value is numeric.
 * @method $this objectOrClass(string|callable $message = null, string $propertyPath = null) Assert that the value is an object, or a class that exists.
 * @method $this phpVersion(mixed $version, string|callable $message = null, string $propertyPath = null) Assert on PHP version.
 * @method $this propertiesExist(array $properties, string|callable $message = null, string $propertyPath = null) Assert that the value is an object or class, and that the properties all exist.
 * @method $this propertyExists(string $property, string|callable $message = null, string $propertyPath = null) Assert that the value is an object or class, and that the property exists.
 * @method $this range(mixed $minValue, mixed $maxValue, string|callable $message = null, string $propertyPath = null) Assert that value is in range of numbers.
 * @method $this readable(string|callable $message = null, string $propertyPath = null) Assert that the value is something readable.
 * @method $this regex(string $pattern, string|callable $message = null, string $propertyPath = null) Assert that value matches a regex.
 * @method $this same(mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are the same (using ===).
 * @method $this satisfy(callable $callback, string|callable $message = null, string $propertyPath = null) Assert that the provided value is valid according to a callback.
 * @method $this scalar(string|callable $message = null, string $propertyPath = null) Assert that value is a PHP scalar.
 * @method $this startsWith(string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string starts with a sequence of chars.
 * @method $this string(string|callable $message = null, string $propertyPath = null) Assert that value is a string.
 * @method $this subclassOf(string $className, string|callable $message = null, string $propertyPath = null) Assert that value is subclass of given class-name.
 * @method $this true(string|callable $message = null, string $propertyPath = null) Assert that the value is boolean True.
 * @method $this url(string|callable $message = null, string $propertyPath = null) Assert that value is an URL.
 * @method $this uuid(string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid UUID.
 * @method $this version(string $operator, string $version2, string|callable $message = null, string $propertyPath = null) Assert comparison of two versions.
 * @method $this writeable(string|callable $message = null, string $propertyPath = null) Assert that the value is something writeable.
 * @method $this all() Switch chain into validation mode for an array of values.
 * @method $this nullOr() Switch chain into mode allowing nulls, ignoring further assertions.
 */
class LazyAssertion
{
    private $currentChainFailed = false;
    private $alwaysTryAll = false;
    private $thisChainTryAll = false;
    private $currentChain;
    private $errors = [];

    /** @var string The class to use as AssertionChain factory */
    private $assertClass = Assert::class;

    /** @var string|LazyAssertionException The class to use for exceptions */
    private $exceptionClass = LazyAssertionException::class;

    /**
     * @return $this
     */
    public function that($value, $propertyPath, $defaultMessage = null)
    {
        $this->currentChainFailed = false;
        $this->thisChainTryAll = false;
        $assertClass = $this->assertClass;
        $this->currentChain = $assertClass::that($value, $defaultMessage, $propertyPath);

        return $this;
    }

    /**
     * @return $this
     */
    public function tryAll()
    {
        if (!$this->currentChain) {
            $this->alwaysTryAll = true;
        }

        $this->thisChainTryAll = true;

        return $this;
    }

    public function __call($method, $args)
    {
        if (false === $this->alwaysTryAll
            && false === $this->thisChainTryAll
            && true === $this->currentChainFailed
        ) {
            return $this;
        }

        try {
            \call_user_func_array([$this->currentChain, $method], $args);
        } catch (AssertionFailedException $e) {
            $this->errors[] = $e;
            $this->currentChainFailed = true;
        }

        return $this;
    }

    /**
     * @throws LazyAssertionException
     *
     * @return bool
     */
    public function verifyNow()
    {
        if ($this->errors) {
            throw \call_user_func([$this->exceptionClass, 'fromErrors'], $this->errors);
        }

        return true;
    }

    /**
     * @param string $className
     *
     * @return $this
     */
    public function setAssertClass(string $className)
    {
        if (Assert::class !== $className && !\is_subclass_of($className, Assert::class)) {
            throw new LogicException($className.' is not (a subclass of) '. Assert::class);
        }

        $this->assertClass = $className;

        return $this;
    }

    /**
     * @param string $className
     *
     * @return $this
     */
    public function setExceptionClass(string $className)
    {
        if (LazyAssertionException::class !== $className && !\is_subclass_of($className, LazyAssertionException::class)) {
            throw new LogicException($className.' is not (a subclass of) '.LazyAssertionException::class);
        }

        $this->exceptionClass = $className;

        return $this;
    }
}
