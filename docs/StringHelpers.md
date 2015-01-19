# StringHelpers

## standardize

This function is made for alias/slug generation.

```{.php}
/**
 * @param string $string
 * @return string
 */
function standardize($string)
```

#### call sample

```{.php}
echo \Dominikzogg\StringHelpers\standardize('Dies ist eine Übung');
```

#### result

```
dies-ist-eine-ubung
```

## shorten

This function is to shorten a string to a wished length, by keep full words

```{.php}
/**
 * @param string $string
 * @param integer $wishedLength
 * @param string $suffix
 * @return string
 */
function shorten($string, $wishedLength, $suffix = '')
```

#### call sample

```{.php}
echo \Dominikzogg\StringHelpers\shorten('Dies ist eine Übung', 10, '...');
```

#### result

```
Dies ist eine...
```

## underscoreToCamelCase

This function converts a underscore string into a camel case ones

```{.php}
/**
 * @param string $string
 * @return string
 */
function underscoreToCamelCase($string)
```

#### call sample

```{.php}
echo \Dominikzogg\StringHelpers\underscoreToCamelCase('dies_ist_ein_test');
```

#### result

```
diesIstEinTest
```

## underscoreToCamelCase

This function converts a camel case string into a underscore ones

```{.php}
/**
 * @param string $string
 * @return string
 */
function camelCaseToUnderscore($string)
```

#### call sample

```{.php}
echo \Dominikzogg\StringHelpers\camelCaseToUnderscore('diesIstEinTest');
```

#### result

```
dies_ist_ein_test
```

## replaceUmlauts

This function replaces umlauts with their base letter

```{.php}
/**
 * @param string $string
 * @return string
 */
function camelCaseToUnderscore($string)
```

#### call sample

```{.php}
echo \Dominikzogg\StringHelpers\replaceUmlauts('Dies ist eine Übung');
```

#### result

```
Dies ist eine Ubung
```