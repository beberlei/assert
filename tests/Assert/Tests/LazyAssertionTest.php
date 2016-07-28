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
}
