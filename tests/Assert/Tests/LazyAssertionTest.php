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
use PHPUnit\Framework\TestCase;

class LazyAssertionTest extends TestCase
{
    public function testThatLazyAssertionsCollectsAllErrorsUntilAssertAll()
    {
        $this->expectException('Assert\LazyAssertionException');
        $this->expectExceptionMessage('The following 3 assertions failed:');
        Assert::lazy()
            ->that(10, 'foo')->string()
            ->that(null, 'bar')->notEmpty()
            ->that('string', 'baz')->isArray()
            ->verifyNow();
    }

    public function testThatLazyAssertionsSkipsAssertionsOfCurrentChainAfterFailure()
    {
        $this->expectException('Assert\LazyAssertionException');
        $this->expectExceptionMessage('The following 1 assertions failed:');
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
            self::assertEquals(
                [
                    'Value "10" expected to be string, type integer given.',
                    'Value "<NULL>" is empty, but non empty value was expected.',
                    'Value "string" is not an array.',
                ],
                \array_map(
                    function (\Exception $ex) {
                        return $ex->getMessage();
                    },
                    $ex->getErrorExceptions()
                )
            );
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
            $this->assertEquals(
                [
                    'must be int',
                    'must be between',
                ],
                \array_map(
                    function (\Exception $ex) {
                        return $ex->getMessage();
                    },
                    $ex->getErrorExceptions()
                )
            );
        }
    }

    public function testCallsToThatFollowingTryAllSkipAssertionsAfterFailure()
    {
        $this->expectException('Assert\LazyAssertionException');
        $this->expectExceptionMessage('The following 1 assertions failed:');
        Assert::lazy()
            ->that(10, 'foo')->tryAll()->integer()
            ->that(null, 'foo')->notEmpty()->string()
            ->verifyNow();
    }

    public function testCallsToThatWithTryAllWithMultipleAssertionsAllGetReported()
    {
        $this->expectException('Assert\LazyAssertionException');
        $this->expectExceptionMessage('The following 4 assertions failed:');
        Assert::lazy()
            ->that(10, 'foo')->tryAll()->float()->greaterThan(100)
            ->that(null, 'foo')->tryAll()->notEmpty()->string()
            ->verifyNow();
    }

    public function testCallsToTryAllOnLazyAlwaysReportAllGetReported()
    {
        $this->expectException('Assert\LazyAssertionException');
        $this->expectExceptionMessage('The following 4 assertions failed:');
        Assert::lazy()->tryAll()
            ->that(10, 'foo')->float()->greaterThan(100)
            ->that(null, 'foo')->notEmpty()->string()
            ->verifyNow();
    }

    public function testThatLazyAssertionThrowsCustomExceptionWhenSet()
    {
        $this->expectException('Assert\Tests\Fixtures\CustomLazyAssertionException');
        $this->expectExceptionMessage('The following 1 assertions failed:');
        $lazyAssertion = new LazyAssertion();
        $lazyAssertion->setExceptionClass(Fixtures\CustomLazyAssertionException::class);

        \var_dump(
            $lazyAssertion
                ->that('foo', 'property')->integer()
                ->verifyNow()
        );
    }

    public function testLazyAssertionExceptionExtendsInvalidArgumentException()
    {
        $this->expectException('Assert\InvalidArgumentException');
        $this->expectExceptionMessage('The following 4 assertions failed:');
        Assert::lazy()->tryAll()
            ->that(10, 'foo')->float()->greaterThan(100)
            ->that(null, 'foo')->notEmpty()->string()
            ->verifyNow();
    }

    public function testLazyAssertionThrowsExceptionWhenPassingInvalidClassToSetExceptionClass()
    {
        $this->expectException('LogicException');
        $this->expectExceptionMessage('stdClass is not (a subclass of) Assert\LazyAssertionException');
        $lazyAssertion = new LazyAssertion();
        $lazyAssertion->setExceptionClass(\stdClass::class);
    }

    public function testLazyAssertionThrowsExceptionWhenPassingInvalidClassToSetAssertClass()
    {
        $this->expectException('LogicException');
        $this->expectExceptionMessage('stdClass is not (a subclass of) Assert\Assert');
        $lazyAssertion = new LazyAssertion();
        $lazyAssertion->setAssertClass(\stdClass::class);
    }
}
