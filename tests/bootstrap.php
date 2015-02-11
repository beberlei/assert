<?php

$loader = @include __DIR__ . '/../vendor/autoload.php';
if (!$loader) {
    die(<<<'EOT'
You must set up the project dependencies, run the following commands:

wget http://getcomposer.org/composer.phar
php composer.phar install

EOT
    );
}
