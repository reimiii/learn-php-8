<?php

/**
 * Trailing Commas in Parameter Lists (PHP 8+)
 *
 * PHP 8 introduced the ability to use trailing commas in function, method,
 * and closure parameter lists, as well as in `use` lists for closures.
 *
 * This feature enhances code readability, especially when dealing with
 * multi-line parameter lists, and simplifies diffs in version control
 * by preventing changes to existing lines when new parameters are added.
 */

echo "--- Function Definition with Trailing Commas (PHP 8+) ---" . PHP_EOL;

/**
 * sayGreeting function
 * Demonstrates a function with parameters defined using trailing commas.
 * This is valid in PHP 8+.
 *
 * @param string $firstName The first name.
 * @param string $lastName The last name.
 */
function sayGreeting(string $firstName, string $lastName,): void
{
    echo "Hello, {$firstName} {$lastName}!" . PHP_EOL;
}

/**
 * calculateSum function
 * Demonstrates a variadic function (`...$values`) with parameters defined using trailing commas.
 * This also applies to the variadic parameter.
 *
 * @param int ...$numbers A variable number of integer arguments.
 * @return int The sum of all provided numbers.
 */
function calculateSum(int ...$numbers,): int
{
    $total = 0;
    foreach ($numbers as $number) {
        $total += $number;
    }
    return $total;
}

echo "\n--- Function Calls with Trailing Commas (PHP 8+) ---" . PHP_EOL;

// Calling sayGreeting with trailing commas in the arguments list.
// This is also valid syntax in PHP 8+.
echo "Calling sayGreeting:" . PHP_EOL;
sayGreeting(
    "John",
    "Doe",
);

// Calling calculateSum with trailing commas in the arguments list.
echo "\nCalling calculateSum with multiple numbers:" . PHP_EOL;
$sumResult = calculateSum(
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    8,
    9,
    10,
    11,
    12,
    13,
    14,
    15,
);
echo "Sum Result: {$sumResult}" . PHP_EOL;

echo "\n--- Array Definition with Trailing Commas (already supported before PHP 8) ---" . PHP_EOL;

// Trailing commas in array definitions have been supported since PHP 7.3.
// This is included to show consistency, but it's not a new PHP 8 feature.
$personalData = [
    "firstName" => "Alice",
    "middleName" => "B.",
    "lastName" => "Smith",
    "address" => "123 Main St",
    "country" => "USA",
    "birthDate" => "1990-05-15",
];

echo "Personal Data Array (demonstrating trailing comma in array definition):" . PHP_EOL;
var_dump($personalData);

echo "They make adding or reordering parameters cleaner by avoiding changes to adjacent lines in version control." . PHP_EOL;
echo "This feature aligns PHP's syntax with similar capabilities already present in arrays and other languages." . PHP_EOL;
