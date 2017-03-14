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

use Assert\Assert;
use Assert\AssertionChain;
use Assert\Tests\Fixtures\CustomAssertion;

class AssertionChainTest extends \PHPUnit_Framework_TestCase
{
    public function testThatAssertionChainReturnAnAssertionChain()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', Assert::that(10)->notEmpty()->integer());
    }

    public function testThatAssertionChainShiftsArgumentsBy1()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', Assert::that(10)->eq(10));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     * @expectedExceptionMessage Not Null and such
     */
    public function testThatAssertionChainKnowsDefaultErrorMessage()
    {
        Assert::that(null, 'Not Null and such')->notEmpty();
    }

    public function testThatAssertionChainSkipAssertionsOnValidNull()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', Assert::that(null)->nullOr()->integer()->eq(10));
    }

    public function testThatAssertionChainValidatesAllInputs()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', Assert::that(array(1, 2, 3))->all()->integer());
    }

    public function testAssertionChainThatAllShortcut()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', Assert::thatAll(array(1, 2, 3))->integer());
    }

    public function testAssertionChainNullOrShortcut()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', Assert::thatNullOr(null)->integer()->eq(10));
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Assertion 'unknownAssertion' does not exist.
     */
    public function testThatAssertionChainThrowsExceptionForUnknownAssertion()
    {
        Assert::that(null)->unknownAssertion();
    }

    public function testAssertionChainSatisfyShortcut()
    {
        $this->assertInstanceOf('\Assert\AssertionChain', Assert::that(null)->satisfy(
            function ($value) {
                return \is_null($value);
            }
        ));
    }

    public function testThatCustomAssertionClassIsUsedWhenSet()
    {
        $assertionChain = new AssertionChain('foo');
        $assertionChain->setAssertionClassName('Assert\Tests\Fixtures\CustomAssertion');

        CustomAssertion::clearCalls();
        $message = \uniqid();
        $assertionChain->string($message);

        $this->assertSame(array(array('string', 'foo')), CustomAssertion::getCalls());
    }

    /**
     * @dataProvider provideDataToTestThatSetAssertionClassNameWillNotAcceptInvalidAssertionClasses
     * @expectedException \LogicException
     *
     * @param $assertionClassName
     */
    public function testThatSetAssertionClassNameWillNotAcceptInvalidAssertionClasses($assertionClassName)
    {
        $lazyAssertion = new AssertionChain('foo');

        $lazyAssertion->setAssertionClassName($assertionClassName);
    }

    /**
     * @return array
     */
    public function provideDataToTestThatSetAssertionClassNameWillNotAcceptInvalidAssertionClasses()
    {
        return array(
            'null' => array(null),
            'string' => array('foo'),
            'array' => array(array()),
            'object' => array(new \stdClass()),
            'other class' => array(__CLASS__),
        );
    }
}
