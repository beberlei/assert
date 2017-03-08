<?php

namespace Assert\Tests\Fixtures;

use Assert\Assert;

class CustomAssert extends Assert
{
    protected static $assertionClass = 'Assert\Tests\Fixtures\CustomAssertion';
    protected static $lazyAssertionExceptionClass = 'Assert\Tests\Fixtures\CustomLazyAssertionException';
}
