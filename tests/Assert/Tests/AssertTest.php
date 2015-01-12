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
        Assertion::float(1.0);
        Assertion::float(0.1);
        Assertion::float(-1.1);
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
        Assertion::boolean(true);
        Assertion::boolean(false);
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
        Assertion::scalar("foo");
        Assertion::scalar(52);
        Assertion::scalar(12.34);
        Assertion::scalar(false);
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

    public function testEmpty()
    {
        Assertion::noContent("");
        Assertion::noContent(0);
        Assertion::noContent(false);
        Assertion::noContent( array() );
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

    public function testString()
    {
        Assertion::string("test-string");
        Assertion::string("");
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
        Assertion::endsWith("foo", "foo");
        Assertion::endsWith("sonderbar", "bar");
        Assertion::endsWith("opp", "p");
        Assertion::endsWith("foo址", "址");
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

    public function testInvalidNotInstanceOf()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_NOT_INSTANCE_OF);
        Assertion::notIsInstanceOf(new \stdClass, 'stdClass');
    }

    public function testValidNotIsInstanceOf()
    {
        Assertion::notIsInstanceOf(new \stdClass, 'PDO');
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
        Assertion::range(1.5, 2, 3);
    }

    public function testValidRange()
    {
        Assertion::range(1, 1, 2);
        Assertion::range(2, 1, 2);
        Assertion::range(2, 0, 100);
        Assertion::range(2.5, 2.25, 2.75);
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
            'null value' => array(""),
            'empty string' => array(" "),
            'no scheme' => array("url.de"),
            'Http with query (no / between tld und ?)' => array("http://example.org?do=something"),
            'Http with query and port (no / between port und ?)' => array("http://example.org:8080?do=something"),
        );
    }

    /**
     * @dataProvider dataValidUrl
     */
    public function testValidUrl($url)
    {
        Assertion::url($url);
    }

    public static function dataValidUrl()
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

    public function testNotEq()
    {
        Assertion::NotEq("1", false);
        Assertion::NotEq(new \stdClass(), array());
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_NOT_EQ);
        Assertion::NotEq("1", 1);
    }

    public function testNotSame()
    {
        Assertion::notSame("1", 2);
        Assertion::notSame(new \stdClass(), array());
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_NOT_SAME);
        Assertion::notSame(1, 1);
    }

    public function testMin()
    {
        Assertion::min(1, 1);
        Assertion::min(2, 1);
        Assertion::min(2.5, 1);

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MIN);
        Assertion::min(0, 1);
    }

    public function testMax()
    {
        Assertion::max(1, 1);
        Assertion::max(0.5, 1);
        Assertion::max(0, 1);

        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_MAX);
        Assertion::max(2, 1);
    }

    public function testNullOr()
    {
        Assertion::nullOrMax(null, 1);
        Assertion::nullOrMax(null, 2);
    }

    public function testNullOrWithNoValueThrows()
    {
        $this->setExpectedException('BadMethodCallException');
        Assertion::nullOrMax();
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

    /**
     * @dataProvider isJsonStringDataprovider
     */
    public function testIsJsonString($content)
    {
        Assertion::isJsonString($content);
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
        Assertion::uuid($uuid);
    }

    /**
     * @dataProvider providesInvalidUuids
     */
    public function testInvalidUuids($uuid)
    {
        $this->setExpectedException('Assert\InvalidArgumentException');
        Assertion::uuid($uuid);
    }

    static public function providesValidUuids()
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

    static public function providesInvalidUuids()
    {
        return array(
            array('zf6f8cb0-c57d-11e1-9b21-0800200c9a66'),
            array('af6f8cb0c57d11e19b210800200c9a66'),
            array('ff6f8cb0-c57da-51e1-9b21-0800200c9a66'),
            array('af6f8cb-c57d-11e1-9b21-0800200c9a66'),
            array('3f6f8cb0-c57d-11e1-9b21-0800200c9a6'),
        );
    }

    public function testValidNotEmptyKey()
    {
        Assertion::notEmptyKey(array('keyExists' => 'notEmpty'), 'keyExists');
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
        Assertion::allTrue(array(true, true));
    }

    public function testAllWithSimpleAssertionThrowsExceptionOnElementThatFailsAssertion()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_TRUE);
        Assertion::allTrue(array(true, false));
    }

    public function testAllWithComplexAssertion()
    {
        Assertion::allIsInstanceOf(array(new \stdClass, new \stdClass), 'stdClass');
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
        Assertion::count(array('Hi'), 1);
        Assertion::count(new OneCountable(), 1);
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
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_COUNT);
        Assertion::count($countable, $count);
    }

    public function testChoicesNotEmpty()
    {
        Assertion::choicesNotEmpty(
            array('tux' => 'linux', 'Gnu' => 'dolphin'),
            array('tux')
        );
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
            'choice not found in values' => array(array('tux' => ''), array('invalidChoice'), Assertion::INVALID_KEY_EXISTS),
        );
    }

    public function testIsObject()
    {
        Assertion::isObject(new \StdClass);
    }

    public function testIsObjectExpectingException()
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_OBJECT);
        Assertion::isObject('notAnObject');
    }

    public function testMethodExists()
    {
        Assertion::methodExists('methodExists', new Assertion());
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
