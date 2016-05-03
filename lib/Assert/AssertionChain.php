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
 * @method \Assert\AssertionChain eq($value2, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain same($value2, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain notEq($value2, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain notSame($value2, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain integer($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain float($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain digit($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain integerish($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain boolean($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain scalar($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain notEmpty($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain noContent($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain notNull($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain string($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain regex($pattern, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain length($length, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\AssertionChain minLength($minLength, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\AssertionChain maxLength($maxLength, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\AssertionChain betweenLength($minLength, $maxLength, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\AssertionChain startsWith($needle, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\AssertionChain endsWith($needle, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\AssertionChain contains($needle, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\AssertionChain choice($choices, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain inArray($choices, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain numeric($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain isArray($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain isTraversable($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain isArrayAccessible($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain keyExists($key, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain keyIsset($key, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain notEmptyKey($key, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain notBlank($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain isInstanceOf($className, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain notIsInstanceOf($className, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain subclassOf($className, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain range($minValue, $maxValue, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain min($minValue, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain max($maxValue, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain file($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain directory($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain readable($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain writeable($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain email($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain url($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain alnum($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain true($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain false($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain classExists($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain implementsInterface($interfaceName, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain isJsonString($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain uuid($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain count($count, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain choicesNotEmpty($choices, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain methodExists($object, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain isObject($message = null, $propertyPath = null)
 * @method \Assert\AssertionChain lessThan($limit, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain lessOrEqualThan($limit, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain greaterThan($limit, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain greaterOrEqualThan($limit, $message = null, $propertyPath = null)
 * @method \Assert\AssertionChain date($format, $message = null, $propertyPath = null)
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
