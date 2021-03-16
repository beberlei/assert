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

namespace Assert\Tests;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Assert\Tests\Fixtures\CustomAssertion;
use Assert\Tests\Fixtures\OneCountable;
use PDO;
use ResourceBundle;
use SimpleXMLElement;
use stdClass;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class AssertTest extends TestCase
{
    public static function dataInvalidFloat()
    {
        return [
            [1],
            [false],
            ['test'],
            [null],
            ['1.23'],
            ['10'],
        ];
    }

    /**
     * @dataProvider dataInvalidFloat
     *
     * @param mixed $nonFloat
     */
    public function testInvalidFloat($nonFloat)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_FLOAT);
        Assertion::float($nonFloat);
    }

    public function testValidFloat()
    {
        $this->assertTrue(Assertion::float(1.0));
        $this->assertTrue(Assertion::float(0.1));
        $this->assertTrue(Assertion::float(-1.1));
    }

    public static function dataInvalidInteger()
    {
        return [
            [1.23],
            [false],
            ['test'],
            [null],
            ['1.23'],
            ['10'],
            [new \DateTime()],
        ];
    }

    /**
     * @dataProvider dataInvalidInteger
     *
     * @param mixed $nonInteger
     */
    public function testInvalidInteger($nonInteger)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_INTEGER);
        Assertion::integer($nonInteger);
    }

    public function testValidInteger()
    {
        $this->assertTrue(Assertion::integer(10));
        $this->assertTrue(Assertion::integer(0));
    }

    public function dataValidIntergerish()
    {
        return [
            [10],
            ['10'],
            [-10],
            ['-10'],
            [0123],
            ['0123'],
            [0],
            ['0'],
            [00123],
            ['00123'],
            [00],
            ['00'],
            ['0040'],
        ];
    }

    /**
     * @param mixed $value
     *
     * @throws AssertionFailedException
     * @dataProvider dataValidIntergerish
     */
    public function testValidIntegerish($value)
    {
        $this->assertTrue(Assertion::integerish($value));
    }

    public static function dataInvalidIntegerish()
    {
        return [
            'A float' => [1.23],
            'Boolean true' => [true],
            'Boolean false' => [false],
            'A text string' => ['test'],
            'A null' => [null],
            'A float in a string' => ['1.23'],
            'A negative float in a string' => ['-1.23'],
            'A file pointer' => [\fopen(__FILE__, 'r')],
            'A float in a string with a leading space' => [' 1.23'],
            'An integer in a string with a leading space' => [' 123'],
            'A negative integer in a string with a leading space' => [' -123'],
            'An integer in a string with a trailing space' => ['456 '],
            'A negative integer in a string with a trailing space' => ['-456 '],
            'An array' => [[]],
            'An object' => [new stdClass()],
            'A float that is less than 1' => [0.1],
            'A float that is less than 0.1' => [0.01],
            'A float that is less than 0.01' => [0.001],
            'A float in a string that is less than 1' => ['0.1'],
            'A float in a string that is less than 0.1' => ['0.01'],
            'A float in a string that is less than 0.01' => ['0.001'],
            'An empty string' => [''],
            'A single space string' => [' '],
            'A multiple spaced string' => ['  '],
        ];
    }

    /**
     * @dataProvider dataInvalidIntegerish
     *
     * @param mixed $nonInteger
     */
    public function testInvalidIntegerish($nonInteger)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_INTEGERISH);
        Assertion::integerish($nonInteger);
    }

    public function testValidBoolean()
    {
        $this->assertTrue(Assertion::boolean(true));
        $this->assertTrue(Assertion::boolean(false));
    }

    public function testInvalidBoolean()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_BOOLEAN);
        Assertion::boolean(1);
    }

    public function testInvalidScalar()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_SCALAR);
        Assertion::scalar(new stdClass());
    }

    public function testValidScalar()
    {
        $this->assertTrue(Assertion::scalar('foo'));
        $this->assertTrue(Assertion::scalar(52));
        $this->assertTrue(Assertion::scalar(12.34));
        $this->assertTrue(Assertion::scalar(false));
    }

    public static function dataInvalidNotEmpty()
    {
        return [
            [''],
            [false],
            [0],
            [null],
            [[]],
        ];
    }

    /**
     * @dataProvider dataInvalidNotEmpty
     *
     * @param mixed $value
     */
    public function testInvalidNotEmpty($value)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::VALUE_EMPTY);
        Assertion::notEmpty($value);
    }

    public function testNotEmpty()
    {
        $this->assertTrue(Assertion::notEmpty('test'));
        $this->assertTrue(Assertion::notEmpty(1));
        $this->assertTrue(Assertion::notEmpty(true));
        $this->assertTrue(Assertion::notEmpty(['foo']));
    }

    public function testEmpty()
    {
        $this->assertTrue(Assertion::noContent(''));
        $this->assertTrue(Assertion::noContent(0));
        $this->assertTrue(Assertion::noContent(false));
        $this->assertTrue(Assertion::noContent([]));
    }

    public static function dataInvalidEmpty()
    {
        return [
            ['foo'],
            [true],
            [12],
            [['foo']],
            [new stdClass()],
        ];
    }

    /**
     * @dataProvider dataInvalidEmpty
     *
     * @param mixed $value
     */
    public function testInvalidEmpty($value)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::VALUE_NOT_EMPTY);
        Assertion::noContent($value);
    }

    public static function dataInvalidNull()
    {
        return [
            ['foo'],
            [''],
            [false],
            [12],
            [0],
            [[]],
        ];
    }

    /**
     * @dataProvider dataInvalidNull
     *
     * @param mixed $value
     */
    public function testInvalidNull($value)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::VALUE_NOT_NULL);
        Assertion::null($value);
    }

    public function testNull()
    {
        $this->assertTrue(Assertion::null(null));
    }

    public function testNotNull()
    {
        $this->assertTrue(Assertion::notNull('1'));
        $this->assertTrue(Assertion::notNull(1));
        $this->assertTrue(Assertion::notNull(0));
        $this->assertTrue(Assertion::notNull([]));
        $this->assertTrue(Assertion::notNull(false));
    }

    public function testInvalidNotNull()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::VALUE_NULL);
        Assertion::notNull(null);
    }

    public function testString()
    {
        $this->assertTrue(Assertion::string('test-string'));
        $this->assertTrue(Assertion::string(''));
    }

    /**
     * @dataProvider dataInvalidString
     *
     * @param mixed $invalidString
     */
    public function testInvalidString($invalidString)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_STRING);
        Assertion::string($invalidString);
    }

    public static function dataInvalidString()
    {
        return [
            [1.23],
            [false],
            [new \ArrayObject()],
            [null],
            [10],
            [true],
        ];
    }

    public function testValidRegex()
    {
        $this->assertTrue(Assertion::regex('some string', '/.*/'));
    }

    public function testInvalidRegex()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_REGEX);
        Assertion::regex('foo', '(bar)');
    }

    public function testInvalidRegexValueNotString()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_STRING);
        Assertion::regex(['foo'], '(bar)');
    }

    public function testValidNotRegex()
    {
        $this->assertTrue(Assertion::notRegex('some string', '/[0-9]+/'));
    }

    public function testInvalidNotRegex()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_NOT_REGEX);
        Assertion::notRegex('some string', '/.*/');
    }

    public function testInvalidMinLength()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_MIN_LENGTH);
        Assertion::minLength('foo', 4);
    }

    public function testValidMinLength()
    {
        $this->assertTrue(Assertion::minLength('foo', 3));
        $this->assertTrue(Assertion::minLength('foo', 1));
        $this->assertTrue(Assertion::minLength('foo', 0));
        $this->assertTrue(Assertion::minLength('', 0));
        $this->assertTrue(Assertion::minLength('址址', 2));
    }

    public function testInvalidMaxLength()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_MAX_LENGTH);
        Assertion::maxLength('foo', 2);
    }

    public function testValidMaxLength()
    {
        $this->assertTrue(Assertion::maxLength('foo', 10));
        $this->assertTrue(Assertion::maxLength('foo', 3));
        $this->assertTrue(Assertion::maxLength('', 0));
        $this->assertTrue(Assertion::maxLength('址址', 2));
    }

    public function testInvalidBetweenLengthMin()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_MIN_LENGTH);
        Assertion::betweenLength('foo', 4, 100);
    }

    public function testInvalidBetweenLengthMax()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_MAX_LENGTH);
        Assertion::betweenLength('foo', 0, 2);
    }

    public function testValidBetweenLength()
    {
        $this->assertTrue(Assertion::betweenLength('foo', 0, 3));
        $this->assertTrue(Assertion::betweenLength('址址', 2, 2));
    }

    public function testInvalidStartsWith()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_STRING_START);
        Assertion::startsWith('foo', 'bar');
    }

    public function testInvalidStartsWithDueToWrongEncoding()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_STRING_START);
        Assertion::startsWith('址', '址址', null, null, 'ASCII');
    }

    public function testValidStartsWith()
    {
        $this->assertTrue(Assertion::startsWith('foo', 'foo'));
        $this->assertTrue(Assertion::startsWith('foo', 'fo'));
        $this->assertTrue(Assertion::startsWith('foo', 'f'));
        $this->assertTrue(Assertion::startsWith('址foo', '址'));
    }

    public function testInvalidEndsWith()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_STRING_END);
        Assertion::endsWith('foo', 'bar');
    }

    public function testInvalidEndsWithDueToWrongEncoding()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_STRING_END);
        Assertion::endsWith('址', '址址', null, null, 'ASCII');
    }

    public function testValidEndsWith()
    {
        $this->assertTrue(Assertion::endsWith('foo', 'foo'));
        $this->assertTrue(Assertion::endsWith('sonderbar', 'bar'));
        $this->assertTrue(Assertion::endsWith('opp', 'p'));
        $this->assertTrue(Assertion::endsWith('foo址', '址'));
    }

    public function testInvalidContains()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_STRING_CONTAINS);
        Assertion::contains('foo', 'bar');
    }

    public function testValidContains()
    {
        $this->assertTrue(Assertion::contains('foo', 'foo'));
        $this->assertTrue(Assertion::contains('foo', 'oo'));
    }

    public function testInvalidNotContains()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_STRING_NOT_CONTAINS);
        Assertion::notContains('foo', 'o');
    }

    public function testValidNotContains()
    {
        $this->assertTrue(Assertion::notContains('foo', 'bar'));
        $this->assertTrue(Assertion::notContains('foo', 'p'));
    }

    public function testInvalidChoice()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_CHOICE);
        Assertion::choice('foo', ['bar', 'baz']);
    }

    public function testValidChoice()
    {
        $this->assertTrue(Assertion::choice('foo', ['foo']));
    }

    public function testInvalidInArray()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_CHOICE);
        Assertion::inArray('bar', ['baz']);
    }

    public function testValidInArray()
    {
        $this->assertTrue(Assertion::inArray('foo', ['foo']));
    }

    public function testInvalidNumeric()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_NUMERIC);
        Assertion::numeric('foo');
    }

    public function testValidNumeric()
    {
        $this->assertTrue(Assertion::numeric('1'));
        $this->assertTrue(Assertion::numeric(1));
        $this->assertTrue(Assertion::numeric(1.23));
    }

    public static function dataInvalidArray()
    {
        return [
            [null],
            [false],
            ['test'],
            [1],
            [1.23],
            [new stdClass()],
            [\fopen('php://memory', 'r')],
        ];
    }

    /**
     * @dataProvider dataInvalidArray
     *
     * @param mixed $value
     */
    public function testInvalidArray($value)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_ARRAY);
        Assertion::isArray($value);
    }

    public function testValidArray()
    {
        $this->assertTrue(Assertion::isArray([]));
        $this->assertTrue(Assertion::isArray([1, 2, 3]));
        $this->assertTrue(Assertion::isArray([[], []]));
    }

    public function testInvalidKeyExists()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_KEY_EXISTS);
        Assertion::keyExists(['foo' => 'bar'], 'baz');
    }

    public function testValidKeyExists()
    {
        $this->assertTrue(Assertion::keyExists(['foo' => 'bar'], 'foo'));
    }

    public function testInvalidKeyNotExists()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_KEY_NOT_EXISTS);
        Assertion::keyNotExists(['foo' => 'bar'], 'foo');
    }

    public function testValidKeyNotExists()
    {
        $this->assertTrue(Assertion::keyNotExists(['foo' => 'bar'], 'baz'));
    }

    public static function dataInvalidUniqueValues()
    {
        $object = new \stdClass();

        return [
            [['foo' => 'bar', 'baz' => 'bar']],
            [[$object, $object]],
            [[$object, &$object]],
            [[true, true]],
            [[null, null]],
            [[1, $object, true, $object, 'foo']],
        ];
    }

    /**
     * @dataProvider dataInvalidUniqueValues
     */
    public function testInvalidUniqueValues($array)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_UNIQUE_VALUES);
        Assertion::uniqueValues($array, 'quux');
    }

    public static function dataValidUniqueValues()
    {
        $object = new \stdClass();

        return [
            [['foo' => 0, 'bar' => '0']],
            [[true, 'true', false, 'false', null, 'null']],
            [['foo', 'Foo', 'FOO']],
            [['foo', $object]],
            [[new \stdClass(), new \stdClass()]],
            [[&$object, new \stdClass()]],
        ];
    }

    /** @dataProvider dataValidUniqueValues */
    public function testValidUniqueValues($array)
    {
        $this->assertTrue(Assertion::uniqueValues($array, 'baz'));
    }

    public static function dataInvalidNotBlank()
    {
        return [
            [''],
            [' '],
            ["\t"],
            ["\n"],
            ["\r"],
            [false],
            [null],
            [[]],
        ];
    }

    /**
     * @dataProvider dataInvalidNotBlank
     *
     * @param mixed $notBlank
     */
    public function testInvalidNotBlank($notBlank)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_NOT_BLANK);
        Assertion::notBlank($notBlank);
    }

    public function testValidNotBlank()
    {
        $this->assertTrue(Assertion::notBlank('foo'));
    }

    public function testInvalidNotInstanceOf()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_NOT_INSTANCE_OF);
        Assertion::notIsInstanceOf(new stdClass(), stdClass::class);
    }

    public function testValidNotIsInstanceOf()
    {
        $this->assertTrue(Assertion::notIsInstanceOf(new stdClass(), PDO::class));
    }

    public function testInvalidInstanceOf()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_INSTANCE_OF);
        Assertion::isInstanceOf(new stdClass(), PDO::class);
    }

    public function testValidInstanceOf()
    {
        $this->assertTrue(Assertion::isInstanceOf(new stdClass(), stdClass::class));
    }

    public function testInvalidSubclassOf()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_SUBCLASS_OF);
        Assertion::subclassOf(new stdClass(), PDO::class);
    }

    public function testValidSubclassOf()
    {
        $this->assertTrue(Assertion::subclassOf(new Fixtures\ChildStdClass(), stdClass::class));
    }

    public function testInvalidRange()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_RANGE);
        Assertion::range(1, 2, 3);
        Assertion::range(1.5, 2, 3);
    }

    public function testValidRange()
    {
        $this->assertTrue(Assertion::range(1, 1, 2));
        $this->assertTrue(Assertion::range(2, 1, 2));
        $this->assertTrue(Assertion::range(2, 0, 100));
        $this->assertTrue(Assertion::range(2.5, 2.25, 2.75));
    }

    public function testInvalidEmail()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_EMAIL);
        Assertion::email('foo');
    }

    public function testValidEmail()
    {
        $this->assertTrue(Assertion::email('123hello+world@email.provider.com'));
    }

    /**
     * @dataProvider dataInvalidUrl
     *
     * @param string $url
     */
    public function testInvalidUrl($url)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_URL);
        Assertion::url($url);
    }

    public static function dataInvalidUrl()
    {
        return [
            ['google.com'],
            ['://google.com'],
            ['http ://google.com'],
            ['http:/google.com'],
            ['http://goog_le.com'],
            ['http://google.com::aa'],
            ['http://google.com:aa'],
            ['ftp://google.fr'],
            ['faked://google.fr'],
            ['http://127.0.0.1:aa/'],
            ['ftp://[::1]/'],
            ['http://[::1'],
            ['http://hello.☎/'],
            ['http://:password@symfony.com'],
            ['http://:password@@symfony.com'],
            ['http://username:passwordsymfony.com'],
            ['http://usern@me:password@symfony.com'],
        ];
    }

    /**
     * @dataProvider dataValidUrl
     *
     * @param string $url
     */
    public function testValidUrl($url)
    {
        $this->assertTrue(Assertion::url($url));
    }

    public static function dataValidUrl()
    {
        return [
            ['http://a.pl'],
            ['http://www.google.com'],
            ['http://www.google.com.'],
            ['http://www.google.museum'],
            ['https://google.com/'],
            ['https://google.com:80/'],
            ['http://www.example.coop/'],
            ['http://www.test-example.com/'],
            ['http://www.symfony.com/'],
            ['http://symfony.fake/blog/'],
            ['http://symfony.com/?'],
            ['http://symfony.com/search?type=&q=url+validator'],
            ['http://symfony.com/#'],
            ['http://symfony.com/#?'],
            ['http://www.symfony.com/doc/current/book/validation.html#supported-constraints'],
            ['http://very.long.domain.name.com/'],
            ['http://localhost/'],
            ['http://myhost123/'],
            ['http://127.0.0.1/'],
            ['http://127.0.0.1:80/'],
            ['http://[::1]/'],
            ['http://[::1]:80/'],
            ['http://[1:2:3::4:5:6:7]/'],
            ['http://sãopaulo.com/'],
            ['http://xn--sopaulo-xwa.com/'],
            ['http://sãopaulo.com.br/'],
            ['http://xn--sopaulo-xwa.com.br/'],
            ['http://пример.испытание/'],
            ['http://xn--e1afmkfd.xn--80akhbyknj4f/'],
            ['http://مثال.إختبار/'],
            ['http://xn--mgbh0fb.xn--kgbechtv/'],
            ['http://例子.测试/'],
            ['http://xn--fsqu00a.xn--0zwm56d/'],
            ['http://例子.測試/'],
            ['http://xn--fsqu00a.xn--g6w251d/'],
            ['http://例え.テスト/'],
            ['http://xn--r8jz45g.xn--zckzah/'],
            ['http://مثال.آزمایشی/'],
            ['http://xn--mgbh0fb.xn--hgbk6aj7f53bba/'],
            ['http://실례.테스트/'],
            ['http://xn--9n2bp8q.xn--9t4b11yi5a/'],
            ['http://العربية.idn.icann.org/'],
            ['http://xn--ogb.idn.icann.org/'],
            ['http://xn--e1afmkfd.xn--80akhbyknj4f.xn--e1afmkfd/'],
            ['http://xn--espaa-rta.xn--ca-ol-fsay5a/'],
            ['http://xn--d1abbgf6aiiy.xn--p1ai/'],
            ['http://☎.com/'],
            ['http://username:password@symfony.com'],
            ['http://user.name:password@symfony.com'],
            ['http://username:pass.word@symfony.com'],
            ['http://user.name:pass.word@symfony.com'],
            ['http://user-name@symfony.com'],
            ['http://symfony.com?'],
            ['http://symfony.com?query=1'],
            ['http://symfony.com/?query=1'],
            ['http://symfony.com#'],
            ['http://symfony.com#fragment'],
            ['http://symfony.com/#fragment'],
            ['http://symfony.com?query[]=1'],
            ['http://symfony.com/?query[]=1'],
            ['http://symfony.com?query[1]=1'],
            ['http://symfony.com/?query[2]=1'],
            ['http://symfony.com?query[1][]=1'],
            ['http://symfony.com/?query[2][]=1'],
            ['http://symfony.com?query[1][3]=1'],
            ['http://symfony.com/?query[2][4]=1'],
            ['http://symfony.com?query[1][3]=1&query[5][7]=2'],
            ['http://symfony.com/?query[2][4]=1&query[6][8]=2'],
        ];
    }

    public function testInvalidDigit()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_DIGIT);
        Assertion::digit(-1);
    }

    public function testValidDigit()
    {
        $this->assertTrue(Assertion::digit(1));
        $this->assertTrue(Assertion::digit(0));
        $this->assertTrue(Assertion::digit('0'));
    }

    public function testValidAlnum()
    {
        $this->assertTrue(Assertion::alnum('a'));
        $this->assertTrue(Assertion::alnum('a1'));
        $this->assertTrue(Assertion::alnum('aasdf1234'));
        $this->assertTrue(Assertion::alnum('a1b2c3'));
        $this->assertTrue(Assertion::alnum('1234567890'));
    }

    public function testInvalidAlnum()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_ALNUM);
        Assertion::alnum('_1a');
    }

    public function testValidTrue()
    {
        $this->assertTrue(Assertion::true(1 == 1));
    }

    public function testInvalidTrue()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_TRUE);
        Assertion::true(false);
    }

    public function testValidFalse()
    {
        $this->assertTrue(Assertion::false(1 == 0));
    }

    public function testInvalidFalse()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_FALSE);
        Assertion::false(true);
    }

    public function testInvalidClass()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_CLASS);
        Assertion::classExists(\Foo::class);
    }

    public function testValidClass()
    {
        $this->assertTrue(Assertion::classExists(\Exception::class));
    }

    public function testSame()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_SAME);
        $this->assertTrue(Assertion::same(1, 1));
        $this->assertTrue(Assertion::same('foo', 'foo'));
        $this->assertTrue(Assertion::same($obj = new stdClass(), $obj));

        Assertion::same(new stdClass(), new stdClass());
    }

    public function testEq()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_EQ);
        $this->assertTrue(Assertion::eq(1, '1'));
        $this->assertTrue(Assertion::eq('foo', true));
        $this->assertTrue(Assertion::eq($obj = new stdClass(), $obj));

        Assertion::eq('2', 1);
    }

    public function testNotEq()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_NOT_EQ);
        $this->assertTrue(Assertion::notEq('1', false));
        $this->assertTrue(Assertion::notEq(new stdClass(), []));

        Assertion::notEq('1', 1);
    }

    public function testNotSame()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_NOT_SAME);
        $this->assertTrue(Assertion::notSame('1', 2));
        $this->assertTrue(Assertion::notSame(new stdClass(), []));

        Assertion::notSame(1, 1);
    }

    public function testNotInArray()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_VALUE_IN_ARRAY);
        $this->assertTrue(Assertion::notInArray(6, \range(1, 5)));
        $this->assertTrue(Assertion::notInArray('a', \range('b', 'z')));

        Assertion::notInArray(1, \range(1, 5));
    }

    public function testMin()
    {
        $this->assertTrue(Assertion::min(1, 1));
        $this->assertTrue(Assertion::min(2, 1));
        $this->assertTrue(Assertion::min(2.5, 1));
    }

    /**
     * @dataProvider dataInvalidMin
     *
     * @param float|int $value
     * @param float|int $min
     */
    public function testInvalidMin($value, $min)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_MIN);
        $this->expectExceptionMessageMatches('/Number "(0\.5|0)" was expected to be at least "(1|2\.5)"/');
        Assertion::min($value, $min);
    }

    public function dataInvalidMin()
    {
        return [
            [0, 1],
            [0.5, 2.5],
        ];
    }

    public function testMax()
    {
        $this->assertTrue(Assertion::max(1, 1));
        $this->assertTrue(Assertion::max(0.5, 1));
        $this->assertTrue(Assertion::max(0, 1));
    }

    /**
     * @dataProvider dataInvalidMax
     *
     * @param float|int $value
     * @param float|int $min
     */
    public function testInvalidMax($value, $min)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_MAX);
        $this->expectExceptionMessageMatches('/Number "(2.5|2)" was expected to be at most "(1|0\.5)"/');
        Assertion::max($value, $min);
    }

    public function dataInvalidMax()
    {
        return [
            [2, 1],
            [2.5, 0.5],
        ];
    }

    public function testNullOr()
    {
        $this->assertTrue(Assertion::nullOrMax(null, 1));
        $this->assertTrue(Assertion::nullOrMax(null, 2));
    }

    public function testNullOrWithNoValueThrows()
    {
        $this->expectException('BadMethodCallException');
        $this->expectExceptionMessage('Missing the first argument.');
        Assertion::nullOrMax();
    }

    public function testLength()
    {
        $this->assertTrue(Assertion::length('asdf', 4));
        $this->assertTrue(Assertion::length('', 0));
    }

    public static function dataLengthUtf8Characters()
    {
        return [
            ['址', 1],
            ['ل', 1],
        ];
    }

    /**
     * @dataProvider dataLengthUtf8Characters
     *
     * @param string $value
     * @param int $expected
     */
    public function testLengthUtf8Characters($value, $expected)
    {
        $this->assertTrue(Assertion::length($value, $expected));
    }

    public function testLengthFailed()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_LENGTH);
        Assertion::length('asdf', 3);
    }

    public function testLengthFailedForWrongEncoding()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_LENGTH);
        Assertion::length('址', 1, null, null, 'ASCII');
    }

    public function testLengthValidForGivenEncoding()
    {
        $this->assertTrue(Assertion::length('址', 1, null, null, 'utf8'));
    }

    public function testFile()
    {
        $this->assertTrue(Assertion::file(__FILE__));
    }

    public function testFileWithEmptyFilename()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::VALUE_EMPTY);
        Assertion::file('');
    }

    public function testFileDoesNotExists()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_FILE);
        Assertion::file(__DIR__.'/does-not-exists');
    }

    public function testDirectory()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_DIRECTORY);
        $this->assertTrue(Assertion::directory(__DIR__));

        Assertion::directory(__DIR__.'/does-not-exist');
    }

    public function testReadable()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_READABLE);
        $this->assertTrue(Assertion::readable(__FILE__));

        Assertion::readable(__DIR__.'/does-not-exist');
    }

    public function testWriteable()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_WRITEABLE);
        $this->assertTrue(Assertion::writeable(\sys_get_temp_dir()));

        Assertion::writeable(__DIR__.'/does-not-exist');
    }

    public function testFailedNullOrMethodCall()
    {
        $this->expectException('BadMethodCallException');
        $this->expectExceptionMessage('No assertion');
        Assertion::nullOrAssertionDoesNotExist('');
    }

    public function testImplementsInterface()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INTERFACE_NOT_IMPLEMENTED);
        $this->assertTrue(Assertion::implementsInterface(\ArrayIterator::class, \Traversable::class));

        Assertion::implementsInterface(\Exception::class, \Traversable::class);
    }

    public function testImplementsInterfaceWithClassObject()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INTERFACE_NOT_IMPLEMENTED);
        $class = new \ArrayObject();

        $this->assertTrue(Assertion::implementsInterface($class, \Traversable::class));

        Assertion::implementsInterface($class, \SplObserver::class);
    }

    public function testImplementsInterfaceThrowsExceptionForInvalidSubject()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INTERFACE_NOT_IMPLEMENTED);
        $this->expectExceptionMessage('Class "not_a_class" failed reflection');
        $this->assertTrue(Assertion::implementsInterface('not_a_class', \Traversable::class));

        Assertion::implementsInterface(\Exception::class, \Traversable::class);
    }

    /**
     * @dataProvider isJsonStringDataprovider
     *
     * @param mixed $content
     */
    public function testIsJsonString($content)
    {
        $this->assertTrue(Assertion::isJsonString($content));
    }

    public static function isJsonStringDataprovider()
    {
        return [
            '»null« value' => [\json_encode(null)],
            '»false« value' => [\json_encode(false)],
            'array value' => ['["false"]'],
            'object value' => ['{"tux":"false"}'],
        ];
    }

    /**
     * @dataProvider isJsonStringInvalidStringDataprovider
     *
     * @param mixed $invalidString
     */
    public function testIsJsonStringExpectingException($invalidString)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_JSON_STRING);
        Assertion::isJsonString($invalidString);
    }

    public static function isJsonStringInvalidStringDataprovider()
    {
        return [
            'no json string' => ['invalid json encoded string'],
            'error in json string' => ['{invalid json encoded string}'],
        ];
    }

    /**
     * @dataProvider providesValidUuids
     *
     * @param string $uuid
     */
    public function testValidUuids($uuid)
    {
        $this->assertTrue(Assertion::uuid($uuid));
    }

    /**
     * @dataProvider providesInvalidUuids
     *
     * @param string $uuid
     */
    public function testInvalidUuids($uuid)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_UUID);
        Assertion::uuid($uuid);
    }

    public static function providesValidUuids()
    {
        return [
            ['ff6f8cb0-c57d-11e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-31e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-41e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-51e1-9b21-0800200c9a66'],
            ['FF6F8CB0-C57D-11E1-9B21-0800200C9A66'],
            ['00000000-0000-0000-0000-000000000000'],
        ];
    }

    public static function providesInvalidUuids()
    {
        return [
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66'],
            ['af6f8cb0c57d11e19b210800200c9a66'],
            ['ff6f8cb0-c57da-51e1-9b21-0800200c9a66'],
            ['af6f8cb-c57d-11e1-9b21-0800200c9a66'],
            ['3f6f8cb0-c57d-11e1-9b21-0800200c9a6'],
        ];
    }

    /**
     * @dataProvider providesValidE164s
     *
     * @param string $e164
     */
    public function testValidE164s($e164)
    {
        $this->assertTrue(Assertion::e164($e164));
    }

    /**
     * @dataProvider providesInvalidE164s
     *
     * @param string $e164
     */
    public function testInvalidE164s($e164)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_E164);
        Assertion::e164($e164);
    }

    public static function providesValidE164s()
    {
        return [
            ['+33626525690'],
            ['33626525690'],
            ['+16174552211'],
        ];
    }

    public static function providesInvalidE164s()
    {
        return [
            ['+3362652569e'],
            ['+3361231231232652569'],
        ];
    }

    public function testValidNotEmptyKey()
    {
        $this->assertTrue(Assertion::notEmptyKey(['keyExists' => 'notEmpty'], 'keyExists'));
    }

    public function testInvalidNotEmptyKeyEmptyKey()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::VALUE_EMPTY);
        Assertion::notEmptyKey(['keyExists' => ''], 'keyExists');
    }

    public function testInvalidNotEmptyKeyKeyNotExists()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_KEY_ISSET);
        Assertion::notEmptyKey(['key' => 'notEmpty'], 'keyNotExists');
    }

    public function testAllWithSimpleAssertion()
    {
        $this->assertTrue(Assertion::allTrue([true, true]));
    }

    public function testAllWithSimpleAssertionThrowsExceptionOnElementThatFailsAssertion()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_TRUE);
        Assertion::allTrue([true, false]);
    }

    public function testAllWithComplexAssertion()
    {
        $this->assertTrue(Assertion::allIsInstanceOf([new stdClass(), new stdClass()], stdClass::class));
    }

    public function testAllWithComplexAssertionThrowsExceptionOnElementThatFailsAssertion()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_INSTANCE_OF);
        Assertion::allIsInstanceOf([new stdClass(), new stdClass()], PDO::class, 'Assertion failed', 'foos');
    }

    public function testAllWithNoValueThrows()
    {
        $this->expectException('BadMethodCallException');
        Assertion::allTrue();
    }

    public function testValidCount()
    {
        $this->assertTrue(Assertion::count(['Hi'], 1));
        $this->assertTrue(Assertion::count(['Hi', 'There'], 2));
        $this->assertTrue(Assertion::count(new Fixtures\OneCountable(), 1));
        $this->assertTrue(Assertion::count(new SimpleXMLElement('<a><b /><c /></a>'), 2));
        // Test ResourceBundle counting using resources generated for PHP testing of ResourceBundle
        // https://github.com/php/php-src/commit/8f4337f2551e28d98290752e9ca99fc7f87d93b5
        $this->assertTrue(Assertion::count(new ResourceBundle('en_US', __DIR__.'/_files/ResourceBundle'), 6));
    }

    public static function dataInvalidCount()
    {
        return [
            [['Hi', 'There'], 3],
            [new Fixtures\OneCountable(), 2],
            [new Fixtures\OneCountable(), 0],
            [[], 2],
        ];
    }

    /**
     * @dataProvider dataInvalidCount
     *
     * @param mixed $countable
     * @param int $count
     */
    public function testInvalidCount($countable, $count)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_COUNT);
        $this->expectExceptionMessageMatches('/List does not contain exactly \d+ elements \(\d+ given\)./');
        Assertion::count($countable, $count);
    }

    public function testValidMinCount()
    {
        $this->assertTrue(Assertion::minCount(['Hi'], 1));
        $this->assertTrue(Assertion::minCount(['Hi', 'There'], 1));
        $this->assertTrue(Assertion::minCount(new Fixtures\OneCountable(), 1));
        $this->assertTrue(Assertion::minCount(new SimpleXMLElement('<a><b /><c /></a>'), 1));
        $this->assertTrue(Assertion::minCount(new ResourceBundle('en_US', __DIR__.'/_files/ResourceBundle'), 2));
    }

    public static function dataInvalidMinCount()
    {
        return [
            '2 elements while at least 3 expected' => [['Hi', 'There'], 3],
            '1 countable while at least 2 expected' => [new Fixtures\OneCountable(), 2],
            '2 countable while at least 3 expected' => [new SimpleXMLElement('<a><b /><c /></a>'), 3],
            '6 countable while at least 7 expected' => [new ResourceBundle('en_US', __DIR__.'/_files/ResourceBundle'), 7],
        ];
    }

    /**
     * @dataProvider dataInvalidMinCount
     *
     * @param mixed $countable
     * @param int $count
     */
    public function testInvalidMinCount($countable, $count)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_MIN_COUNT);
        $this->expectExceptionMessageMatches('/List should have at least \d+ elements, but has \d elements./');
        Assertion::minCount($countable, $count);
    }

    public function testValidMaxCount()
    {
        $this->assertTrue(Assertion::maxCount(['Hi'], 1));
        $this->assertTrue(Assertion::maxCount(['Hi', 'There'], 2));
        $this->assertTrue(Assertion::maxCount(new Fixtures\OneCountable(), 1));
        $this->assertTrue(Assertion::maxCount(new SimpleXMLElement('<a><b /><c /></a>'), 3));
        $this->assertTrue(Assertion::maxCount(new ResourceBundle('en_US', __DIR__.'/_files/ResourceBundle'), 7));
    }

    public static function dataInvalidMaxCount()
    {
        return [
            '2 elements while at most 1 expected' => [['Hi', 'There'], 1],
            '1 countable while at most 0 expected' => [new Fixtures\OneCountable(), 0],
            '2 countable while at most 1 expected' => [new SimpleXMLElement('<a><b /><c /></a>'), 1],
            '6 countable while at most 5 expected' => [new ResourceBundle('en_US', __DIR__.'/_files/ResourceBundle'), 5],
        ];
    }

    /**
     * @dataProvider dataInvalidMaxCount
     */
    public function testInvalidMaxCount($countable, $count)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_MAX_COUNT);
        $this->expectExceptionMessageMatches('/List should have at most \d+ elements, but has \d elements./');
        Assertion::maxCount($countable, $count);
    }

    public function testChoicesNotEmpty()
    {
        $this->assertTrue(
            Assertion::choicesNotEmpty(
                ['tux' => 'linux', 'Gnu' => 'dolphin'],
                ['tux']
            )
        );
    }

    /**
     * @dataProvider invalidChoicesProvider
     *
     * @param mixed $values
     * @param mixed $choices
     */
    public function testChoicesNotEmptyExpectingExceptionEmptyValue($values, $choices)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::VALUE_EMPTY);
        Assertion::choicesNotEmpty($values, $choices);
    }

    public function testChoicesNotEmptyExpectingExceptionInvalidKeyIsset()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_KEY_ISSET);
        Assertion::choicesNotEmpty(['tux' => ''], ['invalidChoice']);
    }

    public function invalidChoicesProvider()
    {
        return [
            'empty values' => [[], ['tux'], Assertion::VALUE_EMPTY],
            'empty recodes in $values' => [['tux' => ''], ['tux'], Assertion::VALUE_EMPTY],
        ];
    }

    public function testIsObject()
    {
        $this->assertTrue(Assertion::isObject(new stdClass()));
    }

    public function testIsObjectExpectingException()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_OBJECT);
        Assertion::isObject('notAnObject');
    }

    public function testMethodExists()
    {
        $this->assertTrue(Assertion::methodExists('methodExists', new Assertion()));
    }

    public function testMethodExistsFailure()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_METHOD);
        Assertion::methodExists('methodNotExists', new Assertion());
    }

    public function testThatAssertionExceptionCanAccessValueAndSupplyConstraints()
    {
        try {
            Assertion::range(0, 10, 20);

            $this->fail('Exception expected');
        } catch (AssertionFailedException $e) {
            $this->assertEquals(0, $e->getValue());
            $this->assertEquals(['min' => 10, 'max' => 20], $e->getConstraints());
        }
    }

    public function testLessThan()
    {
        $this->assertTrue(Assertion::lessThan(1, 2));
        $this->assertTrue(Assertion::lessThan('aaa', 'bbb'));
        $this->assertTrue(Assertion::lessThan('aaa', 'aaaa'));
        $this->assertTrue(Assertion::lessThan(new \DateTime('today'), new \DateTime('tomorrow')));
    }

    public function invalidLessProvider()
    {
        return [
            [2, 1],
            [2, 2],
            ['aaa', 'aaa'],
            ['aaaa', 'aaa'],
            [new \DateTime('today'), new \DateTime('yesterday')],
            [new \DateTime('today'), new \DateTime('today')],
        ];
    }

    /**
     * @dataProvider invalidLessProvider
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testLessThanThrowsException($value, $limit)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_LESS);
        Assertion::lessThan($value, $limit);
    }

    public function testLessOrEqualThan()
    {
        $this->assertTrue(Assertion::lessOrEqualThan(1, 2));
        $this->assertTrue(Assertion::lessOrEqualThan(1, 1));
        $this->assertTrue(Assertion::lessOrEqualThan('aaa', 'bbb'));
        $this->assertTrue(Assertion::lessOrEqualThan('aaa', 'aaaa'));
        $this->assertTrue(Assertion::lessOrEqualThan('aaa', 'aaa'));
        $this->assertTrue(Assertion::lessOrEqualThan(new \DateTime('today'), new \DateTime('tomorrow')));
        $this->assertTrue(Assertion::lessOrEqualThan(new \DateTime('today'), new \DateTime('today')));
    }

    public function invalidLessOrEqualProvider()
    {
        return [
            [2, 1],
            ['aaaa', 'aaa'],
            [new \DateTime('today'), new \DateTime('yesterday')],
        ];
    }

    /**
     * @dataProvider invalidLessOrEqualProvider
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testLessOrEqualThanThrowsException($value, $limit)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_LESS_OR_EQUAL);
        Assertion::lessOrEqualThan($value, $limit);
    }

    public function testGreaterThan()
    {
        $this->assertTrue(Assertion::greaterThan(2, 1));
        $this->assertTrue(Assertion::greaterThan('bbb', 'aaa'));
        $this->assertTrue(Assertion::greaterThan('aaaa', 'aaa'));
        $this->assertTrue(Assertion::greaterThan(new \DateTime('tomorrow'), new \DateTime('today')));
    }

    public function invalidGreaterProvider()
    {
        return [
            [1, 2],
            [2, 2],
            ['aaa', 'aaa'],
            ['aaa', 'aaaa'],
            [new \DateTime('yesterday'), new \DateTime('today')],
            [new \DateTime('today'), new \DateTime('today')],
        ];
    }

    /**
     * @dataProvider validDateProvider
     *
     * @param string $value
     * @param string $format
     */
    public function testValidDate($value, $format)
    {
        $this->assertTrue(Assertion::date($value, $format));
    }

    public function validDateProvider()
    {
        return [
            ['2012-03-13', 'Y-m-d'],
            ['29.02.2012 12:03:36.432563', 'd.m.Y H:i:s.u'],
            ['13.08.2015 17:08:23 Thu Thursday th 224 August Aug 8 15 17 432563 UTC UTC', 'd.m.Y H:i:s D l S z F M n y H u e T'],
            ['1439486158', 'U'],
        ];
    }

    /**
     * @dataProvider invalidGreaterProvider
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testGreaterThanThrowsException($value, $limit)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_GREATER);
        Assertion::greaterThan($value, $limit);
    }

    public function testGreaterOrEqualThan()
    {
        $this->assertTrue(Assertion::greaterOrEqualThan(2, 1));
        $this->assertTrue(Assertion::greaterOrEqualThan(1, 1));
        $this->assertTrue(Assertion::greaterOrEqualThan('bbb', 'aaa'));
        $this->assertTrue(Assertion::greaterOrEqualThan('aaaa', 'aaa'));
        $this->assertTrue(Assertion::greaterOrEqualThan('aaa', 'aaa'));
        $this->assertTrue(Assertion::greaterOrEqualThan(new \DateTime('tomorrow'), new \DateTime('today')));
        $this->assertTrue(Assertion::greaterOrEqualThan(new \DateTime('today'), new \DateTime('today')));
    }

    public function invalidGreaterOrEqualProvider()
    {
        return [
            [1, 2],
            ['aaa', 'aaaa'],
            [new \DateTime('yesterday'), new \DateTime('tomorrow')],
        ];
    }

    /**
     * @dataProvider invalidGreaterOrEqualProvider
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testGreaterOrEqualThanThrowsException($value, $limit)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_GREATER_OR_EQUAL);
        Assertion::greaterOrEqualThan($value, $limit);
    }

    /**
     * @dataProvider invalidDateProvider
     *
     * @param string $value
     * @param string $format
     */
    public function testInvalidDate($value, $format)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_DATE);
        Assertion::date($value, $format);
    }

    public function invalidDateProvider()
    {
        return [
            ['this is not the date', 'Y-m-d'],
            ['2011-02-29', 'Y-m-d'],
            ['2012.02.29 12:60:36.432563', 'Y.m.d H:i:s.u'],
        ];
    }

    public function testValidTraversable()
    {
        $this->assertTrue(Assertion::isTraversable(new \ArrayObject()));
    }

    public function testInvalidTraversable()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_TRAVERSABLE);
        Assertion::isTraversable('not traversable');
    }

    public function testValidCountable()
    {
        $this->assertTrue(Assertion::isCountable([]));
        $this->assertTrue(Assertion::isCountable(new \ArrayObject()));
    }

    public function testInvalidCountable()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_COUNTABLE);
        Assertion::isCountable('not countable');
    }

    public function testValidArrayAccessible()
    {
        $this->assertTrue(Assertion::isArrayAccessible(new \ArrayObject()));
    }

    public function testInvalidArrayAccessible()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_ARRAY_ACCESSIBLE);
        Assertion::isArrayAccessible('not array accessible');
    }

    public function testInvalidCallable()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_CALLABLE);
        Assertion::isCallable('nonExistingFunction');
    }

    public function testValidCallable()
    {
        $this->assertTrue(Assertion::isCallable('\is_callable'));
        $this->assertTrue(Assertion::isCallable(__NAMESPACE__.'\\Fixtures\\someCallable'));
        $this->assertTrue(Assertion::isCallable([new OneCountable(), 'count']));
        $this->assertTrue(Assertion::isCallable([CustomAssertion::class, 'clearCalls']));
        $this->assertTrue(
            Assertion::isCallable(
                function () {
                }
            )
        );
    }

    public function testInvalidSatisfy()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_SATISFY);
        Assertion::satisfy(
            null,
            function ($value) {
                return !\is_null($value);
            }
        );
    }

    public function testValidSatisfy()
    {
        // Should not fail with true return
        $this->assertTrue(
            Assertion::satisfy(
                null,
                function ($value) {
                    return \is_null($value);
                }
            )
        );

        // Should not fail with void return
        $this->assertTrue(
            Assertion::satisfy(
                true,
                function ($value) {
                    if (!\is_bool($value)) {
                        return false;
                    }
                }
            )
        );
    }

    /**
     * @dataProvider validIpProvider
     *
     * @param string $value
     */
    public function testValidIp($value)
    {
        $this->assertTrue(Assertion::ip($value));
    }

    public function validIpProvider()
    {
        return [
            ['0.0.0.0'],
            ['14.32.152.216'],
            ['255.255.255.255'],
            ['2001:db8:85a3:8d3:1319:8a2e:370:7348'],
        ];
    }

    /**
     * @dataProvider invalidIpProvider
     *
     * @param string $value
     * @param int|null $flag
     */
    public function testInvalidIp($value, $flag = null)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_IP);
        Assertion::ip($value, $flag);
    }

    public function invalidIpProvider()
    {
        return [
            ['invalid ip address'],
            ['14.32.152,216'],
            ['14.32.256.216'],
            ['192.168.0.10', FILTER_FLAG_NO_PRIV_RANGE],
            ['127.0.0.1', FILTER_FLAG_NO_RES_RANGE],
            ['2001:db8:85a3:8d3:1319:8g2e:370:7348'],
            ['fdb9:75b9:9e69:5d08:1:1:1:1', FILTER_FLAG_NO_PRIV_RANGE],
        ];
    }

    public function testValidIpv4()
    {
        $this->assertTrue(Assertion::ipv4('109.188.127.26'));
    }

    public function testInvalidIpv4()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_IP);
        Assertion::ipv4('2001:db8:85a3:8d3:1319:8a2e:370:7348');
    }

    public function testValidIpv6()
    {
        $this->assertTrue(Assertion::ipv6('2001:db8:85a3:8d3:1319:8a2e:370:7348'));
    }

    public function testInvalidIpv6()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_IP);
        Assertion::ipv6('109.188.127.26');
    }

    public function testInvalidInterfaceExists()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_INTERFACE);
        Assertion::interfaceExists('Foo');
    }

    public function testValidInterfaceExists()
    {
        $this->assertTrue(Assertion::interfaceExists(\Countable::class));
    }

    /**
     * @dataProvider providerInvalidBetween
     *
     * @param mixed $value
     * @param mixed $lowerLimit
     * @param mixed $upperLimit
     */
    public function testInvalidBetween($value, $lowerLimit, $upperLimit)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_BETWEEN);
        Assertion::between($value, $lowerLimit, $upperLimit);
    }

    /**
     * @return array
     */
    public function providerInvalidBetween()
    {
        return [
            [1, 2, 3],
            [3, 1, 2],
            ['aaa', 'bbb', 'ccc'],
            ['ddd', 'bbb', 'ccc'],
            [new \DateTime('yesterday'), new \DateTime('today'), new \DateTime('tomorrow')],
            [new \DateTime('tomorrow'), new \DateTime('yesterday'), new \DateTime('today')],
        ];
    }

    /**
     * @dataProvider providerValidBetween
     *
     * @param mixed $value
     * @param mixed $lowerLimit
     * @param mixed $upperLimit
     */
    public function testValidBetween($value, $lowerLimit, $upperLimit)
    {
        $this->assertTrue(Assertion::between($value, $lowerLimit, $upperLimit));
    }

    /**
     * @return array
     */
    public function providerValidBetween()
    {
        return [
            [2, 1, 3],
            [1, 1, 1],
            ['bbb', 'aaa', 'ccc'],
            ['aaa', 'aaa', 'aaa'],
            [new \DateTime('today'), new \DateTime('yesterday'), new \DateTime('tomorrow')],
            [new \DateTime('today'), new \DateTime('today'), new \DateTime('today')],
        ];
    }

    /**
     * @dataProvider providerInvalidBetweenExclusive
     *
     * @param mixed $value
     * @param mixed $lowerLimit
     * @param mixed $upperLimit
     */
    public function testInvalidBetweenExclusive($value, $lowerLimit, $upperLimit)
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_BETWEEN_EXCLUSIVE);
        Assertion::betweenExclusive($value, $lowerLimit, $upperLimit);
    }

    /**
     * @return array
     */
    public function providerInvalidBetweenExclusive()
    {
        return [
            [1, 1, 2],
            [2, 1, 2],
            ['aaa', 'aaa', 'bbb'],
            ['bbb', 'aaa', 'bbb'],
            [new \DateTime('today'), new \DateTime('today'), new \DateTime('tomorrow')],
            [new \DateTime('tomorrow'), new \DateTime('today'), new \DateTime('tomorrow')],
        ];
    }

    /**
     * @dataProvider providerValidBetweenExclusive
     *
     * @param mixed $value
     * @param mixed $lowerLimit
     * @param mixed $upperLimit
     */
    public function testValidBetweenExclusive($value, $lowerLimit, $upperLimit)
    {
        $this->assertTrue(Assertion::betweenExclusive($value, $lowerLimit, $upperLimit));
    }

    /**
     * @return array
     */
    public function providerValidBetweenExclusive()
    {
        return [
            [2, 1, 3],
            ['bbb', 'aaa', 'ccc'],
            [new \DateTime('today'), new \DateTime('yesterday'), new \DateTime('tomorrow')],
        ];
    }

    public function testStringifyTruncatesStringValuesLongerThan100CharactersAppropriately()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_FLOAT);
        $this->expectExceptionMessage('1234567...');
        $string = \str_repeat('1234567890', 11);

        $this->assertTrue(Assertion::float($string));
    }

    public function testStringifyReportsResourceType()
    {
        $this->expectException('Assert\AssertionFailedException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_FLOAT);
        $this->expectExceptionMessage('stream');
        $this->assertTrue(Assertion::float(\fopen('php://stdin', 'rb')));
    }

    public function testExtensionLoaded()
    {
        $this->assertTrue(Assertion::extensionLoaded('date'));
    }

    public function testExtensionNotLoaded()
    {
        $this->expectException('Assert\InvalidArgumentException');
        Assertion::extensionLoaded('NOT_LOADED');
    }

    public function testValidConstant()
    {
        $this->assertTrue(Assertion::defined('PHP_VERSION'));
    }

    public function testInvalidConstant()
    {
        $this->expectException('Assert\InvalidArgumentException');
        Assertion::defined('NOT_A_CONSTANT');
    }

    public function testValidVersion()
    {
        $this->assertTrue(Assertion::version('1.0.0', '<', '2.0.0'));
    }

    public function testInvalidVersion()
    {
        $this->expectException('Assert\InvalidArgumentException');
        Assertion::version('1.0.0', 'eq', '2.0.0');
    }

    public function testInvalidVersionOperator()
    {
        $this->expectException('Assert\InvalidArgumentException');
        Assertion::version('1.0.0', null, '2.0.0');
    }

    public function testValidPhpVersion()
    {
        $this->assertTrue(Assertion::phpVersion('>', '4.0.0'));
    }

    public function testInvalidPhpVersion()
    {
        $this->expectException('Assert\InvalidArgumentException');
        Assertion::phpVersion('<', '5.0.0');
    }

    public function testValidExtensionVersion()
    {
        $this->assertTrue(Assertion::extensionVersion('json', '>', '1.0.0'));
    }

    public function testInvalidExtensionVersion()
    {
        $this->expectException('Assert\InvalidArgumentException');
        Assertion::extensionVersion('json', '<', '0.1.0');
    }

    public function testObjectOrClass()
    {
        self::assertTrue(Assertion::objectOrClass(new stdClass()));
        self::assertTrue(Assertion::objectOrClass(stdClass::class));
    }

    public function testNotObjectOrClass()
    {
        $this->expectException('Assert\InvalidArgumentException');
        Assertion::objectOrClass('InvalidClassName');
    }

    public function testPropertyExists()
    {
        self::assertTrue(Assertion::propertyExists(new \Exception(), 'message'));
    }

    public function testInvalidPropertyExists()
    {
        $this->expectException('Assert\InvalidArgumentException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_PROPERTY);
        Assertion::propertyExists(new \Exception(), 'invalidProperty');
    }

    public function testPropertiesExist()
    {
        self::assertTrue(Assertion::propertiesExist(new \Exception(), ['message', 'code', 'previous']));
    }

    public function invalidPropertiesExistProvider()
    {
        return [
            [['invalidProperty']],
            [['invalidProperty', 'anotherInvalidProperty']],
        ];
    }

    /**
     * @dataProvider invalidPropertiesExistProvider
     *
     * @param array $properties
     */
    public function testInvalidPropertiesExist($properties)
    {
        $this->expectException('Assert\InvalidArgumentException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_PROPERTY);
        Assertion::propertiesExist(new \Exception(), $properties);
    }

    public function testIsResource()
    {
        self::assertTrue(Assertion::isResource(\fopen('php://memory', 'w')));
    }

    public function testIsNotResource()
    {
        $this->expectException('Assert\InvalidArgumentException');
        Assertion::isResource(new stdClass());
    }

    public function testBase64()
    {
        $base64String = \base64_encode('content');

        $this->assertTrue(Assertion::base64($base64String));
    }

    public function testNotBase64()
    {
        $this->expectException('Assert\InvalidArgumentException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_BASE64);
        Assertion::base64('wrong-content');
    }

    public function invalidEqArraySubsetProvider()
    {
        return [
            'firstArgumentNotArray' => ['notArray', []],
            'secondArgumentNotArray' => [[], 'notArray'],
        ];
    }

    public function testEqArraySubsetValid()
    {
        $this->assertTrue(
            Assertion::eqArraySubset(
                [
                    'a' => [
                        'a1' => 'a2',
                        'a3' => 'a4',
                    ],
                    'b' => [
                        'b1' => 'b2',
                    ],
                ],
                [
                    'a' => [
                        'a1' => 'a2',
                    ],
                ]
            )
        );
    }

    /**
     * @dataProvider invalidEqArraySubsetProvider
     */
    public function testEqArraySubsetInvalid($value, $value2)
    {
        $this->expectException('Assert\InvalidArgumentException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_ARRAY);
        Assertion::eqArraySubset($value, $value2);
    }

    /**
     * @dataProvider invalidEqArraySubsetProvider
     */
    public function testEqArraySubsetMismatchingSubset()
    {
        $this->expectException('Assert\InvalidArgumentException');
        $this->expectExceptionCode(\Assert\Assertion::INVALID_EQ);
        Assertion::eqArraySubset(
            [
                'a' => 'b',
            ],
            [
                'c' => 'd',
            ]
        );
    }
}
