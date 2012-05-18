<?php
namespace Assert\Tests;

use Assert\Assertion;

class AssertTest extends \PHPUnit_Framework_TestCase
{
    static public function dataInvalidInteger()
    {
        return array(
            array("1"),
            array(1.23),
            array(false),
            array("test"),
        );
    }

    /**
     * @dataProvider dataInvalidInteger
     */
    public function testInvalidInteger($nonInteger)
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_INTEGER);
        Assertion::integer($nonInteger);
    }
}

