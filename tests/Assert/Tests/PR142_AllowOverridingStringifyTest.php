<?php

namespace Assert\Tests;

use Assert\Assertion;

class PR142_AllowOverridingStringifyTest extends \PHPUnit_Framework_TestCase
{
    public static function dataInvalidString()
    {
        return array(
            array(1.23, 'Value "***1.23***" expected to be string, type double given.'),
            array(false, 'Value "***<FALSE>***" expected to be string, type boolean given.'),
            array(new \ArrayObject, 'Value "***ArrayObject***" expected to be string, type object given.'),
            array(null, 'Value "***<NULL>***" expected to be string, type NULL given.'),
            array(10, 'Value "***10***" expected to be string, type integer given.'),
            array(true, 'Value "***<TRUE>***" expected to be string, type boolean given.'),
        );
    }

    /**
     * @dataProvider dataInvalidString
     *
     * @param string $invalidString
     * @param string $exceptionMessage
     */
    public function testInvalidStringWithOverriddenStringify($invalidString, $exceptionMessage)
    {
        $this->setExpectedException('Assert\AssertionFailedException', $exceptionMessage, Assertion::INVALID_STRING);
        PR142_OverrideStringify::string($invalidString);
    }
}

class PR142_OverrideStringify extends Assertion
{
    protected static function stringify($value)
    {
        return '***' . parent::stringify($value) . '***';
    }
}
