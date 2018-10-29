<?php

namespace Assert\Tests;

use Assert\Assert;
use PHPUnit\Framework\TestCase;

class LazyArrayTest extends TestCase
{
    public function testLazyArray()
    {
        $form = [
            'email' => 'Richard@Home.com',
            'password' => 'Some highly secret password',
        ];

        $this->assertTrue(Assert::lazy()

            ->that($form['email'] ?? null, 'email')
            ->notEmpty()
            ->maxLength(255)
            ->email()

            ->that($form['password'] ?? null, 'password')
            ->notEmpty()
            ->minLength(4)
            ->maxLength(255)

            ->verifyNow()
        );
    }
}
