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

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/MethodDocGenerator.php';

$generator = new MethodDocGenerator();
$generator->generateAssertionDocs();
$generator->generateChainDocs();
$generator->generateLazyAssertionDocs();
$generator->generateReadMe();
