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

/**
 * Class MethodDocGenerator.
 */
class MethodDocGenerator
{
    public function generateChainDocs()
    {
        $phpFile = __DIR__.'/../lib/Assert/AssertionChain.php';
        $skipParameterTest = function (ReflectionParameter $parameter) {
            return 0 === $parameter->getPosition();
        };

        $docs = $this->generateMethodDocs($this->gatherAssertions(), ' * @method AssertionChain %s(%s) %s.', $skipParameterTest);
        $this->generateFile($phpFile, $docs, 'class');
    }

    /**
     * @param ReflectionMethod[] $methods
     * @param string             $format
     * @param callable|false     $skipParameterTest
     * @param string             $prefix
     *
     * @return array
     *
     * @throws \Assert\AssertionFailedException
     */
    private function generateMethodDocs($methods, $format, $skipParameterTest, $prefix = '')
    {
        $lines = [];
        \asort($methods);
        foreach ($methods as $method) {
            $doc = $method->getDocComment();
            list(, $descriptionLine) = \explode("\n", $doc);
            $shortDescription = \trim(\substr($descriptionLine, 7), '.');
            $methodName = $prefix.($prefix ? \ucfirst($method->getName()) : $method->getName());

            if (\preg_match('`\* This is an alias of {@see (?P<aliasOf>[^\s\}]++)`sim', $doc, $aliasMatch)) {
                $shortDescription .= \sprintf('. This is an alias of Assertion::%s()', \trim($aliasMatch['aliasOf'], '(){}'));
            }

            $parameters = [];

            foreach ($method->getParameters() as $parameterIndex => $methodParameter) {
                if (
                    (\is_bool($skipParameterTest) && $skipParameterTest) ||
                    (\is_callable($skipParameterTest) && $skipParameterTest($methodParameter))
                ) {
                    continue;
                }

                $parameter = '$'.$methodParameter->getName();

                $type = \version_compare(PHP_VERSION, '7.0.0') >= 0 ? $methodParameter->getType() : null;

                if (\is_null($type)) {
                    \preg_match(\sprintf('`\* @param (?P<type>[^ ]++) +\%s\b`sim', $parameter), $doc, $matches);
                    if (isset($matches['type'])) {
                        $type = (
                            $methodParameter->isOptional() &&
                            null == $methodParameter->getDefaultValue()
                        )
                            ? \str_replace(['|null', 'null|'], '', $matches['type'])
                            : $matches['type'];
                    }
                }

                if ($prefix === 'nullOr' && strpos($type, 'null') === false && $parameterIndex === 0) {
                    $type .= '|null';
                }

                \Assert\Assertion::notEmpty($type, \sprintf('No type defined for %s in %s', $parameter, $methodName));
                $parameter = \sprintf('%s %s', $type, $parameter);

                if ($methodParameter->isOptional()) {
                    if (null === $methodParameter->getDefaultValue()) {
                        $parameter .= ' = null';
                    } else {
                        $parameter .= \sprintf(' = \'%s\'', $methodParameter->getDefaultValue());
                    }
                }

                $parameters[] = $parameter;
            }

            $lines[] = \sprintf($format, $methodName, \implode(', ', $parameters), $shortDescription);
        }

        return $lines;
    }

    /**
     * @return ReflectionMethod[]
     */
    private function gatherAssertions()
    {
        $reflClass = new ReflectionClass('Assert\Assertion');

        return \array_filter(
            $reflClass->getMethods(ReflectionMethod::IS_STATIC),
            function (ReflectionMethod $reflMethod) {
                if ($reflMethod->isProtected()) {
                    return false;
                }

                if (\in_array($reflMethod->getName(), ['__callStatic', 'createException', 'stringify'])) {
                    return false;
                }

                return true;
            }
        );
    }

    /**
     * @param string   $phpFile
     * @param string[] $lines
     * @param string   $fileType
     */
    private function generateFile($phpFile, $lines, $fileType)
    {
        $phpFile = \realpath($phpFile);
        $fileContent = \file_get_contents($phpFile);

        switch ($fileType) {
            case 'class':
                $fileContent = \preg_replace(
                    '`\* @method.*? \*/\nclass `sim',
                    \sprintf("%s\n */\nclass ", \trim(\implode("\n", $lines))),
                    $fileContent
                );
                break;
            case 'readme':
                $fileContent = \preg_replace(
                    '/```php\n<\?php\nuse Assert\\\Assertion;\n\nAssertion::.*?```/sim',
                    \sprintf("```php\n<?php\nuse Assert\\Assertion;\n\n%s\n\n```", \implode("\n", $lines)),
                    $fileContent
                );
                break;
        }

        $writtenBytes = \file_put_contents($phpFile, $fileContent);

        if (false !== $writtenBytes) {
            echo 'Generated '.$phpFile.'.'.PHP_EOL;
        }
    }

    public function generateAssertionDocs()
    {
        $phpFile = __DIR__.'/../lib/Assert/Assertion.php';
        $skipParameterTest = function () {
            return false;
        };

        $docs = \array_merge(
            $this->generateMethodDocs($this->gatherAssertions(), ' * @method static bool %s(%s) %s for all values.', $skipParameterTest, 'all'),
            $this->generateMethodDocs($this->gatherAssertions(), ' * @method static bool %s(%s) %s or that the value is null.', $skipParameterTest, 'nullOr')
        );

        $this->generateFile($phpFile, $docs, 'class');
    }

    public function generateReadMe()
    {
        $mdFile = __DIR__.'/../README.md';
        $skipParameterTest = function (ReflectionParameter $parameter) {
            return \in_array($parameter->getName(), ['message', 'propertyPath', 'encoding']);
        };

        $docs = $this->generateMethodDocs($this->gatherAssertions(), 'Assertion::%s(%s);', $skipParameterTest);

        $this->generateFile($mdFile, $docs, 'readme');
    }

    public function generateLazyAssertionDocs()
    {
        $phpFile = __DIR__.'/../lib/Assert/LazyAssertion.php';
        $skipParameterTest = function (ReflectionParameter $parameter) {
            return 0 === $parameter->getPosition();
        };

        $docs = \array_merge(
            $this->generateMethodDocs($this->gatherAssertions(), ' * @method $this %s(%s) %s.', $skipParameterTest),
            $this->generateMethodDocs($this->gatherAssertionChainSwitches(), ' * @method $this %s(%s) %s.', false)
        );

        $this->generateFile($phpFile, $docs, 'class');
    }

    /**
     * @return ReflectionMethod[]
     */
    private function gatherAssertionChainSwitches()
    {
        $reflClass = new ReflectionClass('Assert\AssertionChain');

        return \array_filter(
            $reflClass->getMethods(ReflectionMethod::IS_PUBLIC),
            function (ReflectionMethod $reflMethod) {
                if (!$reflMethod->isPublic()) {
                    return false;
                }

                if (\in_array($reflMethod->getName(), ['__construct', '__call', 'setAssertionClassName'])) {
                    return false;
                }

                return true;
            }
        );
    }
}
