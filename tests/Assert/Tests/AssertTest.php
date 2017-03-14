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

class AssertTest extends \PHPUnit_Framework_TestCase
{
    public static function dataInvalidFloat()
    {
        return array(
            array(1),
            array(false),
            array('test'),
            array(null),
            array('1.23'),
            array('10'),
        );
    }

    /**
     * @dataProvider dataInvalidFloat
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_FLOAT
     *
     * @param mixed $nonFloat
     */
    public function testInvalidFloat($nonFloat)
    {
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
        return array(
            array(1.23),
            array(false),
            array('test'),
            array(null),
            array('1.23'),
            array('10'),
            array(new \DateTime()),
        );
    }

    /**
     * @dataProvider dataInvalidInteger
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_INTEGER
     *
     * @param mixed $nonInteger
     */
    public function testInvalidInteger($nonInteger)
    {
        Assertion::integer($nonInteger);
    }

    public function testValidInteger()
    {
        $this->assertTrue(Assertion::integer(10));
        $this->assertTrue(Assertion::integer(0));
    }

    public function testValidIntegerish()
    {
        $this->assertTrue(Assertion::integerish(10));
        $this->assertTrue(Assertion::integerish('10'));
    }

    public static function dataInvalidIntegerish()
    {
        return array(
            array(1.23),
            array(false),
            array('test'),
            array(null),
            array('1.23'),
            array(\fopen(__FILE__, 'r')),
        );
    }

    /**
     * @dataProvider dataInvalidIntegerish
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_INTEGERISH
     *
     * @param mixed $nonInteger
     */
    public function testInvalidIntegerish($nonInteger)
    {
        Assertion::integerish($nonInteger);
    }

