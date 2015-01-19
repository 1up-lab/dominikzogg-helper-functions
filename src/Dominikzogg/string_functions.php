<?php

namespace Dominikzogg\StringHelpers;

/**
 * @param string $string
 * @return string
 */
function standardize($string)
{
    $search = array('/[^a-zA-Z0-9 _-]+/', '/ +/', '/\-+/');
    $replace = array('', '-', '-');

    $string = \html_entity_decode($string, ENT_QUOTES, 'utf-8');
    $string = replaceUmlauts($string);
    $string = \preg_replace($search, $replace, $string);
    $string = \strtolower($string);

    return \trim($string, '-');
}

/**
 * @param string $string
 * @param integer $wishedLength
 * @param string $suffix
 * @return string
 */
function shorten($string, $wishedLength, $suffix = '')
{
    $length = strlen($string);
    if ($length <= $wishedLength) {
        return $string;
    }

    $wishedString = '';

    $matches = array();
    preg_match_all('/\S+/', $string, $matches);

    foreach ($matches[0] as $word) {
        $wishedString .= $word;
        if (strlen($wishedString) < $wishedLength) {
            $wishedString .= ' ';
        } else {
            break;
        }
    }

    return rtrim($wishedString) . $suffix;
}

/**
 * @param string $string
 * @return string
 */
function underscoreToCamelCase($string)
{
    $stringParts = explode('_', $string);

    if(1 === count($stringParts)) {
        return lcfirst($string);
    }

    $output = '';
    foreach ($stringParts as $i => $inputPart) {
        $inputPart = strtolower($inputPart);
        if (0 !== $i) {
            $output .= ucfirst($inputPart);
        } else {
            $output .= lcfirst($inputPart);
        }
    }

    return $output;
}

/**
 * @param string $string
 * @return string
 */
function camelCaseToUnderscore($string)
{
    $output = '';
    $stringParts = preg_split('/(?=[A-Z])/', $string);
    foreach ($stringParts as $inputPart) {
        if ('' !== $inputPart) {
            $output .= rtrim($inputPart . '_', '_') . '_';
        }
    }

    return strtolower(substr($output, 0, -1));
}

/**
 * @param int|float $a
 * @param int|float $b
 * @return int
 * @throws \InvalidArgumentException
 */
function numberCmp($a, $b)
{
    if (!is_numeric($a)) {
        throw new \InvalidArgumentException('A is not a number!');
    }

    if (!is_numeric($b)) {
        throw new \InvalidArgumentException('B is not a number!');
    }

    if ($a == $b) {
        return 0;
    }

    return $a > $b ? 1 : -1;
}

/**
 * @param string $input
 * @return string
 */
function replaceUmlauts($input)
{
    $signs = array(
        'A' => array('À','Á','Â','Ã','Ä','Å','Æ'),
        'C' => array('Ç'),
        'D' => array('Ð'),
        'E' => array('È','É','Ê','Ë'),
        'I' => array('Ì','Í','Î','Ï'),
        'N' => array('Ñ'),
        'O' => array('Ò','Ó','Ô','Õ','Ö'),
        'TH' => array('Þ'),
        'U' => array('Ù','Ú','Û','Ü'),
        'Y' => array('Ý'),

        'a' => array('à','á','â','ã','ä','å','æ'),
        'c' => array('ç'),
        'd' => array('ð'),
        'e' => array('è','é','ê','ë'),
        'i' => array('ì','í','î','ï'),
        'n' => array('ñ'),
        'o' => array('ò','ó','ô','õ','ö'),
        'ss' => array('ß'),
        'th' => array('þ'),
        'u' => array('ù','ú','û','ü'),
        'y' => array('ý','ÿ'),
    );

    foreach ($signs as $sign => $umlauts) {
        foreach ($umlauts as $umlaut) {
            $input = str_replace($umlaut, $sign, $input);
        }
    }

    return $input;
}
