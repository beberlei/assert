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
use Assert\InvalidArgumentException;

class CustomAssertionClassTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        CustomAssertion::clearCalls();
    }

    /**
     * @test
     */
    public function it_uses_custom_exception_class()
    {
        $this->setExpectedException('Assert\Tests\CustomException');
        CustomAssertion::integer('foo');
    }

    /**
     * @test
     */
    public function it_uses_custom_assertion_class_for_assertion_chains()
    {
        $string = 's' . uniqid();
        CustomAssert::that($string)->string();
        $this->assertSame(array(array('string', $string)), CustomAssertion::getCalls());

        $this->setExpectedException('Assert\Tests\CustomException');
        CustomAssert::that($string)->integer();
    }

    /**
     * @test
     */
    public function it_uses_custom_exception_for_lazy_assertion_chains()
    {
        $this->setExpectedException('Assert\Tests\CustomLazyAssertionException');
        CustomAssert::lazy()
            ->that('foo', 'foo')->integer()
            ->verifyNow()
        ;
    }

    /**
     * @test
     */
    public function it_uses_custom_exception_for_lazy_assertion_chains_when_first_assertion_does_not_fail()
    {
        $this->setExpectedException('Assert\Tests\CustomLazyAssertionException');
        CustomAssert::lazy()
            ->that('foo', 'foo')->string()
            ->that('bar', 'bar')->integer()
            ->verifyNow()
        ;
    }

    /**
     * @test
     */
    public function it_uses_custom_exception_for_lazy_assertion_chains_that_try_all_assertions_per_chain()
    {
        $this->setExpectedException('Assert\Tests\CustomLazyAssertionException', <<< MESSAGE
The following 4 assertions failed:
1) foo: Value "foo" is not an integer.
2) foo: Value "foo" is not an array.
3) bar: Value "123" expected to be string, type integer given.
4) bar: Value "123" is not an array.
MESSAGE
);
        CustomAssert::lazy()
            ->that('foo', 'foo')->tryAll()->integer()->isArray()
            ->that(123, 'bar')->tryAll()->string()->isArray()
            ->verifyNow()
        ;
    }

    /**
     * @test
     */
    public function it_uses_custom_exception_for_lazy_assertion_chains_that_try_all_assertions()
    {
        $this->setExpectedException('Assert\Tests\CustomLazyAssertionException', <<< MESSAGE
The following 4 assertions failed:
1) foo: Value "foo" is not an integer.
2) foo: Value "foo" is not an array.
3) bar: Value "123" expected to be string, type integer given.
4) bar: Value "123" is not an array.
MESSAGE
);
        CustomAssert::lazy()
            ->tryAll()
            ->that('foo', 'foo')->integer()->isArray()
            ->that(123, 'bar')->string()->isArray()
            ->verifyNow()
        ;
    }
}

class CustomException extends InvalidArgumentException
{
}

class CustomAssert extends Assert
{
    protected static $assertionClass = 'Assert\Tests\CustomAssertion';
    protected static $lazyAssertionExceptionClass = 'Assert\Tests\CustomLazyAssertionException';
}
