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

namespace Assert\Tests\Assertion;

use Assert\Assertion;
use Assert\Tests\Fixtures\OneCountable;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Assert\Assertion\ArrayTrait
 */
class ArrayTraitTest extends TestCase
{
    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_VALUE_IN_ARRAY
     */
    public function testNotInArray()
    {
        $this->assertTrue(Assertion::notInArray(6, \range(1, 5)));
        $this->assertTrue(Assertion::notInArray('a', \range('b', 'z')));

        Assertion::notInArray(1, \range(1, 5));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_CHOICE
     */
    public function testInvalidInArray()
    {
        Assertion::inArray('bar', array('baz'));
    }

    public function testValidInArray()
    {
        $this->assertTrue(Assertion::inArray('foo', array('foo')));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_CHOICE
     */
    public function testInvalidChoice()
    {
        Assertion::choice('foo', array('bar', 'baz'));
    }

    public function testValidChoice()
    {
        $this->assertTrue(Assertion::choice('foo', array('foo')));
    }

    public function testValidTraversable()
    {
        $this->assertTrue(Assertion::isTraversable(new \ArrayObject()));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_TRAVERSABLE
     */
    public function testInvalidTraversable()
    {
        Assertion::isTraversable('not traversable');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_KEY_EXISTS
     */
    public function testInvalidKeyExists()
    {
        Assertion::keyExists(array('foo' => 'bar'), 'baz');
    }

    public function testValidKeyExists()
    {
        $this->assertTrue(Assertion::keyExists(array('foo' => 'bar'), 'foo'));
    }

    public static function dataInvalidArray()
    {
        return array(
            array(null),
            array(false),
            array('test'),
            array(1),
            array(1.23),
            array(new \stdClass()),
            array(\fopen('php://memory', 'r')),
        );
    }

    /**
     * @dataProvider dataInvalidArray
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_ARRAY
     *
     * @param mixed $value
     */
    public function testInvalidArray($value)
    {
        Assertion::isArray($value);
    }

    public function testValidArray()
    {
        $this->assertTrue(Assertion::isArray(array()));
        $this->assertTrue(Assertion::isArray(array(1, 2, 3)));
        $this->assertTrue(Assertion::isArray(array(array(), array())));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_KEY_NOT_EXISTS
     */
    public function testInvalidKeyNotExists()
    {
        Assertion::keyNotExists(array('foo' => 'bar'), 'foo');
    }

    public function testValidKeyNotExists()
    {
        $this->assertTrue(Assertion::keyNotExists(array('foo' => 'bar'), 'baz'));
    }

    public function testValidCount()
    {
        $this->assertTrue(Assertion::count(array('Hi'), 1));
        $this->assertTrue(Assertion::count(new OneCountable(), 1));
    }

    public static function dataInvalidCount()
    {
        return array(
            array(array('Hi', 'There'), 3),
            array(new OneCountable(), 2),
        );
    }

    /**
     * @dataProvider dataInvalidCount
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_COUNT
     * @expectedExceptionMessageRegExp /List does not contain exactly "\d+" elements./
     *
     * @param mixed $countable
     * @param int   $count
     */
    public function testInvalidCount($countable, $count)
    {
        Assertion::count($countable, $count);
    }

    public function testChoicesNotEmpty()
    {
        $this->assertTrue(Assertion::choicesNotEmpty(
            array('tux' => 'linux', 'Gnu' => 'dolphin'),
            array('tux')
        ));
    }

    /**
     * @dataProvider invalidChoicesProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\VALUE_EMPTY
     *
     * @param $values
     * @param $choices
     */
    public function testChoicesNotEmptyExpectingExceptionEmptyValue($values, $choices)
    {
        Assertion::choicesNotEmpty($values, $choices);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_KEY_ISSET
     */
    public function testChoicesNotEmptyExpectingExceptionInvalidKeyIsset()
    {
        Assertion::choicesNotEmpty(array('tux' => ''), array('invalidChoice'));
    }

    public function invalidChoicesProvider()
    {
        return array(
            'empty values' => array(array(), array('tux'), Assertion\VALUE_EMPTY),
            'empty recodes in $values' => array(array('tux' => ''), array('tux'), Assertion\VALUE_EMPTY),
        );
    }

    public function testValidNotEmptyKey()
    {
        $this->assertTrue(Assertion::notEmptyKey(array('keyExists' => 'notEmpty'), 'keyExists'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\VALUE_EMPTY
     */
    public function testInvalidNotEmptyKeyEmptyKey()
    {
        Assertion::notEmptyKey(array('keyExists' => ''), 'keyExists');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_KEY_ISSET
     */
    public function testInvalidNotEmptyKeyKeyNotExists()
    {
        Assertion::notEmptyKey(array('key' => 'notEmpty'), 'keyNotExists');
    }

    public function testValidArrayAccessible()
    {
        $this->assertTrue(Assertion::isArrayAccessible(new \ArrayObject()));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_ARRAY_ACCESSIBLE
     */
    public function testInvalidArrayAccessible()
    {
        Assertion::isArrayAccessible('not array accessible');
    }
}
