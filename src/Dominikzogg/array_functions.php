<?php

namespace Dominikzogg\StringHelpers;

/**
 * @param array $array1
 * @param array $array2
 * @return array
 */
function enrich(array $array1, array $array2)
{
    foreach($array2 as $key => $value) {
        if(is_array($value)) {
            $array1[$key] = enrich(
                array_key_exists($key, $array1) ? $array1[$key] : array(),
                $value
            );
        } else {
            if(array_key_exists($key, $array1)) {
                if(!is_array($array1[$key])) {
                    $array1[$key] = [$array1[$key]];
                }
                $array1[$key][] = $value;
            } else {
                $array1[$key] = $value;
            }
        }
    }

    return $array1;
}