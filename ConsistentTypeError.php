<?php

/**
 * Consistent Type Errors (PHP 8+)
 *
 * Prior to PHP 8, many built-in functions would issue a Warning or Notice
 * when provided with invalid argument types, and then often try to coerce
 * the value or return `null`/`false`.
 *
 * PHP 8 introduces **Consistent Type Errors**. Now, most internal functions
 * and operators will consistently throw a `TypeError` exception when passed
 * an argument of an unexpected type. This makes type-related errors more
 * predictable and easier to catch and handle.
 */

echo "--- Demonstrating Consistent Type Error ---" . PHP_EOL;

echo "Attempting to call strlen() with an array ([]):" . PHP_EOL;

try {
    // Calling strlen() (string length) with an array is an invalid type.
    // In PHP 7.x, this would typically produce a Warning.
    // In PHP 8+, this consistently throws a TypeError.
    $length = strlen([]);
    echo "This line will not be reached if a TypeError is thrown." . PHP_EOL;
} catch (TypeError $e) {
    // Catching the TypeError allows for graceful error handling.
    echo "Caught expected TypeError: " . $e->getMessage() . PHP_EOL;
    echo "Explanation: strlen() expects a string, but received an array." .
        PHP_EOL;
    echo "This consistency helps in debugging and ensures stricter type enforcement." .
        PHP_EOL;
}

echo "\n--- Example of Correct Usage (No Error) ---" . PHP_EOL;

$validString = "Hello PHP 8";
echo "Calling strlen() with a string ('{$validString}'):" . PHP_EOL;
$length = strlen($validString);
echo "Length of '{$validString}': {$length}" . PHP_EOL;

echo "\n--- Another Consistent Type Error Example (Division by Zero) ---" .
    PHP_EOL;

// While not strictly a type error, PHP 8 also changed division by zero.
// Previously, it would issue a Warning for integer division by zero and return `false`,
// or produce `INF`/`NAN` for float division.
// Now, integer division by zero consistently throws a `DivisionByZeroError`.

$numerator = 10;
$denominator = 0;

echo "Attempting integer division by zero ({$numerator} / {$denominator}):" .
    PHP_EOL;
try {
    $result = $numerator / $denominator; // This will throw DivisionByZeroError
    echo "Result (this line will not be reached): " . $result . PHP_EOL;
} catch (DivisionByZeroError $e) {
    echo "Caught expected DivisionByZeroError: " . $e->getMessage() . PHP_EOL;
    echo "Explanation: Division by zero is now a specific error." . PHP_EOL;
}

echo "\n--- Consistent Type Errors in Custom Functions (using strict_types) ---" .
    PHP_EOL;

// declare(strict_types=1) at the top of the file would enforce strict types for user-defined functions as well.
// If a function expects a `string` and you pass an `int` without strict types,
// PHP might coerce it. With `declare(strict_types=1)`, it would throw a TypeError.

// Example function with type hint
function processString(string $text): string
{
    return "Processed: " . strtoupper($text);
}

echo "\nCalling processString with a string ('test'):" . PHP_EOL;
echo processString("test") . PHP_EOL;

echo "\nCalling processString with an integer (123 - will cause TypeError if declare(strict_types=1) is used):" .
    PHP_EOL;
try {
    // If 'declare(strict_types=1);' was at the very top of this file, this would throw a TypeError.
    // Without it, PHP might try to convert 123 to "123".
    echo processString(123);
} catch (TypeError $e) {
    echo "Caught expected TypeError: " . $e->getMessage() . PHP_EOL;
    echo "Explanation: With 'declare(strict_types=1)', passing an int where a string is expected throws an error." .
        PHP_EOL;
}
