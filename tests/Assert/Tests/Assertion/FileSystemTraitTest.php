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
 * @covers \Assert\Assertion\FileSystemTrait
 */
class FileSystemTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testFile()
    {
        $this->assertTrue(Assertion::file(__FILE__));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\VALUE_EMPTY
     */
    public function testFileWithEmptyFilename()
    {
        Assertion::file('');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_FILE
     */
    public function testFileDoesNotExists()
    {
        Assertion::file(__DIR__ . '/does-not-exists');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_DIRECTORY
     */
    public function testDirectory()
    {
        $this->assertTrue(Assertion::directory(__DIR__));

        Assertion::directory(__DIR__ . '/does-not-exist');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_READABLE
     */
    public function testReadable()
    {
        $this->assertTrue(Assertion::readable(__FILE__));

        Assertion::readable(__DIR__ . '/does-not-exist');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_WRITEABLE
     */
    public function testWriteable()
    {
        $this->assertTrue(Assertion::writeable(\sys_get_temp_dir()));

        Assertion::writeable(__DIR__ . '/does-not-exist');
    }

    public function testIsResource()
    {
        self::assertTrue(Assertion::isResource(\curl_init()));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testIsNotResource()
    {
        Assertion::isResource(new \stdClass());
    }
}
