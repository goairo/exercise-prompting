# PHP `each()` Function Reference

## What is `each()`?

The `each()` function was a built-in PHP function used to return the current key/value pair from an array and advance the array cursor. It was commonly used in while loops to iterate through arrays.

## Basic Syntax

```php
array each(array &$array)
```

## Return Value

`each()` returns the current key/value pair from the array as a four-element array:
- Elements 0 and 'key' contain the key name
- Elements 1 and 'value' contain the data

## Deprecation History

- **PHP 7.2**: The `each()` function was officially deprecated
- **PHP 8.0**: The `each()` function was removed completely

## Why was `each()` Deprecated?

1. **Performance Issues**: `each()` is significantly slower than modern alternatives like `foreach`
2. **Internal Cursor Manipulation**: It modifies the array's internal pointer, which can lead to unexpected behavior
3. **Code Readability**: Modern alternatives like `foreach` provide clearer, more readable code
4. **Maintenance**: PHP core developers decided to simplify the language by removing redundant functions

## Modern Alternatives

### 1. `foreach` Loop (Most Common Replacement)

```php
// Old way with each()
reset($array);
while (list($key, $value) = each($array)) {
    echo "$key => $value\n";
}

// New way with foreach
foreach ($array as $key => $value) {
    echo "$key => $value\n";
}
```

### 2. Using `array_keys()` and `array_values()`

```php
// If you need keys and values separately
$keys = array_keys($array);
$values = array_values($array);

for ($i = 0; $i < count($keys); $i++) {
    echo $keys[$i] . " => " . $values[$i] . "\n";
}
```

### 3. Iterator Classes

For more complex iteration needs, PHP provides Iterator classes that offer advanced functionality.

## Impact of Refactoring

When refactoring code that uses `each()`:

1. Remember that `foreach` doesn't modify the array's internal pointer
2. If your code relied on `reset()` and internal pointer manipulation, you may need to adjust your approach
3. Functions related to array pointers (`current()`, `key()`, `next()`, `prev()`, `reset()`, `end()`) are still available in PHP 8, but modern code generally avoids them in favor of more explicit iteration
