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

        $docs = $this->generateMethodDocs($this->gatherAssertions(), $flags, $skipParameterTest);
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
            $this->generateMethodDocs($this->gatherAssertions(), $flags, $skipParameterTest, 'nullOr'),
            $this->generateMethodDocs($this->gatherAssertions(), $flags, $skipParameterTest, 'all')
        );

        $this->generateFile($phpFile, $docs);
    }

    public function generateLazyAssertionDocs()
    {
        $phpFile = __DIR__ . '/../lib/Assert/LazyAssertion.php';
        $flags = '\\Assert\\LazyAssertion';
        $skipParameterTest = function ($parameter) {
            return $parameter->getPosition() === 0;
        };

        $docs = array_merge(
            $this->generateMethodDocs($this->gatherAssertions(), $flags, $skipParameterTest),
            $this->generateMethodDocs($this->gatherAssertionChainSwitches(), $flags, false)
        );

        $this->generateFile($phpFile, $docs);
    }

    private function generateMethodDocs($methods, $flags, $skipParameterTest, $prefix = '')
    {
        $lines = array();
        foreach ($methods as $method) {
            $doc = $method->getDocComment();
            $shortDescription = substr(explode("\n", $doc)[1], 7);
            $methodName = $prefix . ($prefix ? ucfirst($method->getName()) : $method->getName());

            $line = ' * @method ' . $flags . ' ' . $methodName . '(';

            if (count($method->getParameters()) === 0) {
                $lines[] = $line . ")\n";
            } else {
                foreach ($method->getParameters() as $parameter) {
                    if ($skipParameterTest($parameter)) {
                        continue;
                    }

                    $line .= '$' . $parameter->getName();

                    if ($parameter->isOptional()) {
                        if (null === $parameter->getDefaultValue()) {
                            $line .= ' = null';
                        } else {
                            $line .= sprintf(' = "%s"', $parameter->getDefaultValue());
                        }
                    }

                    $line .= ', ';
                }
                $lines[] = substr($line, 0, -2) . ")\n";
            }
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

    private function gatherAssertionChainSwitches()
    {
        $reflClass = new ReflectionClass('Assert\AssertionChain');

        return array_filter(
            $reflClass->getMethods(\ReflectionMethod::IS_PUBLIC),
            function ($reflMethod) {
                if ( ! $reflMethod->isPublic()) {
                    return false;
                }

                if (in_array($reflMethod->getName(), array('__construct', '__call'))) {
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
$generator->generateLazyAssertionDocs();
