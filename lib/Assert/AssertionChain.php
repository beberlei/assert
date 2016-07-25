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
 * @method \Assert\AssertionChain alnum($message = null, $propertyPath = null) Assert that value is alphanumeric.
 * @method \Assert\AssertionChain betweenLength($minLength, $maxLength, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string length is between min,max lengths.
 * @method \Assert\AssertionChain boolean($message = null, $propertyPath = null) Assert that value is php boolean.
 * @method \Assert\AssertionChain choice($choices, $message = null, $propertyPath = null) Assert that value is in array of choices.
 * @method \Assert\AssertionChain choicesNotEmpty($choices, $message = null, $propertyPath = null) Determines if the values array has every choice as key and that this choice has content.
 * @method \Assert\AssertionChain classExists($message = null, $propertyPath = null) Assert that the class exists.
 * @method \Assert\AssertionChain contains($needle, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string contains a sequence of chars.
 * @method \Assert\AssertionChain count($count, $message = null, $propertyPath = null) Assert that the count of countable is equal to count.
 * @method \Assert\AssertionChain date($format, $message = null, $propertyPath = null) Assert that date is valid and corresponds to the given format.
 * @method \Assert\AssertionChain digit($message = null, $propertyPath = null) Validates if an integer or integerish is a digit.
 * @method \Assert\AssertionChain directory($message = null, $propertyPath = null) Assert that a directory exists.
 * @method \Assert\AssertionChain email($message = null, $propertyPath = null) Assert that value is an email adress (using input_filter/FILTER_VALIDATE_EMAIL).
 * @method \Assert\AssertionChain endsWith($needle, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string ends with a sequence of chars.
 * @method \Assert\AssertionChain eq($value2, $message = null, $propertyPath = null) Assert that two values are equal (using == ).
 * @method \Assert\AssertionChain false($message = null, $propertyPath = null) Assert that the value is boolean False.
 * @method \Assert\AssertionChain file($message = null, $propertyPath = null) Assert that a file exists.
 * @method \Assert\AssertionChain float($message = null, $propertyPath = null) Assert that value is a php float.
 * @method \Assert\AssertionChain greaterOrEqualThan($limit, $message = null, $propertyPath = null) Determines if the value is greater or equal than given limit.
 * @method \Assert\AssertionChain greaterThan($limit, $message = null, $propertyPath = null) Determines if the value is greater than given limit.
 * @method \Assert\AssertionChain implementsInterface($interfaceName, $message = null, $propertyPath = null) Assert that the class implements the interface.
 * @method \Assert\AssertionChain inArray($choices, $message = null, $propertyPath = null) Alias of {@see choice()}.
 * @method \Assert\AssertionChain integer($message = null, $propertyPath = null) Assert that value is a php integer.
 * @method \Assert\AssertionChain integerish($message = null, $propertyPath = null) Assert that value is a php integer'ish.
 * @method \Assert\AssertionChain isArray($message = null, $propertyPath = null) Assert that value is an array.
 * @method \Assert\AssertionChain isArrayAccessible($message = null, $propertyPath = null) Assert that value is an array or an array-accessible object.
 * @method \Assert\AssertionChain isInstanceOf($className, $message = null, $propertyPath = null) Assert that value is instance of given class-name.
 * @method \Assert\AssertionChain isJsonString($message = null, $propertyPath = null) Assert that the given string is a valid json string.
 * @method \Assert\AssertionChain isObject($message = null, $propertyPath = null) Determines that the provided value is an object.
 * @method \Assert\AssertionChain isTraversable($message = null, $propertyPath = null) Assert that value is an array or a traversable object.
 * @method \Assert\AssertionChain keyExists($key, $message = null, $propertyPath = null) Assert that key exists in an array.
 * @method \Assert\AssertionChain keyIsset($key, $message = null, $propertyPath = null) Assert that key exists in an array/array-accessible object using isset().
 * @method \Assert\AssertionChain length($length, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string has a given length.
 * @method \Assert\AssertionChain lessOrEqualThan($limit, $message = null, $propertyPath = null) Determines if the value is less or than given limit.
 * @method \Assert\AssertionChain lessThan($limit, $message = null, $propertyPath = null) Determines if the value is less than given limit.
 * @method \Assert\AssertionChain max($maxValue, $message = null, $propertyPath = null) Assert that a number is smaller as a given limit.
 * @method \Assert\AssertionChain maxLength($maxLength, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string value is not longer than $maxLength chars.
 * @method \Assert\AssertionChain methodExists($object, $message = null, $propertyPath = null) Determines that the named method is defined in the provided object.
 * @method \Assert\AssertionChain min($minValue, $message = null, $propertyPath = null) Assert that a value is at least as big as a given limit.
 * @method \Assert\AssertionChain minLength($minLength, $message = null, $propertyPath = null, $encoding = "utf8") Assert that a string is at least $minLength chars long.
 * @method \Assert\AssertionChain noContent($message = null, $propertyPath = null) Assert that value is empty.
 * @method \Assert\AssertionChain notBlank($message = null, $propertyPath = null) Assert that value is not blank.
 * @method \Assert\AssertionChain notEmpty($message = null, $propertyPath = null) Assert that value is not empty.
 * @method \Assert\AssertionChain notEmptyKey($key, $message = null, $propertyPath = null) Assert that key exists in an array/array-accessible object and it's value is not empty.
 * @method \Assert\AssertionChain notEq($value2, $message = null, $propertyPath = null) Assert that two values are not equal (using == ).
 * @method \Assert\AssertionChain notIsInstanceOf($className, $message = null, $propertyPath = null) Assert that value is not instance of given class-name.
 * @method \Assert\AssertionChain notNull($message = null, $propertyPath = null) Assert that value is not null.
 * @method \Assert\AssertionChain notSame($value2, $message = null, $propertyPath = null) Assert that two values are not the same (using === ).
 * @method \Assert\AssertionChain numeric($message = null, $propertyPath = null) Assert that value is numeric.
 * @method \Assert\AssertionChain range($minValue, $maxValue, $message = null, $propertyPath = null) Assert that value is in range of numbers.
 * @method \Assert\AssertionChain readable($message = null, $propertyPath = null) Assert that the value is something readable.
 * @method \Assert\AssertionChain regex($pattern, $message = null, $propertyPath = null) Assert that value matches a regex.
 * @method \Assert\AssertionChain same($value2, $message = null, $propertyPath = null) Assert that two values are the same (using ===).
 * @method \Assert\AssertionChain scalar($message = null, $propertyPath = null) Assert that value is a PHP scalar.
 * @method \Assert\AssertionChain startsWith($needle, $message = null, $propertyPath = null, $encoding = "utf8") Assert that string starts with a sequence of chars.
 * @method \Assert\AssertionChain string($message = null, $propertyPath = null) Assert that value is a string.
 * @method \Assert\AssertionChain subclassOf($className, $message = null, $propertyPath = null) Assert that value is subclass of given class-name.
 * @method \Assert\AssertionChain true($message = null, $propertyPath = null) Assert that the value is boolean True.
 * @method \Assert\AssertionChain url($message = null, $propertyPath = null) Assert that value is an URL.
 * @method \Assert\AssertionChain uuid($message = null, $propertyPath = null) Assert that the given string is a valid UUID.
 * @method \Assert\AssertionChain writeable($message = null, $propertyPath = null) Assert that the value is something writeable.
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
     * @param string $methodName
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
