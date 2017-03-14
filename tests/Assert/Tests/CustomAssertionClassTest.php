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

use Assert\Tests\Fixtures\CustomAssertion;

class CustomAssertionClassTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        CustomAssertion::clearCalls();
    }

    /**
     * @expectedException \Assert\Tests\Fixtures\CustomException
     */
    public function testThatCustomAssertionUsesCustomException()
    {
        CustomAssertion::integer('foo');
    }

    /**
     * @expectedException \Assert\Tests\Fixtures\CustomException
     */
    public function testThatCustomAssertionsUsesCustomExceptionForAssertionChains()
    {
        $string = 's' . \uniqid();
        Fixtures\CustomAssert::that($string)->string();
        $this->assertSame(array(array('string', $string)), CustomAssertion::getCalls());

        Fixtures\CustomAssert::that($string)->integer();
    }

    /**
     * @expectedException \Assert\Tests\Fixtures\CustomLazyAssertionException
     */
    public function testThatCustomAssertionsUsesCustomAssertionExceptionForLazyAssertionChains()
    {
        Fixtures\CustomAssert::lazy()
            ->that('foo', 'foo')->integer()
            ->verifyNow()
        ;
    }

    /**
     * @expectedException \Assert\Tests\Fixtures\CustomLazyAssertionException
     */
    public function testThatCustomAssertionsUsesCustomAssertionExceptionWhenFirstAssertionDoesNotFail()
    {
        Fixtures\CustomAssert::lazy()
            ->that('foo', 'foo')->string()
            ->that('bar', 'bar')->integer()
            ->verifyNow()
        ;
    }

    /**
     * @expectedException \Assert\Tests\Fixtures\CustomLazyAssertionException
     * @expectedExceptionMessageRegex /The following 4 assertions failed:\s+1) foo: Value "foo" is not an integer.\s+2) foo: Value "foo" is not an array.\s+3) bar: Value "123" expected to be string, type integer given.\s+4) bar: Value "123" is not an array./
     */
    public function testThatCustomAsserionsExceptionsForLazyAssertionChainsTryAllTheAssertionsPerChain()
    {
        Fixtures\CustomAssert::lazy()
            ->that('foo', 'foo')->tryAll()->integer()->isArray()
            ->that(123, 'bar')->tryAll()->string()->isArray()
            ->verifyNow()
        ;
    }

    /**
     * @expectedException \Assert\Tests\Fixtures\CustomLazyAssertionException
     * @expectedExceptionMessageRegex /The following 4 assertions failed:\s+1) foo: Value "foo" is not an integer.\s+2) foo: Value "foo" is not an array.\s+3) bar: Value "123" expected to be string, type integer given.\s+4) bar: Value "123" is not an array./
     */
    public function testThatCustomAsserionsExceptionsForLazyAssertionChainsTryAllTheAssertions()
    {
        Fixtures\CustomAssert::lazy()
            ->tryAll()
            ->that('foo', 'foo')->integer()->isArray()
            ->that(123, 'bar')->string()->isArray()
            ->verifyNow()
        ;
    }
}
