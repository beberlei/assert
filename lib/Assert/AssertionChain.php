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
