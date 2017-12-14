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
 * @covers \Assert\Assertion\ScalarTrait
 */
class ScalarTraitTest extends TestCase
{
    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_SCALAR
     */
    public function testInvalidScalar()
    {
        Assertion::scalar(new \stdClass());
    }

    public function testValidScalar()
    {
        $this->assertTrue(Assertion::scalar('foo'));
        $this->assertTrue(Assertion::scalar(52));
        $this->assertTrue(Assertion::scalar(12.34));
        $this->assertTrue(Assertion::scalar(false));
    }
}
