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

class AssertTest extends \PHPUnit_Framework_TestCase
{
    public function testNullOr()
    {
        $this->assertTrue(Assertion::nullOrMax(null, 1));
        $this->assertTrue(Assertion::nullOrMax(null, 2));
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Missing the first argument.
     */
    public function testNullOrWithNoValueThrows()
    {
        Assertion::nullOrMax();
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage No assertion
     */
    public function testFailedNullOrMethodCall()
    {
        Assertion::nullOrAssertionDoesNotExist('');
    }

    public function testAllWithSimpleAssertion()
    {
        $this->assertTrue(Assertion::allTrue(array(true, true)));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_TRUE
     */
    public function testAllWithSimpleAssertionThrowsExceptionOnElementThatFailsAssertion()
    {
        Assertion::allTrue(array(true, false));
    }

    public function testAllWithComplexAssertion()
    {
        $this->assertTrue(Assertion::allIsInstanceOf(array(new \stdClass(), new \stdClass()), 'stdClass'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_INSTANCE_OF
     */
    public function testAllWithComplexAssertionThrowsExceptionOnElementThatFailsAssertion()
    {
        Assertion::allIsInstanceOf(array(new \stdClass(), new \stdClass()), 'PDO', 'Assertion failed', 'foos');
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testAllWithNoValueThrows()
    {
        Assertion::allTrue();
    }
}
