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

namespace Assert;

use Assert\Assertion\ArrayTrait;
use Assert\Assertion\BoolTrait;
use Assert\Assertion\CallableTrait;
use Assert\Assertion\ClassTrait;
use Assert\Assertion\CompareTrait;
use Assert\Assertion\EnvironmentTrait;
use Assert\Assertion\FileSystemTrait;
use Assert\Assertion\NumberTrait;
use Assert\Assertion\ObjectTrait;
use Assert\Assertion\StringTrait;
use BadMethodCallException;

/**
 * Assert library.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 *
 * @method static bool allAlnum(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is alphanumeric for all values.
 * @method static bool allBetween(mixed $value, mixed $lowerLimit, mixed $upperLimit, string $message = null, string $propertyPath = null) Assert that a value is greater or equal than a lower limit, and less than or equal to an upper limit for all values.
 * @method static bool allBetweenExclusive(mixed $value, mixed $lowerLimit, mixed $upperLimit, string $message = null, string $propertyPath = null) Assert that a value is greater than a lower limit, and less than an upper limit for all values.
 * @method static bool allBetweenLength(mixed $value, int $minLength, int $maxLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string length is between min,max lengths for all values.
 * @method static bool allBoolean(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is php boolean for all values.
 * @method static bool allChoice(mixed $value, array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is in array of choices for all values.
 * @method static bool allChoicesNotEmpty(array $values, array $choices, string|callable $message = null, string $propertyPath = null) Determines if the values array has every choice as key and that this choice has content for all values.
 * @method static bool allClassExists(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the class exists for all values.
 * @method static bool allContains(mixed $string, string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string contains a sequence of chars for all values.
 * @method static bool allCount(array|\Countable $countable, array|\Countable $count, string $message = null, string $propertyPath = null) Assert that the count of countable is equal to count for all values.
 * @method static bool allDate(string $value, string $format, string|callable $message = null, string $propertyPath = null) Assert that date is valid and corresponds to the given format for all values.
 * @method static bool allDefined(mixed $constant, string|callable $message = null, string $propertyPath = null) Assert that a constant is defined for all values.
 * @method static bool allDigit(mixed $value, string|callable $message = null, string $propertyPath = null) Validates if an integer or integerish is a digit for all values.
 * @method static bool allDirectory(string $value, string|callable $message = null, string $propertyPath = null) Assert that a directory exists for all values.
 * @method static bool allE164(string $value, string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid E164 Phone Number for all values.
 * @method static bool allEmail(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is an email adress (using input_filter/FILTER_VALIDATE_EMAIL) for all values.
 * @method static bool allEndsWith(mixed $string, string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string ends with a sequence of chars for all values.
 * @method static bool allEq(mixed $value, mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are equal (using == ) for all values.
 * @method static bool allExtensionLoaded(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that extension is loaded for all values.
 * @method static bool allExtensionVersion(string $extension, string $operator, mixed $version, string|callable $message = null, string $propertyPath = null) Assert that extension is loaded and a specific version is installed for all values.
 * @method static bool allFalse(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the value is boolean False for all values.
 * @method static bool allFile(string $value, string|callable $message = null, string $propertyPath = null) Assert that a file exists for all values.
 * @method static bool allFloat(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is a php float for all values.
 * @method static bool allGreaterOrEqualThan(mixed $value, mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is greater or equal than given limit for all values.
 * @method static bool allGreaterThan(mixed $value, mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is greater than given limit for all values.
 * @method static bool allImplementsInterface(mixed $class, string $interfaceName, string|callable $message = null, string $propertyPath = null) Assert that the class implements the interface for all values.
 * @method static bool allInArray(mixed $value, array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is in array of choices. This is an alias of Assertion::choice() for all values.
 * @method static bool allInteger(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is a php integer for all values.
 * @method static bool allIntegerish(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is a php integer'ish for all values.
 * @method static bool allInterfaceExists(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the interface exists for all values.
 * @method static bool allIp(string $value, int $flag = null, string|callable $message = null, string $propertyPath = null) Assert that value is an IPv4 or IPv6 address for all values.
 * @method static bool allIpv4(string $value, int $flag = null, string|callable $message = null, string $propertyPath = null) Assert that value is an IPv4 address for all values.
 * @method static bool allIpv6(string $value, int $flag = null, string|callable $message = null, string $propertyPath = null) Assert that value is an IPv6 address for all values.
 * @method static bool allIsArray(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is an array for all values.
 * @method static bool allIsArrayAccessible(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is an array or an array-accessible object for all values.
 * @method static bool allIsCallable(mixed $value, string|callable $message = null, string $propertyPath = null) Determines that the provided value is callable for all values.
 * @method static bool allIsInstanceOf(mixed $value, string $className, string|callable $message = null, string $propertyPath = null) Assert that value is instance of given class-name for all values.
 * @method static bool allIsJsonString(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid json string for all values.
 * @method static bool allIsObject(mixed $value, string|callable $message = null, string $propertyPath = null) Determines that the provided value is an object for all values.
 * @method static bool allIsResource(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is a resource for all values.
 * @method static bool allIsTraversable(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is an array or a traversable object for all values.
 * @method static bool allKeyExists(mixed $value, string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key exists in an array for all values.
 * @method static bool allKeyIsset(mixed $value, string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key exists in an array/array-accessible object using isset() for all values.
 * @method static bool allKeyNotExists(mixed $value, string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key does not exist in an array for all values.
 * @method static bool allLength(mixed $value, int $length, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string has a given length for all values.
 * @method static bool allLessOrEqualThan(mixed $value, mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is less or than given limit for all values.
 * @method static bool allLessThan(mixed $value, mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is less than given limit for all values.
 * @method static bool allMax(mixed $value, mixed $maxValue, string|callable $message = null, string $propertyPath = null) Assert that a number is smaller as a given limit for all values.
 * @method static bool allMaxLength(mixed $value, int $maxLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string value is not longer than $maxLength chars for all values.
 * @method static bool allMethodExists(string $value, mixed $object, string|callable $message = null, string $propertyPath = null) Determines that the named method is defined in the provided object for all values.
 * @method static bool allMin(mixed $value, mixed $minValue, string|callable $message = null, string $propertyPath = null) Assert that a value is at least as big as a given limit for all values.
 * @method static bool allMinLength(mixed $value, int $minLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that a string is at least $minLength chars long for all values.
 * @method static bool allNoContent(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is empty for all values.
 * @method static bool allNotBlank(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is not blank for all values.
 * @method static bool allNotEmpty(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is not empty for all values.
 * @method static bool allNotEmptyKey(mixed $value, string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key exists in an array/array-accessible object and its value is not empty for all values.
 * @method static bool allNotEq(mixed $value1, mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are not equal (using == ) for all values.
 * @method static bool allNotInArray(mixed $value, array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is not in array of choices for all values.
 * @method static bool allNotIsInstanceOf(mixed $value, string $className, string|callable $message = null, string $propertyPath = null) Assert that value is not instance of given class-name for all values.
 * @method static bool allNotNull(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is not null for all values.
 * @method static bool allNotSame(mixed $value1, mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are not the same (using === ) for all values.
 * @method static bool allNull(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is null for all values.
 * @method static bool allNumeric(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is numeric for all values.
 * @method static bool allObjectOrClass(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the value is an object, or a class that exists for all values.
 * @method static bool allPhpVersion(string $operator, mixed $version, string|callable $message = null, string $propertyPath = null) Assert on PHP version for all values.
 * @method static bool allPropertiesExist(mixed $value, array $properties, string|callable $message = null, string $propertyPath = null) Assert that the value is an object or class, and that the properties all exist for all values.
 * @method static bool allPropertyExists(mixed $value, string $property, string|callable $message = null, string $propertyPath = null) Assert that the value is an object or class, and that the property exists for all values.
 * @method static bool allRange(mixed $value, mixed $minValue, mixed $maxValue, string|callable $message = null, string $propertyPath = null) Assert that value is in range of numbers for all values.
 * @method static bool allReadable(string $value, string|callable $message = null, string $propertyPath = null) Assert that the value is something readable for all values.
 * @method static bool allRegex(mixed $value, string $pattern, string|callable $message = null, string $propertyPath = null) Assert that value matches a regex for all values.
 * @method static bool allSame(mixed $value, mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are the same (using ===) for all values.
 * @method static bool allSatisfy(mixed $value, callable $callback, string|callable $message = null, string $propertyPath = null) Assert that the provided value is valid according to a callback for all values.
 * @method static bool allScalar(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is a PHP scalar for all values.
 * @method static bool allStartsWith(mixed $string, string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string starts with a sequence of chars for all values.
 * @method static bool allString(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is a string for all values.
 * @method static bool allSubclassOf(mixed $value, string $className, string|callable $message = null, string $propertyPath = null) Assert that value is subclass of given class-name for all values.
 * @method static bool allTrue(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the value is boolean True for all values.
 * @method static bool allUrl(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is an URL for all values.
 * @method static bool allUuid(string $value, string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid UUID for all values.
 * @method static bool allVersion(string $version1, string $operator, string $version2, string|callable $message = null, string $propertyPath = null) Assert comparison of two versions for all values.
 * @method static bool allWriteable(string $value, string|callable $message = null, string $propertyPath = null) Assert that the value is something writeable for all values.
 * @method static bool nullOrAlnum(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is alphanumeric or that the value is null.
 * @method static bool nullOrBetween(mixed $value, mixed $lowerLimit, mixed $upperLimit, string $message = null, string $propertyPath = null) Assert that a value is greater or equal than a lower limit, and less than or equal to an upper limit or that the value is null.
 * @method static bool nullOrBetweenExclusive(mixed $value, mixed $lowerLimit, mixed $upperLimit, string $message = null, string $propertyPath = null) Assert that a value is greater than a lower limit, and less than an upper limit or that the value is null.
 * @method static bool nullOrBetweenLength(mixed $value, int $minLength, int $maxLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string length is between min,max lengths or that the value is null.
 * @method static bool nullOrBoolean(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is php boolean or that the value is null.
 * @method static bool nullOrChoice(mixed $value, array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is in array of choices or that the value is null.
 * @method static bool nullOrChoicesNotEmpty(array $values, array $choices, string|callable $message = null, string $propertyPath = null) Determines if the values array has every choice as key and that this choice has content or that the value is null.
 * @method static bool nullOrClassExists(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the class exists or that the value is null.
 * @method static bool nullOrContains(mixed $string, string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string contains a sequence of chars or that the value is null.
 * @method static bool nullOrCount(array|\Countable $countable, array|\Countable $count, string $message = null, string $propertyPath = null) Assert that the count of countable is equal to count or that the value is null.
 * @method static bool nullOrDate(string $value, string $format, string|callable $message = null, string $propertyPath = null) Assert that date is valid and corresponds to the given format or that the value is null.
 * @method static bool nullOrDefined(mixed $constant, string|callable $message = null, string $propertyPath = null) Assert that a constant is defined or that the value is null.
 * @method static bool nullOrDigit(mixed $value, string|callable $message = null, string $propertyPath = null) Validates if an integer or integerish is a digit or that the value is null.
 * @method static bool nullOrDirectory(string $value, string|callable $message = null, string $propertyPath = null) Assert that a directory exists or that the value is null.
 * @method static bool nullOrE164(string $value, string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid E164 Phone Number or that the value is null.
 * @method static bool nullOrEmail(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is an email adress (using input_filter/FILTER_VALIDATE_EMAIL) or that the value is null.
 * @method static bool nullOrEndsWith(mixed $string, string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string ends with a sequence of chars or that the value is null.
 * @method static bool nullOrEq(mixed $value, mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are equal (using == ) or that the value is null.
 * @method static bool nullOrExtensionLoaded(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that extension is loaded or that the value is null.
 * @method static bool nullOrExtensionVersion(string $extension, string $operator, mixed $version, string|callable $message = null, string $propertyPath = null) Assert that extension is loaded and a specific version is installed or that the value is null.
 * @method static bool nullOrFalse(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the value is boolean False or that the value is null.
 * @method static bool nullOrFile(string $value, string|callable $message = null, string $propertyPath = null) Assert that a file exists or that the value is null.
 * @method static bool nullOrFloat(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is a php float or that the value is null.
 * @method static bool nullOrGreaterOrEqualThan(mixed $value, mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is greater or equal than given limit or that the value is null.
 * @method static bool nullOrGreaterThan(mixed $value, mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is greater than given limit or that the value is null.
 * @method static bool nullOrImplementsInterface(mixed $class, string $interfaceName, string|callable $message = null, string $propertyPath = null) Assert that the class implements the interface or that the value is null.
 * @method static bool nullOrInArray(mixed $value, array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is in array of choices. This is an alias of Assertion::choice() or that the value is null.
 * @method static bool nullOrInteger(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is a php integer or that the value is null.
 * @method static bool nullOrIntegerish(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is a php integer'ish or that the value is null.
 * @method static bool nullOrInterfaceExists(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the interface exists or that the value is null.
 * @method static bool nullOrIp(string $value, int $flag = null, string|callable $message = null, string $propertyPath = null) Assert that value is an IPv4 or IPv6 address or that the value is null.
 * @method static bool nullOrIpv4(string $value, int $flag = null, string|callable $message = null, string $propertyPath = null) Assert that value is an IPv4 address or that the value is null.
 * @method static bool nullOrIpv6(string $value, int $flag = null, string|callable $message = null, string $propertyPath = null) Assert that value is an IPv6 address or that the value is null.
 * @method static bool nullOrIsArray(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is an array or that the value is null.
 * @method static bool nullOrIsArrayAccessible(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is an array or an array-accessible object or that the value is null.
 * @method static bool nullOrIsCallable(mixed $value, string|callable $message = null, string $propertyPath = null) Determines that the provided value is callable or that the value is null.
 * @method static bool nullOrIsInstanceOf(mixed $value, string $className, string|callable $message = null, string $propertyPath = null) Assert that value is instance of given class-name or that the value is null.
 * @method static bool nullOrIsJsonString(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid json string or that the value is null.
 * @method static bool nullOrIsObject(mixed $value, string|callable $message = null, string $propertyPath = null) Determines that the provided value is an object or that the value is null.
 * @method static bool nullOrIsResource(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is a resource or that the value is null.
 * @method static bool nullOrIsTraversable(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is an array or a traversable object or that the value is null.
 * @method static bool nullOrKeyExists(mixed $value, string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key exists in an array or that the value is null.
 * @method static bool nullOrKeyIsset(mixed $value, string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key exists in an array/array-accessible object using isset() or that the value is null.
 * @method static bool nullOrKeyNotExists(mixed $value, string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key does not exist in an array or that the value is null.
 * @method static bool nullOrLength(mixed $value, int $length, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string has a given length or that the value is null.
 * @method static bool nullOrLessOrEqualThan(mixed $value, mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is less or than given limit or that the value is null.
 * @method static bool nullOrLessThan(mixed $value, mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is less than given limit or that the value is null.
 * @method static bool nullOrMax(mixed $value, mixed $maxValue, string|callable $message = null, string $propertyPath = null) Assert that a number is smaller as a given limit or that the value is null.
 * @method static bool nullOrMaxLength(mixed $value, int $maxLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string value is not longer than $maxLength chars or that the value is null.
 * @method static bool nullOrMethodExists(string $value, mixed $object, string|callable $message = null, string $propertyPath = null) Determines that the named method is defined in the provided object or that the value is null.
 * @method static bool nullOrMin(mixed $value, mixed $minValue, string|callable $message = null, string $propertyPath = null) Assert that a value is at least as big as a given limit or that the value is null.
 * @method static bool nullOrMinLength(mixed $value, int $minLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that a string is at least $minLength chars long or that the value is null.
 * @method static bool nullOrNoContent(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is empty or that the value is null.
 * @method static bool nullOrNotBlank(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is not blank or that the value is null.
 * @method static bool nullOrNotEmpty(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is not empty or that the value is null.
 * @method static bool nullOrNotEmptyKey(mixed $value, string|int $key, string|callable $message = null, string $propertyPath = null) Assert that key exists in an array/array-accessible object and its value is not empty or that the value is null.
 * @method static bool nullOrNotEq(mixed $value1, mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are not equal (using == ) or that the value is null.
 * @method static bool nullOrNotInArray(mixed $value, array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is not in array of choices or that the value is null.
 * @method static bool nullOrNotIsInstanceOf(mixed $value, string $className, string|callable $message = null, string $propertyPath = null) Assert that value is not instance of given class-name or that the value is null.
 * @method static bool nullOrNotNull(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is not null or that the value is null.
 * @method static bool nullOrNotSame(mixed $value1, mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are not the same (using === ) or that the value is null.
 * @method static bool nullOrNull(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is null or that the value is null.
 * @method static bool nullOrNumeric(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is numeric or that the value is null.
 * @method static bool nullOrObjectOrClass(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the value is an object, or a class that exists or that the value is null.
 * @method static bool nullOrPhpVersion(string $operator, mixed $version, string|callable $message = null, string $propertyPath = null) Assert on PHP version or that the value is null.
 * @method static bool nullOrPropertiesExist(mixed $value, array $properties, string|callable $message = null, string $propertyPath = null) Assert that the value is an object or class, and that the properties all exist or that the value is null.
 * @method static bool nullOrPropertyExists(mixed $value, string $property, string|callable $message = null, string $propertyPath = null) Assert that the value is an object or class, and that the property exists or that the value is null.
 * @method static bool nullOrRange(mixed $value, mixed $minValue, mixed $maxValue, string|callable $message = null, string $propertyPath = null) Assert that value is in range of numbers or that the value is null.
 * @method static bool nullOrReadable(string $value, string|callable $message = null, string $propertyPath = null) Assert that the value is something readable or that the value is null.
 * @method static bool nullOrRegex(mixed $value, string $pattern, string|callable $message = null, string $propertyPath = null) Assert that value matches a regex or that the value is null.
 * @method static bool nullOrSame(mixed $value, mixed $value2, string|callable $message = null, string $propertyPath = null) Assert that two values are the same (using ===) or that the value is null.
 * @method static bool nullOrSatisfy(mixed $value, callable $callback, string|callable $message = null, string $propertyPath = null) Assert that the provided value is valid according to a callback or that the value is null.
 * @method static bool nullOrScalar(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is a PHP scalar or that the value is null.
 * @method static bool nullOrStartsWith(mixed $string, string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string starts with a sequence of chars or that the value is null.
 * @method static bool nullOrString(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is a string or that the value is null.
 * @method static bool nullOrSubclassOf(mixed $value, string $className, string|callable $message = null, string $propertyPath = null) Assert that value is subclass of given class-name or that the value is null.
 * @method static bool nullOrTrue(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the value is boolean True or that the value is null.
 * @method static bool nullOrUrl(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is an URL or that the value is null.
 * @method static bool nullOrUuid(string $value, string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid UUID or that the value is null.
 * @method static bool nullOrVersion(string $version1, string $operator, string $version2, string|callable $message = null, string $propertyPath = null) Assert comparison of two versions or that the value is null.
 * @method static bool nullOrWriteable(string $value, string|callable $message = null, string $propertyPath = null) Assert that the value is something writeable or that the value is null.
 */
