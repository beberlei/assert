<?php

declare(strict_types=1);

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

namespace Assert\Tests\Assertion;

use Assert\Assertion;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Assert\Assertion\BoolTrait
 */
class BoolTraitTest extends TestCase
{
    public static function dataInvalidIntegerish()
    {
        return array(
            array(1.23),
            array(false),
            array('test'),
            array(null),
            array('1.23'),
            array(\fopen(__FILE__, 'r')),
        );
    }

    /**
     * @dataProvider dataInvalidIntegerish
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_INTEGERISH
     *
     * @param mixed $nonInteger
     */
    public function testInvalidIntegerish($nonInteger)
    {
        Assertion::integerish($nonInteger);
    }

    public function testValidBoolean()
    {
        $this->assertTrue(Assertion::boolean(true));
        $this->assertTrue(Assertion::boolean(false));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_BOOLEAN
     */
    public function testInvalidBoolean()
    {
        Assertion::boolean(1);
    }

    public function testValidTrue()
    {
        $this->assertTrue(Assertion::true(1 > 0));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_TRUE
     */
    public function testInvalidTrue()
    {
        Assertion::true(false);
    }

    public function testValidFalse()
    {
        $this->assertTrue(Assertion::false(1 == 0));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_FALSE
     */
    public function testInvalidFalse()
    {
        Assertion::false(true);
    }
}
