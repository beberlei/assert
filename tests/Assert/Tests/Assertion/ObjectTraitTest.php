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
 * @covers \Assert\Assertion\ObjectTrait
 */
class ObjectTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testMethodExists()
    {
        $this->assertTrue(Assertion::methodExists('methodExists', new Assertion()));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_METHOD
     */
    public function testMethodExistsFailure()
    {
        Assertion::methodExists('methodNotExists', new Assertion());
    }

    public function testIsObject()
    {
        $this->assertTrue(Assertion::isObject(new \stdClass()));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_OBJECT
     */
    public function testIsObjectExpectingException()
    {
        Assertion::isObject('notAnObject');
    }

    public function testPropertyExists()
    {
        self::assertTrue(Assertion::propertyExists(new \Exception(), 'message'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     * @expectedExceptionCode \Assert\Assertion\INVALID_PROPERTY
     */
    public function testInvalidPropertyExists()
    {
        Assertion::propertyExists(new \Exception(), 'invalidProperty');
    }

    public function testObjectOrClass()
    {
        self::assertTrue(Assertion::objectOrClass(new \stdClass()));
        self::assertTrue(Assertion::objectOrClass('stdClass'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testNotObjectOrClass()
    {
        Assertion::objectOrClass('InvalidClassName');
    }

    public function testPropertiesExist()
    {
        self::assertTrue(Assertion::propertiesExist(new \Exception(), array('message', 'code', 'previous')));
    }

    public function invalidPropertiesExistProvider()
    {
        return array(
            array(array('invalidProperty')),
            array(array('invalidProperty', 'anotherInvalidProperty')),
        );
    }

    /**
     * @dataProvider invalidPropertiesExistProvider
     * @expectedException \Assert\InvalidArgumentException
     * @expectedExceptionCode \Assert\Assertion\INVALID_PROPERTY
     *
     * @param array $properties
     */
    public function testInvalidPropertiesExist($properties)
    {
        Assertion::propertiesExist(new \Exception(), $properties);
    }
}