    public function testValidBoolean()
    {
        $this->assertTrue(Assertion::boolean(true));
        $this->assertTrue(Assertion::boolean(false));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_BOOLEAN
     */
    public function testInvalidBoolean()
    {
        Assertion::boolean(1);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_SCALAR
     */
    public function testInvalidScalar()
    {
        Assertion::scalar(new \stdClass());
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
        return array(
            array(''),
            array(false),
            array(0),
            array(null),
            array(array()),
        );
    }

    /**
     * @dataProvider dataInvalidNotEmpty
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::VALUE_EMPTY
     *
     * @param mixed $value
     */
    public function testInvalidNotEmpty($value)
    {
        Assertion::notEmpty($value);
    }

    public function testNotEmpty()
    {
        $this->assertTrue(Assertion::notEmpty('test'));
        $this->assertTrue(Assertion::notEmpty(1));
        $this->assertTrue(Assertion::notEmpty(true));
        $this->assertTrue(Assertion::notEmpty(array('foo')));
    }

    public function testEmpty()
    {
        $this->assertTrue(Assertion::noContent(''));
        $this->assertTrue(Assertion::noContent(0));
        $this->assertTrue(Assertion::noContent(false));
        $this->assertTrue(Assertion::noContent(array()));
    }

    public static function dataInvalidEmpty()
    {
        return array(
            array('foo'),
            array(true),
            array(12),
            array(array('foo')),
            array(new \stdClass()),
        );
    }

    /**
     * @dataProvider dataInvalidEmpty
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::VALUE_NOT_EMPTY
     *
     * @param mixed $value
     */
    public function testInvalidEmpty($value)
    {
        Assertion::noContent($value);
    }

    public static function dataInvalidNull()
    {
        return array(
            array('foo'),
            array(''),
            array(false),
            array(12),
            array(0),
            array(array()),
        );
    }

    /**
     * @dataProvider dataInvalidNull
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::VALUE_NOT_NULL
     *
     * @param mixed $value
     */
    public function testInvalidNull($value)
    {
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
        $this->assertTrue(Assertion::notNull(array()));
        $this->assertTrue(Assertion::notNull(false));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::VALUE_NULL
     */
    public function testInvalidNotNull()
    {
        Assertion::notNull(null);
    }

    public function testString()
    {
        $this->assertTrue(Assertion::string('test-string'));
        $this->assertTrue(Assertion::string(''));
    }

    /**
     * @dataProvider dataInvalidString
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_STRING
     *
     * @param mixed $invalidString
     */
    public function testInvalidString($invalidString)
    {
        Assertion::string($invalidString);
    }

    public static function dataInvalidString()
    {
        return array(
            array(1.23),
            array(false),
            array(new \ArrayObject()),
            array(null),
            array(10),
            array(true),
        );
    }

    public function testValidRegex()
    {
        $this->assertTrue(Assertion::regex('some string', '/.*/'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_REGEX
     */
    public function testInvalidRegex()
    {
        Assertion::regex('foo', '(bar)');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_STRING
     */
    public function testInvalidRegexValueNotString()
    {
        Assertion::regex(array('foo'), '(bar)');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_MIN_LENGTH
     */
    public function testInvalidMinLength()
    {
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

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_MAX_LENGTH
     */
    public function testInvalidMaxLength()
    {
        Assertion::maxLength('foo', 2);
    }

    public function testValidMaxLength()
    {
        $this->assertTrue(Assertion::maxLength('foo', 10));
        $this->assertTrue(Assertion::maxLength('foo', 3));
        $this->assertTrue(Assertion::maxLength('', 0));
        $this->assertTrue(Assertion::maxLength('址址', 2));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_MIN_LENGTH
     */
    public function testInvalidBetweenLengthMin()
    {
        Assertion::betweenLength('foo', 4, 100);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_MAX_LENGTH
     */
    public function testInvalidBetweenLengthMax()
    {
        Assertion::betweenLength('foo', 0, 2);
    }

    public function testValidBetweenLength()
    {
        $this->assertTrue(Assertion::betweenLength('foo', 0, 3));
        $this->assertTrue(Assertion::betweenLength('址址', 2, 2));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_STRING_START
     */
    public function testInvalidStartsWith()
    {
        Assertion::startsWith('foo', 'bar');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_STRING_START
     */
    public function testInvalidStartsWithDueToWrongEncoding()
    {
        Assertion::startsWith('址', '址址', null, null, 'ASCII');
    }

    public function testValidStartsWith()
    {
        $this->assertTrue(Assertion::startsWith('foo', 'foo'));
        $this->assertTrue(Assertion::startsWith('foo', 'fo'));
        $this->assertTrue(Assertion::startsWith('foo', 'f'));
        $this->assertTrue(Assertion::startsWith('址foo', '址'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_STRING_END
     */
    public function testInvalidEndsWith()
    {
        Assertion::endsWith('foo', 'bar');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_STRING_END
     */
    public function testInvalidEndsWithDueToWrongEncoding()
    {
        Assertion::endsWith('址', '址址', null, null, 'ASCII');
    }

    public function testValidEndsWith()
    {
        $this->assertTrue(Assertion::endsWith('foo', 'foo'));
        $this->assertTrue(Assertion::endsWith('sonderbar', 'bar'));
        $this->assertTrue(Assertion::endsWith('opp', 'p'));
        $this->assertTrue(Assertion::endsWith('foo址', '址'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_STRING_CONTAINS
     */
    public function testInvalidContains()
    {
        Assertion::contains('foo', 'bar');
    }

    public function testValidContains()
    {
        $this->assertTrue(Assertion::contains('foo', 'foo'));
        $this->assertTrue(Assertion::contains('foo', 'oo'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_CHOICE
     */
    public function testInvalidChoice()
    {
        Assertion::choice('foo', array('bar', 'baz'));
    }

    public function testValidChoice()
    {
        $this->assertTrue(Assertion::choice('foo', array('foo')));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_CHOICE
     */
    public function testInvalidInArray()
    {
        Assertion::inArray('bar', array('baz'));
    }

    public function testValidInArray()
    {
        $this->assertTrue(Assertion::inArray('foo', array('foo')));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_NUMERIC
     */
    public function testInvalidNumeric()
    {
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
        return array(
            array(null),
            array(false),
            array('test'),
            array(1),
            array(1.23),
            array(new \stdClass()),
            array(\fopen('php://memory', 'r')),
        );
    }

    /**
     * @dataProvider dataInvalidArray
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_ARRAY
     *
     * @param mixed $value
     */
    public function testInvalidArray($value)
    {
        Assertion::isArray($value);
    }

    public function testValidArray()
    {
        $this->assertTrue(Assertion::isArray(array()));
        $this->assertTrue(Assertion::isArray(array(1, 2, 3)));
        $this->assertTrue(Assertion::isArray(array(array(), array())));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_KEY_EXISTS
     */
    public function testInvalidKeyExists()
    {
        Assertion::keyExists(array('foo' => 'bar'), 'baz');
    }

    public function testValidKeyExists()
    {
        $this->assertTrue(Assertion::keyExists(array('foo' => 'bar'), 'foo'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_KEY_NOT_EXISTS
     */
    public function testInvalidKeyNotExists()
    {
        Assertion::keyNotExists(array('foo' => 'bar'), 'foo');
    }

    public function testValidKeyNotExists()
    {
        $this->assertTrue(Assertion::keyNotExists(array('foo' => 'bar'), 'baz'));
    }

    public static function dataInvalidNotBlank()
    {
        return array(
            array(''),
            array(' '),
            array("\t"),
            array("\n"),
            array("\r"),
            array(false),
            array(null),
            array(array()),
        );
    }

    /**
     * @dataProvider dataInvalidNotBlank
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_NOT_BLANK
     *
     * @param mixed $notBlank
     */
    public function testInvalidNotBlank($notBlank)
    {
        Assertion::notBlank($notBlank);
    }

    public function testValidNotBlank()
    {
        $this->assertTrue(Assertion::notBlank('foo'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_NOT_INSTANCE_OF
     */
    public function testInvalidNotInstanceOf()
    {
        Assertion::notIsInstanceOf(new \stdClass(), 'stdClass');
    }

    public function testValidNotIsInstanceOf()
    {
        $this->assertTrue(Assertion::notIsInstanceOf(new \stdClass(), 'PDO'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_INSTANCE_OF
     */
    public function testInvalidInstanceOf()
    {
        Assertion::isInstanceOf(new \stdClass(), 'PDO');
    }

    public function testValidInstanceOf()
    {
        $this->assertTrue(Assertion::isInstanceOf(new \stdClass(), 'stdClass'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_SUBCLASS_OF
     */
    public function testInvalidSubclassOf()
    {
        Assertion::subclassOf(new \stdClass(), 'PDO');
    }

    public function testValidSubclassOf()
    {
        $this->assertTrue(Assertion::subclassOf(new Fixtures\ChildStdClass(), 'stdClass'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_RANGE
     */
    public function testInvalidRange()
    {
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

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_EMAIL
     */
    public function testInvalidEmail()
    {
        Assertion::email('foo');
    }

    public function testValidEmail()
    {
        $this->assertTrue(Assertion::email('123hello+world@email.provider.com'));
    }

    /**
     * @dataProvider dataInvalidUrl
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_URL
     *
     * @param string $url
     */
    public function testInvalidUrl($url)
    {
        Assertion::url($url);
    }

    public static function dataInvalidUrl()
    {
        return array(
            array('google.com'),
            array('://google.com'),
            array('http ://google.com'),
            array('http:/google.com'),
            array('http://goog_le.com'),
            array('http://google.com::aa'),
            array('http://google.com:aa'),
            array('ftp://google.fr'),
            array('faked://google.fr'),
            array('http://127.0.0.1:aa/'),
            array('ftp://[::1]/'),
            array('http://[::1'),
            array('http://hello.☎/'),
            array('http://:password@symfony.com'),
            array('http://:password@@symfony.com'),
            array('http://username:passwordsymfony.com'),
            array('http://usern@me:password@symfony.com'),
        );
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
        return array(
            array('http://a.pl'),
            array('http://www.google.com'),
            array('http://www.google.com.'),
            array('http://www.google.museum'),
            array('https://google.com/'),
            array('https://google.com:80/'),
            array('http://www.example.coop/'),
            array('http://www.test-example.com/'),
            array('http://www.symfony.com/'),
            array('http://symfony.fake/blog/'),
            array('http://symfony.com/?'),
            array('http://symfony.com/search?type=&q=url+validator'),
            array('http://symfony.com/#'),
            array('http://symfony.com/#?'),
            array('http://www.symfony.com/doc/current/book/validation.html#supported-constraints'),
            array('http://very.long.domain.name.com/'),
            array('http://localhost/'),
            array('http://myhost123/'),
            array('http://127.0.0.1/'),
            array('http://127.0.0.1:80/'),
            array('http://[::1]/'),
            array('http://[::1]:80/'),
            array('http://[1:2:3::4:5:6:7]/'),
            array('http://sãopaulo.com/'),
            array('http://xn--sopaulo-xwa.com/'),
            array('http://sãopaulo.com.br/'),
            array('http://xn--sopaulo-xwa.com.br/'),
            array('http://пример.испытание/'),
            array('http://xn--e1afmkfd.xn--80akhbyknj4f/'),
            array('http://مثال.إختبار/'),
            array('http://xn--mgbh0fb.xn--kgbechtv/'),
            array('http://例子.测试/'),
            array('http://xn--fsqu00a.xn--0zwm56d/'),
            array('http://例子.測試/'),
            array('http://xn--fsqu00a.xn--g6w251d/'),
            array('http://例え.テスト/'),
            array('http://xn--r8jz45g.xn--zckzah/'),
            array('http://مثال.آزمایشی/'),
            array('http://xn--mgbh0fb.xn--hgbk6aj7f53bba/'),
            array('http://실례.테스트/'),
            array('http://xn--9n2bp8q.xn--9t4b11yi5a/'),
            array('http://العربية.idn.icann.org/'),
            array('http://xn--ogb.idn.icann.org/'),
            array('http://xn--e1afmkfd.xn--80akhbyknj4f.xn--e1afmkfd/'),
            array('http://xn--espaa-rta.xn--ca-ol-fsay5a/'),
            array('http://xn--d1abbgf6aiiy.xn--p1ai/'),
            array('http://☎.com/'),
            array('http://username:password@symfony.com'),
            array('http://user-name@symfony.com'),
            array('http://symfony.com?'),
            array('http://symfony.com?query=1'),
            array('http://symfony.com/?query=1'),
            array('http://symfony.com#'),
            array('http://symfony.com#fragment'),
            array('http://symfony.com/#fragment'),
        );
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_DIGIT
     */
    public function testInvalidDigit()
    {
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
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_ALNUM
     */
    public function testInvalidAlnum()
    {
        Assertion::alnum('1a');
    }

    public function testValidTrue()
    {
        $this->assertTrue(Assertion::true(1 == 1));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_TRUE
     */
    public function testInvalidTrue()
    {
        Assertion::true(false);
    }

    public function testValidFalse()
    {
        $this->assertTrue(Assertion::false(1 == 0));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_FALSE
     */
    public function testInvalidFalse()
    {
        Assertion::false(true);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_CLASS
     */
    public function testInvalidClass()
    {
        Assertion::classExists('Foo');
    }

    public function testValidClass()
    {
        $this->assertTrue(Assertion::classExists('\\Exception'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_SAME
     */
    public function testSame()
    {
        $this->assertTrue(Assertion::same(1, 1));
        $this->assertTrue(Assertion::same('foo', 'foo'));
        $this->assertTrue(Assertion::same($obj = new \stdClass(), $obj));

        Assertion::same(new \stdClass(), new \stdClass());
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_EQ
     */
    public function testEq()
    {
        $this->assertTrue(Assertion::eq(1, '1'));
        $this->assertTrue(Assertion::eq('foo', true));
        $this->assertTrue(Assertion::eq($obj = new \stdClass(), $obj));

        Assertion::eq('2', 1);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_NOT_EQ
     */
    public function testNotEq()
    {
        $this->assertTrue(Assertion::notEq('1', false));
        $this->assertTrue(Assertion::notEq(new \stdClass(), array()));

        Assertion::notEq('1', 1);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_NOT_SAME
     */
    public function testNotSame()
    {
        $this->assertTrue(Assertion::notSame('1', 2));
        $this->assertTrue(Assertion::notSame(new \stdClass(), array()));

        Assertion::notSame(1, 1);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_VALUE_IN_ARRAY
     */
    public function testNotInArray()
    {
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
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_MIN
     * @expectedExceptionMessageRegExp /Number "(0\.5|0)" was expected to be at least "(1|2\.5)"/
     *
     * @param float|int $value
     * @param float|int $min
     */
    public function testInvalidMin($value, $min)
    {
        Assertion::min($value, $min);
    }

    public function dataInvalidMin()
    {
        return array(
            array(0, 1),
            array(0.5, 2.5),
        );
    }

    public function testMax()
    {
        $this->assertTrue(Assertion::max(1, 1));
        $this->assertTrue(Assertion::max(0.5, 1));
        $this->assertTrue(Assertion::max(0, 1));
    }

    /**
     * @dataProvider dataInvalidMax
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_MAX
     * @expectedExceptionMessageRegExp /Number "(2.5|2)" was expected to be at most "(1|0\.5)"/
     *
     * @param float|int $value
     * @param float|int $min
     */
    public function testInvalidMax($value, $min)
    {
        Assertion::max($value, $min);
    }

    public function dataInvalidMax()
    {
        return array(
            array(2, 1),
            array(2.5, 0.5),
        );
    }

    public function testNullOr()
    {
        $this->assertTrue(Assertion::nullOrMax(null, 1));
        $this->assertTrue(Assertion::nullOrMax(null, 2));
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Missing the first argument.
     */
    public function testNullOrWithNoValueThrows()
    {
        Assertion::nullOrMax();
    }

    public function testLength()
    {
        $this->assertTrue(Assertion::length('asdf', 4));
        $this->assertTrue(Assertion::length('', 0));
    }

    public static function dataLengthUtf8Characters()
    {
        return array(
            array('址', 1),
            array('ل', 1),
        );
    }

    /**
     * @dataProvider dataLengthUtf8Characters
     *
     * @param string $value
     * @param int    $expected
     */
    public function testLengthUtf8Characters($value, $expected)
    {
        $this->assertTrue(Assertion::length($value, $expected));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_LENGTH
     */
    public function testLengthFailed()
    {
        Assertion::length('asdf', 3);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_LENGTH
     */
    public function testLengthFailedForWrongEncoding()
    {
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

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::VALUE_EMPTY
     */
    public function testFileWithEmptyFilename()
    {
        Assertion::file('');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_FILE
     */
    public function testFileDoesNotExists()
    {
        Assertion::file(__DIR__ . '/does-not-exists');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_DIRECTORY
     */
    public function testDirectory()
    {
        $this->assertTrue(Assertion::directory(__DIR__));

        Assertion::directory(__DIR__ . '/does-not-exist');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_READABLE
     */
    public function testReadable()
    {
        $this->assertTrue(Assertion::readable(__FILE__));

        Assertion::readable(__DIR__ . '/does-not-exist');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_WRITEABLE
     */
    public function testWriteable()
    {
        $this->assertTrue(Assertion::writeable(\sys_get_temp_dir()));

        Assertion::writeable(__DIR__ . '/does-not-exist');
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage No assertion
     */
    public function testFailedNullOrMethodCall()
    {
        Assertion::nullOrAssertionDoesNotExist('');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INTERFACE_NOT_IMPLEMENTED
     */
    public function testImplementsInterface()
    {
        $this->assertTrue(Assertion::implementsInterface('\ArrayIterator', '\Traversable'));

        Assertion::implementsInterface('\Exception', '\Traversable');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INTERFACE_NOT_IMPLEMENTED
     */
    public function testImplementsInterfaceWithClassObject()
    {
        $class = new \ArrayObject();

        $this->assertTrue(Assertion::implementsInterface($class, '\Traversable'));

        Assertion::implementsInterface($class, '\SplObserver');
    }

    /**
     * @dataProvider isJsonStringDataprovider
     *
     * @param $content
     */
    public function testIsJsonString($content)
    {
        $this->assertTrue(Assertion::isJsonString($content));
    }

    public static function isJsonStringDataprovider()
    {
        return array(
            '»null« value' => array(\json_encode(null)),
            '»false« value' => array(\json_encode(false)),
            'array value' => array('["false"]'),
            'object value' => array('{"tux":"false"}'),
        );
    }

    /**
     * @dataProvider isJsonStringInvalidStringDataprovider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_JSON_STRING
     *
     * @param $invalidString
     */
    public function testIsJsonStringExpectingException($invalidString)
    {
        Assertion::isJsonString($invalidString);
    }

    public static function isJsonStringInvalidStringDataprovider()
    {
        return array(
            'no json string' => array('invalid json encoded string'),
            'error in json string' => array('{invalid json encoded string}'),
        );
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
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_UUID
     *
     * @param string $uuid
     */
    public function testInvalidUuids($uuid)
    {
        Assertion::uuid($uuid);
    }

    public static function providesValidUuids()
    {
        return array(
            array('ff6f8cb0-c57d-11e1-9b21-0800200c9a66'),
            array('ff6f8cb0-c57d-21e1-9b21-0800200c9a66'),
            array('ff6f8cb0-c57d-31e1-9b21-0800200c9a66'),
            array('ff6f8cb0-c57d-41e1-9b21-0800200c9a66'),
            array('ff6f8cb0-c57d-51e1-9b21-0800200c9a66'),
            array('FF6F8CB0-C57D-11E1-9B21-0800200C9A66'),
            array('00000000-0000-0000-0000-000000000000'),
        );
    }

    public static function providesInvalidUuids()
    {
        return array(
            array('zf6f8cb0-c57d-11e1-9b21-0800200c9a66'),
            array('af6f8cb0c57d11e19b210800200c9a66'),
            array('ff6f8cb0-c57da-51e1-9b21-0800200c9a66'),
            array('af6f8cb-c57d-11e1-9b21-0800200c9a66'),
            array('3f6f8cb0-c57d-11e1-9b21-0800200c9a6'),
        );
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
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_E164
     *
     * @param string $e164
     */
    public function testInvalidE164s($e164)
    {
        Assertion::e164($e164);
    }

    public static function providesValidE164s()
    {
        return array(
            array('+33626525690'),
            array('33626525690'),
            array('+16174552211'),
        );
    }

    public static function providesInvalidE164s()
    {
        return array(
            array('+3362652569e'),
            array('+3361231231232652569'),
        );
    }

    public function testValidNotEmptyKey()
    {
        $this->assertTrue(Assertion::notEmptyKey(array('keyExists' => 'notEmpty'), 'keyExists'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::VALUE_EMPTY
     */
    public function testInvalidNotEmptyKeyEmptyKey()
    {
        Assertion::notEmptyKey(array('keyExists' => ''), 'keyExists');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_KEY_ISSET
     */
    public function testInvalidNotEmptyKeyKeyNotExists()
    {
        Assertion::notEmptyKey(array('key' => 'notEmpty'), 'keyNotExists');
    }

    public function testAllWithSimpleAssertion()
    {
        $this->assertTrue(Assertion::allTrue(array(true, true)));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_TRUE
     */
    public function testAllWithSimpleAssertionThrowsExceptionOnElementThatFailsAssertion()
    {
        Assertion::allTrue(array(true, false));
    }

    public function testAllWithComplexAssertion()
    {
        $this->assertTrue(Assertion::allIsInstanceOf(array(new \stdClass(), new \stdClass()), 'stdClass'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_INSTANCE_OF
     */
    public function testAllWithComplexAssertionThrowsExceptionOnElementThatFailsAssertion()
    {
        Assertion::allIsInstanceOf(array(new \stdClass(), new \stdClass()), 'PDO', 'Assertion failed', 'foos');
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testAllWithNoValueThrows()
    {
        Assertion::allTrue();
    }

    public function testValidCount()
    {
        $this->assertTrue(Assertion::count(array('Hi'), 1));
        $this->assertTrue(Assertion::count(new Fixtures\OneCountable(), 1));
    }

    public static function dataInvalidCount()
    {
        return array(
            array(array('Hi', 'There'), 3),
            array(new Fixtures\OneCountable(), 2),
        );
    }

    /**
     * @dataProvider dataInvalidCount
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_COUNT
     * @expectedExceptionMessageRegExp /List does not contain exactly "\d+" elements./
     *
     * @param mixed $countable
     * @param int   $count
     */
    public function testInvalidCount($countable, $count)
    {
        Assertion::count($countable, $count);
    }

    public function testChoicesNotEmpty()
    {
        $this->assertTrue(Assertion::choicesNotEmpty(
            array('tux' => 'linux', 'Gnu' => 'dolphin'),
            array('tux')
        ));
    }

    /**
     * @dataProvider invalidChoicesProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::VALUE_EMPTY
     *
     * @param $values
     * @param $choices
     */
    public function testChoicesNotEmptyExpectingExceptionEmptyValue($values, $choices)
    {
        Assertion::choicesNotEmpty($values, $choices);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_KEY_ISSET
     */
    public function testChoicesNotEmptyExpectingExceptionInvalidKeyIsset()
    {
        Assertion::choicesNotEmpty(array('tux' => ''), array('invalidChoice'));
    }

    public function invalidChoicesProvider()
    {
        return array(
            'empty values' => array(array(), array('tux'), Assertion::VALUE_EMPTY),
            'empty recodes in $values' => array(array('tux' => ''), array('tux'), Assertion::VALUE_EMPTY),
        );
    }

    public function testIsObject()
    {
        $this->assertTrue(Assertion::isObject(new \stdClass()));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_OBJECT
     */
    public function testIsObjectExpectingException()
    {
        Assertion::isObject('notAnObject');
    }

    public function testMethodExists()
    {
        $this->assertTrue(Assertion::methodExists('methodExists', new Assertion()));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_METHOD
     */
    public function testMethodExistsFailure()
    {
        Assertion::methodExists('methodNotExists', new Assertion());
    }

    public function testThatAssertionExceptionCanAccessValueAndSupplyConstraints()
    {
        try {
            Assertion::range(0, 10, 20);

            $this->fail('Exception expected');
        } catch (AssertionFailedException $e) {
            $this->assertEquals(0, $e->getValue());
            $this->assertEquals(array('min' => 10, 'max' => 20), $e->getConstraints());
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
        return array(
            array(2, 1),
            array(2, 2),
            array('aaa', 'aaa'),
            array('aaaa', 'aaa'),
            array(new \DateTime('today'), new \DateTime('yesterday')),
            array(new \DateTime('today'), new \DateTime('today')),
        );
    }

    /**
     * @dataProvider invalidLessProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_LESS
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testLessThanThrowsException($value, $limit)
    {
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
        return array(
            array(2, 1),
            array('aaaa', 'aaa'),
            array(new \DateTime('today'), new \DateTime('yesterday')),
        );
    }

    /**
     * @dataProvider invalidLessOrEqualProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_LESS_OR_EQUAL
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testLessOrEqualThanThrowsException($value, $limit)
    {
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
        return array(
            array(1, 2),
            array(2, 2),
            array('aaa', 'aaa'),
            array('aaa', 'aaaa'),
            array(new \DateTime('yesterday'), new \DateTime('today')),
            array(new \DateTime('today'), new \DateTime('today')),
        );
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
        return array(
            array('2012-03-13', 'Y-m-d'),
            array('29.02.2012 12:03:36.432563', 'd.m.Y H:i:s.u'),
            array('13.08.2015 17:08:23 Thu Thursday th 224 August Aug 8 15 17 432563 UTC UTC', 'd.m.Y H:i:s D l S z F M n y H u e T'),
            array('1439486158', 'U'),
        );
    }

    /**
     * @dataProvider invalidGreaterProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_GREATER
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testGreaterThanThrowsException($value, $limit)
    {
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
        return array(
            array(1, 2),
            array('aaa', 'aaaa'),
            array(new \DateTime('yesterday'), new \DateTime('tomorrow')),
        );
    }

    /**
     * @dataProvider invalidGreaterOrEqualProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_GREATER_OR_EQUAL
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testGreaterOrEqualThanThrowsException($value, $limit)
    {
        Assertion::greaterOrEqualThan($value, $limit);
    }

    /**
     * @dataProvider invalidDateProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_DATE
     *
     * @param string $value
     * @param string $format
     */
    public function testInvalidDate($value, $format)
    {
        Assertion::date($value, $format);
    }

    public function invalidDateProvider()
    {
        return array(
            array('this is not the date', 'Y-m-d'),
            array('2011-02-29', 'Y-m-d'),
            array('2012.02.29 12:60:36.432563', 'Y.m.d H:i:s.u'),
        );
    }

    public function testValidTraversable()
    {
        $this->assertTrue(Assertion::isTraversable(new \ArrayObject()));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_TRAVERSABLE
     */
    public function testInvalidTraversable()
    {
        Assertion::isTraversable('not traversable');
    }

    public function testValidArrayAccessible()
    {
        $this->assertTrue(Assertion::isArrayAccessible(new \ArrayObject()));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_ARRAY_ACCESSIBLE
     */
    public function testInvalidArrayAccessible()
    {
        Assertion::isArrayAccessible('not array accessible');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_CALLABLE
     */
    public function testInvalidCallable()
    {
        Assertion::isCallable('nonExistingFunction');
    }

    public function testValidCallable()
    {
        $this->assertTrue(Assertion::isCallable('\is_callable'));
        $this->assertTrue(Assertion::isCallable(__NAMESPACE__ . '\\Fixtures\\someCallable'));
        $this->assertTrue(Assertion::isCallable(array(__NAMESPACE__ . '\\Fixtures\\OneCountable', 'count')));
        $this->assertTrue(Assertion::isCallable(function () {
        }));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_SATISFY
     */
    public function testInvalidSatisfy()
    {
        Assertion::satisfy(null, function ($value) {
            return !\is_null($value);
        });
    }

    public function testValidSatisfy()
    {
        // Should not fail with true return
        $this->assertTrue(Assertion::satisfy(null, function ($value) {
            return \is_null($value);
        }));

        // Should not fail with void return
        $this->assertTrue(Assertion::satisfy(true, function ($value) {
            if (!\is_bool($value)) {
                return false;
            }
        }));
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
        return array(
            array('0.0.0.0'),
            array('14.32.152.216'),
            array('255.255.255.255'),
            array('2001:db8:85a3:8d3:1319:8a2e:370:7348'),
        );
    }

    /**
     * @dataProvider invalidIpProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_IP
     *
     * @param string   $value
     * @param int|null $flag
     */
    public function testInvalidIp($value, $flag = null)
    {
        Assertion::ip($value, $flag);
    }

    public function invalidIpProvider()
    {
        return array(
            array('invalid ip address'),
            array('14.32.152,216'),
            array('14.32.256.216'),
            array('192.168.0.10', FILTER_FLAG_NO_PRIV_RANGE),
            array('127.0.0.1', FILTER_FLAG_NO_RES_RANGE),
            array('2001:db8:85a3:8d3:1319:8g2e:370:7348'),
            array('fdb9:75b9:9e69:5d08:1:1:1:1', FILTER_FLAG_NO_PRIV_RANGE),
        );
    }

    public function testValidIpv4()
    {
        $this->assertTrue(Assertion::ipv4('109.188.127.26'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_IP
     */
    public function testInvalidIpv4()
    {
        Assertion::ipv4('2001:db8:85a3:8d3:1319:8a2e:370:7348');
    }

    public function testValidIpv6()
    {
        $this->assertTrue(Assertion::ipv6('2001:db8:85a3:8d3:1319:8a2e:370:7348'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_IP
     */
    public function testInvalidIpv6()
    {
        Assertion::ipv6('109.188.127.26');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_INTERFACE
     */
    public function testInvalidInterfaceExists()
    {
        Assertion::interfaceExists('Foo');
    }

    public function testValidInterfaceExists()
    {
        $this->assertTrue(Assertion::interfaceExists('\\Countable'));
    }

    /**
     * @dataProvider providerInvalidBetween
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_BETWEEN
     *
     * @param mixed $value
     * @param mixed $lowerLimit
     * @param mixed $upperLimit
     */
    public function testInvalidBetween($value, $lowerLimit, $upperLimit)
    {
        Assertion::between($value, $lowerLimit, $upperLimit);
    }

    /**
     * @return array
     */
    public function providerInvalidBetween()
    {
        return array(
            array(1, 2, 3),
            array(3, 1, 2),
            array('aaa', 'bbb', 'ccc'),
            array('ddd', 'bbb', 'ccc'),
            array(new \DateTime('yesterday'), new \DateTime('today'), new \DateTime('tomorrow')),
            array(new \DateTime('tomorrow'), new \DateTime('yesterday'), new \DateTime('today')),
        );
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
        return array(
            array(2, 1, 3),
            array(1, 1, 1),
            array('bbb', 'aaa', 'ccc'),
            array('aaa', 'aaa', 'aaa'),
            array(new \DateTime('today'), new \DateTime('yesterday'), new \DateTime('tomorrow')),
            array(new \DateTime('today'), new \DateTime('today'), new \DateTime('today')),
        );
    }

    /**
     * @dataProvider providerInvalidBetweenExclusive
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_BETWEEN_EXCLUSIVE
     *
     * @param mixed $value
     * @param mixed $lowerLimit
     * @param mixed $upperLimit
     */
    public function testInvalidBetweenExclusive($value, $lowerLimit, $upperLimit)
    {
        Assertion::betweenExclusive($value, $lowerLimit, $upperLimit);
    }

    /**
     * @return array
     */
    public function providerInvalidBetweenExclusive()
    {
        return array(
            array(1, 1, 2),
            array(2, 1, 2),
            array('aaa', 'aaa', 'bbb'),
            array('bbb', 'aaa', 'bbb'),
            array(new \DateTime('today'), new \DateTime('today'), new \DateTime('tomorrow')),
            array(new \DateTime('tomorrow'), new \DateTime('today'), new \DateTime('tomorrow')),
        );
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
        return array(
            array(2, 1, 3),
            array('bbb', 'aaa', 'ccc'),
            array(new \DateTime('today'), new \DateTime('yesterday'), new \DateTime('tomorrow')),
        );
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_FLOAT
     * @expectedExceptionMessage 1234567...
     */
    public function testStringifyTruncatesStringValuesLongerThan100CharactersAppropriately()
    {
        $string = \str_repeat('1234567890', 11);

        $this->assertTrue(Assertion::float($string));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion::INVALID_FLOAT
     * @expectedExceptionMessage stream
     */
    public function testStringifyReportsResourceType()
    {
        $this->assertTrue(Assertion::float(\fopen('php://stdin', 'rb')));
    }

    public function testExtensionLoaded()
    {
        $this->assertTrue(Assertion::extensionLoaded('date'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testExtensionNotLoaded()
    {
        Assertion::extensionLoaded('NOT_LOADED');
    }

    public function testValidConstant()
    {
        $this->assertTrue(Assertion::defined('PHP_VERSION'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testInvalidConstant()
    {
        Assertion::defined('NOT_A_CONSTANT');
    }

    public function testValidVersion()
    {
        $this->assertTrue(Assertion::version('1.0.0', '<', '2.0.0'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testInvalidVersion()
    {
        Assertion::version('1.0.0', 'eq', '2.0.0');
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testInvalidVersionOperator()
    {
        Assertion::version('1.0.0', null, '2.0.0');
    }

    public function testValidPhpVersion()
    {
        $this->assertTrue(Assertion::phpVersion('>', '4.0.0'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testInvalidPhpVersion()
    {
        Assertion::phpVersion('<', '5.0.0');
    }

    public function testValidExtensionVersion()
    {
        $this->assertTrue(Assertion::extensionVersion('json', '>', '1.0.0'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testInvalidExtensionVersion()
    {
        Assertion::extensionVersion('json', '<', '0.1.0');
    }

    public function testObjectOrClass()
    {
        self::assertTrue(Assertion::objectOrClass(new \stdClass()));
        self::assertTrue(Assertion::objectOrClass('stdClass'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testNotObjectOrClass()
    {
        Assertion::objectOrClass('InvalidClassName');
    }

    public function testPropertyExists()
    {
        self::assertTrue(Assertion::propertyExists(new \Exception(), 'message'));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testPropertyNotExists()
    {
        Assertion::propertyExists(new \Exception(), 'invalidProperty');
    }

    public function testPropertiesExist()
    {
        self::assertTrue(Assertion::propertiesExist(new \Exception(), array('message', 'code', 'previous')));
    }

    /**
     * @expectedException \Assert\InvalidArgumentException
     */
    public function testPropertiesNotExist()
    {
        Assertion::propertiesExist(new \Exception(), array('invalidProperty'));
    }
}
