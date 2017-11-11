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

use Assert\Assertion;
use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class PR142_AllowOverridingStringifyTest extends TestCase
{
    public static function dataInvalidString()
    {
        return array(
            array(1.23, 'Value "***1.23***" expected to be string, type double given.'),
            array(false, 'Value "***<FALSE>***" expected to be string, type boolean given.'),
            array(new \ArrayObject(), 'Value "***ArrayObject***" expected to be string, type object given.'),
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
        try {
            Fixtures\PR142_OverrideStringify::string($invalidString);
        } catch (AssertionFailedException $ex) {
            $this->assertSame(Assertion::INVALID_STRING, $ex->getCode());
            $this->assertSame($exceptionMessage, $ex->getMessage());
        }
    }
}
