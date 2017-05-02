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
use Assert\Tests\Fixtures\ChildStdClass;

/**
 * @covers \Assert\Assertion\ClassTrait
 */
class ClassTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_SUBCLASS_OF
     */
    public function testInvalidSubclassOf()
    {
        Assertion::subclassOf(new \stdClass(), 'PDO');
    }

    public function testValidSubclassOf()
    {
        $this->assertTrue(Assertion::subclassOf(new ChildStdClass(), 'stdClass'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_CLASS
     */
    public function testInvalidClass()
    {
        Assertion::classExists('Foo');
    }

    public function testValidClass()
    {
        $this->assertTrue(Assertion::classExists('\\Exception'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_INTERFACE
     */
    public function testInvalidInterfaceExists()
    {
        Assertion::interfaceExists('Foo');
    }

    public function testValidInterfaceExists()
    {
        $this->assertTrue(Assertion::interfaceExists('\\Countable'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INTERFACE_NOT_IMPLEMENTED
     */
    public function testImplementsInterface()
    {
        $this->assertTrue(Assertion::implementsInterface('\ArrayIterator', '\Traversable'));

        Assertion::implementsInterface('\Exception', '\Traversable');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INTERFACE_NOT_IMPLEMENTED
     */
    public function testImplementsInterfaceWithClassObject()
    {
        $class = new \ArrayObject();

        $this->assertTrue(Assertion::implementsInterface($class, '\Traversable'));

        Assertion::implementsInterface($class, '\SplObserver');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_INSTANCE_OF
     */
    public function testInvalidInstanceOf()
    {
        Assertion::isInstanceOf(new \stdClass(), 'PDO');
    }

    public function testValidInstanceOf()
    {
        $this->assertTrue(Assertion::isInstanceOf(new \stdClass(), 'stdClass'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_NOT_INSTANCE_OF
     */
    public function testInvalidNotInstanceOf()
    {
        Assertion::notIsInstanceOf(new \stdClass(), 'stdClass');
    }

    public function testValidNotIsInstanceOf()
    {
        $this->assertTrue(Assertion::notIsInstanceOf(new \stdClass(), 'PDO'));
    }
}
