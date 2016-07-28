<?php

namespace Assert;

use ReflectionClass;

class MethodDocGenerator
{
    public function generateChainDocs()
    {
        $phpFile           = __DIR__ . '/../lib/Assert/AssertionChain.php';
        $skipParameterTest = function (\ReflectionParameter $parameter) {
            return $parameter->getPosition() === 0;
        };

        $docs = $this->generateMethodDocs($this->gatherAssertions(), ' * @method AssertionChain %s(%s) %s.', $skipParameterTest);
        $this->generateFile($phpFile, $docs, 'class');
    }

    private function generateMethodDocs($methods, $format, $skipParameterTest, $prefix = '')
    {
        $lines = [];
        asort($methods);
        foreach ($methods as $method) {
            $doc              = $method->getDocComment();
            $shortDescription = trim(substr(explode("\n", $doc)[1], 7), '.');
            $methodName       = $prefix . ($prefix ? ucfirst($method->getName()) : $method->getName());

            $parameters = [];

            foreach ($method->getParameters() as $methodParameter) {
                if ($skipParameterTest($methodParameter)) {
                    continue;
                }

                $parameter = '$' . $methodParameter->getName();

                if ($methodParameter->isOptional()) {
                    if (null === $methodParameter->getDefaultValue()) {
                        $parameter .= ' = null';
                    } else {
                        $parameter .= sprintf(' = "%s"', $methodParameter->getDefaultValue());
                    }
                }

                $parameters[] = $parameter;
            }

            $lines[] = sprintf($format, $methodName, implode(', ', $parameters), $shortDescription);
        }

        return $lines;
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

                if (in_array($reflMethod->getName(), ['__callStatic', 'createException', 'stringify'])) {
                    return false;
                }

                return true;
            }
        );
    }

    private function generateFile($phpFile, $lines, $fileType)
    {
        $phpFile = realpath($phpFile);
        $fileContent = file_get_contents($phpFile);

        switch ($fileType) {
            case 'class':
                $fileContent = preg_replace(
                    '`\* @method.*? \*/\nclass `sim',
                    sprintf("%s\n */\nclass ", trim(implode("\n", $lines))),
                    $fileContent
                );
                break;
            case 'readme':
                $fileContent = preg_replace(
                    '/```php\n<\?php\nuse Assert\\\Assertion;\n\nAssertion::.*?```/sim',
                    sprintf("```php\n<?php\nuse Assert\\Assertion;\n\n%s\n\n```", implode("\n", $lines)),
                    $fileContent
                );
                break;
        }

        $writtenBytes = file_put_contents($phpFile, $fileContent);

        if ($writtenBytes !== false) {
            echo 'Generated ' . $phpFile . '.' . PHP_EOL;
        }
    }

    public function generateAssertionDocs()
    {
        $phpFile           = __DIR__ . '/../lib/Assert/Assertion.php';
        $skipParameterTest = function (\ReflectionParameter $parameter) {
            return false;
        };

        $docs = array_merge(
            $this->generateMethodDocs($this->gatherAssertions(), ' * @method static void %s(%s) %s for all values.', $skipParameterTest, 'all'),
            $this->generateMethodDocs($this->gatherAssertions(), ' * @method static void %s(%s) %s or that the value is null.', $skipParameterTest, 'nullOr')
        );

        $this->generateFile($phpFile, $docs, 'class');
    }

    public function generateReadMe()
    {
        $mdFile            = __DIR__ . '/../README.md';
        $skipParameterTest = function (\ReflectionParameter $parameter) {
            return in_array($parameter->getName(), ['message', 'propertyPath', 'encoding']);
        };

        $docs = $this->generateMethodDocs($this->gatherAssertions(), 'Assertion::%s(%s);', $skipParameterTest);

        $this->generateFile($mdFile, $docs, 'readme');
    }

    public function generateLazyAssertionDocs()
    {
        $phpFile           = __DIR__ . '/../lib/Assert/LazyAssertion.php';
        $flags             = '\\Assert\\LazyAssertion';
        $skipParameterTest = function ($parameter) {
            return $parameter->getPosition() === 0;
        };

        $docs = array_merge(
            $this->generateMethodDocs($this->gatherAssertions(), ' * @method LazyAssertion %s(%s) %s.', $skipParameterTest),
            $this->generateMethodDocs($this->gatherAssertionChainSwitches(), ' * @method LazyAssertion %s(%s) %s.', false)
        );

        $this->generateFile($phpFile, $docs, 'class');
    }

    private function gatherAssertionChainSwitches()
    {
        $reflClass = new ReflectionClass('Assert\AssertionChain');

        return array_filter(
            $reflClass->getMethods(\ReflectionMethod::IS_PUBLIC),
            function ($reflMethod) {
                if (!$reflMethod->isPublic()) {
                    return false;
                }

                if (in_array($reflMethod->getName(), ['__construct', '__call'])) {
                    return false;
                }

                return true;
            }
        );
    }
}

require_once __DIR__ . "/../vendor/autoload.php";

$generator = new MethodDocGenerator();
$generator->generateAssertionDocs();
$generator->generateChainDocs();
$generator->generateLazyAssertionDocs();
$generator->generateReadMe();
