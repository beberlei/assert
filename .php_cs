<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__);

$rules = array(
    'psr0' => false,
    '@PSR2' => true,
    'psr4' => true,
);

$cacheDir = getenv('TRAVIS') ? getenv('HOME') . '/.php-cs-fixer' : __DIR__;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules($rules)
    ->setFinder($finder)
    ->setCacheFile($cacheDir . '/.php_cs.cache');
