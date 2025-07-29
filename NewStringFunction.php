<?php

/**
 * New String Functions (PHP 8+)
 *
 * PHP 8 introduced three new convenient string functions:
 * - `str_contains()`: Checks if a string contains another string.
 * - `str_starts_with()`: Checks if a string starts with another string.
 * - `str_ends_with()`: Checks if a string ends with another string.
 *
 * These functions provide dedicated and efficient ways to perform common string operations,
 * replacing less readable or potentially slower workarounds.
 */

echo "--- Demonstrating `str_contains()` ---" . PHP_EOL;
echo "Checks if a string contains a specific substring." . PHP_EOL;

$sampleText = "Hello, World from PHP 8!";

echo "Does '{$sampleText}' contain 'World'? ";
var_dump(str_contains($sampleText, "World"));

echo "Does '{$sampleText}' contain 'PHP'? ";
var_dump(str_contains($sampleText, "PHP"));

echo "Does '{$sampleText}' contain 'Java'? ";
var_dump(str_contains($sampleText, "Java"));

$personName = "John Doe"; // Western name
echo "Does '{$personName}' contain 'John'? ";
var_dump(str_contains($personName, "John"));

echo "Does '{$personName}' contain 'Doe'? ";
var_dump(str_contains($personName, "Doe"));

echo "Does '{$personName}' contain 'Jane'? ";
var_dump(str_contains($personName, "Jane"));


echo "\n--- Demonstrating `str_starts_with()` ---" . PHP_EOL;
echo "Checks if a string begins with a specific substring." . PHP_EOL;

echo "Does '{$sampleText}' start with 'Hello'? ";
var_dump(str_starts_with($sampleText, "Hello"));

echo "Does '{$sampleText}' start with 'World'? ";
var_dump(str_starts_with($sampleText, "World"));

echo "Does '{$personName}' start with 'John'? ";
var_dump(str_starts_with($personName, "John"));

echo "Does '{$personName}' start with 'Doe'? ";
var_dump(str_starts_with($personName, "Doe"));

echo "Does '{$personName}' start with 'Jane'? ";
var_dump(str_starts_with($personName, "Jane"));


echo "\n--- Demonstrating `str_ends_with()` ---" . PHP_EOL;
echo "Checks if a string ends with a specific substring." . PHP_EOL;

echo "Does '{$sampleText}' end with '8!'? ";
var_dump(str_ends_with($sampleText, "8!"));

echo "Does '{$sampleText}' end with 'World'? ";
var_dump(str_ends_with($sampleText, "World"));

echo "Does '{$personName}' end with 'John'? ";
var_dump(str_ends_with($personName, "John"));

echo "Does '{$personName}' end with 'Doe'? ";
var_dump(str_ends_with($personName, "Doe"));

echo "Does '{$personName}' end with 'Jane'? ";
var_dump(str_ends_with($personName, "Jane"));


echo "\n--- Feature Explanation ---" . PHP_EOL;
echo "These functions are case-sensitive by default." . PHP_EOL;
echo "They provide clear, readable, and performant alternatives to previous methods " . PHP_EOL;
echo "for common string searching and comparison tasks." . PHP_EOL;
echo "They return `true` or `false`, simplifying conditional logic." . PHP_EOL;

echo "\n--- Comparison with Older Methods (Conceptual) ---" . PHP_EOL;
$genericText = "PHP is versatile";
echo "Before PHP 8, checking if 'PHP is versatile' contains 'is': " . PHP_EOL;
// strpos($genericText, 'is') !== false ? 'true' : 'false';
echo "Before PHP 8, checking if 'PHP is versatile' starts with 'PHP': " . PHP_EOL;
// substr($genericText, 0, strlen('PHP')) === 'PHP' ? 'true' : 'false';
echo "Before PHP 8, checking if 'PHP is versatile' ends with 'versatile': " . PHP_EOL;
// substr($genericText, -strlen('versatile')) === 'versatile' ? 'true' : 'false';
echo "The new functions are much more intuitive and less error-prone." . PHP_EOL;
