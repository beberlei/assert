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

namespace Assert\Tests;

use Assert\LazyAssertionException;
use Assert\Tests\Fixtures\ContextAware\Assert;
use Assert\Tests\Fixtures\ContextAware\InvalidArgumentException;
use Assert\Tests\Fixtures\ContextAware\LazyAssertion;
use PHPUnit\Framework\TestCase;

class ContextAwareLazyAssertionTest extends TestCase
{
    public function testContextIsPassedThroughToExceptions()
    {
        $context = ['method' => __FUNCTION__, 'class' => __CLASS__];
        /** @var LazyAssertion $assertion */
        $assertion = Assert::lazy();
        $assertion->tryAll()
            ->that(true, '', null)
            ->withContext($context)
            ->false()
            ->null();

        try {
            $assertion->verifyNow();
        } catch (LazyAssertionException $e) {
            self::assertCount(2, $e->getErrorExceptions());

            foreach ($e->getErrorExceptions() as $error) {
                self::assertInstanceOf(InvalidArgumentException::class, $error);
                self::assertSame($context, $error->getContext());
            }
        }
    }
}
