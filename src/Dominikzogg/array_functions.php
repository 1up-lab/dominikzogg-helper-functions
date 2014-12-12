<?php

namespace Dominikzogg\ArrayHelpers;

/**
 * This function creates an array with the values exists on same key within both arrays
 * @param array $array1
 * @param array $array2
 * @return array
 */
function enrich(array $array1, array $array2)
{
    foreach ($array2 as $key => $value) {
        if (is_array($value)) {
            $array1[$key] = enrich(
                array_key_exists($key, $array1) ? $array1[$key] : array(),
                $value
            );
        } else {
            if (array_key_exists($key, $array1)) {
                if (!is_array($array1[$key])) {
                    $array1[$key] = array($array1[$key]);
                }
                $array1[$key][] = $value;
            } else {
                $array1[$key] = $value;
            }
        }
    }

    return $array1;
}

/**
 * @param array $array
 */
function sortBySubArrayCount(array &$array)
{
    uasort($array, function (array $a, array $b) {
        $aCount = count($a);
        $bCount = count($b);
        if ($aCount === $bCount) {
            return 0;
        }

        return $aCount < $bCount ? -1 : 1;
    });
}

/**
 * @param array $array
 */
function sortWithUmlauts(array &$array)
{
    uasort($array, function ($a, $b) {
        return strcmp(
            \Dominikzogg\StringHelpers\replaceUmlauts($a),
            \Dominikzogg\StringHelpers\replaceUmlauts($b)
        );
    });
}
