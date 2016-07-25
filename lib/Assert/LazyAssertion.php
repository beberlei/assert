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
 * @method \Assert\LazyAssertion alnum($message = null, $propertyPath = null) Assert that value is alphanumeric.
 * @method \Assert\LazyAssertion betweenLength($minLength, $maxLength, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string length is between min,max lengths.
 * @method \Assert\LazyAssertion boolean($message = null, $propertyPath = null) Assert that value is php boolean.
 * @method \Assert\LazyAssertion choice($choices, $message = null, $propertyPath = null) Assert that value is in array of choices.
 * @method \Assert\LazyAssertion choicesNotEmpty($choices, $message = null, $propertyPath = null) Determines if the values array has every choice as key and that this choice has content.
 * @method \Assert\LazyAssertion classExists($message = null, $propertyPath = null) Assert that the class exists.
 * @method \Assert\LazyAssertion contains($needle, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string contains a sequence of chars.
 * @method \Assert\LazyAssertion count($count, $message = null, $propertyPath = null) Assert that the count of countable is equal to count.
 * @method \Assert\LazyAssertion date($format, $message = null, $propertyPath = null) Assert that date is valid and corresponds to the given format.
 * @method \Assert\LazyAssertion digit($message = null, $propertyPath = null) Validates if an integer or integerish is a digit.
 * @method \Assert\LazyAssertion directory($message = null, $propertyPath = null) Assert that a directory exists.
 * @method \Assert\LazyAssertion email($message = null, $propertyPath = null) Assert that value is an email adress (using input_filter/FILTER_VALIDATE_EMAIL).
 * @method \Assert\LazyAssertion endsWith($needle, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string ends with a sequence of chars.
 * @method \Assert\LazyAssertion eq($value2, $message = null, $propertyPath = null) Assert that two values are equal (using == ).
 * @method \Assert\LazyAssertion false($message = null, $propertyPath = null) Assert that the value is boolean False.
 * @method \Assert\LazyAssertion file($message = null, $propertyPath = null) Assert that a file exists.
 * @method \Assert\LazyAssertion float($message = null, $propertyPath = null) Assert that value is a php float.
 * @method \Assert\LazyAssertion greaterOrEqualThan($limit, $message = null, $propertyPath = null) Determines if the value is greater or equal than given limit.
 * @method \Assert\LazyAssertion greaterThan($limit, $message = null, $propertyPath = null) Determines if the value is greater than given limit.
 * @method \Assert\LazyAssertion implementsInterface($interfaceName, $message = null, $propertyPath = null) Assert that the class implements the interface.
 * @method \Assert\LazyAssertion inArray($choices, $message = null, $propertyPath = null) Alias of {@see choice()}.
 * @method \Assert\LazyAssertion integer($message = null, $propertyPath = null) Assert that value is a php integer.
 * @method \Assert\LazyAssertion integerish($message = null, $propertyPath = null) Assert that value is a php integer'ish.
 * @method \Assert\LazyAssertion isArray($message = null, $propertyPath = null) Assert that value is an array.
 * @method \Assert\LazyAssertion isArrayAccessible($message = null, $propertyPath = null) Assert that value is an array or an array-accessible object.
 * @method \Assert\LazyAssertion isInstanceOf($className, $message = null, $propertyPath = null) Assert that value is instance of given class-name.
 * @method \Assert\LazyAssertion isJsonString($message = null, $propertyPath = null) Assert that the given string is a valid json string.
 * @method \Assert\LazyAssertion isObject($message = null, $propertyPath = null) Determines that the provided value is an object.
 * @method \Assert\LazyAssertion isTraversable($message = null, $propertyPath = null) Assert that value is an array or a traversable object.
 * @method \Assert\LazyAssertion keyExists($key, $message = null, $propertyPath = null) Assert that key exists in an array.
 * @method \Assert\LazyAssertion keyIsset($key, $message = null, $propertyPath = null) Assert that key exists in an array/array-accessible object using isset().
 * @method \Assert\LazyAssertion length($length, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string has a given length.
 * @method \Assert\LazyAssertion lessOrEqualThan($limit, $message = null, $propertyPath = null) Determines if the value is less or than given limit.
 * @method \Assert\LazyAssertion lessThan($limit, $message = null, $propertyPath = null) Determines if the value is less than given limit.
 * @method \Assert\LazyAssertion max($maxValue, $message = null, $propertyPath = null) Assert that a number is smaller as a given limit.
 * @method \Assert\LazyAssertion maxLength($maxLength, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string value is not longer than $maxLength chars.
 * @method \Assert\LazyAssertion methodExists($object, $message = null, $propertyPath = null) Determines that the named method is defined in the provided object.
 * @method \Assert\LazyAssertion min($minValue, $message = null, $propertyPath = null) Assert that a value is at least as big as a given limit.
 * @method \Assert\LazyAssertion minLength($minLength, $message = null, $propertyPath = null, $encoding = "utf8") Assert that a string is at least $minLength chars long.
 * @method \Assert\LazyAssertion noContent($message = null, $propertyPath = null) Assert that value is empty.
 * @method \Assert\LazyAssertion notBlank($message = null, $propertyPath = null) Assert that value is not blank.
 * @method \Assert\LazyAssertion notEmpty($message = null, $propertyPath = null) Assert that value is not empty.
 * @method \Assert\LazyAssertion notEmptyKey($key, $message = null, $propertyPath = null) Assert that key exists in an array/array-accessible object and it's value is not empty.
 * @method \Assert\LazyAssertion notEq($value2, $message = null, $propertyPath = null) Assert that two values are not equal (using == ).
 * @method \Assert\LazyAssertion notIsInstanceOf($className, $message = null, $propertyPath = null) Assert that value is not instance of given class-name.
 * @method \Assert\LazyAssertion notNull($message = null, $propertyPath = null) Assert that value is not null.
 * @method \Assert\LazyAssertion notSame($value2, $message = null, $propertyPath = null) Assert that two values are not the same (using === ).
 * @method \Assert\LazyAssertion numeric($message = null, $propertyPath = null) Assert that value is numeric.
 * @method \Assert\LazyAssertion range($minValue, $maxValue, $message = null, $propertyPath = null) Assert that value is in range of numbers.
 * @method \Assert\LazyAssertion readable($message = null, $propertyPath = null) Assert that the value is something readable.
 * @method \Assert\LazyAssertion regex($pattern, $message = null, $propertyPath = null) Assert that value matches a regex.
 * @method \Assert\LazyAssertion same($value2, $message = null, $propertyPath = null) Assert that two values are the same (using ===).
 * @method \Assert\LazyAssertion scalar($message = null, $propertyPath = null) Assert that value is a PHP scalar.
 * @method \Assert\LazyAssertion startsWith($needle, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string starts with a sequence of chars.
 * @method \Assert\LazyAssertion string($message = null, $propertyPath = null) Assert that value is a string.
 * @method \Assert\LazyAssertion subclassOf($className, $message = null, $propertyPath = null) Assert that value is subclass of given class-name.
 * @method \Assert\LazyAssertion true($message = null, $propertyPath = null) Assert that the value is boolean True.
 * @method \Assert\LazyAssertion url($message = null, $propertyPath = null) Assert that value is an URL.
 * @method \Assert\LazyAssertion uuid($message = null, $propertyPath = null) Assert that the given string is a valid UUID.
 * @method \Assert\LazyAssertion writeable($message = null, $propertyPath = null) Assert that the value is something writeable.
 * @method \Assert\LazyAssertion all() Switch chain into validation mode for an array of values.
 * @method \Assert\LazyAssertion nullOr() Switch chain into mode allowing nulls, ignoring further assertions.
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
     */
    public function verifyNow()
    {
        if ($this->errors) {
            throw LazyAssertionException::fromErrors($this->errors);
        }
    }
}
