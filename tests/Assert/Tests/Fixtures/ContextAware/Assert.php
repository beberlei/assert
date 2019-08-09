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

namespace Assert\Tests\Fixtures\ContextAware;

use Assert\Assert as BaseAssert;

class Assert extends BaseAssert
{
    /** @var string */
    protected static $assertionClass = Assertion::class;

    /** @var string */
    protected static $lazyAssertionClass = LazyAssertion::class;

    public static function that($value, $defaultMessage = null, $defaultPropertyPath = null, array $context = [])
    {
        $assertionChain = new AssertionChain($value, $defaultMessage, $defaultPropertyPath, $context);

        return $assertionChain->setAssertionClassName(static::$assertionClass);
    }
}
