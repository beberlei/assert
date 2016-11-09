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

use Assert\Assert;
use Assert\Assertion;
use Assert\InvalidArgumentException;
use Assert\LazyAssertionException;

class CustomAssertionClassTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        CustomAssertion::clearCalls();
    }

    /**
     * @test
     */
    public function it_uses_custom_exception_class()
    {
        $this->expectException(CustomException::class);
        CustomAssertion::integer('foo');
    }

    /**
     * @test
     */
    public function it_uses_custom_assertion_class_for_assertion_chains()
    {
        $string = 's' . uniqid();
        CustomAssert::that($string)->string();
        $this->assertSame([['string', $string]], CustomAssertion::getCalls());

        $this->expectException(CustomException::class);
        CustomAssert::that($string)->integer();
    }

    /**
     * @test
     */
    public function it_uses_custom_exception_for_lazy_assertion_chains()
    {
        $this->expectException(CustomLazyAssertionException::class);
        CustomAssert::lazy()
            ->that('foo', 'foo')->integer()
            ->verifyNow()
        ;
    }

    /**
     * @test
     */
    public function it_uses_custom_exception_for_lazy_assertion_chains_when_first_assertion_does_not_fail()
    {
        $this->expectException(CustomLazyAssertionException::class);
        CustomAssert::lazy()
            ->that('foo', 'foo')->string()
            ->that('bar', 'bar')->integer()
            ->verifyNow()
        ;
    }
}

class CustomException extends InvalidArgumentException
{
}

class CustomLazyAssertionException extends LazyAssertionException
{
}

class CustomAssertion extends Assertion
{
    protected static $exceptionClass = CustomException::class;
    private static $calls = [];

    public static function clearCalls()
    {
        self::$calls = [];
    }

    public static function getCalls()
    {
        return self::$calls;
    }

    public static function string($value, $message = null, $propertyPath = null)
    {
        self::$calls[] = ['string', $value];
        return parent::string($value, $message, $propertyPath);
    }
}

class CustomAssert extends Assert
{
    protected static $assertionClass = CustomAssertion::class;
    protected static $lazyAssertionExceptionClass = CustomLazyAssertionException::class;
}
