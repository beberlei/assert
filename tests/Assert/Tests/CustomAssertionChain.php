<?php

namespace Assert\Tests;

use Assert\AssertionChain;

class CustomAssertionChain extends AssertionChain
{
    protected $assertionClass = 'Assert\Tests\CustomAssertion';
}
