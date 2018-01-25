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

namespace Assert;

/**
 * AssertionChain factory.
 */
abstract class Assert
{
    /** @var string */
    protected static $lazyAssertionExceptionClass = 'Assert\LazyAssertionException';

    /** @var string */
    protected static $assertionClass = 'Assert\Assertion';

    /**
     * Start validation on a value, returns {@link AssertionChain}.
     *
     * The invocation of this method starts an assertion chain
     * that is happening on the passed value.
     *
     * @example
     *
     *  Assert::that($value)->notEmpty()->integer();
     *  Assert::that($value)->nullOr()->string()->startsWith("Foo");
     *
     * The assertion chain can be stateful, that means be careful when you reuse
     * it. You should never pass around the chain.
     *
     * @param mixed  $value
     * @param string $defaultMessage
     * @param string $defaultPropertyPath
     *
     * @return \Assert\AssertionChain
     */
    public static function that($value, $defaultMessage = null, $defaultPropertyPath = null)
    {
        $assertionChain = new AssertionChain($value, $defaultMessage, $defaultPropertyPath);

        return $assertionChain
            ->setAssertionClassName(static::$assertionClass)
        ;
    }

    /**
     * Start validation on a set of values, returns {@link AssertionChain}.
     *
     * @param mixed  $values
     * @param string $defaultMessage
     * @param string $defaultPropertyPath
     *
     * @return \Assert\AssertionChain
     */
    public static function thatAll($values, $defaultMessage = null, $defaultPropertyPath = null)
    {
        return static::that($values, $defaultMessage, $defaultPropertyPath)->all();
    }

    /**
     * Start validation and allow NULL, returns {@link AssertionChain}.
     *
     * @param mixed  $value
     * @param string $defaultMessage
     * @param string $defaultPropertyPath
     *
     * @return \Assert\AssertionChain
     */
    public static function thatNullOr($value, $defaultMessage = null, $defaultPropertyPath = null)
    {
        return static::that($value, $defaultMessage, $defaultPropertyPath)->nullOr();
    }

    /**
     * Create a lazy assertion object.
     *
     * @return \Assert\LazyAssertion
     */
    public static function lazy()
    {
        $lazyAssertion = new LazyAssertion();

        return $lazyAssertion
            ->setAssertClass(get_called_class())
            ->setExceptionClass(static::$lazyAssertionExceptionClass)
        ;
    }
}
