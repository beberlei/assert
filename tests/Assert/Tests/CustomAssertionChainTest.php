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

class CustomAssertionChainTest extends \PHPUnit_Framework_TestCase
{
    public function testIsAnAssertionChain()
    {
        $this->assertInstanceOf('Assert\AssertionChain', new CustomAssertionChain(10));
    }

    public function testHasAccessToMethodsInCustomAssert()
    {
        $chain = new CustomAssertionChain(true);
        $chain->customAssert();
    }

    public function testHasAccessToMethodsInLibAssert()
    {
        $chain = new CustomAssertionChain(true);
        $chain->boolean();
    }

    public function testCanThrowErrors()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, CustomAssertion::INVALID_CUSTOM);
        $chain = new CustomAssertionChain(false);
        $chain->customAssert();
    }
}
