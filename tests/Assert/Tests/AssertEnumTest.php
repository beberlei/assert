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
use Assert\Tests\Fixtures\TestBackedEnum;
use Assert\Tests\Fixtures\TestUnitEnum;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class AssertEnumTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        if (\PHP_VERSION_ID < 80100) {
            static::markTestSkipped('Enum is not supported in this PHP version.');
        }
    }

    public function testValidEnumExists()
    {
        $this->assertTrue(Assertion::enumExists(TestUnitEnum::class));
    }

    public function testInvalidEnumExists()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_ENUM);
        Assertion::enumExists('InvalidEnum');
    }

    public function testValidEnumCase()
    {
        $this->assertTrue(Assertion::enumCase('one', TestBackedEnum::class));
    }

    public function testEnumCaseInvalidValue()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_ENUM_CASE);
        Assertion::enumCase('three', TestBackedEnum::class);
    }

    public function testEnumCaseInvalidEnum()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_ENUM);
        Assertion::enumCase('three', 'InvalidEnum');
    }

    public function testEnumCaseNonBackedEnum()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INTERFACE_NOT_IMPLEMENTED);
        Assertion::enumCase('first', TestUnitEnum::class);
    }
}
