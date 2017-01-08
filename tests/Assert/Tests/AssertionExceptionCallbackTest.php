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
    public function testMessageUsingCallbackForString()
    {
        $this->setExpectedException('Assert\AssertionFailedException', 'The assertion Assert\Assertion::string() failed for 3.1415926535898');
        Assertion::string(
            M_PI,
            function (array $parameters) {
                return sprintf(
                    'The assertion %s() failed for %s',
                    $parameters['::assertion'],
                    $parameters['value']
                );
            },
            'M_PI'
        );
    }

    public function testMessageUsingCallbackForRegexFailingAtTheStringAssertion()
    {
        $this->setExpectedException('Assert\AssertionFailedException', 'The assertion Assert\Assertion::string() failed for 3.1415926535898');
        Assertion::regex(
            M_PI,
            '`[A-Z]++`',
            function (array $parameters) {
                return sprintf(
                    'The assertion %s() failed for %s',
                    $parameters['::assertion'],
                    $parameters['value']
                );
            },
            'M_PI'
        );
    }

    public function testMessageUsingCallbackForRegexFailingAtTheRegexAssertion()
    {
        $this->setExpectedException('Assert\AssertionFailedException', 'The assertion Assert\Assertion::regex() failed for 3.1415926535898 against the pattern `^[0-9]++$`');
        Assertion::regex(
            (string) M_PI,
            '`^[0-9]++$`',
            function (array $parameters) {
                return sprintf(
                    'The assertion %s() failed for %s against the pattern %s',
                    $parameters['::assertion'],
                    $parameters['value'],
                    $parameters['pattern']
                );
            },
            'M_PI'
        );
    }
}
