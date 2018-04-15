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

use BadMethodCallException;

/**
 * Assert library.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 *
 * @method static bool allAlnum(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is alphanumeric for all values.
 * @method static bool allBase64(string $value, string|callable $message = null, string $propertyPath = null) Assert that a constant is defined for all values.
 * @method static bool allBetween(mixed $value, mixed $lowerLimit, mixed $upperLimit, string $message = null, string $propertyPath = null) Assert that a value is greater or equal than a lower limit, and less than or equal to an upper limit for all values.
 * @method static bool allBetweenExclusive(mixed $value, mixed $lowerLimit, mixed $upperLimit, string $message = null, string $propertyPath = null) Assert that a value is greater than a lower limit, and less than an upper limit for all values.
 * @method static bool allBetweenLength(mixed $value, int $minLength, int $maxLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string length is between min,max lengths for all values.
 * @method static bool allBoolean(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is php boolean for all values.
 * @method static bool allChoice(mixed $value, array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is in array of choices for all values.
 * @method static bool allChoicesNotEmpty(array $values, array $choices, string|callable $message = null, string $propertyPath = null) Determines if the values array has every choice as key and that this choice has content for all values.
 * @method static bool allClassExists(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the class exists for all values.
 * @method static bool allContains(mixed $string, string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string contains a sequence of chars for all values.
 * @method static bool allCount(array|\Countable $countable, int $count, string $message = null, string $propertyPath = null) Assert that the count of countable is equal to count for all values.
 * @method static bool allDate(string $value, string $format, string|callable $message = null, string $propertyPath = null) Assert that date is valid and corresponds to the given format for all values.
 * @method static bool allDefined(mixed $constant, string|callable $message = null, string $propertyPath = null) Assert that a constant is defined for all values.
 * @method static bool allDigit(mixed $value, string|callable $message = null, string $propertyPath = null) Validates if an integer or integerish is a digit for all values.
 * @method static bool allDirectory(string $value, string|callable $message = null, string $propertyPath = null) Assert that a directory exists for all values.
 * @method static bool allE164(string $value, string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid E164 Phone Number for all values.
 * @method static bool allEmail(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is an email address (using input_filter/FILTER_VALIDATE_EMAIL) for all values.
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
 * @method static bool allLessOrEqualThan(mixed $value, mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is less or equal than given limit for all values.
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
 * @method static bool nullOrBase64(string $value, string|callable $message = null, string $propertyPath = null) Assert that a constant is defined or that the value is null.
 * @method static bool nullOrBetween(mixed $value, mixed $lowerLimit, mixed $upperLimit, string $message = null, string $propertyPath = null) Assert that a value is greater or equal than a lower limit, and less than or equal to an upper limit or that the value is null.
 * @method static bool nullOrBetweenExclusive(mixed $value, mixed $lowerLimit, mixed $upperLimit, string $message = null, string $propertyPath = null) Assert that a value is greater than a lower limit, and less than an upper limit or that the value is null.
 * @method static bool nullOrBetweenLength(mixed $value, int $minLength, int $maxLength, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string length is between min,max lengths or that the value is null.
 * @method static bool nullOrBoolean(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is php boolean or that the value is null.
 * @method static bool nullOrChoice(mixed $value, array $choices, string|callable $message = null, string $propertyPath = null) Assert that value is in array of choices or that the value is null.
 * @method static bool nullOrChoicesNotEmpty(array $values, array $choices, string|callable $message = null, string $propertyPath = null) Determines if the values array has every choice as key and that this choice has content or that the value is null.
 * @method static bool nullOrClassExists(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that the class exists or that the value is null.
 * @method static bool nullOrContains(mixed $string, string $needle, string|callable $message = null, string $propertyPath = null, string $encoding = 'utf8') Assert that string contains a sequence of chars or that the value is null.
 * @method static bool nullOrCount(array|\Countable $countable, int $count, string $message = null, string $propertyPath = null) Assert that the count of countable is equal to count or that the value is null.
 * @method static bool nullOrDate(string $value, string $format, string|callable $message = null, string $propertyPath = null) Assert that date is valid and corresponds to the given format or that the value is null.
 * @method static bool nullOrDefined(mixed $constant, string|callable $message = null, string $propertyPath = null) Assert that a constant is defined or that the value is null.
 * @method static bool nullOrDigit(mixed $value, string|callable $message = null, string $propertyPath = null) Validates if an integer or integerish is a digit or that the value is null.
 * @method static bool nullOrDirectory(string $value, string|callable $message = null, string $propertyPath = null) Assert that a directory exists or that the value is null.
 * @method static bool nullOrE164(string $value, string|callable $message = null, string $propertyPath = null) Assert that the given string is a valid E164 Phone Number or that the value is null.
 * @method static bool nullOrEmail(mixed $value, string|callable $message = null, string $propertyPath = null) Assert that value is an email address (using input_filter/FILTER_VALIDATE_EMAIL) or that the value is null.
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
 * @method static bool nullOrLessOrEqualThan(mixed $value, mixed $limit, string|callable $message = null, string $propertyPath = null) Determines if the value is less or equal than given limit or that the value is null.
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
    const INVALID_FLOAT = 9;
    const INVALID_INTEGER = 10;
    const INVALID_DIGIT = 11;
    const INVALID_INTEGERISH = 12;
    const INVALID_BOOLEAN = 13;
    const VALUE_EMPTY = 14;
    const VALUE_NULL = 15;
    const VALUE_NOT_NULL = 25;
    const INVALID_STRING = 16;
    const INVALID_REGEX = 17;
    const INVALID_MIN_LENGTH = 18;
    const INVALID_MAX_LENGTH = 19;
    const INVALID_STRING_START = 20;
    const INVALID_STRING_CONTAINS = 21;
    const INVALID_CHOICE = 22;
    const INVALID_NUMERIC = 23;
    const INVALID_ARRAY = 24;
    const INVALID_KEY_EXISTS = 26;
    const INVALID_NOT_BLANK = 27;
    const INVALID_INSTANCE_OF = 28;
    const INVALID_SUBCLASS_OF = 29;
    const INVALID_RANGE = 30;
    const INVALID_ALNUM = 31;
    const INVALID_TRUE = 32;
    const INVALID_EQ = 33;
    const INVALID_SAME = 34;
    const INVALID_MIN = 35;
    const INVALID_MAX = 36;
    const INVALID_LENGTH = 37;
    const INVALID_FALSE = 38;
    const INVALID_STRING_END = 39;
    const INVALID_UUID = 40;
    const INVALID_COUNT = 41;
    const INVALID_NOT_EQ = 42;
    const INVALID_NOT_SAME = 43;
    const INVALID_TRAVERSABLE = 44;
    const INVALID_ARRAY_ACCESSIBLE = 45;
    const INVALID_KEY_ISSET = 46;
    const INVALID_VALUE_IN_ARRAY = 47;
    const INVALID_E164 = 48;
    const INVALID_BASE64 = 49;
    const INVALID_DIRECTORY = 101;
    const INVALID_FILE = 102;
    const INVALID_READABLE = 103;
    const INVALID_WRITEABLE = 104;
    const INVALID_CLASS = 105;
    const INVALID_INTERFACE = 106;
    const INVALID_EMAIL = 201;
    const INTERFACE_NOT_IMPLEMENTED = 202;
    const INVALID_URL = 203;
    const INVALID_NOT_INSTANCE_OF = 204;
    const VALUE_NOT_EMPTY = 205;
    const INVALID_JSON_STRING = 206;
    const INVALID_OBJECT = 207;
    const INVALID_METHOD = 208;
    const INVALID_SCALAR = 209;
    const INVALID_LESS = 210;
    const INVALID_LESS_OR_EQUAL = 211;
    const INVALID_GREATER = 212;
    const INVALID_GREATER_OR_EQUAL = 213;
    const INVALID_DATE = 214;
    const INVALID_CALLABLE = 215;
    const INVALID_KEY_NOT_EXISTS = 216;
    const INVALID_SATISFY = 217;
    const INVALID_IP = 218;
    const INVALID_BETWEEN = 219;
    const INVALID_BETWEEN_EXCLUSIVE = 220;
    const INVALID_EXTENSION = 222;
    const INVALID_CONSTANT = 221;
    const INVALID_VERSION = 223;
    const INVALID_PROPERTY = 224;
    const INVALID_RESOURCE = 225;

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
     * Assert that two values are equal (using == ).
     *
     * @param mixed                $value
     * @param mixed                $value2
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function eq($value, $value2, $message = null, $propertyPath = null)
    {
        if ($value != $value2) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" does not equal expected value "%s".'),
                static::stringify($value),
                static::stringify($value2)
            );

            throw static::createException($value, $message, static::INVALID_EQ, $propertyPath, array('expected' => $value2));
        }

        return true;
    }

    /**
     * Assert that two values are the same (using ===).
     *
     * @param mixed                $value
     * @param mixed                $value2
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function same($value, $value2, $message = null, $propertyPath = null)
    {
        if ($value !== $value2) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not the same as expected value "%s".'),
                static::stringify($value),
                static::stringify($value2)
            );

            throw static::createException($value, $message, static::INVALID_SAME, $propertyPath, array('expected' => $value2));
        }

        return true;
    }

    /**
     * Assert that two values are not equal (using == ).
     *
     * @param mixed                $value1
     * @param mixed                $value2
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notEq($value1, $value2, $message = null, $propertyPath = null)
    {
        if ($value1 == $value2) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is equal to expected value "%s".'),
                static::stringify($value1),
                static::stringify($value2)
            );
            throw static::createException($value1, $message, static::INVALID_NOT_EQ, $propertyPath, array('expected' => $value2));
        }

        return true;
    }

    /**
     * Assert that two values are not the same (using === ).
     *
     * @param mixed                $value1
     * @param mixed                $value2
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notSame($value1, $value2, $message = null, $propertyPath = null)
    {
        if ($value1 === $value2) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is the same as expected value "%s".'),
                static::stringify($value1),
                static::stringify($value2)
            );
            throw static::createException($value1, $message, static::INVALID_NOT_SAME, $propertyPath, array('expected' => $value2));
        }

        return true;
    }

    /**
     * Assert that value is not in array of choices.
     *
     * @param mixed                $value
     * @param array                $choices
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notInArray($value, array $choices, $message = null, $propertyPath = null)
    {
        if (true === \in_array($value, $choices)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is in given "%s".'),
                static::stringify($value),
                static::stringify($choices)
            );
            throw static::createException($value, $message, static::INVALID_VALUE_IN_ARRAY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is a php integer.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function integer($value, $message = null, $propertyPath = null)
    {
        if (!\is_int($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not an integer.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_INTEGER, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is a php float.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function float($value, $message = null, $propertyPath = null)
    {
        if (!\is_float($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not a float.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_FLOAT, $propertyPath);
        }

        return true;
    }

    /**
     * Validates if an integer or integerish is a digit.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function digit($value, $message = null, $propertyPath = null)
    {
        if (!\ctype_digit((string) $value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not a digit.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_DIGIT, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is a php integer'ish.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function integerish($value, $message = null, $propertyPath = null)
    {
        if (
            \is_resource($value) ||
            \is_object($value) ||
            \is_bool($value) ||
            \is_null($value) ||
            \is_array($value) ||
            (\is_string($value) && '' == $value) ||
            (
                \strval(\intval($value)) !== \strval($value) &&
                \strval(\intval($value)) !== \strval(\ltrim($value, '0')) &&
                '' !== \strval(\intval($value)) &&
                '' !== \strval(\ltrim($value, '0'))
            )
        ) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not an integer or a number castable to integer.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_INTEGERISH, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is php boolean.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function boolean($value, $message = null, $propertyPath = null)
    {
        if (!\is_bool($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not a boolean.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_BOOLEAN, $propertyPath);
        }

        return true;
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
                static::generateMessage($message ?: 'Value "%s" is not a scalar.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_SCALAR, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is not empty.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notEmpty($value, $message = null, $propertyPath = null)
    {
        if (empty($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is empty, but non empty value was expected.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::VALUE_EMPTY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is empty.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function noContent($value, $message = null, $propertyPath = null)
    {
        if (!empty($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not empty, but empty value was expected.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::VALUE_NOT_EMPTY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is null.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function null($value, $message = null, $propertyPath = null)
    {
        if (null !== $value) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not null, but null value was expected.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::VALUE_NOT_NULL, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is not null.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notNull($value, $message = null, $propertyPath = null)
    {
        if (null === $value) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is null, but non null value was expected.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::VALUE_NULL, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is a string.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function string($value, $message = null, $propertyPath = null)
    {
        if (!\is_string($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" expected to be string, type %s given.'),
                static::stringify($value),
                \gettype($value)
            );

            throw static::createException($value, $message, static::INVALID_STRING, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value matches a regex.
     *
     * @param mixed                $value
     * @param string               $pattern
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function regex($value, $pattern, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        if (!\preg_match($pattern, $value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" does not match expression.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_REGEX, $propertyPath, array('pattern' => $pattern));
        }

        return true;
    }

    /**
     * Assert that string has a given length.
     *
     * @param mixed                $value
     * @param int                  $length
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function length($value, $length, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($value, $message, $propertyPath);

        if (\mb_strlen($value, $encoding) !== $length) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" has to be %d exactly characters long, but length is %d.'),
                static::stringify($value),
                $length,
                \mb_strlen($value, $encoding)
            );

            $constraints = array('length' => $length, 'encoding' => $encoding);
            throw static::createException($value, $message, static::INVALID_LENGTH, $propertyPath, $constraints);
        }

        return true;
    }

    /**
     * Assert that a string is at least $minLength chars long.
     *
     * @param mixed                $value
     * @param int                  $minLength
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function minLength($value, $minLength, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($value, $message, $propertyPath);

        if (\mb_strlen($value, $encoding) < $minLength) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is too short, it should have at least %d characters, but only has %d characters.'),
                static::stringify($value),
                $minLength,
                \mb_strlen($value, $encoding)
            );

            $constraints = array('min_length' => $minLength, 'encoding' => $encoding);
            throw static::createException($value, $message, static::INVALID_MIN_LENGTH, $propertyPath, $constraints);
        }

        return true;
    }

    /**
     * Assert that string value is not longer than $maxLength chars.
     *
     * @param mixed                $value
     * @param int                  $maxLength
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function maxLength($value, $maxLength, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($value, $message, $propertyPath);

        if (\mb_strlen($value, $encoding) > $maxLength) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is too long, it should have no more than %d characters, but has %d characters.'),
                static::stringify($value),
                $maxLength,
                \mb_strlen($value, $encoding)
            );

            $constraints = array('max_length' => $maxLength, 'encoding' => $encoding);
            throw static::createException($value, $message, static::INVALID_MAX_LENGTH, $propertyPath, $constraints);
        }

        return true;
    }

    /**
     * Assert that string length is between min,max lengths.
     *
     * @param mixed                $value
     * @param int                  $minLength
     * @param int                  $maxLength
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function betweenLength($value, $minLength, $maxLength, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($value, $message, $propertyPath);
        static::minLength($value, $minLength, $message, $propertyPath, $encoding);
        static::maxLength($value, $maxLength, $message, $propertyPath, $encoding);

        return true;
    }

    /**
     * Assert that string starts with a sequence of chars.
     *
     * @param mixed                $string
     * @param string               $needle
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function startsWith($string, $needle, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($string, $message, $propertyPath);

        if (0 !== \mb_strpos($string, $needle, null, $encoding)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" does not start with "%s".'),
                static::stringify($string),
                static::stringify($needle)
            );

            $constraints = array('needle' => $needle, 'encoding' => $encoding);
            throw static::createException($string, $message, static::INVALID_STRING_START, $propertyPath, $constraints);
        }

        return true;
    }

    /**
     * Assert that string ends with a sequence of chars.
     *
     * @param mixed                $string
     * @param string               $needle
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function endsWith($string, $needle, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($string, $message, $propertyPath);

        $stringPosition = \mb_strlen($string, $encoding) - \mb_strlen($needle, $encoding);

        if (\mb_strripos($string, $needle, null, $encoding) !== $stringPosition) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" does not end with "%s".'),
                static::stringify($string),
                static::stringify($needle)
            );

            $constraints = array('needle' => $needle, 'encoding' => $encoding);
            throw static::createException($string, $message, static::INVALID_STRING_END, $propertyPath, $constraints);
        }

        return true;
    }

    /**
     * Assert that string contains a sequence of chars.
     *
     * @param mixed                $string
     * @param string               $needle
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     * @param string               $encoding
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function contains($string, $needle, $message = null, $propertyPath = null, $encoding = 'utf8')
    {
        static::string($string, $message, $propertyPath);

        if (false === \mb_strpos($string, $needle, null, $encoding)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" does not contain "%s".'),
                static::stringify($string),
                static::stringify($needle)
            );

            $constraints = array('needle' => $needle, 'encoding' => $encoding);
            throw static::createException($string, $message, static::INVALID_STRING_CONTAINS, $propertyPath, $constraints);
        }

        return true;
    }

    /**
     * Assert that value is in array of choices.
     *
     * @param mixed                $value
     * @param array                $choices
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function choice($value, array $choices, $message = null, $propertyPath = null)
    {
        if (!\in_array($value, $choices, true)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not an element of the valid values: %s'),
                static::stringify($value),
                \implode(', ', \array_map(array(\get_called_class(), 'stringify'), $choices))
            );

            throw static::createException($value, $message, static::INVALID_CHOICE, $propertyPath, array('choices' => $choices));
        }

        return true;
    }

    /**
     * Assert that value is in array of choices.
     *
     * This is an alias of {@see choice()}.
     *
     * @param mixed                $value
     * @param array                $choices
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function inArray($value, array $choices, $message = null, $propertyPath = null)
    {
        return static::choice($value, $choices, $message, $propertyPath);
    }

    /**
     * Assert that value is numeric.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function numeric($value, $message = null, $propertyPath = null)
    {
        if (!\is_numeric($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not numeric.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_NUMERIC, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is a resource.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function isResource($value, $message = null, $propertyPath = null)
    {
        if (!\is_resource($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not a resource.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_RESOURCE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is an array.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function isArray($value, $message = null, $propertyPath = null)
    {
        if (!\is_array($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not an array.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_ARRAY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is an array or a traversable object.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function isTraversable($value, $message = null, $propertyPath = null)
    {
        if (!\is_array($value) && !$value instanceof \Traversable) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not an array and does not implement Traversable.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_TRAVERSABLE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is an array or an array-accessible object.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function isArrayAccessible($value, $message = null, $propertyPath = null)
    {
        if (!\is_array($value) && !$value instanceof \ArrayAccess) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not an array and does not implement ArrayAccess.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_ARRAY_ACCESSIBLE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that key exists in an array.
     *
     * @param mixed                $value
     * @param string|int           $key
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function keyExists($value, $key, $message = null, $propertyPath = null)
    {
        static::isArray($value, $message, $propertyPath);

        if (!\array_key_exists($key, $value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Array does not contain an element with key "%s"'),
                static::stringify($key)
            );

            throw static::createException($value, $message, static::INVALID_KEY_EXISTS, $propertyPath, array('key' => $key));
        }

        return true;
    }

    /**
     * Assert that key does not exist in an array.
     *
     * @param mixed                $value
     * @param string|int           $key
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function keyNotExists($value, $key, $message = null, $propertyPath = null)
    {
        static::isArray($value, $message, $propertyPath);

        if (\array_key_exists($key, $value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Array contains an element with key "%s"'),
                static::stringify($key)
            );

            throw static::createException($value, $message, static::INVALID_KEY_NOT_EXISTS, $propertyPath, array('key' => $key));
        }

        return true;
    }

    /**
     * Assert that key exists in an array/array-accessible object using isset().
     *
     * @param mixed                $value
     * @param string|int           $key
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function keyIsset($value, $key, $message = null, $propertyPath = null)
    {
        static::isArrayAccessible($value, $message, $propertyPath);

        if (!isset($value[$key])) {
            $message = \sprintf(
                static::generateMessage($message ?: 'The element with key "%s" was not found'),
                static::stringify($key)
            );

            throw static::createException($value, $message, static::INVALID_KEY_ISSET, $propertyPath, array('key' => $key));
        }

        return true;
    }

    /**
     * Assert that key exists in an array/array-accessible object and its value is not empty.
     *
     * @param mixed                $value
     * @param string|int           $key
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notEmptyKey($value, $key, $message = null, $propertyPath = null)
    {
        static::keyIsset($value, $key, $message, $propertyPath);
        static::notEmpty($value[$key], $message, $propertyPath);

        return true;
    }

    /**
     * Assert that value is not blank.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notBlank($value, $message = null, $propertyPath = null)
    {
        if (false === $value || (empty($value) && '0' != $value) || (\is_string($value) && '' === \trim($value))) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is blank, but was expected to contain a value.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_NOT_BLANK, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is instance of given class-name.
     *
     * @param mixed                $value
     * @param string               $className
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function isInstanceOf($value, $className, $message = null, $propertyPath = null)
    {
        if (!($value instanceof $className)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Class "%s" was expected to be instanceof of "%s" but is not.'),
                static::stringify($value),
                $className
            );

            throw static::createException($value, $message, static::INVALID_INSTANCE_OF, $propertyPath, array('class' => $className));
        }

        return true;
    }

    /**
     * Assert that value is not instance of given class-name.
     *
     * @param mixed                $value
     * @param string               $className
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function notIsInstanceOf($value, $className, $message = null, $propertyPath = null)
    {
        if ($value instanceof $className) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Class "%s" was not expected to be instanceof of "%s".'),
                static::stringify($value),
                $className
            );

            throw static::createException($value, $message, static::INVALID_NOT_INSTANCE_OF, $propertyPath, array('class' => $className));
        }

        return true;
    }

    /**
     * Assert that value is subclass of given class-name.
     *
     * @param mixed                $value
     * @param string               $className
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function subclassOf($value, $className, $message = null, $propertyPath = null)
    {
        if (!\is_subclass_of($value, $className)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Class "%s" was expected to be subclass of "%s".'),
                static::stringify($value),
                $className
            );

            throw static::createException($value, $message, static::INVALID_SUBCLASS_OF, $propertyPath, array('class' => $className));
        }

        return true;
    }

    /**
     * Assert that value is in range of numbers.
     *
     * @param mixed                $value
     * @param mixed                $minValue
     * @param mixed                $maxValue
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function range($value, $minValue, $maxValue, $message = null, $propertyPath = null)
    {
        static::numeric($value, $message, $propertyPath);

        if ($value < $minValue || $value > $maxValue) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Number "%s" was expected to be at least "%d" and at most "%d".'),
                static::stringify($value),
                static::stringify($minValue),
                static::stringify($maxValue)
            );

            throw static::createException($value, $message, static::INVALID_RANGE, $propertyPath, array('min' => $minValue, 'max' => $maxValue));
        }

        return true;
    }

    /**
     * Assert that a value is at least as big as a given limit.
     *
     * @param mixed                $value
     * @param mixed                $minValue
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function min($value, $minValue, $message = null, $propertyPath = null)
    {
        static::numeric($value, $message, $propertyPath);

        if ($value < $minValue) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Number "%s" was expected to be at least "%s".'),
                static::stringify($value),
                static::stringify($minValue)
            );

            throw static::createException($value, $message, static::INVALID_MIN, $propertyPath, array('min' => $minValue));
        }

        return true;
    }

    /**
     * Assert that a number is smaller as a given limit.
     *
     * @param mixed                $value
     * @param mixed                $maxValue
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function max($value, $maxValue, $message = null, $propertyPath = null)
    {
        static::numeric($value, $message, $propertyPath);

        if ($value > $maxValue) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Number "%s" was expected to be at most "%s".'),
                static::stringify($value),
                static::stringify($maxValue)
            );

            throw static::createException($value, $message, static::INVALID_MAX, $propertyPath, array('max' => $maxValue));
        }

        return true;
    }

    /**
     * Assert that a file exists.
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function file($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);
        static::notEmpty($value, $message, $propertyPath);

        if (!\is_file($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'File "%s" was expected to exist.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_FILE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that a directory exists.
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function directory($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        if (!\is_dir($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Path "%s" was expected to be a directory.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_DIRECTORY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is something readable.
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function readable($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        if (!\is_readable($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Path "%s" was expected to be readable.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_READABLE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is something writeable.
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function writeable($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        if (!\is_writable($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Path "%s" was expected to be writeable.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_WRITEABLE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is an email address (using input_filter/FILTER_VALIDATE_EMAIL).
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function email($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        if (!\filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" was expected to be a valid e-mail address.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_EMAIL, $propertyPath);
        } else {
            $host = \substr($value, \strpos($value, '@') + 1);

            // Likely not a FQDN, bug in PHP FILTER_VALIDATE_EMAIL prior to PHP 5.3.3
            if (\version_compare(PHP_VERSION, '5.3.3', '<') && false === \strpos($host, '.')) {
                $message = \sprintf(
                    static::generateMessage($message ?: 'Value "%s" was expected to be a valid e-mail address.'),
                    static::stringify($value)
                );

                throw static::createException($value, $message, static::INVALID_EMAIL, $propertyPath);
            }
        }

        return true;
    }

    /**
     * Assert that value is an URL.
     *
     * This code snipped was taken from the Symfony project and modified to the special demands of this method.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     *
     * @see https://github.com/symfony/Validator/blob/master/Constraints/UrlValidator.php
     * @see https://github.com/symfony/Validator/blob/master/Constraints/Url.php
     */
    public static function url($value, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);

        $protocols = array('http', 'https');

        $pattern = '~^
            (%s)://                                     # protocol
            (([\.\pL\pN-]+:)?([\.\pL\pN-]+)@)?          # basic auth
            (
                ([\pL\pN\pS-\.])+(\.?([\pL\pN]|xn\-\-[\pL\pN-]+)+\.?) # a domain name
                    |                                                 # or
                \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}                    # an IP address
                    |                                                 # or
                \[
                    (?:(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){6})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:::(?:(?:(?:[0-9a-f]{1,4})):){5})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){4})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,1}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){3})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,2}(?:(?:[0-9a-f]{1,4})))?::(?:(?:(?:[0-9a-f]{1,4})):){2})(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,3}(?:(?:[0-9a-f]{1,4})))?::(?:(?:[0-9a-f]{1,4})):)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,4}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:(?:(?:(?:[0-9a-f]{1,4})):(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9]))\.){3}(?:(?:25[0-5]|(?:[1-9]|1[0-9]|2[0-4])?[0-9])))))))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,5}(?:(?:[0-9a-f]{1,4})))?::)(?:(?:[0-9a-f]{1,4})))|(?:(?:(?:(?:(?:(?:[0-9a-f]{1,4})):){0,6}(?:(?:[0-9a-f]{1,4})))?::))))
                \]  # an IPv6 address
            )
            (:[0-9]+)?                              # a port (optional)
            (/?|/\S+|\?\S*|\#\S*)                   # a /, nothing, a / with something, a query or a fragment
        $~ixu';

        $pattern = \sprintf($pattern, \implode('|', $protocols));

        if (!\preg_match($pattern, $value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" was expected to be a valid URL starting with http or https'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_URL, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is alphanumeric.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function alnum($value, $message = null, $propertyPath = null)
    {
        try {
            static::regex($value, '(^([a-zA-Z]{1}[a-zA-Z0-9]*)$)', $message, $propertyPath);
        } catch (AssertionFailedException $e) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not alphanumeric, starting with letters and containing only letters and numbers.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_ALNUM, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is boolean True.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function true($value, $message = null, $propertyPath = null)
    {
        if (true !== $value) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not TRUE.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_TRUE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is boolean False.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function false($value, $message = null, $propertyPath = null)
    {
        if (false !== $value) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not FALSE.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_FALSE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the class exists.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function classExists($value, $message = null, $propertyPath = null)
    {
        if (!\class_exists($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Class "%s" does not exist.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_CLASS, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the interface exists.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function interfaceExists($value, $message = null, $propertyPath = null)
    {
        if (!\interface_exists($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Interface "%s" does not exist.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_INTERFACE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the class implements the interface.
     *
     * @param mixed                $class
     * @param string               $interfaceName
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function implementsInterface($class, $interfaceName, $message = null, $propertyPath = null)
    {
        $reflection = new \ReflectionClass($class);
        if (!$reflection->implementsInterface($interfaceName)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Class "%s" does not implement interface "%s".'),
                static::stringify($class),
                static::stringify($interfaceName)
            );

            throw static::createException($class, $message, static::INTERFACE_NOT_IMPLEMENTED, $propertyPath, array('interface' => $interfaceName));
        }

        return true;
    }

    /**
     * Assert that the given string is a valid json string.
     *
     * NOTICE:
     * Since this does a json_decode to determine its validity
     * you probably should consider, when using the variable
     * content afterwards, just to decode and check for yourself instead
     * of using this assertion.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function isJsonString($value, $message = null, $propertyPath = null)
    {
        if (null === \json_decode($value) && JSON_ERROR_NONE !== \json_last_error()) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not a valid JSON string.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_JSON_STRING, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the given string is a valid UUID.
     *
     * Uses code from {@link https://github.com/ramsey/uuid} that is MIT licensed.
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function uuid($value, $message = null, $propertyPath = null)
    {
        $value = \str_replace(array('urn:', 'uuid:', '{', '}'), '', $value);

        if ('00000000-0000-0000-0000-000000000000' === $value) {
            return true;
        }

        if (!\preg_match('/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$/', $value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not a valid UUID.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_UUID, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the given string is a valid E164 Phone Number.
     *
     * @see https://en.wikipedia.org/wiki/E.164
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function e164($value, $message = null, $propertyPath = null)
    {
        if (!\preg_match('/^\+?[1-9]\d{1,14}$/', $value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" is not a valid E164.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_E164, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the count of countable is equal to count.
     *
     * @param array|\Countable $countable
     * @param int              $count
     * @param string|null      $message
     * @param string|null      $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function count($countable, $count, $message = null, $propertyPath = null)
    {
        if ($count !== \count($countable)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'List does not contain exactly %d elements (%d given).'),
                static::stringify($count),
                static::stringify(\count($countable))
            );

            throw static::createException($countable, $message, static::INVALID_COUNT, $propertyPath, array('count' => $count));
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
        if (0 === \strpos($method, 'nullOr')) {
            if (!\array_key_exists(0, $args)) {
                throw new BadMethodCallException('Missing the first argument.');
            }

            if (null === $args[0]) {
                return true;
            }

            $method = \substr($method, 6);

            return \call_user_func_array(array(\get_called_class(), $method), $args);
        }

        if (0 === \strpos($method, 'all')) {
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
     * Determines if the values array has every choice as key and that this choice has content.
     *
     * @param array                $values
     * @param array                $choices
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function choicesNotEmpty(array $values, array $choices, $message = null, $propertyPath = null)
    {
        static::notEmpty($values, $message, $propertyPath);

        foreach ($choices as $choice) {
            static::notEmptyKey($values, $choice, $message, $propertyPath);
        }

        return true;
    }

    /**
     * Determines that the named method is defined in the provided object.
     *
     * @param string               $value
     * @param mixed                $object
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function methodExists($value, $object, $message = null, $propertyPath = null)
    {
        static::isObject($object, $message, $propertyPath);

        if (!\method_exists($object, $value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Expected "%s" does not exist in provided object.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_METHOD, $propertyPath);
        }

        return true;
    }

    /**
     * Determines that the provided value is an object.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function isObject($value, $message = null, $propertyPath = null)
    {
        if (!\is_object($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Provided "%s" is not a valid object.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_OBJECT, $propertyPath);
        }

        return true;
    }

    /**
     * Determines if the value is less than given limit.
     *
     * @param mixed                $value
     * @param mixed                $limit
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function lessThan($value, $limit, $message = null, $propertyPath = null)
    {
        if ($value >= $limit) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Provided "%s" is not less than "%s".'),
                static::stringify($value),
                static::stringify($limit)
            );

            throw static::createException($value, $message, static::INVALID_LESS, $propertyPath);
        }

        return true;
    }

    /**
     * Determines if the value is less or equal than given limit.
     *
     * @param mixed                $value
     * @param mixed                $limit
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function lessOrEqualThan($value, $limit, $message = null, $propertyPath = null)
    {
        if ($value > $limit) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Provided "%s" is not less or equal than "%s".'),
                static::stringify($value),
                static::stringify($limit)
            );

            throw static::createException($value, $message, static::INVALID_LESS_OR_EQUAL, $propertyPath);
        }

        return true;
    }

    /**
     * Determines if the value is greater than given limit.
     *
     * @param mixed                $value
     * @param mixed                $limit
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function greaterThan($value, $limit, $message = null, $propertyPath = null)
    {
        if ($value <= $limit) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Provided "%s" is not greater than "%s".'),
                static::stringify($value),
                static::stringify($limit)
            );

            throw static::createException($value, $message, static::INVALID_GREATER, $propertyPath);
        }

        return true;
    }

    /**
     * Determines if the value is greater or equal than given limit.
     *
     * @param mixed                $value
     * @param mixed                $limit
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function greaterOrEqualThan($value, $limit, $message = null, $propertyPath = null)
    {
        if ($value < $limit) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Provided "%s" is not greater or equal than "%s".'),
                static::stringify($value),
                static::stringify($limit)
            );

            throw static::createException($value, $message, static::INVALID_GREATER_OR_EQUAL, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that a value is greater or equal than a lower limit, and less than or equal to an upper limit.
     *
     * @param mixed  $value
     * @param mixed  $lowerLimit
     * @param mixed  $upperLimit
     * @param string $message
     * @param string $propertyPath
     *
     * @return bool
     */
    public static function between($value, $lowerLimit, $upperLimit, $message = null, $propertyPath = null)
    {
        if ($lowerLimit > $value || $value > $upperLimit) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Provided "%s" is neither greater than or equal to "%s" nor less than or equal to "%s".'),
                static::stringify($value),
                static::stringify($lowerLimit),
                static::stringify($upperLimit)
            );

            throw static::createException($value, $message, static::INVALID_BETWEEN, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that a value is greater than a lower limit, and less than an upper limit.
     *
     * @param mixed  $value
     * @param mixed  $lowerLimit
     * @param mixed  $upperLimit
     * @param string $message
     * @param string $propertyPath
     *
     * @return bool
     */
    public static function betweenExclusive($value, $lowerLimit, $upperLimit, $message = null, $propertyPath = null)
    {
        if ($lowerLimit >= $value || $value >= $upperLimit) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Provided "%s" is neither greater than "%s" nor less than "%s".'),
                static::stringify($value),
                static::stringify($lowerLimit),
                static::stringify($upperLimit)
            );

            throw static::createException($value, $message, static::INVALID_BETWEEN_EXCLUSIVE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that extension is loaded.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function extensionLoaded($value, $message = null, $propertyPath = null)
    {
        if (!\extension_loaded($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Extension "%s" is required.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_EXTENSION, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that date is valid and corresponds to the given format.
     *
     * @param string               $value
     * @param string               $format       supports all of the options date(), except for the following:
     *                                           N, w, W, t, L, o, B, a, A, g, h, I, O, P, Z, c, r
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @see http://php.net/manual/function.date.php#refsect1-function.date-parameters
     */
    public static function date($value, $format, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);
        static::string($format, $message, $propertyPath);

        $dateTime = \DateTime::createFromFormat('!' . $format, $value);

        if (false === $dateTime || $value !== $dateTime->format($format)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Date "%s" is invalid or does not match format "%s".'),
                static::stringify($value),
                static::stringify($format)
            );

            throw static::createException($value, $message, static::INVALID_DATE, $propertyPath, array('format' => $format));
        }

        return true;
    }

    /**
     * Assert that the value is an object, or a class that exists.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function objectOrClass($value, $message = null, $propertyPath = null)
    {
        if (!\is_object($value)) {
            static::classExists($value, $message, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is an object or class, and that the property exists.
     *
     * @param mixed                $value
     * @param string               $property
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function propertyExists($value, $property, $message = null, $propertyPath = null)
    {
        static::objectOrClass($value);

        if (!\property_exists($value, $property)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Class "%s" does not have property "%s".'),
                static::stringify($value),
                static::stringify($property)
            );

            throw static::createException($value, $message, static::INVALID_PROPERTY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the value is an object or class, and that the properties all exist.
     *
     * @param mixed                $value
     * @param array                $properties
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function propertiesExist($value, array $properties, $message = null, $propertyPath = null)
    {
        static::objectOrClass($value);
        static::allString($properties, $message, $propertyPath);

        $invalidProperties = array();
        foreach ($properties as $property) {
            if (!\property_exists($value, $property)) {
                $invalidProperties[] = $property;
            }
        }

        if ($invalidProperties) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Class "%s" does not have these properties: %s.'),
                static::stringify($value),
                static::stringify(\implode(', ', $invalidProperties))
            );

            throw static::createException($value, $message, static::INVALID_PROPERTY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert comparison of two versions.
     *
     * @param string               $version1
     * @param string               $operator
     * @param string               $version2
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function version($version1, $operator, $version2, $message = null, $propertyPath = null)
    {
        static::notEmpty($operator, 'versionCompare operator is required and cannot be empty.');

        if (true !== \version_compare($version1, $version2, $operator)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Version "%s" is not "%s" version "%s".'),
                static::stringify($version1),
                static::stringify($operator),
                static::stringify($version2)
            );

            throw static::createException($version1, $message, static::INVALID_VERSION, $propertyPath);
        }

        return true;
    }

    /**
     * Assert on PHP version.
     *
     * @param string               $operator
     * @param mixed                $version
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function phpVersion($operator, $version, $message = null, $propertyPath = null)
    {
        static::defined('PHP_VERSION');

        return static::version(PHP_VERSION, $operator, $version, $message, $propertyPath);
    }

    /**
     * Assert that extension is loaded and a specific version is installed.
     *
     * @param string               $extension
     * @param string               $operator
     * @param mixed                $version
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function extensionVersion($extension, $operator, $version, $message = null, $propertyPath = null)
    {
        static::extensionLoaded($extension, $message, $propertyPath);

        return static::version(\phpversion($extension), $operator, $version, $message, $propertyPath);
    }

    /**
     * Determines that the provided value is callable.
     *
     * @param mixed                $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function isCallable($value, $message = null, $propertyPath = null)
    {
        if (!\is_callable($value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Provided "%s" is not a callable.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_CALLABLE, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that the provided value is valid according to a callback.
     *
     * If the callback returns `false` the assertion will fail.
     *
     * @param mixed                $value
     * @param callable             $callback
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     */
    public static function satisfy($value, $callback, $message = null, $propertyPath = null)
    {
        static::isCallable($callback);

        if (false === \call_user_func($callback, $value)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Provided "%s" is invalid according to custom rule.'),
                static::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_SATISFY, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is an IPv4 or IPv6 address
     * (using input_filter/FILTER_VALIDATE_IP).
     *
     * @param string               $value
     * @param null|int             $flag
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @see http://php.net/manual/filter.filters.flags.php
     */
    public static function ip($value, $flag = null, $message = null, $propertyPath = null)
    {
        static::string($value, $message, $propertyPath);
        if (!\filter_var($value, FILTER_VALIDATE_IP, $flag)) {
            $message = \sprintf(
                static::generateMessage($message ?: 'Value "%s" was expected to be a valid IP address.'),
                static::stringify($value)
            );
            throw static::createException($value, $message, static::INVALID_IP, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that value is an IPv4 address
     * (using input_filter/FILTER_VALIDATE_IP).
     *
     * @param string               $value
     * @param null|int             $flag
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @see http://php.net/manual/filter.filters.flags.php
     */
    public static function ipv4($value, $flag = null, $message = null, $propertyPath = null)
    {
        static::ip($value, $flag | FILTER_FLAG_IPV4, static::generateMessage($message ?: 'Value "%s" was expected to be a valid IPv4 address.'), $propertyPath);

        return true;
    }

    /**
     * Assert that value is an IPv6 address
     * (using input_filter/FILTER_VALIDATE_IP).
     *
     * @param string               $value
     * @param null|int             $flag
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @see http://php.net/manual/filter.filters.flags.php
     */
    public static function ipv6($value, $flag = null, $message = null, $propertyPath = null)
    {
        static::ip($value, $flag | FILTER_FLAG_IPV6, static::generateMessage($message ?: 'Value "%s" was expected to be a valid IPv6 address.'), $propertyPath);

        return true;
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
        } elseif (\is_scalar($value)) {
            $val = (string) $value;

            if (\strlen($val) > 100) {
                $val = \substr($val, 0, 97) . '...';
            }

            $result = $val;
        } elseif (\is_array($value)) {
            $result = '<ARRAY>';
        } elseif (\is_object($value)) {
            $result = \get_class($value);
        } elseif (\is_resource($value)) {
            $result = \get_resource_type($value);
        } elseif (null === $value) {
            $result = '<NULL>';
        }

        return $result;
    }

    /**
     * Assert that a constant is defined.
     *
     * @param mixed                $constant
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function defined($constant, $message = null, $propertyPath = null)
    {
        if (!\defined($constant)) {
            $message = \sprintf(static::generateMessage($message ?: 'Value "%s" expected to be a defined constant.'), $constant);

            throw static::createException($constant, $message, static::INVALID_CONSTANT, $propertyPath);
        }

        return true;
    }

    /**
     * Assert that a constant is defined.
     *
     * @param string               $value
     * @param string|callable|null $message
     * @param string|null          $propertyPath
     *
     * @return bool
     *
     * @throws \Assert\AssertionFailedException
     */
    public static function base64($value, $message = null, $propertyPath = null)
    {
        if (false === \base64_decode($value, true)) {
            $message = \sprintf(static::generateMessage($message ?: 'Value "%s" is not a valid base64 string.'), $value);

            throw static::createException($value, $message, static::INVALID_BASE64, $propertyPath);
        }

        return true;
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
                if ('message' !== $parameter->getName()) {
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
