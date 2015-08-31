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

/**
 * Class CountTest
 */
class CountTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function count_will_return_void_if_the_count_matches_the_size()
    {
        Assertion::count(array('Hi'), 1);
        Assertion::count(new GenericCountable(1), 1);
    }

    /**
     * @test
     */
    public static function count_will_throw_an_exception_if_the_count_does_not_match_the_size()
    {
        return array(
            array(array('Hi', 'There'), 3),
            array(new GenericCountable(1), 2),
        );
    }

    /**
     * @test
     */
    public function countable_will_throw_an_exception_if_value_is_not_countable()
    {

        $value = 'Not a countable value';

        $this->setExpectedException('Assert\InvalidArgumentException',null,Assertion::INVALID_NOT_COUNTABLE);

        Assertion::countable($value);

    }

    /**
     * @test
     * @dataProvider provider_for_minCount_ok
     */
    public function minCount_will_return_void_if_the_count_is_greater_than_or_equal_the_provided_size($value,$size)
    {
        Assertion::minCount($value, $size);
    }

    /**
     * @test
     * @dataProvider provider_for_minCount_ko
     */
    public function minCount_will_throw_an_exception_if_count_is_lower_than_the_provided_size($value,$size)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_COUNT);
        Assertion::minCount($value, $size);

    }

    /**
     * @test
     * @dataProvider provider_for_maxCount_ok
     */
    public function maxCount_will_return_void_if_the_count_is_lower_than_or_equal_the_provided_size($value,$size)
    {
        Assertion::maxCount($value, $size);
    }

    /**
     * @test
     * @dataProvider provider_for_maxCount_ko
     */
    public function maxCount_will_throw_an_exception_if_count_is_greater_than_the_provided_size($value,$size)
    {
        $this->setExpectedException('Assert\AssertionFailedException', null, Assertion::INVALID_COUNT);
        Assertion::maxCount($value, $size);

    }
    /**
     * @dataProvider dataInvalidCount
     */
    public function testInvalidCount($countable, $count)
    {
        $this->setExpectedException('Assert\AssertionFailedException', 'List does not contain exactly "'.$count.'" elements.', Assertion::INVALID_COUNT);
        Assertion::count($countable, $count);
    }


    public static function dataInvalidCount()
    {
        return array(
            array(array('Hi', 'There'), 3),
            array(new GenericCountable(1), 2),
        );
    }


    public function provider_for_minCount_ok()
    {
        return array(
            array(array('Hi', 'There'), 1),
            array(array('Hi', 'There'), 2),
            array(new GenericCountable(2), 1),
            array(new GenericCountable(2), 2),
        );

    }

    public function provider_for_minCount_ko()
    {
        return array(
            array(array('Hi', 'There'), 3),
            array(new GenericCountable(2), 3),
        );

    }

    public function provider_for_maxCount_ok()
    {
        return array(
            array(array('Hi', 'There'), 3),
            array(array('Hi', 'There'), 2),
            array(new GenericCountable(2), 3),
            array(new GenericCountable(2), 2),
        );

    }

    public function provider_for_maxCount_ko()
    {
        return array(
            array(array('Hi', 'There'), 1),
            array(new GenericCountable(2), 1),
        );

    }

}

class GenericCountable implements \Countable
{

    /** @var int  */
    protected $size;

    /**
     * @param int $size
     */
    public function __construct($size = 0)
    {
        $this->size = $size;

    }

    public function count()
    {
        return $this->size;
    }
}
