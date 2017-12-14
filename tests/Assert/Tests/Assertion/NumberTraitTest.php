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
use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Assert\Assertion\NumberTrait
 */
class NumberTraitTest extends TestCase
{
    public static function dataInvalidInteger()
    {
        return array(
            array(1.23),
            array(false),
            array('test'),
            array(null),
            array('1.23'),
            array('10'),
            array(new \DateTime()),
        );
    }

    /**
     * @dataProvider dataInvalidInteger
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_INTEGER
     *
     * @param mixed $nonInteger
     */
    public function testInvalidInteger($nonInteger)
    {
        Assertion::integer($nonInteger);
    }

    public function testValidInteger()
    {
        $this->assertTrue(Assertion::integer(10));
        $this->assertTrue(Assertion::integer(0));
    }

    public static function dataInvalidFloat()
    {
        return array(
            array(1),
            array(false),
            array('test'),
            array(null),
            array('1.23'),
            array('10'),
        );
    }

    /**
     * @dataProvider dataInvalidFloat
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_FLOAT
     *
     * @param mixed $nonFloat
     */
    public function testInvalidFloat($nonFloat)
    {
        Assertion::float($nonFloat);
    }

    public function testValidFloat()
    {
        $this->assertTrue(Assertion::float(1.0));
        $this->assertTrue(Assertion::float(0.1));
        $this->assertTrue(Assertion::float(-1.1));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_FLOAT
     * @expectedExceptionMessage 1234567...
     */
    public function testStringifyTruncatesStringValuesLongerThan100CharactersAppropriately()
    {
        $string = \str_repeat('1234567890', 11);

        $this->assertTrue(Assertion::float($string));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_FLOAT
     * @expectedExceptionMessage stream
     */
    public function testStringifyReportsResourceType()
    {
        $this->assertTrue(Assertion::float(\fopen('php://stdin', 'rb')));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_DIGIT
     */
    public function testInvalidDigit()
    {
        Assertion::digit(-1);
    }

    public function testValidDigit()
    {
        $this->assertTrue(Assertion::digit(1));
        $this->assertTrue(Assertion::digit(0));
        $this->assertTrue(Assertion::digit('0'));
    }

    public function testValidIntegerish()
    {
        $this->assertTrue(Assertion::integerish(10));
        $this->assertTrue(Assertion::integerish('10'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_RANGE
     */
    public function testInvalidRange()
    {
        Assertion::range(1, 2, 3);
        Assertion::range(1.5, 2, 3);
    }

    public function testValidRange()
    {
        $this->assertTrue(Assertion::range(1, 1, 2));
        $this->assertTrue(Assertion::range(2, 1, 2));
        $this->assertTrue(Assertion::range(2, 0, 100));
        $this->assertTrue(Assertion::range(2.5, 2.25, 2.75));
    }

    public function testThatAssertionExceptionCanAccessValueAndSupplyConstraints()
    {
        try {
            Assertion::range(0, 10, 20);

            $this->fail('Exception expected');
        } catch (AssertionFailedException $e) {
            $this->assertEquals(0, $e->getValue());
            $this->assertEquals(array('min' => 10, 'max' => 20), $e->getConstraints());
        }
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_NUMERIC
     */
    public function testInvalidNumeric()
    {
        Assertion::numeric('foo');
    }

    public function testValidNumeric()
    {
        $this->assertTrue(Assertion::numeric('1'));
        $this->assertTrue(Assertion::numeric(1));
        $this->assertTrue(Assertion::numeric(1.23));
    }

    public function testMin()
    {
        $this->assertTrue(Assertion::min(1, 1));
        $this->assertTrue(Assertion::min(2, 1));
        $this->assertTrue(Assertion::min(2.5, 1));
    }

    /**
     * @dataProvider dataInvalidMin
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_MIN
     * @expectedExceptionMessageRegExp /Number "(0\.5|0)" was expected to be at least "(1|2\.5)"/
     *
     * @param float|int $value
     * @param float|int $min
     */
    public function testInvalidMin($value, $min)
    {
        Assertion::min($value, $min);
    }

    public function dataInvalidMin()
    {
        return array(
            array(0, 1),
            array(0.5, 2.5),
        );
    }

    public function testMax()
    {
        $this->assertTrue(Assertion::max(1, 1));
        $this->assertTrue(Assertion::max(0.5, 1));
        $this->assertTrue(Assertion::max(0, 1));
    }

    /**
     * @dataProvider dataInvalidMax
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_MAX
     * @expectedExceptionMessageRegExp /Number "(2.5|2)" was expected to be at most "(1|0\.5)"/
     *
     * @param float|int $value
     * @param float|int $min
     */
    public function testInvalidMax($value, $min)
    {
        Assertion::max($value, $min);
    }

    public function dataInvalidMax()
    {
        return array(
            array(2, 1),
            array(2.5, 0.5),
        );
    }

    public function testLessThan()
    {
        $this->assertTrue(Assertion::lessThan(1, 2));
        $this->assertTrue(Assertion::lessThan('aaa', 'bbb'));
        $this->assertTrue(Assertion::lessThan('aaa', 'aaaa'));
        $this->assertTrue(Assertion::lessThan(new \DateTime('today'), new \DateTime('tomorrow')));
    }

    public function invalidLessProvider()
    {
        return array(
            array(2, 1),
            array(2, 2),
            array('aaa', 'aaa'),
            array('aaaa', 'aaa'),
            array(new \DateTime('today'), new \DateTime('yesterday')),
            array(new \DateTime('today'), new \DateTime('today')),
        );
    }

    /**
     * @dataProvider invalidLessProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_LESS
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testLessThanThrowsException($value, $limit)
    {
        Assertion::lessThan($value, $limit);
    }

    public function testLessOrEqualThan()
    {
        $this->assertTrue(Assertion::lessOrEqualThan(1, 2));
        $this->assertTrue(Assertion::lessOrEqualThan(1, 1));
        $this->assertTrue(Assertion::lessOrEqualThan('aaa', 'bbb'));
        $this->assertTrue(Assertion::lessOrEqualThan('aaa', 'aaaa'));
        $this->assertTrue(Assertion::lessOrEqualThan('aaa', 'aaa'));
        $this->assertTrue(Assertion::lessOrEqualThan(new \DateTime('today'), new \DateTime('tomorrow')));
        $this->assertTrue(Assertion::lessOrEqualThan(new \DateTime('today'), new \DateTime('today')));
    }

    public function invalidLessOrEqualProvider()
    {
        return array(
            array(2, 1),
            array('aaaa', 'aaa'),
            array(new \DateTime('today'), new \DateTime('yesterday')),
        );
    }

    /**
     * @dataProvider invalidLessOrEqualProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_LESS_OR_EQUAL
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testLessOrEqualThanThrowsException($value, $limit)
    {
        Assertion::lessOrEqualThan($value, $limit);
    }

    public function testGreaterThan()
    {
        $this->assertTrue(Assertion::greaterThan(2, 1));
        $this->assertTrue(Assertion::greaterThan('bbb', 'aaa'));
        $this->assertTrue(Assertion::greaterThan('aaaa', 'aaa'));
        $this->assertTrue(Assertion::greaterThan(new \DateTime('tomorrow'), new \DateTime('today')));
    }

    public function invalidGreaterProvider()
    {
        return array(
            array(1, 2),
            array(2, 2),
            array('aaa', 'aaa'),
            array('aaa', 'aaaa'),
            array(new \DateTime('yesterday'), new \DateTime('today')),
            array(new \DateTime('today'), new \DateTime('today')),
        );
    }

    /**
     * @dataProvider invalidGreaterProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_GREATER
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testGreaterThanThrowsException($value, $limit)
    {
        Assertion::greaterThan($value, $limit);
    }

    public function testGreaterOrEqualThan()
    {
        $this->assertTrue(Assertion::greaterOrEqualThan(2, 1));
        $this->assertTrue(Assertion::greaterOrEqualThan(1, 1));
        $this->assertTrue(Assertion::greaterOrEqualThan('bbb', 'aaa'));
        $this->assertTrue(Assertion::greaterOrEqualThan('aaaa', 'aaa'));
        $this->assertTrue(Assertion::greaterOrEqualThan('aaa', 'aaa'));
        $this->assertTrue(Assertion::greaterOrEqualThan(new \DateTime('tomorrow'), new \DateTime('today')));
        $this->assertTrue(Assertion::greaterOrEqualThan(new \DateTime('today'), new \DateTime('today')));
    }

    public function invalidGreaterOrEqualProvider()
    {
        return array(
            array(1, 2),
            array('aaa', 'aaaa'),
            array(new \DateTime('yesterday'), new \DateTime('tomorrow')),
        );
    }

    /**
     * @dataProvider invalidGreaterOrEqualProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_GREATER_OR_EQUAL
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testGreaterOrEqualThanThrowsException($value, $limit)
    {
        Assertion::greaterOrEqualThan($value, $limit);
    }

    /**
     * @dataProvider providerInvalidBetween
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_BETWEEN
     *
     * @param mixed $value
     * @param mixed $lowerLimit
     * @param mixed $upperLimit
     */
    public function testInvalidBetween($value, $lowerLimit, $upperLimit)
    {
        Assertion::between($value, $lowerLimit, $upperLimit);
    }

    /**
     * @return array
     */
    public function providerInvalidBetween()
    {
        return array(
            array(1, 2, 3),
            array(3, 1, 2),
            array('aaa', 'bbb', 'ccc'),
            array('ddd', 'bbb', 'ccc'),
            array(new \DateTime('yesterday'), new \DateTime('today'), new \DateTime('tomorrow')),
            array(new \DateTime('tomorrow'), new \DateTime('yesterday'), new \DateTime('today')),
        );
    }

    /**
     * @dataProvider providerValidBetween
     *
     * @param mixed $value
     * @param mixed $lowerLimit
     * @param mixed $upperLimit
     */
    public function testValidBetween($value, $lowerLimit, $upperLimit)
    {
        $this->assertTrue(Assertion::between($value, $lowerLimit, $upperLimit));
    }

    /**
     * @return array
     */
    public function providerValidBetween()
    {
        return array(
            array(2, 1, 3),
            array(1, 1, 1),
            array('bbb', 'aaa', 'ccc'),
            array('aaa', 'aaa', 'aaa'),
            array(new \DateTime('today'), new \DateTime('yesterday'), new \DateTime('tomorrow')),
            array(new \DateTime('today'), new \DateTime('today'), new \DateTime('today')),
        );
    }

    /**
     * @dataProvider providerInvalidBetweenExclusive
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_BETWEEN_EXCLUSIVE
     *
     * @param mixed $value
     * @param mixed $lowerLimit
     * @param mixed $upperLimit
     */
    public function testInvalidBetweenExclusive($value, $lowerLimit, $upperLimit)
    {
        Assertion::betweenExclusive($value, $lowerLimit, $upperLimit);
    }

    /**
     * @return array
     */
    public function providerInvalidBetweenExclusive()
    {
        return array(
            array(1, 1, 2),
            array(2, 1, 2),
            array('aaa', 'aaa', 'bbb'),
            array('bbb', 'aaa', 'bbb'),
            array(new \DateTime('today'), new \DateTime('today'), new \DateTime('tomorrow')),
            array(new \DateTime('tomorrow'), new \DateTime('today'), new \DateTime('tomorrow')),
        );
    }

    /**
     * @dataProvider providerValidBetweenExclusive
     *
     * @param mixed $value
     * @param mixed $lowerLimit
     * @param mixed $upperLimit
     */
    public function testValidBetweenExclusive($value, $lowerLimit, $upperLimit)
    {
        $this->assertTrue(Assertion::betweenExclusive($value, $lowerLimit, $upperLimit));
    }

    /**
     * @return array
     */
    public function providerValidBetweenExclusive()
    {
        return array(
            array(2, 1, 3),
            array('bbb', 'aaa', 'ccc'),
            array(new \DateTime('today'), new \DateTime('yesterday'), new \DateTime('tomorrow')),
        );
    }
}