class Assertion
{
    use ArrayTrait;
    use BoolTrait;
    use CallableTrait;
    use ClassTrait;
    use CompareTrait;
    use EnvironmentTrait;
    use FileSystemTrait;
    use NumberTrait;
    use ObjectTrait;
    use StringTrait;

    const INVALID_SCALAR = 209;

    // constants linked for BC
    const INVALID_TRAVERSABLE = Assertion\INVALID_TRAVERSABLE;
    const INVALID_ARRAY_ACCESSIBLE = Assertion\INVALID_ARRAY_ACCESSIBLE;
    const INVALID_KEY_ISSET = Assertion\INVALID_KEY_ISSET;
    const INVALID_VALUE_IN_ARRAY = Assertion\INVALID_VALUE_IN_ARRAY;
    const INVALID_CHOICE = Assertion\INVALID_CHOICE;
    const INVALID_ARRAY = Assertion\INVALID_ARRAY;
    const INVALID_KEY_EXISTS = Assertion\INVALID_KEY_EXISTS;
    const INVALID_KEY_NOT_EXISTS = Assertion\INVALID_KEY_NOT_EXISTS;
    const INVALID_COUNT = Assertion\INVALID_COUNT;
    const INVALID_BOOLEAN = Assertion\INVALID_BOOLEAN;
    const INVALID_TRUE = Assertion\INVALID_TRUE;
    const INVALID_FALSE = Assertion\INVALID_FALSE;
    const INVALID_SATISFY = Assertion\INVALID_SATISFY;
    const INVALID_CALLABLE = Assertion\INVALID_CALLABLE;
    const INVALID_INSTANCE_OF = Assertion\INVALID_INSTANCE_OF;
    const INVALID_SUBCLASS_OF = Assertion\INVALID_SUBCLASS_OF;
    const INVALID_CLASS = Assertion\INVALID_CLASS;
    const INVALID_INTERFACE = Assertion\INVALID_INTERFACE;
    const INTERFACE_NOT_IMPLEMENTED = Assertion\INTERFACE_NOT_IMPLEMENTED;
    const INVALID_NOT_INSTANCE_OF = Assertion\INVALID_NOT_INSTANCE_OF;
    const INVALID_EQ = Assertion\INVALID_EQ;
    const INVALID_SAME = Assertion\INVALID_SAME;
    const INVALID_NOT_EQ = Assertion\INVALID_NOT_EQ;
    const INVALID_NOT_SAME = Assertion\INVALID_NOT_SAME;
    const VALUE_EMPTY = Assertion\VALUE_EMPTY;
    const VALUE_NULL = Assertion\VALUE_NULL;
    const VALUE_NOT_NULL = Assertion\VALUE_NOT_NULL;
    const VALUE_NOT_EMPTY = Assertion\VALUE_NOT_EMPTY;
    const INVALID_NOT_BLANK = Assertion\INVALID_NOT_BLANK;
    const INVALID_EXTENSION = Assertion\INVALID_EXTENSION;
    const INVALID_CONSTANT = Assertion\INVALID_CONSTANT;
    const INVALID_VERSION = Assertion\INVALID_VERSION;
    const INVALID_DIRECTORY = Assertion\INVALID_DIRECTORY;
    const INVALID_FILE = Assertion\INVALID_FILE;
    const INVALID_READABLE = Assertion\INVALID_READABLE;
    const INVALID_WRITEABLE = Assertion\INVALID_WRITEABLE;
    const INVALID_RESOURCE = Assertion\INVALID_RESOURCE;
    const INVALID_FLOAT = Assertion\INVALID_FLOAT;
    const INVALID_INTEGER = Assertion\INVALID_INTEGER;
    const INVALID_DIGIT = Assertion\INVALID_DIGIT;
    const INVALID_INTEGERISH = Assertion\INVALID_INTEGERISH;
    const INVALID_RANGE = Assertion\INVALID_RANGE;
    const INVALID_NUMERIC = Assertion\INVALID_NUMERIC;
    const INVALID_MIN = Assertion\INVALID_MIN;
    const INVALID_MAX = Assertion\INVALID_MAX;
    const INVALID_LESS = Assertion\INVALID_LESS;
    const INVALID_LESS_OR_EQUAL = Assertion\INVALID_LESS_OR_EQUAL;
    const INVALID_GREATER = Assertion\INVALID_GREATER;
    const INVALID_GREATER_OR_EQUAL = Assertion\INVALID_GREATER_OR_EQUAL;
    const INVALID_BETWEEN = Assertion\INVALID_BETWEEN;
    const INVALID_BETWEEN_EXCLUSIVE = Assertion\INVALID_BETWEEN_EXCLUSIVE;
    const INVALID_OBJECT = Assertion\INVALID_OBJECT;
    const INVALID_METHOD = Assertion\INVALID_METHOD;
    const INVALID_PROPERTY = Assertion\INVALID_PROPERTY;
    const INVALID_LENGTH = Assertion\INVALID_LENGTH;
    const INVALID_STRING = Assertion\INVALID_STRING;
    const INVALID_MIN_LENGTH = Assertion\INVALID_MIN_LENGTH;
    const INVALID_MAX_LENGTH = Assertion\INVALID_MAX_LENGTH;
    const INVALID_STRING_START = Assertion\INVALID_STRING_START;
    const INVALID_STRING_CONTAINS = Assertion\INVALID_STRING_CONTAINS;
    const INVALID_STRING_END = Assertion\INVALID_STRING_END;
    const INVALID_UUID = Assertion\INVALID_UUID;
    const INVALID_EMAIL = Assertion\INVALID_EMAIL;
    const INVALID_URL = Assertion\INVALID_URL;
    const INVALID_ALNUM = Assertion\INVALID_ALNUM;
    const INVALID_REGEX = Assertion\INVALID_REGEX;
    const INVALID_JSON_STRING = Assertion\INVALID_JSON_STRING;
    const INVALID_E164 = Assertion\INVALID_E164;
    const INVALID_IP = Assertion\INVALID_IP;
    const INVALID_DATE = Assertion\INVALID_DATE;

