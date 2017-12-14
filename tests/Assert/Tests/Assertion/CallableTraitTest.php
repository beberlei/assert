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
 * @covers \Assert\Assertion\CallableTrait
 */
class CallableTraitTest extends TestCase
{
    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_SATISFY
     */
    public function testInvalidSatisfy()
    {
        Assertion::satisfy(null, function ($value) {
            return !\is_null($value);
        });
    }

    public function testValidSatisfy()
    {
        // Should not fail with true return
        $this->assertTrue(Assertion::satisfy(null, function ($value) {
            return \is_null($value);
        }));

        // Should not fail with void return
        $this->assertTrue(Assertion::satisfy(true, function ($value) {
            if (!\is_bool($value)) {
                return false;
            }
        }));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_CALLABLE
     */
    public function testInvalidCallable()
    {
        Assertion::isCallable('nonExistingFunction');
    }

    public function testValidCallable()
    {
        $this->assertTrue(Assertion::isCallable('\is_callable'));
        $this->assertTrue(Assertion::isCallable('\\Assert\\Tests\\Fixtures\\someCallable'));
        $this->assertTrue(Assertion::isCallable(array('\\Assert\\Tests\\Fixtures\\OneCountable', 'count')));
        $this->assertTrue(Assertion::isCallable(function () {
        }));
    }
}
