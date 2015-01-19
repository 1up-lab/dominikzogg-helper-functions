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

```{.php}
echo \Dominikzogg\StringHelpers\standardize('Dies ist eine Übung');
// dies-ist-eine-ubung
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

```{.php}
echo \Dominikzogg\StringHelpers\shorten('Dies ist eine Übung', 10, '...');
// Dies ist eine...
```