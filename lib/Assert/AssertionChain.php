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
 *
 * to kontakt@beberlei.de so I can send you a copy immediately.
 */

namespace Assert;

use ReflectionClass;

/**
 * Chaining builder for assertions
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 *
 * METHODSTART
 * @method \Assert\AssertionChain eq($value2, $message, $propertyPath) Assert that two values are equal (using == ).
 * @method \Assert\AssertionChain same($value2, $message, $propertyPath) Assert that two values are the same (using ===).
 * @method \Assert\AssertionChain notEq($value2, $message, $propertyPath) Assert that two values are not equal (using == ).
 * @method \Assert\AssertionChain notSame($value2, $message, $propertyPath) Assert that two values are not the same (using === ).
 * @method \Assert\AssertionChain integer($message, $propertyPath) Assert that value is a php integer.
 * @method \Assert\AssertionChain float($message, $propertyPath) Assert that value is a php float.
 * @method \Assert\AssertionChain digit($message, $propertyPath) Validates if an integer or integerish is a digit.
 * @method \Assert\AssertionChain integerish($message, $propertyPath) Assert that value is a php integer'ish.
 * @method \Assert\AssertionChain boolean($message, $propertyPath) Assert that value is php boolean
 * @method \Assert\AssertionChain notEmpty($message, $propertyPath) Assert that value is not empty
 * @method \Assert\AssertionChain noContent($message, $propertyPath) Assert that value is empty
 * @method \Assert\AssertionChain notNull($message, $propertyPath) Assert that value is not null
 * @method \Assert\AssertionChain string($message, $propertyPath) Assert that value is a string
 * @method \Assert\AssertionChain regex($pattern, $message, $propertyPath) Assert that value matches a regex
 * @method \Assert\AssertionChain isRegex($message, $propertyPath) Assert that pattern is a regex
 * @method \Assert\AssertionChain length($length, $message, $propertyPath, $encoding) Assert that string has a given length.
 * @method \Assert\AssertionChain minLength($minLength, $message, $propertyPath, $encoding) Assert that a string is at least $minLength chars long.
 * @method \Assert\AssertionChain maxLength($maxLength, $message, $propertyPath, $encoding) Assert that string value is not longer than $maxLength chars.
 * @method \Assert\AssertionChain betweenLength($minLength, $maxLength, $message, $propertyPath, $encoding) Assert that string length is between min,max lengths.
 * @method \Assert\AssertionChain startsWith($needle, $message, $propertyPath, $encoding) Assert that string starts with a sequence of chars.
 * @method \Assert\AssertionChain endsWith($needle, $message, $propertyPath, $encoding) Assert that string ends with a sequence of chars.
 * @method \Assert\AssertionChain contains($needle, $message, $propertyPath, $encoding) Assert that string contains a sequence of chars.
 * @method \Assert\AssertionChain choice($choices, $message, $propertyPath) Assert that value is in array of choices.
 * @method \Assert\AssertionChain inArray($choices, $message, $propertyPath) Alias of {@see choice()}
 * @method \Assert\AssertionChain numeric($message, $propertyPath) Assert that value is numeric.
 * @method \Assert\AssertionChain isArray($message, $propertyPath) Assert that value is array.
 * @method \Assert\AssertionChain keyExists($key, $message, $propertyPath) Assert that key exists in array
 * @method \Assert\AssertionChain notEmptyKey($key, $message, $propertyPath) Assert that key exists in array and it's value not empty.
 * @method \Assert\AssertionChain notBlank($message, $propertyPath) Assert that value is not blank
 * @method \Assert\AssertionChain isInstanceOf($className, $message, $propertyPath) Assert that value is instance of given class-name.
 * @method \Assert\AssertionChain notIsInstanceOf($className, $message, $propertyPath) Assert that value is not instance of given class-name.
 * @method \Assert\AssertionChain subclassOf($className, $message, $propertyPath) Assert that value is subclass of given class-name.
 * @method \Assert\AssertionChain range($minValue, $maxValue, $message, $propertyPath) Assert that value is in range of integers.
 * @method \Assert\AssertionChain min($minValue, $message, $propertyPath) Assert that a value is at least as big as a given limit
 * @method \Assert\AssertionChain max($maxValue, $message, $propertyPath) Assert that a number is smaller as a given limit
 * @method \Assert\AssertionChain file($message, $propertyPath) Assert that a file exists
 * @method \Assert\AssertionChain directory($message, $propertyPath) Assert that a directory exists
 * @method \Assert\AssertionChain readable($message, $propertyPath) Assert that the value is something readable
 * @method \Assert\AssertionChain writeable($message, $propertyPath) Assert that the value is something writeable
 * @method \Assert\AssertionChain email($message, $propertyPath) Assert that value is an email adress (using
 * @method \Assert\AssertionChain url($message, $propertyPath) Assert that value is an URL.
 * @method \Assert\AssertionChain alnum($message, $propertyPath) Assert that value is alphanumeric.
 * @method \Assert\AssertionChain true($message, $propertyPath) Assert that the value is boolean True.
 * @method \Assert\AssertionChain false($message, $propertyPath) Assert that the value is boolean False.
 * @method \Assert\AssertionChain classExists($message, $propertyPath) Assert that the class exists.
 * @method \Assert\AssertionChain implementsInterface($interfaceName, $message, $propertyPath) Assert that the class implements the interface
 * @method \Assert\AssertionChain isJsonString($message, $propertyPath) Assert that the given string is a valid json string.
 * @method \Assert\AssertionChain uuid($message, $propertyPath) Assert that the given string is a valid UUID
 * @method \Assert\AssertionChain count($count, $message, $propertyPath) Assert that the count of countable is equal to count.
 * METHODEND
 */
