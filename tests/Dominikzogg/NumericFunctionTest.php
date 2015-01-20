<?php

namespace Tests\Dominikzogg;

class NumericFunctionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param int $a
     * @paran int $b
     * @param int $expect
     * @dataProvider numberCmpProvider
     */
    public function testNumberCmp($a, $b, $expect)
    {
        $this->assertEquals($expect, \Dominikzogg\NumericHelpers\numberCmp($a, $b));
    }

    /**
     * @return array
     */
    public function numberCmpProvider()
    {
        return array(
            array(1, 1, 0),
            array(1, 2, -1),
            array(2, 1, 1),
            array('1', 1, 0),
            array('1', '1.0', 0),
            array(1, 1.0, 0)
        );
    }

    public function testNumberCmpExceptionAIsNotANumber()
    {
        $this->setExpectedException('\InvalidArgumentException', 'A is not a number!');

        \Dominikzogg\NumericHelpers\numberCmp('test', 0);
    }

    public function testNumberCmpExceptionBIsNotANumber()
    {
        $this->setExpectedException('\InvalidArgumentException', 'B is not a number!');

        \Dominikzogg\NumericHelpers\numberCmp(0, 'test');
    }
}
