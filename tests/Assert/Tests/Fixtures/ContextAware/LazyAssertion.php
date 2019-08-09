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

namespace Assert\Tests\Fixtures\ContextAware;

use Assert\LazyAssertion as BaseLazyAssertion;

class LazyAssertion extends BaseLazyAssertion
{
    /** @var string The class to use as AssertionChain factory */
    protected $assertClass = Assert::class;
    /** @var AssertionChain */
    protected $currentChain;

    public function that($value, $propertyPath, $defaultMessage = null, array $context = [])
    {
        $this->currentChainFailed = false;
        $this->thisChainTryAll = false;
        $assertClass = $this->assertClass;
        $this->currentChain = $assertClass::that($value, $defaultMessage, $propertyPath, $context);

        return $this;
    }

    public function __call($method, $args)
    {
        $errorKeys = \array_keys($this->errors);

        parent::__call($method, $args);

        $additions = \array_diff(\array_keys($this->errors), $errorKeys);

        foreach ($additions as $addition) {
            $error = $this->errors[$addition];
            if ($error instanceof InvalidArgumentException) {
                $this->errors[$addition] = $error->setContext($this->currentChain->getContext());
            }
        }

        return $this;
    }
}
