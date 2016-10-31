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

/**
 * Chaining builder for lazy assertions
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 *
 * @method LazyAssertion alnum($message = null, $propertyPath = null) Assert that value is alphanumeric.
 * @method LazyAssertion between($lowerLimit, $upperLimit, $message = null, $propertyPath = null) Assert that a value is greater or equal than a lower limit, and less than or equal to an upper limit.
 * @method LazyAssertion betweenExclusive($lowerLimit, $upperLimit, $message = null, $propertyPath = null) Assert that a value is greater than a lower limit, and less than an upper limit.
 * @method LazyAssertion betweenLength($minLength, $maxLength, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string length is between min,max lengths.
 * @method LazyAssertion boolean($message = null, $propertyPath = null) Assert that value is php boolean.
 * @method LazyAssertion choice($choices, $message = null, $propertyPath = null) Assert that value is in array of choices.
 * @method LazyAssertion choicesNotEmpty($choices, $message = null, $propertyPath = null) Determines if the values array has every choice as key and that this choice has content.
 * @method LazyAssertion classExists($message = null, $propertyPath = null) Assert that the class exists.
 * @method LazyAssertion contains($needle, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string contains a sequence of chars.
 * @method LazyAssertion count($count, $message = null, $propertyPath = null) Assert that the count of countable is equal to count.
 * @method LazyAssertion date($format, $message = null, $propertyPath = null) Assert that date is valid and corresponds to the given format.
 * @method LazyAssertion digit($message = null, $propertyPath = null) Validates if an integer or integerish is a digit.
 * @method LazyAssertion directory($message = null, $propertyPath = null) Assert that a directory exists.
 * @method LazyAssertion e164($message = null, $propertyPath = null) Assert that the given string is a valid E164 Phone Number.
 * @method LazyAssertion email($message = null, $propertyPath = null) Assert that value is an email adress (using input_filter/FILTER_VALIDATE_EMAIL).
 * @method LazyAssertion endsWith($needle, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string ends with a sequence of chars.
 * @method LazyAssertion eq($value2, $message = null, $propertyPath = null) Assert that two values are equal (using == ).
 * @method LazyAssertion false($message = null, $propertyPath = null) Assert that the value is boolean False.
 * @method LazyAssertion file($message = null, $propertyPath = null) Assert that a file exists.
 * @method LazyAssertion float($message = null, $propertyPath = null) Assert that value is a php float.
 * @method LazyAssertion greaterOrEqualThan($limit, $message = null, $propertyPath = null) Determines if the value is greater or equal than given limit.
 * @method LazyAssertion greaterThan($limit, $message = null, $propertyPath = null) Determines if the value is greater than given limit.
 * @method LazyAssertion implementsInterface($interfaceName, $message = null, $propertyPath = null) Assert that the class implements the interface.
 * @method LazyAssertion inArray($choices, $message = null, $propertyPath = null) Alias of {@see choice()}.
 * @method LazyAssertion integer($message = null, $propertyPath = null) Assert that value is a php integer.
 * @method LazyAssertion integerish($message = null, $propertyPath = null) Assert that value is a php integer'ish.
 * @method LazyAssertion interfaceExists($message = null, $propertyPath = null) Assert that the interface exists.
 * @method LazyAssertion ip($flag = null, $message = null, $propertyPath = null) Assert that value is an IPv4 or IPv6 address.
 * @method LazyAssertion ipv4($flag = null, $message = null, $propertyPath = null) Assert that value is an IPv4 address.
 * @method LazyAssertion ipv6($flag = null, $message = null, $propertyPath = null) Assert that value is an IPv6 address.
 * @method LazyAssertion isArray($message = null, $propertyPath = null) Assert that value is an array.
 * @method LazyAssertion isArrayAccessible($message = null, $propertyPath = null) Assert that value is an array or an array-accessible object.
 * @method LazyAssertion isCallable($message = null, $propertyPath = null) Determines that the provided value is callable.
 * @method LazyAssertion isInstanceOf($className, $message = null, $propertyPath = null) Assert that value is instance of given class-name.
 * @method LazyAssertion isJsonString($message = null, $propertyPath = null) Assert that the given string is a valid json string.
 * @method LazyAssertion isObject($message = null, $propertyPath = null) Determines that the provided value is an object.
 * @method LazyAssertion isTraversable($message = null, $propertyPath = null) Assert that value is an array or a traversable object.
 * @method LazyAssertion keyExists($key, $message = null, $propertyPath = null) Assert that key exists in an array.
 * @method LazyAssertion keyIsset($key, $message = null, $propertyPath = null) Assert that key exists in an array/array-accessible object using isset().
 * @method LazyAssertion keyNotExists($key, $message = null, $propertyPath = null) Assert that key does not exist in an array.
 * @method LazyAssertion length($length, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string has a given length.
 * @method LazyAssertion lessOrEqualThan($limit, $message = null, $propertyPath = null) Determines if the value is less or than given limit.
 * @method LazyAssertion lessThan($limit, $message = null, $propertyPath = null) Determines if the value is less than given limit.
 * @method LazyAssertion max($maxValue, $message = null, $propertyPath = null) Assert that a number is smaller as a given limit.
 * @method LazyAssertion maxLength($maxLength, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string value is not longer than $maxLength chars.
 * @method LazyAssertion methodExists($object, $message = null, $propertyPath = null) Determines that the named method is defined in the provided object.
 * @method LazyAssertion min($minValue, $message = null, $propertyPath = null) Assert that a value is at least as big as a given limit.
 * @method LazyAssertion minLength($minLength, $message = null, $propertyPath = null, $encoding = "utf8") Assert that a string is at least $minLength chars long.
 * @method LazyAssertion noContent($message = null, $propertyPath = null) Assert that value is empty.
 * @method LazyAssertion notBlank($message = null, $propertyPath = null) Assert that value is not blank.
 * @method LazyAssertion notEmpty($message = null, $propertyPath = null) Assert that value is not empty.
 * @method LazyAssertion notEmptyKey($key, $message = null, $propertyPath = null) Assert that key exists in an array/array-accessible object and it's value is not empty.
 * @method LazyAssertion notEq($value2, $message = null, $propertyPath = null) Assert that two values are not equal (using == ).
 * @method LazyAssertion notInArray($choices, $message = null, $propertyPath = null) Assert that value is not in array of choices.
 * @method LazyAssertion notIsInstanceOf($className, $message = null, $propertyPath = null) Assert that value is not instance of given class-name.
 * @method LazyAssertion notNull($message = null, $propertyPath = null) Assert that value is not null.
 * @method LazyAssertion notSame($value2, $message = null, $propertyPath = null) Assert that two values are not the same (using === ).
 * @method LazyAssertion null($message = null, $propertyPath = null) Assert that value is null.
 * @method LazyAssertion numeric($message = null, $propertyPath = null) Assert that value is numeric.
 * @method LazyAssertion range($minValue, $maxValue, $message = null, $propertyPath = null) Assert that value is in range of numbers.
 * @method LazyAssertion readable($message = null, $propertyPath = null) Assert that the value is something readable.
 * @method LazyAssertion regex($pattern, $message = null, $propertyPath = null) Assert that value matches a regex.
 * @method LazyAssertion same($value2, $message = null, $propertyPath = null) Assert that two values are the same (using ===).
 * @method LazyAssertion satisfy($callback, $message = null, $propertyPath = null) Assert that the provided value is valid according to a callback.
 * @method LazyAssertion scalar($message = null, $propertyPath = null) Assert that value is a PHP scalar.
 * @method LazyAssertion startsWith($needle, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string starts with a sequence of chars.
 * @method LazyAssertion string($message = null, $propertyPath = null) Assert that value is a string.
 * @method LazyAssertion subclassOf($className, $message = null, $propertyPath = null) Assert that value is subclass of given class-name.
 * @method LazyAssertion true($message = null, $propertyPath = null) Assert that the value is boolean True.
 * @method LazyAssertion url($message = null, $propertyPath = null) Assert that value is an URL.
 * @method LazyAssertion uuid($message = null, $propertyPath = null) Assert that the given string is a valid UUID.
 * @method LazyAssertion writeable($message = null, $propertyPath = null) Assert that the value is something writeable.
 * @method LazyAssertion all() Switch chain into validation mode for an array of values.
 * @method LazyAssertion nullOr() Switch chain into mode allowing nulls, ignoring further assertions.
 */
class LazyAssertion
{
    private $currentChainFailed = false;
    private $currentChain;
    private $errors = array();

    public function that($value, $propertyPath, $defaultMessage = null)
    {
        $this->currentChainFailed = false;
        $this->currentChain = \Assert\that($value, $defaultMessage, $propertyPath);

        return $this;
    }

    public function __call($method, $args)
    {
        if ($this->currentChainFailed === true) {
            return $this;
        }

        try {
            call_user_func_array(array($this->currentChain, $method), $args);
        } catch (AssertionFailedException $e) {
            $this->errors[] = $e;
            $this->currentChainFailed = true;
        }

        return $this;
    }

    /**
     * @throws \Assert\LazyAssertionException
     * @return bool
     */
    public function verifyNow()
    {
        if ($this->errors) {
            throw LazyAssertionException::fromErrors($this->errors);
        }

        return true;
    }
}
