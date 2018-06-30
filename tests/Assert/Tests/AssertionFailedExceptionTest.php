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

use Assert\AssertionFailedException;
use Assert\LazyAssertionException;
use Assert\Tests\Fixtures\CustomException;
use Assert\Tests\Fixtures\CustomLazyAssertionException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Throwable;

class AssertionFailedExceptionTest extends TestCase
{
    /**
     * @param string $exceptionClass
     * @dataProvider provideExceptionClasses
     */
    public function testFailedExceptionIsAValidThrowable(string $exceptionClass)
    {
        self::assertTrue(
            (new ReflectionClass($exceptionClass))
                ->implementsInterface(Throwable::class)
        );
    }

    public function provideExceptionClasses()
    {
        return [
            [AssertionFailedException::class],
            [LazyAssertionException::class],
            [CustomException::class],
            [CustomLazyAssertionException::class],
        ];
    }
}
