<?php
namespace Assert\Tests;

use Assert\Assertion;

class AssertTest extends \PHPUnit_Framework_TestCase
{
    static public function dataInvalidInteger()
    {
        return array(
            array(1.23),
            array(false),
            array("test"),
            array(null),
            array("1.23"),
            array("10"),
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
        Assertion::integer(10);
        Assertion::integer(0);
    }

    public function testValidIntegerish()
    {
        Assertion::integerish(10);
        Assertion::integerish("10");
    }

    static public function dataInvalidIntegerish()
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
        Assertion::boolean(true);
        Assertion::boolean(false);
    }

    public function testInvalidBoolean()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_BOOLEAN);
        Assertion::boolean(1);
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
        Assertion::notEmpty("test");
        Assertion::notEmpty(1);
        Assertion::notEmpty(true);
        Assertion::notEmpty( array("foo") );
    }

    public function testNotNull()
    {
        Assertion::notNull("1");
        Assertion::notNull(1);
        Assertion::notNull(0);
        Assertion::notNull(array());
        Assertion::notNull(false);
    }

    public function testInvalidNotNull()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::VALUE_NULL);
        Assertion::notNull(null);
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
        Assertion::minLength("foo", 3);
        Assertion::minLength("foo", 1);
        Assertion::minLength("foo", 0);
        Assertion::minLength("", 0);
        Assertion::minLength("址址", 2);
    }

    public function testInvalidMaxLength()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MAX_LENGTH);
        Assertion::maxLength("foo", 2);
    }

    public function testValidMaxLength()
    {
        Assertion::maxLength("foo", 10);
        Assertion::maxLength("foo", 3);
        Assertion::maxLength("", 0);
        Assertion::maxLength("址址", 2);
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
        Assertion::betweenLength("foo", 0, 3);
        Assertion::betweenLength("址址", 2, 2);
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
        Assertion::startsWith("foo", "foo");
        Assertion::startsWith("foo", "fo");
        Assertion::startsWith("foo", "f");
        Assertion::startsWith("址foo", "址");
    }

    public function testInvalidContains()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_STRING_CONTAINS);
        Assertion::contains("foo", "bar");
    }

    public function testValidContains()
    {
        Assertion::contains("foo", "foo");
        Assertion::contains("foo", "oo");
    }

    public function testInvalidChoice()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_CHOICE);
        Assertion::choice("foo", array("bar", "baz"));
    }

    public function testValidChoice()
    {
        Assertion::choice("foo", array("foo"));
    }

    public function testInvalidInArray()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_CHOICE);
        Assertion::inArray("bar", array("baz"));
    }

    public function testValidInArray()
    {
        Assertion::inArray("foo", array("foo"));
    }

    public function testInvalidNumeric()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_NUMERIC);
        Assertion::numeric("foo");
    }

    public function testValidNumeric()
    {
        Assertion::numeric("1");
        Assertion::numeric(1);
        Assertion::numeric(1.23);
    }

    public static function dataInvalidArray()
    {
        return array(
            array(null),
            array(false),
            array("test"),
            array(1),
            array(1.23),
            array(new \StdClass),
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
        Assertion::isArray(array());
        Assertion::isArray(array(1,2,3));
        Assertion::isArray(array(array(),array()));
    }

    public function testInvalidKeyExists()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_KEY_EXISTS);
        Assertion::keyExists(array("foo" => "bar"), "baz");
    }

    public function testValidKeyExists()
    {
        Assertion::keyExists(array("foo" => "bar"), "foo");
    }

    public function testInvalidNotBlank()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_NOT_BLANK);
        Assertion::notBlank("");
    }

    public function testValidNotBlank()
    {
        Assertion::notBlank("foo");
    }

    public function testInvalidInstanceOf()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_INSTANCE_OF);
        Assertion::isInstanceOf(new \stdClass, 'PDO');
    }

    public function testValidInstanceOf()
    {
        Assertion::isInstanceOf(new \stdClass, 'stdClass');
    }

    public function testInvalidSubclassOf()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_SUBCLASS_OF);
        Assertion::subclassOf(new \stdClass, 'PDO');
    }

    public function testValidSubclassOf()
    {
        Assertion::subclassOf(new ChildStdClass, 'stdClass');
    }

    public function testInvalidRange()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_RANGE);
        Assertion::range(1, 2, 3);
    }

    public function testValidRange()
    {
        Assertion::range(1, 1, 2);
        Assertion::range(2, 1, 2);
        Assertion::range(2, 0, 100);
    }

    public function testInvalidEmail()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_EMAIL);
        Assertion::email("foo");
    }

    public function testValidEmail()
    {
        Assertion::email("123hello+world@email.provider.com");
    }

    /**
     * @dataProvider invalidUrlDataprovider
     */
    public function testInvalidUrl($url)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_URL);

        Assertion::url($url);
    }
    public static function invalidUrlDataprovider()
    {
        return array(
            'null value' => array(""),
            'empty string' => array(" "),
            'no scheme' => array("url.de"),
            'unsupported scheme' => array("git://url.de"),
            'Http with query (no / between tld und ?)' => array("http://example.org?do=something"),
            'Http with query and port (no / between port und ?)' => array("http://example.org:8080?do=something"),
        );
    }

    /**
     * @dataProvider validUrlDataprovider
     */
    public function testValidUrl($url)
    {
        Assertion::url($url);
    }
    public static function validUrlDataprovider()
    {
        return array(
            'straight with Http' => array("http://example.org"),
            'Http with path' => array("http://example.org/do/something"),
            'Http with query' => array("http://example.org/index.php?do=something"),
            'Http with port' => array("http://example.org:8080"),
            'Http with all possibilities' => array("http://example.org:8080/do/something/index.php?do=something"),
            'straight with Https' => array("https://example.org"),
        );
    }

    public function testInvalidDigit()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_DIGIT);
        Assertion::digit(-1);
    }

    public function testValidDigit()
    {
        Assertion::digit(1);
        Assertion::digit(0);
        Assertion::digit("0");
    }

    public function testValidAlnum()
    {
        Assertion::alnum("a");
        Assertion::alnum("a1");
        Assertion::alnum("aasdf1234");
        Assertion::alnum("a1b2c3");
    }

    public function testInvalidAlnum()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_ALNUM);
        Assertion::alnum("1a");
    }

    public function testValidTrue()
    {
        Assertion::true(1 == 1);
    }

    public function testInvalidTrue()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_TRUE);
        Assertion::true(false);
    }

    public function testValidFalse()
    {
        Assertion::false(1 == 0);
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
        Assertion::classExists("\\Exception");
    }

    public function testSame()
    {
        Assertion::same(1,1);
        Assertion::same("foo","foo");
        Assertion::same($obj = new \stdClass(), $obj);
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_SAME);
        Assertion::same(new \stdClass(), new \stdClass());
    }

    public function testEq()
    {
        Assertion::eq(1,"1");
        Assertion::eq("foo",true);
        Assertion::eq($obj = new \stdClass(), $obj);
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_EQ);
        Assertion::eq("2", 1);
    }

    public function testMin()
    {
        Assertion::min(1, 1);
        Assertion::min(2, 1);

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MIN);
        Assertion::min(0, 1);
    }

    public function testMax()
    {
        Assertion::max(1, 1);
        Assertion::max(0, 1);

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MAX);
        Assertion::max(2, 1);
    }

    public function testNullOr()
    {
        Assertion::nullOrMax(null, 1);
        Assertion::nullOrMax(null, 2);
    }

    public function testLength()
    {
        Assertion::length("asdf", 4);
        Assertion::length("", 0);
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
        Assertion::length($value, $expected);
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
        Assertion::length("址", 1, null, null, 'utf8');
    }

    public function testFile()
    {
        Assertion::file(__FILE__);
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
        Assertion::directory(__DIR__);

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_DIRECTORY);
        Assertion::directory(__DIR__ . '/does-not-exist');
    }

    public function testReadable()
    {
        Assertion::readable(__FILE__);

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_READABLE);
        Assertion::readable(__DIR__ . '/does-not-exist');
    }

    public function testWriteable()
    {
        Assertion::writeable(sys_get_temp_dir());

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
        Assertion::implementsInterface(
            '\ArrayIterator',
            '\Traversable'
        );

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INTERFACE_NOT_IMPLEMENTED);
        Assertion::implementsInterface(
            '\Exception',
            '\Traversable'
        );
    }

    public function testImplementsInterfaceWithClassObject()
    {
        $class = new \ArrayObject();

        Assertion::implementsInterface(
            $class,
            '\Traversable'
        );

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INTERFACE_NOT_IMPLEMENTED);
        Assertion::implementsInterface(
            $class,
            '\SplObserver'
        );
    }

    public function testIsJsonString()
    {
        $validString = json_encode(array('Tux', 'Linus', 'Gnu'));
        $invalidString = 'invalid json encoded string';

        Assertion::isJsonString($validString);

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_JSON_STRING);
        Assertion::isJsonString($invalidString);
    }
}

class ChildStdClass extends \stdClass
{

}
