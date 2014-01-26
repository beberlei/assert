<?php

namespace Assert;

use ReflectionClass;

class MethodDocGenerator
{
    public function generateChainDocs()
    {
        $phpFile = __DIR__ . '/../lib/Assert/AssertionChain.php';
        $flags = '\\Assert\\AssertionChain';
        $skipParameterTest = function ($parameter) {
            return $parameter->getPosition() === 0;
        };

        return $this->generateMethodDocs($phpFile, $flags, $skipParameterTest);
    }

    public function generateAssertionDocs()
    {
        $phpFile = __DIR__ . '/../lib/Assert/Assertion.php';
        $flags = 'static void';
        $skipParameterTest = function ($parameter) {
            return false;
        };

        return $this->generateMethodDocs($phpFile, $flags, $skipParameterTest);
    }

    private function generateMethodDocs($phpFile, $flags, $skipParameterTest)
    {
        $methods = $this->gatherAssertions();

        $lines = array();
        foreach ($methods as $method) {
            $doc = $method->getDocComment();
            $shortDescription = substr(explode("\n", $doc)[1], 7);

            $line = ' * @method ' . $flags . ' ' . $method->getName() . '(';

            foreach ($method->getParameters() as $parameter) {
                if ($skipParameterTest($parameter)) {
                    continue;
                }

                $line .= '$' . $parameter->getName() . ', ';
            }

            $lines[] = substr($line, 0, -2) . ') ' . $shortDescription . "\n";
        }

        $fileLines = file($phpFile);
        $newLines = array();
        $inGeneratedCode = false;

        for ($i = 0; $i < count($fileLines); $i++) {
            if (strpos($fileLines[$i], ' * METHODSTART') === 0) {
                $inGeneratedCode = true;
                $newLines[] = ' * METHODSTART' . "\n";
            }

            if (strpos($fileLines[$i], ' * METHODEND') === 0) {
                $inGeneratedCode = false;

                $newLines = array_merge($newLines, $lines);
            }

            if ( ! $inGeneratedCode) {
                $newLines[] = $fileLines[$i];
            }
        }

        file_put_contents($phpFile, implode("", $newLines));
    }

    private function gatherAssertions()
    {
        $reflClass = new ReflectionClass('Assert\Assertion');

        return array_filter(
            $reflClass->getMethods(\ReflectionMethod::IS_STATIC),
            function ($reflMethod) {
                if ($reflMethod->isProtected()) {
                    return false;
                }

                if (in_array($reflMethod->getName(), array('__callStatic', 'createException'))) {
                    return false;
                }

                return true;
            }
        );
    }
}

require_once __DIR__ . "/../vendor/autoload.php";

$generator = new MethodDocGenerator();
$generator->generateChainDocs();
$generator->generateAssertionDocs();
