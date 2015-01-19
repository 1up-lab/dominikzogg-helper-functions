<?php

namespace Dominikzogg\NumericHelpers;

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