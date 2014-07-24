<?php

namespace Dominikzogg\StringHelpers;

/**
 * Standardize a parameter (strip special characters and convert spaces)
 * @param string
 * @param boolean
 * @return string
 */
function standardize($strString)
{
    $arrSearch = array('/[^a-zA-Z0-9 _-]+/', '/ +/', '/\-+/');
    $arrReplace = array('', '-', '-');

    $strString = \html_entity_decode($strString, ENT_QUOTES, 'utf-8');
    $strString = \utf8_romanize($strString);
    $strString = \preg_replace($arrSearch, $arrReplace, $strString);
    $strString = \strtolower($strString);

    return \trim($strString, '-');
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
    if($length <= $wishedLength) {
        return $string;
    }

    $wishedString = '';

    $matches = array();
    preg_match_all('/\S+/', $string, $matches);

    foreach($matches[0] as $word) {
        $wishedString .= $word;
        if(strlen($wishedString) < $wishedLength) {
            $wishedString .= ' ';
        } else {
            break;
        }
    }

    return rtrim($wishedString) . $suffix;
}

/**
 * @param $input
 * @return string
 */
function underscoreToCamelCase($input)
{
    $output = '';
    $inputParts = explode('_', $input);
    foreach($inputParts as $inputPart) {
        $output .= ucfirst(strtolower($inputPart));
    }

    return $output;
}

/**
 * @param $input
 * @return string
 */
function camelCaseToUnderscore($input)
{
    $output = '';
    $inputParts = preg_split('/(?=[A-Z])/', $input);
    foreach($inputParts as $inputPart) {
        $output .= strtolower($inputPart) . '_';
    }

    return substr($output, 0, -1);
}

/**
 * @param int $a
 * @param int $b
 * @return int
 */
function numberCmp($a, $b)
{
    $aLength = strlen($a);
    $bLength = strlen($b);

    $length = $aLength > $bLength ? $aLength : $bLength;

    return strcmp(
        sprintf('%0'. $length . 's', $a),
        sprintf('%0'. $length . 's', $b)
    );
}