    /**
     * Exception to throw when an assertion failed.
     *
     * @var string
     */
    protected static $exceptionClass = 'Assert\InvalidArgumentException';

    /**
     * Helper method that handles building the assertion failure exceptions.
     * They are returned from this method so that the stack trace still shows
     * the assertions method.
     *
     * @param mixed           $value
     * @param string|callable $message
     * @param int             $code
     * @param string|null     $propertyPath
     * @param array           $constraints
     *
     * @return mixed
     */
    protected static function createException($value, $message, $code, $propertyPath = null, array $constraints = array())
    {
        $exceptionClass = static::$exceptionClass;

        return new $exceptionClass($message, $code, $propertyPath, $value, $constraints);
    }

    /**
     * Assert that value is a PHP scalar.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function scalar($value, $message = null, $propertyPath = null)
    {
        if (!\is_scalar($value)) {
            $message = \sprintf(
                static::generateMessage($message) ?: 'Value "%s" is not a scalar.',
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_SCALAR, $propertyPath);
        }

        return true;
    }

    /**
     * static call handler to implement:
     *  - "null or assertion" delegation
     *  - "all" delegation.
     *
     * @param string $method
     * @param array  $args
     *
     * @return bool|mixed
     */
    public static function __callStatic($method, $args)
    {
        if (\strpos($method, 'nullOr') === 0) {
            if (!\array_key_exists(0, $args)) {
                throw new BadMethodCallException('Missing the first argument.');
            }

            if ($args[0] === null) {
                return true;
            }

            $method = \substr($method, 6);

            return \call_user_func_array(array(\get_called_class(), $method), $args);
        }

        if (\strpos($method, 'all') === 0) {
            if (!\array_key_exists(0, $args)) {
                throw new BadMethodCallException('Missing the first argument.');
            }

            static::isTraversable($args[0]);

            $method = \substr($method, 3);
            $values = \array_shift($args);
            $calledClass = \get_called_class();

            foreach ($values as $value) {
                \call_user_func_array(array($calledClass, $method), \array_merge(array($value), $args));
            }

            return true;
        }

        throw new BadMethodCallException('No assertion Assertion#' . $method . ' exists.');
    }

