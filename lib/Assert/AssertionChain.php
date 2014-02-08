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
 * @method \Assert\AssertionChain eq($value2, $message, $propertyPath)
 * @method \Assert\AssertionChain same($value2, $message, $propertyPath)
 * @method \Assert\AssertionChain notEq($value2, $message, $propertyPath)
 * @method \Assert\AssertionChain notSame($value2, $message, $propertyPath)
 * @method \Assert\AssertionChain integer($message, $propertyPath)
 * @method \Assert\AssertionChain float($message, $propertyPath)
 * @method \Assert\AssertionChain digit($message, $propertyPath)
 * @method \Assert\AssertionChain integerish($message, $propertyPath)
 * @method \Assert\AssertionChain boolean($message, $propertyPath)
 * @method \Assert\AssertionChain notEmpty($message, $propertyPath)
 * @method \Assert\AssertionChain noContent($message, $propertyPath)
 * @method \Assert\AssertionChain notNull($message, $propertyPath)
 * @method \Assert\AssertionChain string($message, $propertyPath)
 * @method \Assert\AssertionChain regex($pattern, $message, $propertyPath)
 * @method \Assert\AssertionChain length($length, $message, $propertyPath, $encoding)
 * @method \Assert\AssertionChain minLength($minLength, $message, $propertyPath, $encoding)
 * @method \Assert\AssertionChain maxLength($maxLength, $message, $propertyPath, $encoding)
 * @method \Assert\AssertionChain betweenLength($minLength, $maxLength, $message, $propertyPath, $encoding)
 * @method \Assert\AssertionChain startsWith($needle, $message, $propertyPath, $encoding)
 * @method \Assert\AssertionChain endsWith($needle, $message, $propertyPath, $encoding)
 * @method \Assert\AssertionChain contains($needle, $message, $propertyPath, $encoding)
 * @method \Assert\AssertionChain choice($choices, $message, $propertyPath)
 * @method \Assert\AssertionChain inArray($choices, $message, $propertyPath)
 * @method \Assert\AssertionChain numeric($message, $propertyPath)
 * @method \Assert\AssertionChain isArray($message, $propertyPath)
 * @method \Assert\AssertionChain keyExists($key, $message, $propertyPath)
 * @method \Assert\AssertionChain notEmptyKey($key, $message, $propertyPath)
 * @method \Assert\AssertionChain notBlank($message, $propertyPath)
 * @method \Assert\AssertionChain isInstanceOf($className, $message, $propertyPath)
 * @method \Assert\AssertionChain notIsInstanceOf($className, $message, $propertyPath)
 * @method \Assert\AssertionChain subclassOf($className, $message, $propertyPath)
 * @method \Assert\AssertionChain range($minValue, $maxValue, $message, $propertyPath)
 * @method \Assert\AssertionChain min($minValue, $message, $propertyPath)
 * @method \Assert\AssertionChain max($maxValue, $message, $propertyPath)
 * @method \Assert\AssertionChain file($message, $propertyPath)
 * @method \Assert\AssertionChain directory($message, $propertyPath)
 * @method \Assert\AssertionChain readable($message, $propertyPath)
 * @method \Assert\AssertionChain writeable($message, $propertyPath)
 * @method \Assert\AssertionChain email($message, $propertyPath)
 * @method \Assert\AssertionChain url($message, $propertyPath)
 * @method \Assert\AssertionChain alnum($message, $propertyPath)
 * @method \Assert\AssertionChain true($message, $propertyPath)
 * @method \Assert\AssertionChain false($message, $propertyPath)
 * @method \Assert\AssertionChain classExists($message, $propertyPath)
 * @method \Assert\AssertionChain implementsInterface($interfaceName, $message, $propertyPath)
 * @method \Assert\AssertionChain isJsonString($message, $propertyPath)
 * @method \Assert\AssertionChain uuid($message, $propertyPath)
 * @method \Assert\AssertionChain count($count, $message, $propertyPath)
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
