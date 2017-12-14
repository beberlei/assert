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

/**
 * @covers \Assert\Assertion\CompareTrait
 */
class CompareTraitTest extends TestCase
{
    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_EQ
     */
    public function testEq()
    {
        $this->assertTrue(Assertion::eq(1, '1'));
        $this->assertTrue(Assertion::eq('foo', true));
        $this->assertTrue(Assertion::eq($obj = new \stdClass(), $obj));

        Assertion::eq('2', 1);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_SAME
     */
    public function testSame()
    {
        $this->assertTrue(Assertion::same(1, 1));
        $this->assertTrue(Assertion::same('foo', 'foo'));
        $this->assertTrue(Assertion::same($obj = new \stdClass(), $obj));

        Assertion::same(new \stdClass(), new \stdClass());
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_NOT_EQ
     */
    public function testNotEq()
    {
        $this->assertTrue(Assertion::notEq('1', false));
        $this->assertTrue(Assertion::notEq(new \stdClass(), array()));

        Assertion::notEq('1', 1);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_NOT_SAME
     */
    public function testNotSame()
    {
        $this->assertTrue(Assertion::notSame('1', 2));
        $this->assertTrue(Assertion::notSame(new \stdClass(), array()));

        Assertion::notSame(1, 1);
    }

    public static function dataInvalidNotEmpty()
    {
        return array(
            array(''),
            array(false),
            array(0),
            array(null),
            array(array()),
        );
    }

    /**
     * @dataProvider dataInvalidNotEmpty
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\VALUE_EMPTY
     *
     * @param mixed $value
     */
    public function testInvalidNotEmpty($value)
    {
        Assertion::notEmpty($value);
    }

    public function testNotEmpty()
    {
        $this->assertTrue(Assertion::notEmpty('test'));
        $this->assertTrue(Assertion::notEmpty(1));
        $this->assertTrue(Assertion::notEmpty(true));
        $this->assertTrue(Assertion::notEmpty(array('foo')));
    }

    public function testEmpty()
    {
        $this->assertTrue(Assertion::noContent(''));
        $this->assertTrue(Assertion::noContent(0));
        $this->assertTrue(Assertion::noContent(false));
        $this->assertTrue(Assertion::noContent(array()));
    }

    public static function dataInvalidEmpty()
    {
        return array(
            array('foo'),
            array(true),
            array(12),
            array(array('foo')),
            array(new \stdClass()),
        );
    }

    /**
     * @dataProvider dataInvalidEmpty
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\VALUE_NOT_EMPTY
     *
     * @param mixed $value
     */
    public function testInvalidEmpty($value)
    {
        Assertion::noContent($value);
    }

    public static function dataInvalidNull()
    {
        return array(
            array('foo'),
            array(''),
            array(false),
            array(12),
            array(0),
            array(array()),
        );
    }

    /**
     * @dataProvider dataInvalidNull
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\VALUE_NOT_NULL
     *
     * @param mixed $value
     */
    public function testInvalidNull($value)
    {
        Assertion::null($value);
    }

    public function testNull()
    {
        $this->assertTrue(Assertion::null(null));
    }

    public function testNotNull()
    {
        $this->assertTrue(Assertion::notNull('1'));
        $this->assertTrue(Assertion::notNull(1));
        $this->assertTrue(Assertion::notNull(0));
        $this->assertTrue(Assertion::notNull(array()));
        $this->assertTrue(Assertion::notNull(false));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\VALUE_NULL
     */
    public function testInvalidNotNull()
    {
        Assertion::notNull(null);
    }

    public static function dataInvalidNotBlank()
    {
        return array(
            array(''),
            array(' '),
            array("\t"),
            array("\n"),
            array("\r"),
            array(false),
            array(null),
            array(array()),
        );
    }

    /**
     * @dataProvider dataInvalidNotBlank
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_NOT_BLANK
     *
     * @param mixed $notBlank
     */
    public function testInvalidNotBlank($notBlank)
    {
        Assertion::notBlank($notBlank);
    }

    public function testValidNotBlank()
    {
        $this->assertTrue(Assertion::notBlank('foo'));
    }
}