    /**
     * Make a string version of a value.
     *
     * @param mixed $value
     *
     * @return string
     */
    protected static function stringify($value)
    {
        $result = \gettype($value);

        if (\is_bool($value)) {
            $result = $value ? '<TRUE>' : '<FALSE>';
        }

        if (\is_scalar($value)) {
            $val = (string) $value;

            if (\strlen($val) > 100) {
                $val = \substr($val, 0, 97) . '...';
            }

            $result = $val;
        }

        if (\is_array($value)) {
            $result = '<ARRAY>';
        }

        if (\is_object($value)) {
            $result = \get_class($value);
        }

        if (\is_resource($value)) {
            $result = \get_resource_type($value);
        }

        if ($value === null) {
            $result = '<NULL>';
        }

        return $result;
    }

    /**
     * Generate the message.
     *
     * @param string|callable|null $message
     *
     * @return string|null
     */
    protected static function generateMessage($message = null)
    {
        if (\is_callable($message)) {
            $traces = \debug_backtrace(0);

            $parameters = array();

            $reflection = new \ReflectionClass($traces[1]['class']);
            $method = $reflection->getMethod($traces[1]['function']);
            foreach ($method->getParameters() as $index => $parameter) {
                if ($parameter->getName() !== 'message') {
                    $parameters[$parameter->getName()] = \array_key_exists($index, $traces[1]['args'])
                        ? $traces[1]['args'][$index]
                        : $parameter->getDefaultValue();
                }
            }

            $parameters['::assertion'] = \sprintf('%s%s%s', $traces[1]['class'], $traces[1]['type'], $traces[1]['function']);

            $message = \call_user_func_array($message, array($parameters));
        }

        return \is_null($message) ? null : (string) $message;
    }
}
