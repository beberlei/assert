<?php
namespace Assert\Tests;

use Assert\Assertion;

class AssertionCodesUniqueTest extends \PHPUnit_Framework_TestCase
{
    public function testAssertionCodesAreUnique()
    {
        $assertReflection = new \ReflectionClass('Assert\Assertion');
        $constants        = $assertReflection->getConstants();

        Assertion::eq(count($constants), count(array_unique($constants)));
    }
}
