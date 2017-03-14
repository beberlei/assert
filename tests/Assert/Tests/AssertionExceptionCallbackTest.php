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

class AssertionExceptionCallbackTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionMessage The assertion Assert\Assertion::string() failed for 3.1415926535898
     */
    public function testMessageUsingCallbackForString()
    {
        Assertion::string(
            M_PI,
            function (array $parameters) {
                return \sprintf(
                    'The assertion %s() failed for %s',
                    $parameters['::assertion'],
                    $parameters['value']
                );
            },
            'M_PI'
        );
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionMessage The assertion Assert\Assertion::string() failed for 3.1415926535898
     */
    public function testMessageUsingCallbackForRegexFailingAtTheStringAssertion()
    {
        Assertion::regex(
            M_PI,
            '`[A-Z]++`',
            function (array $parameters) {
                return \sprintf(
                    'The assertion %s() failed for %s',
                    $parameters['::assertion'],
                    $parameters['value']
                );
            },
            'M_PI'
        );
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionMessage The assertion Assert\Assertion::regex() failed for 3.1415926535898 against the pattern `^[0-9]++$`
     */
    public function testMessageUsingCallbackForRegexFailingAtTheRegexAssertion()
    {
        Assertion::regex(
            (string) M_PI,
            '`^[0-9]++$`',
            function (array $parameters) {
                return \sprintf(
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
