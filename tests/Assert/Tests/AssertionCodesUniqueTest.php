<?php
namespace Assert\Tests;

use Assert\Assertion;

class AssertionCodesUniqueTest extends \PHPUnit_Framework_TestCase
{
    public function testAssertionCodesAreUnique()
    {
        $constants = (new \ReflectionClass('Assert\Assertion'))->getConstants();

        Assertion::eq(count($constants), count(array_unique($constants)));
    }
}
