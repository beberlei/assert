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
use Assert\AssertionFailedException;

class AssertionExceptionCallbackTest extends \PHPUnit_Framework_TestCase
{
    public function testMessageCallback()
    {
        $this->setExpectedException(AssertionFailedException::class, 'The value of M_PI is not regarded as a string');
        Assertion::string(M_PI, function ($value, $propertyPath = null) {
            return 'The value of M_PI is not regarded as a string';
        });
    }
}
