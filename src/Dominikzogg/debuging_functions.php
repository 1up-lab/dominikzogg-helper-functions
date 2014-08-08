<?php

namespace Dominikzogg\DebuggingHelpers;

/**
 * @param int $level
 * @return string
 * @throws \Exception
 */
function getCaller($level = 2)
{
    $callers = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $level + 1);

    if(!isset($callers[$level])) {
        throw new \Exception('Can\'t get the caller!');
    }

    if(isset($callers[$level]['class'])) {
        return $callers[$level]['class'] . ':' . $callers[$level]['function'];
    } elseif($callers[$level]['function']) {
        return $callers[$level]['function'];
    }

    throw new \Exception('Only callable callers are supported!');
}

/**
 * @param array $allowedCallers
 * @throws InvalidCallerException
 * @throws \Exception
 */
function tryCaller(array $allowedCallers = array())
{
    $caller = getCaller(3);

    if(in_array($caller, $allowedCallers)) {
        return;
    }

    throw new InvalidCallerException("The caller '{$caller}' is not allowed! Allowed callers are: " . implode(',', $allowedCallers));
}

class InvalidCallerException extends \Exception {}