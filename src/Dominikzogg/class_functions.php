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
 * @param string $class
 * @param string $type
 * @param string $seperator
 * @return array
 */
function getContantsBasedMappings($class, $type, $seperator = '_')
{
    $reflection = new \ReflectionClass($class);
    $mapping = array();
    foreach($reflection->getConstants() as $name => $value) {
        $nameParts = explode($seperator, $name);
        $firstNamePart = array_shift($nameParts);
        $lastNamePart = array_pop($nameParts);
        if($type === $firstNamePart) {
            $data = &$mapping;
            foreach($nameParts as $namePart) {;
                if(!isset($data[$namePart])) {
                    $data[$namePart] = array();
                }
                $data = &$data[$namePart];
            }
            $data[$lastNamePart] = $value;
        }
    }

    return $mapping;
}

/**
 * @param object $object
 * @return string
 */
function getNameAsCamelCase($object)
{
    $output = '';
    $namespaceParts = explode('\\', get_class($object));
    foreach($namespaceParts as $namespacePart) {
        $output .= ucfirst(strtolower($namespacePart));
    }

    return $output;
}

/**
 * @param object $object
 * @return string
 */
function getNameAsUnderscore($object)
{
    $output = '';
    $namespaceParts = explode('\\', get_class($object));
    foreach($namespaceParts as $namespacePart) {
        $output .= strtolower($namespacePart) . '_';
    }

    return substr($output, 0, -1);
}

/**
 * @param object $object
 * @return string
 */
function getSimpleName($object)
{
    $namespaceParts = explode('\\', get_class($object));
    return (string) array_pop($namespaceParts);
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