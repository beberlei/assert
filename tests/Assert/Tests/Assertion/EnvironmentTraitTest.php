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
 * @covers \Assert\Assertion\EnvironmentTrait
 */
class EnvironmentTraitTest extends TestCase
{
    public function testValidPhpVersion()
    {
        $this->assertTrue(Assertion::phpVersion('>', '4.0.0'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testInvalidPhpVersion()
    {
        Assertion::phpVersion('<', '5.0.0');
    }

    public function testValidConstant()
    {
        $this->assertTrue(Assertion::defined('PHP_VERSION'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testInvalidConstant()
    {
        Assertion::defined('NOT_A_CONSTANT');
    }

    public function testValidVersion()
    {
        $this->assertTrue(Assertion::version('1.0.0', '<', '2.0.0'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testInvalidVersion()
    {
        Assertion::version('1.0.0', 'eq', '2.0.0');
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testInvalidVersionOperator()
    {
        Assertion::version('1.0.0', null, '2.0.0');
    }

    public function testValidExtensionVersion()
    {
        $this->assertTrue(Assertion::extensionVersion('json', '>', '1.0.0'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testInvalidExtensionVersion()
    {
        Assertion::extensionVersion('json', '<', '0.1.0');
    }

    public function testExtensionLoaded()
    {
        $this->assertTrue(Assertion::extensionLoaded('date'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testExtensionNotLoaded()
    {
        Assertion::extensionLoaded('NOT_LOADED');
    }
}
