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
 * @method static static alnum(string|callable $message = null, string $propertyPath = null) Assert that value is alphanumeric.
 * @method static static base64(string|callable $message = null, string $propertyPath = null) Assert that a constant is defined.
 * @method static static between(mixed $lowerLimit, mixed $upperLimit, string|callable $message = null, string $propertyPath = null) Assert that a value is greater or equal than a lower limit, and less than or equal to an upper limit.
 * @method static static betweenExclusive(mixed $lowerLimit, mixed $upperLimit, string|callable $message = null, string $propertyPath = null) Assert that a value is greater than a lower limit, and less than an upper limit.
 * @method static static betweenLength(int $minLength, int $maxLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string length is between min and max lengths.
 * @method static static boolean(string|callable $message = null, string $propertyPath = null) Assert that value is php boolean.
 * @method static static choice(array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is in array of choices.
 * @method static static choicesNotEmpty(array $choices, string|callable $message = null, string $propertyPath = null) Determines if the values array has every choice as key and that this choice has content.
 * @method static static classExists(string|callable $message = null, string $propertyPath = null) Assert that the class exists.
 * @method static static contains(string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string contains a sequence of chars.
 * @method static static count(int $count, string|callable $message = null, string $propertyPath = null) Assert that the count of countable is equal to count.
 * @method static static date(string $format, string|callable $message = null, string $propertyPath = null) Assert that date is valid and corresponds to the given format.
 * @method static static defined(string|callable $message = null, string $propertyPath = null) Assert that a constant is defined.
 * @method static static digit(string|callable $message = null, string $propertyPath = null) Validates if an integer or integerish is a digit.
 * @method static static directory(string|callable $message = null, string $propertyPath = null) Assert that a directory exists.
 * @method static static e164(string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid E164 Phone Number.
 * @method static static email(string|callable $message = null, string $propertyPath = null) Assert that value is an email address (using input_filter/FILTER_VALIDATE_EMAIL).
 * @method static static endsWith(string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string ends with a sequence of chars.
 * @method static static eq(mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are equal (using ==).
 * @method static static eqArraySubset(mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that the array contains the subset.
 * @method static static extensionLoaded(string|callable $message = null, string $propertyPath = null) Assert that extension is loaded.
 * @method static static extensionVersion(string $operator, mixed $version, string|callable $message = null, string $propertyPath = null) Assert that extension is loaded and a specific version is installed.
 * @method static static false(string|callable $message = null, string $propertyPath = null) Assert that the value is boolean False.
 * @method static static file(string|callable $message = null, string $propertyPath = null) Assert that a file exists.
 * @method static static float(string|callable $message = null, string $propertyPath = null) Assert that value is a php float.
 * @method static static greaterOrEqualThan(mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is greater or equal than given limit.
 * @method static static greaterThan(mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is greater than given limit.
 * @method static static implementsInterface(string $interfaceName, string|callable $message = null, string $propertyPath = null) Assert that the class implements the interface.
 * @method static static inArray(array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is in array of choices. This is an alias of Assertion::choice().
 * @method static static integer(string|callable $message = null, string $propertyPath = null) Assert that value is a php integer.
 * @method static static integerish(string|callable $message = null, string $propertyPath = null) Assert that value is a php integer'ish.
 * @method static static interfaceExists(string|callable $message = null, string $propertyPath = null) Assert that the interface exists.
 * @method static static ip(int $flag = null, string|callable $message = null, string $propertyPath = null) Assert that value is an IPv4 or IPv6 address.
 * @method static static ipv4(int $flag = null, string|callable $message = null, string $propertyPath = null) Assert that value is an IPv4 address.
 * @method static static ipv6(int $flag = null, string|callable $message = null, string $propertyPath = null) Assert that value is an IPv6 address.
 * @method static static isArray(string|callable $message = null, string $propertyPath = null) Assert that value is an array.
 * @method static static isArrayAccessible(string|callable $message = null, string $propertyPath = null) Assert that value is an array or an array-accessible object.
 * @method static static isCallable(string|callable $message = null, string $propertyPath = null) Determines that the provided value is callable.
 * @method static static isCountable(string|callable $message = null, string $propertyPath = null) Assert that value is countable.
 * @method static static isInstanceOf(string $className, string|callable $message = null, string $propertyPath = null) Assert that value is instance of given class-name.
 * @method static static isJsonString(string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid json string.
 * @method static static isObject(string|callable $message = null, string $propertyPath = null) Determines that the provided value is an object.
 * @method static static isResource(string|callable $message = null, string $propertyPath = null) Assert that value is a resource.
 * @method static static isTraversable(string|callable $message = null, string $propertyPath = null) Assert that value is an array or a traversable object.
 * @method static static keyExists(string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key exists in an array.
 * @method static static keyIsset(string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key exists in an array/array-accessible object using isset().
 * @method static static keyNotExists(string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key does not exist in an array.
 * @method static static length(int $length, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string has a given length.
 * @method static static lessOrEqualThan(mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is less or equal than given limit.
 * @method static static lessThan(mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is less than given limit.
 * @method static static max(mixed $maxValue, string|callable $message = null, string $propertyPath = null) Assert that a number is smaller as a given limit.
 * @method static static maxCount(int $count, string|callable $message = null, string $propertyPath = null) Assert that the countable have at most $count elements.
 * @method static static maxLength(int $maxLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string value is not longer than $maxLength chars.
 * @method static static methodExists(mixed $object, string|callable $message = null, string $propertyPath = null) Determines that the named method is defined in the provided object.
 * @method static static min(mixed $minValue, string|callable $message = null, string $propertyPath = null) Assert that a value is at least as big as a given limit.
 * @method static static minCount(int $count, string|callable $message = null, string $propertyPath = null) Assert that the countable have at least $count elements.
 * @method static static minLength(int $minLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that a string is at least $minLength chars long.
 * @method static static noContent(string|callable $message = null, string $propertyPath = null) Assert that value is empty.
 * @method static static notBlank(string|callable $message = null, string $propertyPath = null) Assert that value is not blank.
 * @method static static notContains(string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string does not contains a sequence of chars.
 * @method static static notEmpty(string|callable $message = null, string $propertyPath = null) Assert that value is not empty.
 * @method static static notEmptyKey(string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key exists in an array/array-accessible object and its value is not empty.
 * @method static static notEq(mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are not equal (using ==).
 * @method static static notInArray(array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is not in array of choices.
 * @method static static notIsInstanceOf(string $className, string|callable $message = null, string $propertyPath = null) Assert that value is not instance of given class-name.
 * @method static static notNull(string|callable $message = null, string $propertyPath = null) Assert that value is not null.
 * @method static static notRegex(string $pattern, string|callable $message = null, string $propertyPath = null) Assert that value does not match a regex.
 * @method static static notSame(mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are not the same (using ===).
 * @method static static null(string|callable $message = null, string $propertyPath = null) Assert that value is null.
 * @method static static numeric(string|callable $message = null, string $propertyPath = null) Assert that value is numeric.
 * @method static static objectOrClass(string|callable $message = null, string $propertyPath = null) Assert that the value is an object, or a class that exists.
 * @method static static phpVersion(mixed $version, string|callable $message = null, string $propertyPath = null) Assert on PHP version.
 * @method static static propertiesExist(array $properties, string|callable $message = null, string $propertyPath = null) Assert that the value is an object or class, and that the properties all exist.
 * @method static static propertyExists(string $property, string|callable $message = null, string $propertyPath = null) Assert that the value is an object or class, and that the property exists.
 * @method static static range(mixed $minValue, mixed $maxValue, string|callable $message = null, string $propertyPath = null) Assert that value is in range of numbers.
 * @method static static readable(string|callable $message = null, string $propertyPath = null) Assert that the value is something readable.
 * @method static static regex(string $pattern, string|callable $message = null, string $propertyPath = null) Assert that value matches a regex.
 * @method static static same(mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are the same (using ===).
 * @method static static satisfy(callable $callback, string|callable $message = null, string $propertyPath = null) Assert that the provided value is valid according to a callback.
 * @method static static scalar(string|callable $message = null, string $propertyPath = null) Assert that value is a PHP scalar.
 * @method static static startsWith(string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string starts with a sequence of chars.
 * @method static static string(string|callable $message = null, string $propertyPath = null) Assert that value is a string.
 * @method static static subclassOf(string $className, string|callable $message = null, string $propertyPath = null) Assert that value is subclass of given class-name.
 * @method static static true(string|callable $message = null, string $propertyPath = null) Assert that the value is boolean True.
 * @method static static url(string|callable $message = null, string $propertyPath = null) Assert that value is an URL.
 * @method static static uuid(string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid UUID.
 * @method static static version(string $operator, string $version2, string|callable $message = null, string $propertyPath = null) Assert comparison of two versions.
 * @method static static writeable(string|callable $message = null, string $propertyPath = null) Assert that the value is something writeable.
 * @method static static all() Switch chain into validation mode for an array of values.
 * @method static static nullOr() Switch chain into mode allowing nulls, ignoring further assertions.
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
     * @param mixed $value
     * @param string|null $propertyPath
     * @param string|callable|null $defaultMessage
     *
     * @return static
     */
    public function that($value, string $propertyPath = null, $defaultMessage = null)
    {
        $this->currentChainFailed = false;
        $this->thisChainTryAll = false;
        $assertClass = $this->assertClass;
        $this->currentChain = $assertClass::that($value, $defaultMessage, $propertyPath);

        return $this;
    }

    /**
     * @return static
     */
    public function tryAll()
    {
        if (!$this->currentChain) {
            $this->alwaysTryAll = true;
        }

        $this->thisChainTryAll = true;

        return $this;
    }

    /**
     * @param string $method
     * @param array $args
     *
     * @return static
     */
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
     * @return bool
     *
     * @throws LazyAssertionException
     */
    public function verifyNow(): bool
    {
        if ($this->errors) {
            throw \call_user_func([$this->exceptionClass, 'fromErrors'], $this->errors);
        }

        return true;
    }

    /**
     * @param string $className
     *
     * @return static
     */
    public function setAssertClass(string $className)
    {
        if (Assert::class !== $className && !\is_subclass_of($className, Assert::class)) {
            throw new LogicException($className.' is not (a subclass of) '.Assert::class);
        }

        $this->assertClass = $className;

        return $this;
    }

    /**
     * @param string $className
     *
     * @return static
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