class AssertionChain
{
    private $value;
    private $defaultMessage;
    private $defaultPropertyPath;

    /**
     * Return each assertion as always valid.
     *
     * @var bool
     */
    private $alwaysValid = false;

    /**
     * Perform assertion on every element of array or traversable.
     *
     * @var bool
     */
    private $all = false;

    public function __construct($value, $defaultMessage = null, $defaultPropertyPath = null)
    {
        $this->value = $value;
        $this->defaultMessage = $defaultMessage;
        $this->defaultPropertyPath = $defaultPropertyPath;
    }

    /**
     * Call assertion on the current value in the chain.
     *
     * @param string $method
     * @param array $args
     *
     * @return \Assert\AssertionChain
     */
    public function __call($methodName, $args)
    {
        if ($this->alwaysValid === true) {
            return $this;
        }

        if (!method_exists('Assert\Assertion', $methodName)) {
            throw new \RuntimeException("Assertion '" . $methodName . "' does not exist.");
        }

        $reflClass = new ReflectionClass('Assert\Assertion');
        $method = $reflClass->getMethod($methodName);

        array_unshift($args, $this->value);
        $params = $method->getParameters();

        foreach ($params as $idx => $param) {
            if (isset($args[$idx])) {
                continue;
            }

            if ($param->getName() == 'message') {
                $args[$idx] = $this->defaultMessage;
            }

            if ($param->getName() == 'propertyPath') {
                $args[$idx] = $this->defaultPropertyPath;
            }
        }

        if ($this->all) {
            $methodName = 'all' . $methodName;
        }

        call_user_func_array(array('Assert\Assertion', $methodName), $args);

        return $this;
    }

    /**
     * Switch chain into validation mode for an array of values.
     *
     * @return \Assert\AssertionChain
     */
    public function all()
    {
        $this->all = true;

        return $this;
    }

    /**
     * Switch chain into mode allowing nulls, ignoring further assertions.
     *
     * @return \Assert\AssertionChain
     */
    public function nullOr()
    {
        if ($this->value === null) {
            $this->alwaysValid = true;
        }

        return $this;
    }
}
