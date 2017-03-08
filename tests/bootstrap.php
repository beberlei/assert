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

$loader = @include __DIR__.'/../vendor/autoload.php';
if (!$loader) {
    die(<<<'EOT'
You must set up the project dependencies, run the following commands:

wget http://getcomposer.org/composer.phar
php composer.phar install

EOT
    );
}

if (!class_exists('\PHPUnit_Framework_TestCase', true)) {
    class_alias('\PHPUnit\Framework\TestCase', '\PHPUnit_Framework_TestCase');
}
