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
    public function __construct()
    {
        $this->assertClass = Assert::class;
    }

    public function withContext(array $context)
    {
        $this->currentChain->setContext($context);

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
