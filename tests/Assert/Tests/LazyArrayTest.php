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
