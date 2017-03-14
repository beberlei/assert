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

/**
 * Test case specific for the deprecated functions creating assertion chains.
 */
class AssertionChainFunctionsTest extends \PHPUnit_Framework_TestCase
{
    public function testThatAssertionChainFunctionsReturnAnAssertionChain()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', \Assert\that(10)->notEmpty()->integer());
    }

    public function testThatAssertionChainFunctionsShiftsArgumentsBy1()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', \Assert\that(10)->eq(10));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     * @expectedExceptionMessage Not Null and such
     */
    public function testThatAssertionChainFunctionsKnowsDefaultErrorMessage()
    {
        \Assert\that(null, 'Not Null and such')->notEmpty();
    }

    public function testThatAssertionChainFunctionsSkipAssertionsOnValidNull()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', \Assert\that(null)->nullOr()->integer()->eq(10));
    }

    public function testThatAssertionChainFunctionsValidatesAllInputs()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', \Assert\that(array(1, 2, 3))->all()->integer());
    }

    public function testAssertionChainFunctionsThatAllShortcut()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', \Assert\thatAll(array(1, 2, 3))->integer());
    }

    public function testAssertionChainFunctionsNullOrShortcut()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', \Assert\thatNullOr(null)->integer()->eq(10));
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Assertion 'unknownAssertion' does not exist.
     */
    public function testThatAssertionChainFunctionsThrowsExceptionForUnknownAssertion()
    {
        \Assert\that(null)->unknownAssertion();
    }

    public function testAssertionChainFunctionSatisfyShortcut()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', \Assert\that(null)->satisfy(
            function ($value) {
                return \is_null($value);
            }
        ));
    }
}
