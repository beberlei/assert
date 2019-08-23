<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__);

$header = <<<TXT
Assert

LICENSE

This source file is subject to the MIT license that is bundled
with this package in the file LICENSE.txt.
If you did not receive a copy of the license and are unable to
obtain it through the world-wide-web, please send an email
to kontakt@beberlei.de so I can send you a copy immediately.
TXT;

$rules = [
    '@PSR2' => true,
    '@Symfony' => true,
    'cast_spaces' => [
        'space' => 'none',
    ],
    'concat_space' => [
        'spacing' => 'none',
    ],
    'native_function_invocation' => [
        'scope' => 'namespaced',
    ],
    'psr4' => true,
    'phpdoc_align' => [
        'align' => 'left',
    ],
    'array_syntax' => [
        'syntax' => 'short',
    ],
    'header_comment' => [
        'header' => $header,
        'commentType' => PhpCsFixer\Fixer\Comment\HeaderCommentFixer::HEADER_PHPDOC,
    ],
    'yoda_style' => false,
];

$cacheDir = getenv('TRAVIS') ? getenv('HOME') . '/.php-cs-fixer' : __DIR__;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules($rules)
    ->setFinder($finder)
    ->setCacheFile($cacheDir . '/.php_cs.cache');
