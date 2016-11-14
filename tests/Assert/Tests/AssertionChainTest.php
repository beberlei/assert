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

use Assert\Assert;
use Assert\AssertionChain;

class AssertionChainTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_chains_assertions()
    {
        Assert::that(10)->notEmpty()->integer();
    }

    /**
     * @test
     */
    public function it_shifts_arguments_to_assertions_by_one()
    {
        Assert::that(10)->eq(10);
    }

    /**
     * @test
     */
    public function it_knowns_default_error_message()
    {
        $this->setExpectedException('Assert\InvalidArgumentException', 'Not Null and such');

        Assert::that(null, 'Not Null and such')->notEmpty();
    }

    /**
     * @test
     */
    public function it_skips_assertions_on_valid_null()
    {
        Assert::that(null)->nullOr()->integer()->eq(10);
    }

    /**
     * @test
     */
    public function it_validates_all_inputs()
    {
        Assert::that(array(1, 2, 3))->all()->integer();
    }

    /**
     * @test
     */
    public function it_has_thatall_shortcut()
    {
        Assert::thatAll(array(1, 2, 3))->integer();
    }

    /**
     * @test
     */
    public function it_has_nullor_shortcut()
    {
        Assert::thatNullOr(null)->integer()->eq(10);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Assertion 'unknownAssertion' does not exist.
     * @test
     */
    public function it_throws_exception_for_unknown_assertion()
    {
        Assert::that(null)->unknownAssertion();
    }

    /**
     * @test
     */
    public function it_has_satisfy_shortcut()
    {
        Assert::that(null)->satisfy(function ($value) {
            return is_null($value);
        });
    }

    public function testThatCustomAssertionClassIsUsedWhenSet()
    {
        $assertionChain = new AssertionChain('foo');
        $assertionChain->setAssertionClassName('Assert\Tests\CustomAssertion');

        CustomAssertion::clearCalls();
        $message = uniqid();
        $assertionChain->string($message);

        $this->assertSame(array(array('string', 'foo')), CustomAssertion::getCalls());
    }

    /**
     * @dataProvider provideDataToTestThatSetAssertionClassNameWillNotAcceptInvalidAssertionClasses
     * @param $assertionClassName
     */
    public function testThatSetAssertionClassNameWillNotAcceptInvalidAssertionClasses($assertionClassName)
    {
        $lazyAssertion = new AssertionChain('foo');

        $this->setExpectedException('LogicException');
        $lazyAssertion->setAssertionClassName($assertionClassName);
    }

    /**
     * @return array
     */
    public function provideDataToTestThatSetAssertionClassNameWillNotAcceptInvalidAssertionClasses()
    {
        return [
            'null' => [null],
            'string' => ['foo'],
            'array' => [[]],
            'object' => [new \stdClass()],
            'other class' => [__CLASS__],
        ];
    }
}
