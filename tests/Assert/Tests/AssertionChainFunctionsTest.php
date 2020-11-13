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

use Assert\AssertionChain;
use PHPUnit\Framework\TestCase;

/**
 * Test case specific for the deprecated functions creating assertion chains.
 */
class AssertionChainFunctionsTest extends TestCase
{
    public function testThatAssertionChainFunctionsReturnAnAssertionChain()
    {
        $this->assertInstanceOf(AssertionChain::class, \Assert\that(10)->notEmpty()->integer());
    }

    public function testThatAssertionChainFunctionsShiftsArgumentsBy1()
    {
        $this->assertInstanceOf(AssertionChain::class, \Assert\that(10)->eq(10));
    }

    public function testThatAssertionChainFunctionsKnowsDefaultErrorMessage()
    {
        $this->expectException('Assert\InvalidArgumentException');
        $this->expectExceptionMessage('Not Null and such');
        \Assert\that(null, 'Not Null and such')->notEmpty();
    }

    public function testThatAssertionChainFunctionsSkipAssertionsOnValidNull()
    {
        $this->assertInstanceOf(AssertionChain::class, \Assert\that(null)->nullOr()->integer()->eq(10));
    }

    public function testThatAssertionChainFunctionsValidatesAllInputs()
    {
        $this->assertInstanceOf(AssertionChain::class, \Assert\that([1, 2, 3])->all()->integer());
    }

    public function testAssertionChainFunctionsThatAllShortcut()
    {
        $this->assertInstanceOf(AssertionChain::class, \Assert\thatAll([1, 2, 3])->integer());
    }

    public function testAssertionChainFunctionsNullOrShortcut()
    {
        $this->assertInstanceOf(AssertionChain::class, \Assert\thatNullOr(null)->integer()->eq(10));
    }

    public function testThatAssertionChainFunctionsThrowsExceptionForUnknownAssertion()
    {
        $this->expectException('RuntimeException');
        $this->expectExceptionMessage('Assertion \'unknownAssertion\' does not exist.');
        \Assert\that(null)->unknownAssertion();
    }

    public function testAssertionChainFunctionSatisfyShortcut()
    {
        $this->assertInstanceOf(
            AssertionChain::class,
            \Assert\that(null)->satisfy(
                function ($value) {
                    return \is_null($value);
                }
            )
        );
    }
}
