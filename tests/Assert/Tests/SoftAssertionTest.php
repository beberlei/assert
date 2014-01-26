<?php

namespace Assert\Tests;

class SoftAssertionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_collects_errors_until_assertall()
    {
        $this->setExpectedException('Assert\SoftAssertionException', <<<EXC
The following 3 assertions failed:
1) foo: Value "10" expected to be string, type integer given.
2) bar: Value "<NULL>" is empty, but non empty value was expected.
3) baz: Value "string" is not an array.
EXC
        );

        \Assert\soft()
            ->that(10, 'foo')->string()
            ->that(null, 'bar')->notEmpty()
            ->that('string', 'baz')->isArray()
            ->verify();
    }
}
