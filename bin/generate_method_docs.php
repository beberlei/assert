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

        $docs = $this->generateMethodDocs($flags, $skipParameterTest);
        $this->generateFile($phpFile, $docs);
    }

    public function generateAssertionDocs()
    {
        $phpFile = __DIR__ . '/../lib/Assert/Assertion.php';
        $flags = 'static void';
        $skipParameterTest = function ($parameter) {
            return false;
        };

        $docs = array_merge(
            $this->generateMethodDocs($flags, $skipParameterTest, 'nullOr'),
            $this->generateMethodDocs($flags, $skipParameterTest, 'all')
        );

        $this->generateFile($phpFile, $docs);
    }

    private function generateMethodDocs($flags, $skipParameterTest, $prefix = '')
    {
        $methods = $this->gatherAssertions();

        $lines = array();
        foreach ($methods as $method) {
            $doc = $method->getDocComment();
            $shortDescription = substr(explode("\n", $doc)[1], 7);
            $methodName = $prefix . ($prefix ? ucfirst($method->getName()) : $method->getName());

            $line = ' * @method ' . $flags . ' ' . $methodName . '(';

            foreach ($method->getParameters() as $parameter) {
                if ($skipParameterTest($parameter)) {
                    continue;
                }

                $line .= '$' . $parameter->getName() . ', ';
            }

            $lines[] = substr($line, 0, -2) . ') ' . $shortDescription . "\n";
        }

        return $lines;
    }

    private function generateFile($phpFile, $lines)
    {
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

                if (in_array($reflMethod->getName(), array('__callStatic', 'createException', 'stringify'))) {
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
