# NumericHelpers

## numberCmp

This function compares two numeric values.

```
a < b => -1
a = b => 0
a > b => 1
```

```{.php}
/**
 * @param int|float $a
 * @param int|float $b
 * @return int
 * @throws \InvalidArgumentException
 */
function numberCmp($a, $b)
```

#### call sample

```{.php}
echo \Dominikzogg\NumericHelpers\numberCmp(2, 3);
```

#### result

```
-1
```