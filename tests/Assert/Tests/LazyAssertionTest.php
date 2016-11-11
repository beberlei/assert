<?php

namespace Assert\Tests;

use Assert\LazyAssertionException;

class LazyAssertionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_collects_errors_until_assertall()
    {
        $this->setExpectedException('Assert\LazyAssertionException', <<<EXC
The following 3 assertions failed:
1) foo: Value "10" expected to be string, type integer given.
2) bar: Value "<NULL>" is empty, but non empty value was expected.
3) baz: Value "string" is not an array.

EXC
        );

        \Assert\lazy()
            ->that(10, 'foo')->string()
            ->that(null, 'bar')->notEmpty()
            ->that('string', 'baz')->isArray()
            ->verifyNow();
    }

    /**
     * @test
     */
    public function it_skips_assertions_of_current_chain_after_failure()
    {
        $this->setExpectedException('Assert\LazyAssertionException', <<<EXC
The following 1 assertions failed:
1) foo: Value "<NULL>" is empty, but non empty value was expected.

EXC
        );

        \Assert\lazy()
            ->that(null, 'foo')->notEmpty()->string()
            ->verifyNow();
    }

    public function testLazyAssertionExceptionCanReturnAllErrors()
    {
        try {
            \Assert\lazy()
                ->that(10, 'foo')->string()
                ->that(null, 'bar')->notEmpty()
                ->that('string', 'baz')->isArray()
                ->verifyNow();
        } catch (LazyAssertionException $ex) {
            self::assertEquals(array(
                'Value "10" expected to be string, type integer given.',
                'Value "<NULL>" is empty, but non empty value was expected.',
                'Value "string" is not an array.',
            ), array_map(function (\Exception $ex) {
                return $ex->getMessage();
            }, $ex->getErrorExceptions()));
        }
    }

    public function testVerifyNowReturnsTrueIfAssertionsPass()
    {
        $this->assertTrue(
            \Assert\lazy()
                ->that(2, 'Two')->eq(2)
                ->verifyNow()
        );
    }

    public function testRestOfChainNotSkippedWhenTryAllUsed()
    {
        try {
            \Assert\lazy()
                ->that(9.9, 'foo')->tryAll()->integer('must be int')->between(10, 20, 'must be between')
                ->verifyNow();
        } catch (LazyAssertionException $ex) {
            $this->assertEquals(array(
                'must be int',
                'must be between'
            ), array_map(function (\Exception $ex) {
                return $ex->getMessage();
            }, $ex->getErrorExceptions()));
        }
    }

    public function testCallsToThatFollowingTryAllSkipAssertionsAfterFailure()
    {
        $this->setExpectedException('Assert\LazyAssertionException', <<<EXC
The following 1 assertions failed:
1) foo: Value "<NULL>" is empty, but non empty value was expected.

EXC
        );

        \Assert\lazy()
            ->that(10, 'foo')->tryAll()->integer()
            ->that(null, 'foo')->notEmpty()->string()
            ->verifyNow();
    }

    public function testCallsToThatWithTryAllWithMultipleAssertionsAllGetReported()
    {
        $this->setExpectedException('\Assert\LazyAssertionException', <<<EXC
The following 4 assertions failed:
1) foo: Value "10" is not a float.
2) foo: Provided "10" is not greater than "100".
3) foo: Value "<NULL>" is empty, but non empty value was expected.
4) foo: Value "<NULL>" expected to be string, type NULL given.

EXC
);
        \Assert\lazy()
            ->that(10, 'foo')->tryAll()->float()->greaterThan(100)
            ->that(null, 'foo')->tryAll()->notEmpty()->string()
            ->verifyNow();
    }
}
