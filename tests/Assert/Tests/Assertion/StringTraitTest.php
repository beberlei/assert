<?php

declare(strict_types=1);

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

namespace Assert\Tests\Assertion;

use Assert\Assertion;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Assert\Assertion\StringTrait
 */
class StringTraitTest extends TestCase
{
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_LENGTH
     */
    public function testLengthFailed()
    {
        Assertion::length('asdf', 3);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_LENGTH
     */
    public function testLengthFailedForWrongEncoding()
    {
        Assertion::length('址', 1, null, null, 'ASCII');
    }

    public function testLengthValidForGivenEncoding()
    {
        $this->assertTrue(Assertion::length('址', 1, null, null, 'utf8'));
    }

    public function testString()
    {
        $this->assertTrue(Assertion::string('test-string'));
        $this->assertTrue(Assertion::string(''));
    }

    /**
     * @dataProvider dataInvalidString
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_STRING
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

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_MIN_LENGTH
     */
    public function testInvalidBetweenLengthMin()
    {
        Assertion::betweenLength('foo', 4, 100);
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_MAX_LENGTH
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_MIN_LENGTH
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_MAX_LENGTH
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_STRING_START
     */
    public function testInvalidStartsWith()
    {
        Assertion::startsWith('foo', 'bar');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_STRING_START
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_STRING_END
     */
    public function testInvalidEndsWith()
    {
        Assertion::endsWith('foo', 'bar');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_STRING_END
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_STRING_CONTAINS
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_EMAIL
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_URL
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

    public function testValidAlnum()
    {
        $this->assertTrue(Assertion::alnum('a'));
        $this->assertTrue(Assertion::alnum('a1'));
        $this->assertTrue(Assertion::alnum('aasdf1234'));
        $this->assertTrue(Assertion::alnum('a1b2c3'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_ALNUM
     */
    public function testInvalidAlnum()
    {
        Assertion::alnum('1a');
    }

    public function testValidRegex()
    {
        $this->assertTrue(Assertion::regex('some string', '/.*/'));
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_REGEX
     */
    public function testInvalidRegex()
    {
        Assertion::regex('foo', '(bar)');
    }

    /**
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_STRING
     */
    public function testInvalidRegexValueNotString()
    {
        Assertion::regex(array('foo'), '(bar)');
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_JSON_STRING
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_UUID
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_E164
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
     * @dataProvider invalidDateProvider
     * @expectedException \Assert\AssertionFailedException
     * @expectedExceptionCode \Assert\Assertion\INVALID_DATE
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_IP
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_IP
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
     * @expectedExceptionCode \Assert\Assertion\INVALID_IP
     */
    public function testInvalidIpv6()
    {
        Assertion::ipv6('109.188.127.26');
    }
}
