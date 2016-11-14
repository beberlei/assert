<?php
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
            array("test"),
            array(null),
            array("1.23"),
            array("10"),
        );
    }

    /**
     * @dataProvider dataInvalidFloat
     */
    public function testInvalidFloat($nonFloat)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_FLOAT);
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
            array("test"),
            array(null),
            array("1.23"),
            array("10"),
            array(new \DateTime()),
        );
    }

    /**
     * @dataProvider dataInvalidInteger
     */
    public function testInvalidInteger($nonInteger)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_INTEGER);
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
        $this->assertTrue(Assertion::integerish("10"));
    }

    public static function dataInvalidIntegerish()
    {
        return array(
            array(1.23),
            array(false),
            array("test"),
            array(null),
            array("1.23"),
        );
    }

    /**
     * @dataProvider dataInvalidIntegerish
     */
    public function testInvalidIntegerish($nonInteger)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_INTEGERISH);
        Assertion::integerish($nonInteger);
    }

    public function testValidBoolean()
    {
        $this->assertTrue(Assertion::boolean(true));
        $this->assertTrue(Assertion::boolean(false));
    }

    public function testInvalidBoolean()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_BOOLEAN);
        Assertion::boolean(1);
    }

    public function testInvalidScalar()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_SCALAR);
        Assertion::scalar(new \stdClass);
    }

    public function testValidScalar()
    {
        $this->assertTrue(Assertion::scalar("foo"));
        $this->assertTrue(Assertion::scalar(52));
        $this->assertTrue(Assertion::scalar(12.34));
        $this->assertTrue(Assertion::scalar(false));
    }

    public static function dataInvalidNotEmpty()
    {
        return array(
            array(""),
            array(false),
            array(0),
            array(null),
            array( array() ),
        );
    }

    /**
     * @dataProvider dataInvalidNotEmpty
     */
    public function testInvalidNotEmpty($value)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::VALUE_EMPTY);
        Assertion::notEmpty($value);
    }

    public function testNotEmpty()
    {
        $this->assertTrue(Assertion::notEmpty("test"));
        $this->assertTrue(Assertion::notEmpty(1));
        $this->assertTrue(Assertion::notEmpty(true));
        $this->assertTrue(Assertion::notEmpty(array("foo")));
    }

    public function testEmpty()
    {
        $this->assertTrue(Assertion::noContent(""));
        $this->assertTrue(Assertion::noContent(0));
        $this->assertTrue(Assertion::noContent(false));
        $this->assertTrue(Assertion::noContent(array()));
    }

    public static function dataInvalidEmpty()
    {
        return array(
            array("foo"),
            array(true),
            array(12),
            array( array('foo') ),
            array( new \stdClass() ),
        );
    }

    /**
     * @dataProvider dataInvalidEmpty
     */
    public function testInvalidEmpty($value)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::VALUE_NOT_EMPTY);
        Assertion::noContent($value);
    }

    public static function dataInvalidNull()
    {
        return array(
            array("foo"),
            array(""),
            array(false),
            array(12),
            array(0),
            array(array()),
        );
    }

    /**
     * @dataProvider dataInvalidNull
     */
    public function testInvalidNull($value)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::VALUE_NOT_NULL);
        Assertion::null($value);
    }

    public function testNull()
    {
        $this->assertTrue(Assertion::null(null));
    }

    public function testNotNull()
    {
        $this->assertTrue(Assertion::notNull("1"));
        $this->assertTrue(Assertion::notNull(1));
        $this->assertTrue(Assertion::notNull(0));
        $this->assertTrue(Assertion::notNull(array()));
        $this->assertTrue(Assertion::notNull(false));
    }

    public function testInvalidNotNull()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::VALUE_NULL);
        Assertion::notNull(null);
    }

    public function testString()
    {
        $this->assertTrue(Assertion::string("test-string"));
        $this->assertTrue(Assertion::string(""));
    }

    /**
     * @dataProvider dataInvalidString
     */
    public function testInvalidString($invalidString)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_STRING);
        Assertion::string($invalidString);
    }

    public static function dataInvalidString()
    {
        return array(
            array(1.23),
            array(false),
            array(new \ArrayObject),
            array(null),
            array(10),
            array(true),
        );
    }

    public function testValidRegex()
    {
        $this->assertTrue(Assertion::regex('some string', '/.*/'));
    }

    public function testInvalidRegex()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_REGEX);
        Assertion::regex("foo", "(bar)");
    }

    public function testInvalidRegexValueNotString()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_STRING);
        Assertion::regex(array("foo"), "(bar)");
    }

    public function testInvalidMinLength()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MIN_LENGTH);
        Assertion::minLength("foo", 4);
    }

    public function testValidMinLength()
    {
        $this->assertTrue(Assertion::minLength("foo", 3));
        $this->assertTrue(Assertion::minLength("foo", 1));
        $this->assertTrue(Assertion::minLength("foo", 0));
        $this->assertTrue(Assertion::minLength("", 0));
        $this->assertTrue(Assertion::minLength("址址", 2));
    }

    public function testInvalidMaxLength()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MAX_LENGTH);
        Assertion::maxLength("foo", 2);
    }

    public function testValidMaxLength()
    {
        $this->assertTrue(Assertion::maxLength("foo", 10));
        $this->assertTrue(Assertion::maxLength("foo", 3));
        $this->assertTrue(Assertion::maxLength("", 0));
        $this->assertTrue(Assertion::maxLength("址址", 2));
    }

    public function testInvalidBetweenLengthMin()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MIN_LENGTH);
        Assertion::betweenLength("foo", 4, 100);
    }

    public function testInvalidBetweenLengthMax()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MAX_LENGTH);
        Assertion::betweenLength("foo", 0, 2);
    }

    public function testValidBetweenLength()
    {
        $this->assertTrue(Assertion::betweenLength("foo", 0, 3));
        $this->assertTrue(Assertion::betweenLength("址址", 2, 2));
    }

    public function testInvalidStartsWith()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_STRING_START);
        Assertion::startsWith("foo", "bar");
    }

    public function testInvalidStartsWithDueToWrongEncoding()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_STRING_START);
        Assertion::startsWith("址", "址址", null, null, 'ASCII');
    }

    public function testValidStartsWith()
    {
        $this->assertTrue(Assertion::startsWith("foo", "foo"));
        $this->assertTrue(Assertion::startsWith("foo", "fo"));
        $this->assertTrue(Assertion::startsWith("foo", "f"));
        $this->assertTrue(Assertion::startsWith("址foo", "址"));
    }

    public function testInvalidEndsWith()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_STRING_END);
        Assertion::endsWith("foo", "bar");
    }

    public function testInvalidEndsWithDueToWrongEncoding()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_STRING_END);
        Assertion::endsWith("址", "址址", null, null, 'ASCII');
    }

    public function testValidEndsWith()
    {
        $this->assertTrue(Assertion::endsWith("foo", "foo"));
        $this->assertTrue(Assertion::endsWith("sonderbar", "bar"));
        $this->assertTrue(Assertion::endsWith("opp", "p"));
        $this->assertTrue(Assertion::endsWith("foo址", "址"));
    }

    public function testInvalidContains()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_STRING_CONTAINS);
        Assertion::contains("foo", "bar");
    }

    public function testValidContains()
    {
        $this->assertTrue(Assertion::contains("foo", "foo"));
        $this->assertTrue(Assertion::contains("foo", "oo"));
    }

    public function testInvalidChoice()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_CHOICE);
        Assertion::choice("foo", array("bar", "baz"));
    }

    public function testValidChoice()
    {
        $this->assertTrue(Assertion::choice("foo", array("foo")));
    }

    public function testInvalidInArray()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_CHOICE);
        Assertion::inArray("bar", array("baz"));
    }

    public function testValidInArray()
    {
        $this->assertTrue(Assertion::inArray("foo", array("foo")));
    }

    public function testInvalidNumeric()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_NUMERIC);
        Assertion::numeric("foo");
    }

    public function testValidNumeric()
    {
        $this->assertTrue(Assertion::numeric("1"));
        $this->assertTrue(Assertion::numeric(1));
        $this->assertTrue(Assertion::numeric(1.23));
    }

    public static function dataInvalidArray()
    {
        return array(
            array(null),
            array(false),
            array("test"),
            array(1),
            array(1.23),
            array(new \stdClass),
            array(fopen('php://memory', 'r')),
        );
    }

    /**
     * @dataProvider dataInvalidArray
     */
    public function testInvalidArray($value)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_ARRAY);
        Assertion::isArray($value);
    }

    public function testValidArray()
    {
        $this->assertTrue(Assertion::isArray(array()));
        $this->assertTrue(Assertion::isArray(array(1, 2, 3)));
        $this->assertTrue(Assertion::isArray(array(array(), array())));
    }

    public function testInvalidKeyExists()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_KEY_EXISTS);
        Assertion::keyExists(array("foo" => "bar"), "baz");
    }

    public function testValidKeyExists()
    {
        $this->assertTrue(Assertion::keyExists(array("foo" => "bar"), "foo"));
    }

    public function testInvalidKeyNotExists()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_KEY_NOT_EXISTS);
        Assertion::keyNotExists(array("foo" => "bar"), "foo");
    }

    public function testValidKeyNotExists()
    {
        $this->assertTrue(Assertion::keyNotExists(array("foo" => "bar"), "baz"));
    }

    public static function dataInvalidNotBlank()
    {
        return array(
            array(""),
            array(" "),
            array("\t"),
            array("\n"),
            array("\r"),
            array(false),
            array(null),
            array( array() ),
        );
    }

    /**
     * @dataProvider dataInvalidNotBlank
     */
    public function testInvalidNotBlank($notBlank)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_NOT_BLANK);
        Assertion::notBlank($notBlank);
    }

    public function testValidNotBlank()
    {
        $this->assertTrue(Assertion::notBlank("foo"));
    }

    public function testInvalidNotInstanceOf()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_NOT_INSTANCE_OF);
        Assertion::notIsInstanceOf(new \stdClass, 'stdClass');
    }

    public function testValidNotIsInstanceOf()
    {
        $this->assertTrue(Assertion::notIsInstanceOf(new \stdClass, 'PDO'));
    }

    public function testInvalidInstanceOf()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_INSTANCE_OF);
        Assertion::isInstanceOf(new \stdClass, 'PDO');
    }

    public function testValidInstanceOf()
    {
        $this->assertTrue(Assertion::isInstanceOf(new \stdClass, 'stdClass'));
    }

    public function testInvalidSubclassOf()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_SUBCLASS_OF);
        Assertion::subclassOf(new \stdClass, 'PDO');
    }

    public function testValidSubclassOf()
    {
        $this->assertTrue(Assertion::subclassOf(new ChildStdClass, 'stdClass'));
    }

    public function testInvalidRange()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_RANGE);
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
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_EMAIL);
        Assertion::email("foo");
    }

    public function testValidEmail()
    {
        $this->assertTrue(Assertion::email("123hello+world@email.provider.com"));
    }

    /**
     * @dataProvider dataInvalidUrl
     */
    public function testInvalidUrl($url)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_URL);

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

    public function testInvalidDigit()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_DIGIT);
        Assertion::digit(-1);
    }

    public function testValidDigit()
    {
        $this->assertTrue(Assertion::digit(1));
        $this->assertTrue(Assertion::digit(0));
        $this->assertTrue(Assertion::digit("0"));
    }

    public function testValidAlnum()
    {
        $this->assertTrue(Assertion::alnum("a"));
        $this->assertTrue(Assertion::alnum("a1"));
        $this->assertTrue(Assertion::alnum("aasdf1234"));
        $this->assertTrue(Assertion::alnum("a1b2c3"));
    }

    public function testInvalidAlnum()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_ALNUM);
        Assertion::alnum("1a");
    }

    public function testValidTrue()
    {
        $this->assertTrue(Assertion::true(1 == 1));
    }

    public function testInvalidTrue()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_TRUE);
        Assertion::true(false);
    }

    public function testValidFalse()
    {
        $this->assertTrue(Assertion::false(1 == 0));
    }

    public function testInvalidFalse()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_FALSE);
        Assertion::false(true);
    }

    public function testInvalidClass()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_CLASS);
        Assertion::classExists("Foo");
    }

    public function testValidClass()
    {
        $this->assertTrue(Assertion::classExists("\\Exception"));
    }

    public function testSame()
    {
        $this->assertTrue(Assertion::same(1, 1));
        $this->assertTrue(Assertion::same("foo", "foo"));
        $this->assertTrue(Assertion::same($obj = new \stdClass(), $obj));
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_SAME);
        Assertion::same(new \stdClass(), new \stdClass());
    }

    public function testEq()
    {
        $this->assertTrue(Assertion::eq(1, "1"));
        $this->assertTrue(Assertion::eq("foo", true));
        $this->assertTrue(Assertion::eq($obj = new \stdClass(), $obj));
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_EQ);
        Assertion::eq("2", 1);
    }

    public function testNotEq()
    {
        $this->assertTrue(Assertion::notEq("1", false));
        $this->assertTrue(Assertion::notEq(new \stdClass(), array()));
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_NOT_EQ);
        Assertion::notEq("1", 1);
    }

    public function testNotSame()
    {
        $this->assertTrue(Assertion::notSame("1", 2));
        $this->assertTrue(Assertion::notSame(new \stdClass(), array()));
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_NOT_SAME);
        Assertion::notSame(1, 1);
    }

    public function testNotInArray()
    {
        $this->assertTrue(Assertion::notInArray(6, range(1, 5)));

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_VALUE_IN_ARRAY);
        Assertion::notInArray(1, range(1, 5));
        Assertion::notInArray(range('a', 'c'), range('a', 'd'));
    }

    public function testMin()
    {
        $this->assertTrue(Assertion::min(1, 1));
        $this->assertTrue(Assertion::min(2, 1));
        $this->assertTrue(Assertion::min(2.5, 1));

        try {
            Assertion::min(0, 1);
            $this->fail('Expected exception `Assert\AssertionFailedException` not thrown');
        } catch (AssertionFailedException $e) {
            $this->assertEquals(Assertion::INVALID_MIN, $e->getCode());
            $this->assertEquals('Number "0" was expected to be at least "1".', $e->getMessage());
        }

        try {
            Assertion::min(0.5, 2.5);
            $this->fail('Expected exception `Assert\AssertionFailedException` not thrown');
        } catch (AssertionFailedException $e) {
            $this->assertEquals(Assertion::INVALID_MIN, $e->getCode());
            $this->assertEquals('Number "0.5" was expected to be at least "2.5".', $e->getMessage());
        }
    }

    public function testMax()
    {
        $this->assertTrue(Assertion::max(1, 1));
        $this->assertTrue(Assertion::max(0.5, 1));
        $this->assertTrue(Assertion::max(0, 1));

        try {
            Assertion::max(2, 1);
            $this->fail('Expected exception `Assert\AssertionFailedException` not thrown');
        } catch (AssertionFailedException $e) {
            $this->assertEquals(Assertion::INVALID_MAX, $e->getCode());
            $this->assertEquals('Number "2" was expected to be at most "1".', $e->getMessage());
        }

        try {
            Assertion::max(2.5, 0.5);
            $this->fail('Expected exception `Assert\AssertionFailedException` not thrown');
        } catch (AssertionFailedException $e) {
            $this->assertEquals(Assertion::INVALID_MAX, $e->getCode());
            $this->assertEquals('Number "2.5" was expected to be at most "0.5".', $e->getMessage());
        }
    }

    public function testNullOr()
    {
        $this->assertTrue(Assertion::nullOrMax(null, 1));
        $this->assertTrue(Assertion::nullOrMax(null, 2));
    }

    public function testNullOrWithNoValueThrows()
    {
        $this->setExpectedException('BadMethodCallException');
        Assertion::nullOrMax();
    }

    public function testLength()
    {
        $this->assertTrue(Assertion::length("asdf", 4));
        $this->assertTrue(Assertion::length("", 0));
    }

    public static function dataLengthUtf8Characters()
    {
        return array(
            array("址", 1),
            array("ل", 1),
        );
    }

    /**
     * @dataProvider dataLengthUtf8Characters
     */
    public function testLenghtUtf8Characters($value, $expected)
    {
        $this->assertTrue(Assertion::length($value, $expected));
    }

    public function testLengthFailed()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_LENGTH);
        Assertion::length("asdf", 3);
    }

    public function testLengthFailedForWrongEncoding()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_LENGTH);
        Assertion::length("址", 1, null, null, 'ASCII');
    }

    public function testLengthValidForGivenEncoding()
    {
        $this->assertTrue(Assertion::length("址", 1, null, null, 'utf8'));
    }

    public function testFile()
    {
        $this->assertTrue(Assertion::file(__FILE__));
    }

    public function testFileWithEmptyFilename()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::VALUE_EMPTY);
        Assertion::file("");
    }

    public function testFileDoesNotExists()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_FILE);
        Assertion::file(__DIR__ . '/does-not-exists');
    }

    public function testDirectory()
    {
        $this->assertTrue(Assertion::directory(__DIR__));

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_DIRECTORY);
        Assertion::directory(__DIR__ . '/does-not-exist');
    }

    public function testReadable()
    {
        $this->assertTrue(Assertion::readable(__FILE__));

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_READABLE);
        Assertion::readable(__DIR__ . '/does-not-exist');
    }

    public function testWriteable()
    {
        $this->assertTrue(Assertion::writeable(sys_get_temp_dir()));

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_WRITEABLE);
        Assertion::writeable(__DIR__ . '/does-not-exist');
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage No assertion
     */
    public function testFailedNullOrMethodCall()
    {
        Assertion::NullOrAssertionDoesNotExist();
    }

    public function testImplementsInterface()
    {
        $this->assertTrue(Assertion::implementsInterface(
            '\ArrayIterator',
            '\Traversable'
        ));

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INTERFACE_NOT_IMPLEMENTED);
        Assertion::implementsInterface(
            '\Exception',
            '\Traversable'
        );
    }

    public function testImplementsInterfaceWithClassObject()
    {
        $class = new \ArrayObject();

        $this->assertTrue(Assertion::implementsInterface(
            $class,
            '\Traversable'
        ));

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INTERFACE_NOT_IMPLEMENTED);
        Assertion::implementsInterface(
            $class,
            '\SplObserver'
        );
    }

    /**
     * @dataProvider isJsonStringDataprovider
     */
    public function testIsJsonString($content)
    {
        $this->assertTrue(Assertion::isJsonString($content));
    }

    public static function isJsonStringDataprovider()
    {
        return array(
            '»null« value' => array(json_encode(null)),
            '»false« value' => array(json_encode(false)),
            'array value' => array('["false"]'),
            'object value' => array('{"tux":"false"}'),
        );
    }

    /**
     * @dataProvider isJsonStringInvalidStringDataprovider
     */
    public function testIsJsonStringExpectingException($invalidString)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_JSON_STRING);
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
     */
    public function testValidUuids($uuid)
    {
        $this->assertTrue(Assertion::uuid($uuid));
    }

    /**
     * @dataProvider providesInvalidUuids
     */
    public function testInvalidUuids($uuid)
    {
        $this->setExpectedException('Assert\InvalidArgumentException');
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
     */
    public function testValidE164s($e164)
    {
        $this->assertTrue(Assertion::e164($e164));
    }

    /**
     * @dataProvider providesInvalidE164s
     */
    public function testInvalidE164s($e164)
    {
        $this->setExpectedException('Assert\InvalidArgumentException');
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
     * @dataProvider invalidNotEmptyKeyDataprovider
     */
    public function testInvalidNotEmptyKey($invalidArray, $key)
    {
        $this->setExpectedException('Assert\InvalidArgumentException');
        Assertion::notEmptyKey($invalidArray, $key);
    }

    public static function invalidNotEmptyKeyDataprovider()
    {
        return array(
            'empty'          => array(array('keyExists' => ''), 'keyExists'),
            'key not exists' => array(array('key' => 'notEmpty'), 'keyNotExists')
        );
    }

    public function testAllWithSimpleAssertion()
    {
        $this->assertTrue(Assertion::allTrue(array(true, true)));
    }

    public function testAllWithSimpleAssertionThrowsExceptionOnElementThatFailsAssertion()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_TRUE);
        Assertion::allTrue(array(true, false));
    }

    public function testAllWithComplexAssertion()
    {
        $this->assertTrue(Assertion::allIsInstanceOf(array(new \stdClass, new \stdClass), 'stdClass'));
    }

    public function testAllWithComplexAssertionThrowsExceptionOnElementThatFailsAssertion()
    {
        $this->setExpectedException('Assert\AssertionFailedException', 'Assertion failed', Assertion::INVALID_INSTANCE_OF);

        Assertion::allIsInstanceOf(array(new \stdClass, new \stdClass), 'PDO', 'Assertion failed', 'foos');
    }

    public function testAllWithNoValueThrows()
    {
        $this->setExpectedException('BadMethodCallException');
        Assertion::allTrue();
    }

    public function testValidCount()
    {
        $this->assertTrue(Assertion::count(array('Hi'), 1));
        $this->assertTrue(Assertion::count(new OneCountable(), 1));
    }

    public static function dataInvalidCount()
    {
        return array(
            array(array('Hi', 'There'), 3),
            array(new OneCountable(), 2),
        );
    }

    /**
     * @dataProvider dataInvalidCount
     */
    public function testInvalidCount($countable, $count)
    {
        $this->setExpectedException('Assert\AssertionFailedException', 'List does not contain exactly "'.$count.'" elements.', Assertion::INVALID_COUNT);
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
     */
    public function testChoicesNotEmptyExpectingException($values, $choices, $exceptionCode)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, $exceptionCode);
        Assertion::choicesNotEmpty(
            $values,
            $choices
        );
    }

    public function invalidChoicesProvider()
    {
        return array(
            'empty values' => array(array(), array('tux'), Assertion::VALUE_EMPTY),
            'empty recodes in $values' => array(array('tux' => ''), array('tux'), Assertion::VALUE_EMPTY),
            'choice not found in values' => array(array('tux' => ''), array('invalidChoice'), Assertion::INVALID_KEY_ISSET),
        );
    }

    public function testIsObject()
    {
        $this->assertTrue(Assertion::isObject(new \stdClass));
    }

    public function testIsObjectExpectingException()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_OBJECT);
        Assertion::isObject('notAnObject');
    }

    public function testMethodExists()
    {
        $this->assertTrue(Assertion::methodExists('methodExists', new Assertion()));
    }

    public function testMethodExistsFailure()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_METHOD);
        Assertion::methodExists('methodNotExists', new Assertion());
    }

    /**
     * @test
     */
    public function it_passes_values_and_constraints_to_exception()
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
     */
    public function testLessThanThrowsException($value, $limit)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_LESS);
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
     */
    public function testLessOrEqualThanThrowsException($value, $limit)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_LESS_OR_EQUAL);
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
            array('1439486158', 'U')
        );
    }

    /**
     * @dataProvider invalidGreaterProvider
     */
    public function testGreaterThanThrowsException($value, $limit)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_GREATER);
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
     *
     * @param mixed $value
     * @param mixed $limit
     */
    public function testGreaterOrEqualThanThrowsException($value, $limit)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_GREATER_OR_EQUAL);
        Assertion::greaterOrEqualThan($value, $limit);
    }

    /**
     * @dataProvider invalidDateProvider
     */
    public function testInvalidDate($value, $format)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_DATE);
        Assertion::date($value, $format);
    }

    public function invalidDateProvider()
    {
        return array(
            array('this is not the date', 'Y-m-d'),
            array('2011-02-29', 'Y-m-d'),
            array('2012.02.29 12:60:36.432563', 'Y.m.d H:i:s.u')
        );
    }

    public function testValidTraversable()
    {
        $this->assertTrue(Assertion::isTraversable(new \ArrayObject));
    }

    public function testInvalidTraversable()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_TRAVERSABLE);
        Assertion::isTraversable('not traversable');
    }

    public function testValidArrayAccessible()
    {
        $this->assertTrue(Assertion::isArrayAccessible(new \ArrayObject));
    }

    public function testInvalidArrayAccessible()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', null, Assertion::INVALID_ARRAY_ACCESSIBLE);
        Assertion::isArrayAccessible('not array accessible');
    }

    public function testInvalidCallable()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_CALLABLE);
        Assertion::isCallable("nonExistingFunction");
    }

    public function testValidCallable()
    {
        $this->assertTrue(Assertion::isCallable('\is_callable'));
        $this->assertTrue(Assertion::isCallable(__NAMESPACE__ . "\\someCallable"));
        $this->assertTrue(Assertion::isCallable(array(__NAMESPACE__ . "\\OneCountable", "count")));
        $this->assertTrue(Assertion::isCallable(function () {
        }));
    }

    public function testInvalidSatisfy()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_SATISFY);
        Assertion::satisfy(null, function ($value) {
            return !is_null($value);
        });
    }

    public function testValidSatisfy()
    {
        // Should not fail with true return
        $this->assertTrue(Assertion::satisfy(null, function ($value) {
            return is_null($value);
        }));

        // Should not fail with void return
        $this->assertTrue(Assertion::satisfy(true, function ($value) {
            if (!is_bool($value)) {
                return false;
            }
        }));
    }

    /**
     * @dataProvider validIpProvider
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
     */
    public function testInvalidIp($value, $flag = null)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_IP);
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

    public function testInvalidIpv4()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_IP);
        Assertion::ipv4('2001:db8:85a3:8d3:1319:8a2e:370:7348');
    }

    public function testValidIpv6()
    {
        $this->assertTrue(Assertion::ipv6('2001:db8:85a3:8d3:1319:8a2e:370:7348'));
    }

    public function testInvalidIpv6()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_IP);
        Assertion::ipv6('109.188.127.26');
    }

    public function testInvalidInterfaceExists()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_INTERFACE);
        Assertion::interfaceExists("Foo");
    }

    public function testValidInterfaceExists()
    {
        $this->assertTrue(Assertion::interfaceExists("\\Countable"));
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
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_BETWEEN);

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
     *
     * @param mixed $value
     * @param mixed $lowerLimit
     * @param mixed $upperLimit
     */
    public function testInvalidBetweenExclusive($value, $lowerLimit, $upperLimit)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_BETWEEN_EXCLUSIVE);

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

    public function testStringifyTruncatesStringValuesLongerThan100CharactersAppropriately()
    {
        $string = str_repeat('1234567890', 11);

        $this->setExpectedException('Assert\AssertionFailedException', '1234567...', Assertion::INVALID_FLOAT);

        $this->assertTrue(Assertion::float($string));
    }

    public function testStringifyReportsResourceType()
    {
        $this->setExpectedException('Assert\AssertionFailedException', 'stream', Assertion::INVALID_FLOAT);

        $this->assertTrue(Assertion::float(fopen('php://stdin', 'rb')));
    }
}

class ChildStdClass extends \stdClass
{
}

class OneCountable implements \Countable
{
    public function count()
    {
        return 1;
    }
}

function someCallable()
{
}
