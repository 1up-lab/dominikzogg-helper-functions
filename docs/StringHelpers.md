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