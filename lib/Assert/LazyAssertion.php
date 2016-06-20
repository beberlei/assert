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
 * METHODSTART
 * @method \Assert\LazyAssertion eq($value2, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion same($value2, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion notEq($value2, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion notSame($value2, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion integer($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion float($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion digit($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion integerish($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion boolean($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion scalar($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion notEmpty($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion noContent($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion notNull($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion string($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion regex($pattern, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion length($length, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\LazyAssertion minLength($minLength, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\LazyAssertion maxLength($maxLength, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\LazyAssertion betweenLength($minLength, $maxLength, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\LazyAssertion startsWith($needle, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\LazyAssertion endsWith($needle, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\LazyAssertion contains($needle, $message = null, $propertyPath = null, $encoding = "utf8")
 * @method \Assert\LazyAssertion choice($choices, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion inArray($choices, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion numeric($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion isArray($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion isTraversable($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion isArrayAccessible($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion keyExists($key, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion keyIsset($key, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion notEmptyKey($key, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion notBlank($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion isInstanceOf($className, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion notIsInstanceOf($className, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion subclassOf($className, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion range($minValue, $maxValue, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion min($minValue, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion max($maxValue, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion file($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion directory($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion readable($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion writeable($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion email($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion url($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion alnum($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion true($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion false($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion classExists($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion implementsInterface($interfaceName, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion isJsonString($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion uuid($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion count($count, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion choicesNotEmpty($choices, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion methodExists($object, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion isObject($message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion lessThan($limit, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion lessOrEqualThan($limit, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion greaterThan($limit, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion greaterOrEqualThan($limit, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion date($format, $message = null, $propertyPath = null)
 * @method \Assert\LazyAssertion all()
 * @method \Assert\LazyAssertion nullOr()
 * METHODEND
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
