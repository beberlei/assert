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
use Assert\LazyAssertion;
use Assert\LazyAssertionException;

class LazyAssertionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Assert\LazyAssertionException
     * @expectedExceptionMessage The following 3 assertions failed:
     */
    public function testThatLazyAssertionsCollectsAllErrorsUntilAssertAll()
    {
        Assert::lazy()
            ->that(10, 'foo')->string()
            ->that(null, 'bar')->notEmpty()
            ->that('string', 'baz')->isArray()
            ->verifyNow();
    }

    /**
     * @expectedException \Assert\LazyAssertionException
     * @expectedExceptionMessage The following 1 assertions failed:
     */
    public function testThatLazyAssertionsSkipsAssertionsOfCurrentChainAfterFailure()
    {
        Assert::lazy()
            ->that(null, 'foo')->notEmpty()->string()
            ->verifyNow();
    }

    public function testLazyAssertionExceptionCanReturnAllErrors()
    {
        try {
            Assert::lazy()
                ->that(10, 'foo')->string()
                ->that(null, 'bar')->notEmpty()
                ->that('string', 'baz')->isArray()
                ->verifyNow();
        } catch (LazyAssertionException $ex) {
            self::assertEquals(array(
                'Value "10" expected to be string, type integer given.',
                'Value "<NULL>" is empty, but non empty value was expected.',
                'Value "string" is not an array.',
            ), \array_map(function (\Exception $ex) {
                return $ex->getMessage();
            }, $ex->getErrorExceptions()));
        }
    }

    public function testVerifyNowReturnsTrueIfAssertionsPass()
    {
        $this->assertTrue(
            Assert::lazy()
                ->that(2, 'Two')->eq(2)
                ->verifyNow()
        );
    }

    public function testRestOfChainNotSkippedWhenTryAllUsed()
    {
        try {
            Assert::lazy()
                ->that(9.9, 'foo')->tryAll()->integer('must be int')->between(10, 20, 'must be between')
                ->verifyNow();
        } catch (LazyAssertionException $ex) {
            $this->assertEquals(array(
                'must be int',
                'must be between',
            ), \array_map(function (\Exception $ex) {
                return $ex->getMessage();
            }, $ex->getErrorExceptions()));
        }
    }

    /**
     * @expectedException \Assert\LazyAssertionException
     * @expectedExceptionMessage The following 1 assertions failed:
     */
    public function testCallsToThatFollowingTryAllSkipAssertionsAfterFailure()
    {
        Assert::lazy()
            ->that(10, 'foo')->tryAll()->integer()
            ->that(null, 'foo')->notEmpty()->string()
            ->verifyNow();
    }

    /**
     * @expectedException \Assert\LazyAssertionException
     * @expectedExceptionMessage The following 4 assertions failed:
     */
    public function testCallsToThatWithTryAllWithMultipleAssertionsAllGetReported()
    {
        Assert::lazy()
            ->that(10, 'foo')->tryAll()->float()->greaterThan(100)
            ->that(null, 'foo')->tryAll()->notEmpty()->string()
            ->verifyNow();
    }

    /**
     * @expectedException \Assert\LazyAssertionException
     * @expectedExceptionMessage The following 4 assertions failed:
     */
    public function testCallsToTryAllOnLazyAlwaysReportAllGetReported()
    {
        Assert::lazy()->tryAll()
            ->that(10, 'foo')->float()->greaterThan(100)
            ->that(null, 'foo')->notEmpty()->string()
            ->verifyNow();
    }

    /**
     * @expectedException \Assert\Tests\Fixtures\CustomLazyAssertionException
     * @expectedExceptionMessage The following 1 assertions failed:
     */
    public function testThatLazyAssertionThrowsCustomExceptionWhenSet()
    {
        $lazyAssertion = new LazyAssertion();
        $lazyAssertion->setExceptionClass('Assert\Tests\Fixtures\CustomLazyAssertionException');

        \var_dump($lazyAssertion
            ->that('foo', 'property')->integer()
            ->verifyNow()
        );
    }

    /**
     * @dataProvider provideDataToTestThatSetExceptionClassWillNotAcceptInvalidExceptionClasses
     * @expectedException \LogicException
     *
     * @param mixed $exceptionClass
     */
    public function testThatSetExceptionClassWillNotAcceptInvalidExceptionClasses($exceptionClass)
    {
        $lazyAssertion = new LazyAssertion();

        $lazyAssertion->setExceptionClass($exceptionClass);
    }

    /**
     * @return array
     */
    public function provideDataToTestThatSetExceptionClassWillNotAcceptInvalidExceptionClasses()
    {
        return array(
            'null' => array(null),
            'string' => array('foo'),
            'array' => array(array()),
            'object' => array(new \stdClass()),
            'other class' => array(__CLASS__),
            'other exception' => array('Exception'),
        );
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     * @expectedExceptionMessage The following 4 assertions failed:
     */
    public function testLazyAssertionExceptionExtendsInvalidArgumentException()
    {
        Assert::lazy()->tryAll()
            ->that(10, 'foo')->float()->greaterThan(100)
            ->that(null, 'foo')->notEmpty()->string()
            ->verifyNow();
    }
}
