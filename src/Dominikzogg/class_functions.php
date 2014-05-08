<?php

namespace Dominikzogg\ClassHelpers;

/**
 * @param string|object $class
 * @param string $prefix
 * @return array
 */
function getConstantsWithPrefix($class, $prefix)
{
    $reflection = new \ReflectionClass($class);
    $prefixLength = strlen($prefix);

    $constants = array();

    foreach($reflection->getConstants() as $name => $value){
        if(substr($name, 0, $prefixLength) != $prefix){
            continue;
        }
        $constants[$value] = $name;
    }

    return $constants;
}

/**
 *
 * Example:
 * @ORM\Id
 * @ORM\Column(type="string")
 *
 * @return string
 */
function objectId()
{
    static $increment = 0;

    $objectId = '';
    $objectId .= time() . '-';
    $objectId .= crc32(gethostname()) . '-';
    $objectId .= posix_getpid() . '-';
    $objectId .= $increment++;

    return base64_encode($objectId);
}