# Assert

Travis Status: [![Build Status](https://secure.travis-ci.org/beberlei/assert.png?branch=master)](http://travis-ci.org/beberlei/assert)

A simple php library which contains assertions and guard methods for input validation (not filtering!) in business-model, libraries, pre/post conditions and application low-level code.

Idea is to reduce the amount of code for implementing assertions in your model and also simplify the code paths to implement assertions. When assertions fail, an exception is thrown, removing the necessity for if-clauses in your code.

The library is not using Symfony or Zend Validators for a reason: The checks have to be low-level, fast, non-object-oriented code to be used everywhere necessary. Using any of the two libraries requires instantiation of several objects, using a locale component, translations, you name it. Its too much bloat.

## Installation

Using Composer:

    {
        "require": {
            "beberlei/assert": "*"
        }
    }

## Example usages

    <?php
    use Assert\Assertion;

    Assertion::integer($value);
    Assertion::digit($value);
    Assertion::integerish($value);
    Assertion::range($value, $minValue, $maxValue);
    Assertion::boolean($value);
    Assertion::notEmpty($value);
    Assertion::notNull($value);
    Assertion::regex($value, $regex);
    Assertion::minLength($value, $length);
    Assertion::maxLength($value, $length);
    Assertion::betweenLength($value, $minLength, $maxLength);
    Assertion::startsWith($value, $needle);
    Assertion::isArray($value);
    Assertion::contains($value, $needle);
    Assertion::choice($value, $choices);
    Assertion::numeric($value);
    Assertion::keyExists($value, $key);
    Assertion::notBlank($value);
    Assertion::isInstanceOf($value, $className);
    Assertion::subclassOf($value, $className);
    Assertion::directory($value);
    Assertion::file($value);
    Assertion::readable($value);
    Assertion::writeable($value);
    Assertion::email($value);
    Assertion::alnum($value);

Remember: When a configuration parameter is necessary, it is always passed AFTER the value. The value is always the first parameter.

## Exception & Error Handling

If any of the assertions fails a subclass of `InvalidArgumentException` is thrown. You can pass a last argument to any assertion to control the message. Every exception contains a message code by default.

    <?php
    use Assert\Assertion;
    use Assert\InvalidArgumentException;

    try {
        Assertion::integer($value, "The pressure of gas is measured in integers.");
    } catch(InvalidArgumentException $e) {
        // error handling
    }

