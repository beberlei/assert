# Change Log
All notable changes to this project will be documented in this file.

## 3.2.7 - 2019-12-19

### Fixes
- Reinstated the `@method` return type for `Assert\LazyAssertion` methods to show that the return type is `LazyAssertion`.

## 3.2.6 - 2019-10-10

### Fixes
- Make `Assert\Assertion::stringify()` UTF-8 safe (Thanks to [Pedram Azimaei](https://github.com/beberlei/assert/pull/290))

## 3.2.5 - 2019-10-10 - Fix the broken things release.

### Notice
- Sigh!
  - Richard Quadling

### Fixes
- REALLY Removed dependency of the intl extension.
- Updated the Docblocks for `Assert\Assertion::all()` helper to show that the value is expected to be an array.

## 3.2.4 - 2019-10-10 - Fix the broken things release.

### Notice
- It seems I've been slightly lax in verifying the signature changes and expected extensions.
  Hopefully, both of these have been fixed in this version.
  Truly sorry for breaking the internet!
  - Richard Quadling

### Fixes
- Restored `\Assert\Assertion::createException()` signature to 3.2.2.
- Removed dependency of the intl extension. If the extension is available, then `Assert\Assertion::count()`,
  `Assert\Assertion::isCountable()`, `Assert\Assertion::minCount()`, and `Assert\Assertion::maxCount()` will operate on
  `ResourceBundles`.
- Fixed the `@method` return type for `Assert\LazyAssertion` methods to show that the return type is `static` for
  extensions of `Assert\LazyAssertion`.  
  *NOTE :* Docblock does not have the ability to differentiate between a non static `@method` whose returns type is of
  the subclass and a `@method` that is called statically ([PSR-5#899](https://github.com/php-fig/fig-standards/pull/899)).
  So the use of `static static` is a fudge that sort of works for IDEs that need to know about the method that MAY be
  overridden in a subclass.

## 3.2.3 - 2019-08-23

### Other changes
- Added type hints and documentation consistency (Thanks to [Andru Cherny](https://github.com/beberlei/assert/pull/286))

## 3.2.2 - 2019-08-23

### Added assertions
- `Assertion::eqArraySubset()` (Thanks to [Anna Filina](https://github.com/beberlei/assert/pull/283))

## 3.2.1 - 2019-05-28

### Fixes
- Updated regex for `Assert\Assertion::url()` (Thanks to [Christophe Histaesse](https://github.com/beberlei/assert/pull/281))
- Fixed broken regex for `Assert\Assertion::url()` (Thanks to [Menno Holtkamp](https://github.com/beberlei/assert/issues/275))

### Other changes
- Added PHP 7.3.0, PHP 7.3.1, and PHP 7.3.2 to Travis pipeline as there are differences in PCRE
- Updated docblocks for `Assert\Assertion::NullOrXxxx()` to show that the first parameter can be null.
- Updated docblocks for `Assert\LazyAssertion` to show that the return type is `$this` to aid IDE's static analysis.

## 3.2.0 - 2018-12-24

### Added assertions
- `Assertion::isCountable()` (Thanks to [Baptiste Clavié](https://github.com/beberlei/assert/pull/268))
- `Assertion::maxCount()` (Thanks to [Baptiste Clavié](https://github.com/beberlei/assert/pull/269))
- `Assertion::minCount()` (Thanks to [Baptiste Clavié](https://github.com/beberlei/assert/pull/269))
- `Assertion::nonContains()` (Thanks to [Baptiste Clavié](https://github.com/beberlei/assert/pull/270))

### Other changes
- Added PHP 7.3 to Travis pipeline
- Added support for `\ResourceBundle` and `\SimpleXMLElement` to `Assertion::count()`.

## 3.1.0 - 2018-10-29

### Other changes
- Refactor assertion messages for `Assert\Assertion::notEq()`, `Assert\Assertion::notSame()`, and `Assert\Assertion::notInArray()` (Thanks to [Rick Kuipers](https://github.com/beberlei/assert/pull/259))

## 3.0.1 - 2018-07-04

### Added assertions
- `Assertion::notRegex()` (Thanks to [Thomas Müller](https://github.com/beberlei/assert/pull/261))

### Other changes
- Upgraded regex and unit tests for `Assert\Assertion::url()` to latest from Symfony/Validator

## 3.0.0 - 2018-07-04

### Changes
- Deprecate support for PHP < 7.0

### Fixes
- An `AssertionFailedException` must be a `Throwable` (Thanks to [Marco Pivetta](https://github.com/beberlei/assert/pull/256))

## 2.9.8 - 2019-05-28

### Fixes
- Updated regex for `Assert\Assertion::url()` (Thanks to [Christophe Histaesse](https://github.com/beberlei/assert/pull/281))

## 2.9.7 - 2019-02-19

### Fixes
- Fixed broken regex for `Assert\Assertion::url()` (Thanks to [Menno Holtkamp](https://github.com/beberlei/assert/issues/275))

## 2.9.6 - 2018-04-16

### Fixes
- Made constraints in exceptions consistent for all assertions (Thanks to [Peter Kruithof](https://github.com/beberlei/assert/pull/255))

## 2.9.5 - 2018-04-16

### Fixes
- Remove DocBlock entry causing exception in third party DocBlock parser (Thanks to [Koutsoumpos Valantis](https://github.com/beberlei/assert/issues/251))

## 2.9.4 - 2018-04-09

### Fixes
- Prevent date overflow in Assertion::date() by reset preset date value (Thanks to [Nobuhiro Nakamura](https://github.com/beberlei/assert/issues/250))

## 2.9.3 - 2018-03-16

### Changes
- Expand error for `\Assert\Assertion::count()` to include the supplied count (Thanks to [Yoann Blot](https://github.com/beberlei/assert/issues/247))

## 2.9.2 - 2018-01-25

### Fixes
- Usage of custom extended Assertion class in LazyAssertion (Thanks to [Marek Štípek](https://github.com/beberlei/assert/pull/245))

## 2.9.1 - 2018-01-25

### Deprecation notice
- Support for PHP 5 will be dropped at the end of 2018, in line with PHP's [supported versions](http://php.net/supported-versions.php). 

### Fixes
- `\Assert\Assertion::generateMessage()` will now receive the default message for an assertion if one is not supplied (Thanks to [Romans Malinovskis](https://github.com/beberlei/assert/issues/225))

## 2.8.1 - 2017-11-30

### Fixes
- `Assertion::integerish()` has had several issues in the last couple of versions.  
  Hopefully these are now fixed.
  Thanks to [Erik Roelofs](https://github.com/beberlei/assert/issues/243) and [Michał Mleczko](https://github.com/beberlei/assert/issues/240)

### Deprecation notice
- The functions `\Assert\that()`, `\Assert\thatAll()`, `\Assert\thatNullOr()`, and `\Assert\lazy()` are no longer marked as deprecated.  
  Both the functional and static constructors work together. Whichever you wish to use is a personal preference.  

## 2.7.11 - 2017-11-13

### Fixes
- `Assertion::integerish(0)` and `Assertion::integerish('0')` now assert correctly.

## 2.7.10 - 2017-11-13

### Added assertions
- `Assertion::base64()` (Thanks to [Pablo Kowalczyk](https://github.com/beberlei/assert/pull/232))

## 2.7.9 - 2017-11-13

### Fixes
- `Assertion::integerish()` now correctly asserts integers with leading zeros in strings (Thanks to [Albert Casademont](https://github.com/beberlei/assert/pull/227#issuecomment-343961009))

## 2.7.8 - 2017-10-20

### Fixes
- `Assertion::integerish()` now throws exception as expected (Thanks to [Thomas Flack](https://github.com/beberlei/assert/issues/235))

## 2.7.7 - 2017-10-18

### Fixes
- Basic Auth usernames and passwords can contain '.' (Thanks to [Fede Isas](https://github.com/beberlei/assert/issues/234))

## 2.7.6 - 2017-05-04

### Fixes
- Fixed stringification of booleans (Thanks to [Philipp Rieber](https://github.com/beberlei/assert/issues/226))

## 2.7.5 - 2017-04-29
### Added assertions
- `Assert\Assertion:isResource()` (Thanks to [Timothy Younger](https://github.com/beberlei/assert/pull/222))

### Other changes
- Corrected doc-block for `Assert\Assertion::propertiesExist()`.

## 2.7.4 - 2017-03-14
### Added assertions
- `Assert\Assertion::objectOrClass()` (Thanks to [Timothy Younger](https://github.com/beberlei/assert/pull/218))
- `Assert\Assertion::propertyExists()` (Thanks to [Timothy Younger](https://github.com/beberlei/assert/pull/218))
- `Assert\Assertion::propertiesExist()` (Thanks to [Timothy Younger](https://github.com/beberlei/assert/pull/218))

### Other changes
- Unit tests no longer using deprecated exception methods (Thanks to [Richard Quadling](https://github.com/beberlei/assert/pull/217))
- All global namespaced functions have been optimised (Thanks to [Andreas Möller](https://github.com/beberlei/assert/pull/211))

## 2.7.3 - 2017-01-24

### Fixes
- Fix `Assert\Assertion::integerish()` when used with a resource (Thanks to [manuxi](https://github.com/beberlei/assert/issues/206))

## 2.7.2 - 2017-01-09

### Fixes
- Backward compatibility fixes for PHP 5.3

## 2.7.1 - 2017-01-06
### Added assertions
- `Assert\Assertion::extensionVersion()` (Thanks to [Timothy Younger](https://github.com/beberlei/assert/pull/205))
- `Assert\Assertion::phpVersion()` (Thanks to [Timothy Younger](https://github.com/beberlei/assert/pull/203))
- `Assert\Assertion::version()` (Thanks to [Timothy Younger](https://github.com/beberlei/assert/pull/203))

### Other changes
- Exception messages can now be constructed via a callback.
- Documentation now includes types.

## 2.6.9 - 2017-01-04
### Added assertions
- `Assert\Assertion::defined()` (Thanks to [Timothy Younger](https://github.com/beberlei/assert/pull/193))
- `Assert\Assertion::extensionLoaded()` (Thanks to [Timothy Younger](https://github.com/beberlei/assert/pull/201))

### Other changes
- Added types to generated documentation.
- Added PHPStan analysis for PHP 7+

## 2.6.8 - 2016-12-05

### Fixes
- All exceptions thrown by this library extend `\Assert\InvalidArgumentException` (Thanks to [Richard Quadling](https://github.com/beberlei/assert/pull/187))

### Other changes
- Update to php-cs-fixer ^2.0 release (Thanks to [Raphael Stolt](https://github.com/beberlei/assert/pull/188))
- Simplify XDebug disabling for Travis (Thanks to [Raphael Stolt](https://github.com/beberlei/assert/pull/189))
- Use PSR-4 autoloading (Thanks to [Andreas Möller](https://github.com/beberlei/assert/pull/190))
- Enable Composer package sorting (Thanks to [Raphael Stolt](https://github.com/beberlei/assert/pull/191))
- Fix grammar in documentation (Thanks to [Adrian Föder](https://github.com/beberlei/assert/pull/192))

## 2.6.7 - 2016-11-14

### Fixes
- [Fix the interfaceExists assertion](https://github.com/beberlei/assert/pull/182)
- Fixed issue in document generator (Thanks to [Taco van den Broek](https://github.com/tacovandenbroek))

### Other changes
- [Added ability to capture multiple errors on a single value in a chain](https://github.com/beberlei/assert/pull/186) (Thanks to [Alec Carpenter](https://github.com/alecgunnar))
- [Use static factory methods instead of functions in the Assert namespace](https://github.com/beberlei/assert/pull/184) (Thanks to [Taco van den Broek](https://github.com/tacovandenbroek))

### Deprecation notice
- The functions in the Assert namespace (`\Assert\that()`, `\Assert\thatAll()`, `\Assert\thatNullOr()` and `\Assert\lazy()`) are now marked as deprecated.
  They will be removed in the next major release.
  They have been replaced with the static methods `\Assert\Assert::that()`, `\Assert\Assert::thatAll()`, `\Assert\Assert::thatNullOr()` and `\Assert\Assert::lazy()`
  
## 2.6.6 - 2016-10-31

### Other changes
- [Make all assertions return true on success, so that it can be used inside PHP 7 assert()](https://github.com/beberlei/assert/issues/136)

## 2.6.5 - 2016-10-11
### Added assertions
- `Assert\Assertion::between()`
- `Assert\Assertion::betweenExclusive()`

### Fixes
- Allow `http://localhost` as a valid URL - fixes [Assertion::url('http://localhost') not a valid url?](https://github.com/beberlei/assert/issues/133)

### Other changes
- Upgraded regex and unit tests for `Assert\Assertion::url()` to latest from Symfony/Validator
- Added PHP-CS
- Speed up of builds for Travis

## 2.6.4 - 2016-10-03
### Added assertions
- `Assert\Assertion::e164()` - The international public telecommunication numbering plan
- `Assert\Assertion::interfaceExists()`
- `Assert\Assertion::ip()` / `Assert\Assertion::ipv4()` / `Assert\Assertion::ipv6()`
- `Assert\Assertion::keyNotExists()`
- `Assert\Assertion::null()`
- `Assert\Assertion::satisfy()` - Allows for a bespoke assertion, rather than a predefined one

### Fixes
- Improved the reporting of the value for min and max assertions

### Other changes
- Removed `composer.lock` file from library
- Improved travis build to detect incorrect documentation changes

## 2.6.3 - 2016-07-28
### Added assertions
- `Assert\Assertion::notInArray()`

### Fixes
- Made `Assert\Assertion::INVALID_GREATER_OR_EQUAL` unique

### Other changes
- Introduced [CONTRIBUTING.md](https://github.com/beberlei/assert/blob/v2.6.3/CONTRIBUTING.md) to get contributors to generate the docblocks when a new assertion is added
- Introduced [.editorconfig](https://github.com/beberlei/assert/blob/v2.6.3/.editorconfig) to allow IDEs that support EditorConfig to provide a consistent code style. 
  See [EditorConfig](http://editorconfig.org/) for further details
- Additional tests and updated documentation.
- Travis updates. 

## 2.6.2 - 2016-07-26
### Fixes
- Fixed unit test to work with PHP 5.3

## 2.6.1 - 2016-07-26
### Fixes
- Fixed `Assertion::isCallable()` to with with PHP 5.3

## 2.6 - 2016-07-26
### Added assertions
- `Assert\Assertion::isCallable()`

## 2.5.2 - 2016-07-26
### Other changes
- Updated tests
- Updated `generate_method_docs.php` and regenerated all documentation
- Added Richard Quadling as collaborator

## 2.5.1 - 2016-05-20
### Other changes
- Updated missing assertions from documentation

## 2.5 - 2016-03-22
### Added assertions
- `Assert\Assertion::date()`

### Other changes
- Added appropriate guards to the additional assert functions to stop them from being defined twice

## 2.4 - 2015-08-21
### Added assertions
- `Assert\Assertion::lessThan()`
- `Assert\Assertion::lessOrEqualThan()`
- `Assert\Assertion::greaterThan()`
- `Assert\Assertion::greaterOrEqualThan()`

### Other changes
- Added support for PHP 5.6 and PHP 7.0 to Travis

## 2.3 - 2015-12-18
### Added assertions
- `Assert\Assertion::isTraversable()`
- `Assert\Assertion::isArrayAccessible()`
- `Assert\Assertion::keyIsset()` 

## 2.2 - 2015-12-18
### Other changes
- Used parameterised `sprintf()` for messages

## 2.1 - 2015-11-06
### Added assertions
- `Assert\Assertion::notEq()`
- `Assert\Assertion::notSame()`
- `Assert\Assertion::scalar()`
- `Assert\Assertion::choicesNotEmpty()`
- `Assert\Assertion::methodExists()`
- `Assert\Assertion::isObject()`

## 2.0.1 - 2014-01-26
### Other changes
- Pass constraints and values to `Assert\AssertionFailedException`

## 2.0 - 2014-01-26
### Other changes
- Introduce AssertionChaining and LazyAssertions
- Introduce `Assert\Assertion::stringify()` to make a string version of a value

## 1.7 - 2014-01-25
### Added assertions
- `Assert\Assertion::float()`

### Other changes
- Added support for HHVM to Travis

## 1.6 - 2013-11-05
### Added assertions
- `Assert\Assertion::count()`

### Other changes
- Added support for PHP 5.5 to Travis

## 1.5 - 2013-10-01
### Added assertions
- `Assert\Assertion::notEmptyKey()`
- `Assert\Assertion::all....()`


## 1.4 - 2013-07-07
### Added assertions
- `Assert\Assertion::noContent()`
- `Assert\Assertion::endsWith()`
- `Assert\Assertion::notIsInstanceOf()`
- `Assert\Assertion::isJsonString()`
- `Assert\Assertion::uuid()`

### Other changes
- Added BSD-2 License

## 1.3 - 2013-03-02
### Added assertions
- `Assert\Assertion::length()`
- `Assert\Assertion::url()`
- `Assert\Assertion::false()`
- `Assert\Assertion::implementsInterface()`

### Other changes
- Travis now runs PHP Unit tests
- Added `Assert\InvalidArgumentException`
- Added `$encoding = 'UTF-8'` parameter to appropriate assertions

## 1.2 - 2012-07-23
### Added assertions
- `Assert\Assertion::nullOr....()`

## 1.1 - 2012-07-23
### Added assertions
- `Assert\Assertion::eq()`
- `Assert\Assertion::same()`
- `Assert\Assertion::inArray()`
- `Assert\Assertion::min()`
- `Assert\Assertion::max()`
- `Assert\Assertion::true()`
- `Assert\Assertion::classExists()`

### Other changes
- Added `$propertyPath = null` parameter to assertions
 
## 1.0 - 2012-05-20
### Added assertions
- `Assert\Assertion::integer()`
- `Assert\Assertion::digit()`
- `Assert\Assertion::integerish()`
- `Assert\Assertion::boolean()`
- `Assert\Assertion::notEmpty()`
- `Assert\Assertion::string()`
- `Assert\Assertion::regex()`
- `Assert\Assertion::minLength()`
- `Assert\Assertion::maxLength()`
- `Assert\Assertion::betweenLength()`
- `Assert\Assertion::startsWith()`
- `Assert\Assertion::contains()`
- `Assert\Assertion::choice()`
- `Assert\Assertion::isArray()`
- `Assert\Assertion::keyExists()`
- `Assert\Assertion::notBlank()`
- `Assert\Assertion::isInstanceOf()`
- `Assert\Assertion::subclassOf()`
- `Assert\Assertion::range()`
- `Assert\Assertion::file()`
- `Assert\Assertion::readable()`
- `Assert\Assertion::writeable()`
- `Assert\Assertion::email()`
- `Assert\Assertion::alnum()`
