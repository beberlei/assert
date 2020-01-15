# Assert

[![Build Status](https://img.shields.io/travis/beberlei/assert.svg?style=for-the-badge&logo=travis)](https://travis-ci.org/beberlei/assert)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/beberlei/assert.svg?style=for-the-badge&logo=scrutinizer)](https://scrutinizer-ci.com/g/beberlei/assert/)
[![GitHub issues](https://img.shields.io/github/issues/beberlei/assert.svg?style=for-the-badge&logo=github)](https://github.com/beberlei/assert/issues)

[![PHP Version](https://img.shields.io/packagist/php-v/beberlei/assert.svg?style=for-the-badge)](https://github.com/beberlei/assert)
[![Stable Version](https://img.shields.io/packagist/v/beberlei/assert.svg?style=for-the-badge&label=Latest)](https://packagist.org/packages/beberlei/assert)

[![Total Downloads](https://img.shields.io/packagist/dt/beberlei/assert.svg?style=for-the-badge&label=Total+downloads)](https://packagist.org/packages/beberlei/assert)
[![Monthly Downloads](https://img.shields.io/packagist/dm/beberlei/assert.svg?style=for-the-badge&label=Monthly+downloads)](https://packagist.org/packages/beberlei/assert)
[![Daily Downloads](https://img.shields.io/packagist/dd/beberlei/assert.svg?style=for-the-badge&label=Daily+downloads)](https://packagist.org/packages/beberlei/assert)

A simple php library which contains assertions and guard methods for input validation (not filtering!) in business-model, libraries and application low-level code.
The library can be used to implement pre-/post-conditions on input data.

Idea is to reduce the amount of code for implementing assertions in your model and also simplify the code paths to implement assertions. When assertions fail, an exception is thrown, removing the
necessity for if-clauses in your code.

The library is not using Symfony or Zend Validators for a reason: The checks have to be low-level, fast, non-object-oriented code to be used everywhere necessary. Using any of the two libraries
requires instantiation of several objects, using a locale component, translations, you name it. Its too much bloat.

## Installation

Using Composer:

```sh
composer require beberlei/assert
```

## Example usages

```php
<?php
use Assert\Assertion;

function duplicateFile($file, $times)
{
    Assertion::file($file);
    Assertion::digit($times);

    for ($i = 0; $i < $times; $i++) {
        copy($file, $file . $i);
    }
}
```

Real time usage with [Azure Blob Storage](https://github.com/beberlei/azure-blob-storage/blob/master/lib/Beberlei/AzureBlobStorage/BlobClient.php#L571):

```php
<?php
public function putBlob($containerName = '', $blobName = '', $localFileName = '', $metadata = array(), $leaseId = null, $additionalHeaders = array())
{
    Assertion::notEmpty($containerName, 'Container name is not specified');
    self::assertValidContainerName($containerName);
    Assertion::notEmpty($blobName, 'Blob name is not specified.');
    Assertion::notEmpty($localFileName, 'Local file name is not specified.');
    Assertion::file($localFileName, 'Local file name is not specified.');
    self::assertValidRootContainerBlobName($containerName, $blobName);

    // Check file size
    if (filesize($localFileName) >= self::MAX_BLOB_SIZE) {
        return $this->putLargeBlob($containerName, $blobName, $localFileName, $metadata, $leaseId, $additionalHeaders);
    }

    // Put the data to Windows Azure Storage
    return $this->putBlobData($containerName, $blobName, file_get_contents($localFileName), $metadata, $leaseId, $additionalHeaders);
}
```

### NullOr helper

A helper method (`Assertion::nullOr*`) is provided to check if a value is null OR holds for the assertion:

```php
<?php
Assertion::nullOrMax(null, 42); // success
Assertion::nullOrMax(1, 42);    // success
Assertion::nullOrMax(1337, 42); // exception
```

### All helper

The `Assertion::all*` method checks if all provided values hold for the
assertion. It will throw an exception of the assertion does not hold for one of
the values:

```php
<?php
Assertion::allIsInstanceOf(array(new \stdClass, new \stdClass), 'stdClass'); // success
Assertion::allIsInstanceOf(array(new \stdClass, new \stdClass), 'PDO');      // exception
```

### Assert::that() Chaining

Using the static API on values is very verbose when checking values against multiple assertions.
Starting with 2.6.7 of Assert the `Assert` class provides a much nicer fluent API for assertions, starting
with `Assert::that($value)` and then receiving the assertions you want to call
on the fluent interface. You only have to specify the `$value` once.

```php
<?php
Assert::that($value)->notEmpty()->integer();
Assert::that($value)->nullOr()->string()->startsWith("Foo");
Assert::that($values)->all()->float();
```

There are also two shortcut function `Assert::thatNullOr()` and `Assert::thatAll()` enabling
the "nullOr" or "all" helper respectively.

### Lazy Assertions

There are many cases in web development, especially when involving forms, you want to collect several errors
instead of aborting directly on the first error. This is what lazy assertions are for. Their API
works exactly like the fluent ``Assert::that()`` API, but instead of throwing an Exception directly,
they collect all errors and only trigger the exception when the method
``verifyNow()`` is called on the ``Assert\SoftAssertion`` object.

```php
<?php
Assert::lazy()
    ->that(10, 'foo')->string()
    ->that(null, 'bar')->notEmpty()
    ->that('string', 'baz')->isArray()
    ->verifyNow();
```

The method ``that($value, $propertyPath)`` requires a property path (name), so that you know how to differentiate
the errors afterwards.

On failure ``verifyNow()`` will throw an exception
``Assert\\LazyAssertionException`` with a combined message:

    The following 3 assertions failed:
    1) foo: Value "10" expected to be string, type integer given.
    2) bar: Value "<NULL>" is empty, but non empty value was expected.
    3) baz: Value "string" is not an array.

You can also retrieve all the ``AssertionFailedException``s by calling ``getErrorExceptions()``.
This can be useful for example to build a failure response for the user.

For those looking to capture multiple errors on a single value when using a lazy assertion chain,
you may follow your call to ``that`` with ``tryAll`` to run all assertions against the value, and
capture all of the resulting failed assertion error messages. Here's an example:

```php
Assert::lazy()
    ->that(10, 'foo')->tryAll()->integer()->between(5, 15)
    ->that(null, 'foo')->tryAll()->notEmpty()->string()
    ->verifyNow();
```

The above shows how to use this functionality to finely tune the behavior of reporting failures, but to make
catching all failures even easier, you may also call ``tryAll`` before making any assertions like below. This
helps to reduce method calls, and has the same behavior as above.

```php
Assert::lazy()->tryAll()
    ->that(10, 'foo')->integer()->between(5, 15)
    ->that(null, 'foo')->notEmpty()->string()
    ->verifyNow();
```

### Functional Constructors

The following functions exist as aliases to `Assert` static constructors:

- `Assert\that()`
- `Assert\thatAll()`
- `Assert\thatNullOr()`
- `Assert\lazy()`

Using the functional or static constructors is entirely personal preference.

**Note:** The functional constructors will not work with an [`Assertion` extension](#your-own-assertion-class).
However it is trivial to recreate these functions in a way that point to the extended class.

## List of assertions

```php
<?php
use Assert\Assertion;

Assertion::alnum(mixed $value);
Assertion::base64(string $value);
Assertion::between(mixed $value, mixed $lowerLimit, mixed $upperLimit);
Assertion::betweenExclusive(mixed $value, mixed $lowerLimit, mixed $upperLimit);
Assertion::betweenLength(mixed $value, int $minLength, int $maxLength);
Assertion::boolean(mixed $value);
Assertion::choice(mixed $value, array $choices);
Assertion::choicesNotEmpty(array $values, array $choices);
Assertion::classExists(mixed $value);
Assertion::contains(mixed $string, string $needle);
Assertion::count(array|Countable|ResourceBundle|SimpleXMLElement $countable, int $count);
Assertion::date(string $value, string $format);
Assertion::defined(mixed $constant);
Assertion::digit(mixed $value);
Assertion::directory(string $value);
Assertion::e164(string $value);
Assertion::email(mixed $value);
Assertion::endsWith(mixed $string, string $needle);
Assertion::eq(mixed $value, mixed $value2);
Assertion::eqArraySubset(mixed $value, mixed $value2);
Assertion::extensionLoaded(mixed $value);
Assertion::extensionVersion(string $extension, string $operator, mixed $version);
Assertion::false(mixed $value);
Assertion::file(string $value);
Assertion::float(mixed $value);
Assertion::greaterOrEqualThan(mixed $value, mixed $limit);
Assertion::greaterThan(mixed $value, mixed $limit);
Assertion::implementsInterface(mixed $class, string $interfaceName);
Assertion::inArray(mixed $value, array $choices);
Assertion::integer(mixed $value);
Assertion::integerish(mixed $value);
Assertion::interfaceExists(mixed $value);
Assertion::ip(string $value, int $flag = null);
Assertion::ipv4(string $value, int $flag = null);
Assertion::ipv6(string $value, int $flag = null);
Assertion::isArray(mixed $value);
Assertion::isArrayAccessible(mixed $value);
Assertion::isCallable(mixed $value);
Assertion::isCountable(array|Countable|ResourceBundle|SimpleXMLElement $value);
Assertion::isInstanceOf(mixed $value, string $className);
Assertion::isJsonString(mixed $value);
Assertion::isObject(mixed $value);
Assertion::isResource(mixed $value);
Assertion::isTraversable(mixed $value);
Assertion::keyExists(mixed $value, string|int $key);
Assertion::keyIsset(mixed $value, string|int $key);
Assertion::keyNotExists(mixed $value, string|int $key);
Assertion::length(mixed $value, int $length);
Assertion::lessOrEqualThan(mixed $value, mixed $limit);
Assertion::lessThan(mixed $value, mixed $limit);
Assertion::max(mixed $value, mixed $maxValue);
Assertion::maxCount(array|Countable|ResourceBundle|SimpleXMLElement $countable, int $count);
Assertion::maxLength(mixed $value, int $maxLength);
Assertion::methodExists(string $value, mixed $object);
Assertion::min(mixed $value, mixed $minValue);
Assertion::minCount(array|Countable|ResourceBundle|SimpleXMLElement $countable, int $count);
Assertion::minLength(mixed $value, int $minLength);
Assertion::noContent(mixed $value);
Assertion::notBlank(mixed $value);
Assertion::notContains(mixed $string, string $needle);
Assertion::notEmpty(mixed $value);
Assertion::notEmptyKey(mixed $value, string|int $key);
Assertion::notEq(mixed $value1, mixed $value2);
Assertion::notInArray(mixed $value, array $choices);
Assertion::notIsInstanceOf(mixed $value, string $className);
Assertion::notNull(mixed $value);
Assertion::notRegex(mixed $value, string $pattern);
Assertion::notSame(mixed $value1, mixed $value2);
Assertion::null(mixed $value);
Assertion::numeric(mixed $value);
Assertion::objectOrClass(mixed $value);
Assertion::phpVersion(string $operator, mixed $version);
Assertion::propertiesExist(mixed $value, array $properties);
Assertion::propertyExists(mixed $value, string $property);
Assertion::range(mixed $value, mixed $minValue, mixed $maxValue);
Assertion::readable(string $value);
Assertion::regex(mixed $value, string $pattern);
Assertion::same(mixed $value, mixed $value2);
Assertion::satisfy(mixed $value, callable $callback);
Assertion::scalar(mixed $value);
Assertion::startsWith(mixed $string, string $needle);
Assertion::string(mixed $value);
Assertion::subclassOf(mixed $value, string $className);
Assertion::true(mixed $value);
Assertion::uniqueValues(array $values);
Assertion::url(mixed $value);
Assertion::uuid(string $value);
Assertion::version(string $version1, string $operator, string $version2);
Assertion::writeable(string $value);

```

Remember: When a configuration parameter is necessary, it is always passed AFTER the value. The value is always the first parameter.

## Exception & Error Handling

If any of the assertions fails a `Assert\AssertionFailedException` is thrown.
You can pass an argument called ```$message``` to any assertion to control the
exception message. Every exception contains a default message and unique message code
by default.

```php
<?php
use Assert\Assertion;
use Assert\AssertionFailedException;

try {
    Assertion::integer($value, "The pressure of gas is measured in integers.");
} catch(AssertionFailedException $e) {
    // error handling
    $e->getValue(); // the value that caused the failure
    $e->getConstraints(); // the additional constraints of the assertion.
}
```

``Assert\AssertionFailedException`` is just an interface and the default
implementation is ``Assert\InvalidArgumentException`` which extends the SPL
``InvalidArgumentException``. You can change the exception being used on a
package based level.

### Customised exception messages

You can pass a callback as the message parameter, allowing you to construct your own
message only if an assertion fails, rather than every time you run the test.

The callback will be supplied with an array of parameters that are for the assertion.

As some assertions call other assertions, your callback will need to example the array
to determine what assertion failed.

The array will contain a key called `::assertion` that indicates which assertion
failed.

The callback should return the string that will be used as the exception
message.

## Your own Assertion class

To shield your library from possible bugs, misinterpretations or BC breaks
inside Assert you should introduce a library/project based assertion subclass,
where you can override the exception thrown as well.

In addition, you can override the ``Assert\Assertion::stringify()`` method to
provide your own interpretations of the types during error handling.

```php
<?php
namespace MyProject;

use Assert\Assertion as BaseAssertion;

class Assertion extends BaseAssertion
{
    protected static $exceptionClass = 'MyProject\AssertionFailedException';
}
```

As of V2.9.2, [Lazy Assertions](#lazy-assertions) now have access to any additional
assertions present in your own assertion classes.

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for more details.

