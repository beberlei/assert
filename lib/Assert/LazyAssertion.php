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

class LazyAssertion
{
    private $currentChainFailed = false;
    private $currentChain;
    private $errors = array();

    public function that($value, $propertyPath, $defaultMessage = null)
    {
        $this->currentChainFailed = false;
        $this->chains[] = $this->currentChain = \Assert\that($value, $defaultMessage, $propertyPath);

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
