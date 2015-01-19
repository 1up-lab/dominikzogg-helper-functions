<?php

namespace Tests\Dominikzogg;

class StringFunctionTest extends \PHPUnit_Framework_TestCase
{
    public function testStandardize()
    {
        $input = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~ ¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿ';
        $expect = '0123456789abcdefghijklmnopqrstuvwxyz_abcdefghijklmnopqrstuvwxyz-aaaaaaaceeeeiiiidnooooouuuuythssaaaaaaaceeeeiiiidnooooouuuuythy';

        $this->assertEquals($expect, \Dominikzogg\StringHelpers\standardize($input));
    }

    /**
     * @param string      $input
     * @param int         $wishedLength
     * @param string|null $suffix
     * @param string      $expect
     * @dataProvider shortenProvider
     */
    public function testShorten($input, $wishedLength, $suffix, $expect)
    {
        $this->assertEquals($expect, \Dominikzogg\StringHelpers\shorten($input, $wishedLength, $suffix));
    }

    public function shortenProvider()
    {
        return array(
            array(
                'Dies ist ein Test, welcher durchaus ein paar Wörter beinhaltet, welche etwas länger sind, als erlaubt',
                50,
                '',
                'Dies ist ein Test, welcher durchaus ein paar Wörter'
            ),
            array(
                'Dies ist ein Test, welcher durchaus ein paar Wörter beinhaltet, welche etwas länger sind, als erlaubt',
                80,
                '...',
                'Dies ist ein Test, welcher durchaus ein paar Wörter beinhaltet, welche etwas länger...'
            )
        );
    }

    /**
     * @param string $input
     * @param string $expect
     * @dataProvider underscoreToCamelCaseProvider
     */
    public function testUnderscoreToCamelCase($input, $expect)
    {
        $this->assertEquals($expect, \Dominikzogg\StringHelpers\underscoreToCamelCase($input));
    }

    /**
     * @return array
     */
    public function underscoreToCamelCaseProvider()
    {
        return array(
            array(
                'diesIstEinTest',
                'diesIstEinTest'
            ),
            array(
                'DiesIstEinTest',
                'diesIstEinTest'
            ),
            array(
                'dies_ist_ein_test',
                'diesIstEinTest',
            ),
            array(
                'Dies_Ist_Ein_Test',
                'diesIstEinTest'
            )
        );
    }

    /**
     * @param string $input
     * @param string $expect
     * @dataProvider camelCaseToUnderscoreProvider
     */
    public function testCamelCaseToUnderscore($input, $expect)
    {
        $this->assertEquals($expect, \Dominikzogg\StringHelpers\camelCaseToUnderscore($input));
    }

    /**
     * @return array
     */
    public function camelCaseToUnderscoreProvider()
    {
        return array(
            array(
                'dies_Ist_Ein_Test',
                'dies_ist_ein_test',
            ),
            array(
                'Dies_Ist_Ein_Test',
                'dies_ist_ein_test',
            ),
            array(
                'diesIstEinTest',
                'dies_ist_ein_test',
            ),
            array(
                'DiesIstEinTest',
                'dies_ist_ein_test',
            )
        );
    }

    public function testReplaceUmlauts()
    {
        $input = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~ ¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿ';
        $expect = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~ ¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿AAAAAAACEEEEIIIIDNOOOOO×ØUUUUYTHssaaaaaaaceeeeiiiidnooooo÷øuuuuythy';

        $this->assertEquals($expect, \Dominikzogg\StringHelpers\replaceUmlauts($input));
    }
}
