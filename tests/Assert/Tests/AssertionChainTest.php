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
use PHPUnit\Framework\TestCase;

class AssertionChainTest extends TestCase
{
    public function testThatAssertionChainReturnAnAssertionChain()
    {
        $this->assertInstanceOf(AssertionChain::class, Assert::that(10)->notEmpty()->integer());
    }

    public function testThatAssertionChainShiftsArgumentsBy1()
    {
        $this->assertInstanceOf(AssertionChain::class, Assert::that(10)->eq(10));
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
        $this->assertInstanceOf(AssertionChain::class, Assert::that(null)->nullOr()->integer()->eq(10));
    }

    public function testThatAssertionChainValidatesAllInputs()
    {
        $this->assertInstanceOf(AssertionChain::class, Assert::that([1, 2, 3])->all()->integer());
    }

    public function testAssertionChainThatAllShortcut()
    {
        $this->assertInstanceOf(AssertionChain::class, Assert::thatAll([1, 2, 3])->integer());
    }

    public function testAssertionChainNullOrShortcut()
    {
        $this->assertInstanceOf(AssertionChain::class, Assert::thatNullOr(null)->integer()->eq(10));
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
        $this->assertInstanceOf(
            AssertionChain::class,
            Assert::that(null)->satisfy(
                function ($value) {
                    return \is_null($value);
                }
            )
        );
    }

    public function testThatCustomAssertionClassIsUsedWhenSet()
    {
        $assertionChain = new AssertionChain('foo');
        $assertionChain->setAssertionClassName(CustomAssertion::class);

        CustomAssertion::clearCalls();
        $message = \uniqid();
        $assertionChain->string($message);

        $this->assertSame([['string', 'foo']], CustomAssertion::getCalls());
    }

    /**
     * @dataProvider provideDataToTestThatSetAssertionClassNameWillNotAcceptInvalidAssertionClasses
     * @expectedException \LogicException
     *
     * @param mixed $assertionClassName
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
        return [
            'null' => [null],
            'string' => ['foo'],
            'array' => [[]],
            'object' => [new \stdClass()],
            'other class' => [__CLASS__],
        ];
    }
}
