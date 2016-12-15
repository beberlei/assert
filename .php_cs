<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__);

$rules = array(
    '@PSR2' => true,
);

$cacheDir = getenv('TRAVIS') ? getenv('HOME') . '/.php-cs-fixer' : __DIR__;

return PhpCsFixer\Config::create()
    ->setRules($rules)
    ->setFinder($finder)
    ->setCacheFile($cacheDir . '/.php_cs.cache');
