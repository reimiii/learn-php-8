<?php

/**
 * Class Example
 *
 * Demonstrates **Union Types**, a PHP 8+ feature.
 * Union types allow a property, parameter, or return type to accept
 * multiple different types. This provides more flexibility than a single type hint
 * while still maintaining type safety.
 */
class Example
{
    /**
     * @var string|int|bool|array $data
     * This property can hold a string, an integer, a boolean, or an array.
     * PHP will enforce that any value assigned to $data must be one of these types.
     */
    public string|int|bool|array $data;
}

echo "--- Demonstrating Union Type Property Assignment ---" . PHP_EOL;

$exampleInstance = new Example();

echo "Assigning a string: 'Hello'" . PHP_EOL;
$exampleInstance->data = "Hello"; // Valid: Assign a string
var_dump($exampleInstance->data);

echo "Assigning an integer: 123" . PHP_EOL;
$exampleInstance->data = 123; // Valid: Assign an integer
var_dump($exampleInstance->data);

echo "Assigning a boolean: true" . PHP_EOL;
$exampleInstance->data = true; // Valid: Assign a boolean
var_dump($exampleInstance->data);

echo "Assigning an array: [1, 2, 3]" . PHP_EOL;
$exampleInstance->data = [1, 2, 3]; // Valid: Assign an array
var_dump($exampleInstance->data);

// Attempting to assign an unsupported type (e.g., float) would result in a TypeError.
/*
echo "Attempting to assign a float (will cause TypeError):" . PHP_EOL;
try {
    $exampleInstance->data = 1.23; // This line would throw a TypeError in PHP 8+
} catch (TypeError $e) {
    echo "Caught Error: " . $e->getMessage() . PHP_EOL;
}
*/

echo "\n--- Demonstrating Union Types in Functions ---" . PHP_EOL;

/**
 * Function sampleProcessor
 *
 * This function uses union types for both its parameter and return type.
 * It can accept either a string or an array as input.
 * It will return a string if the input was a string, and an array if the input was an array.
 *
 * @param string|array $inputData The data to process, can be a string or an array.
 * @return string|array The processed data, either a string or an array.
 */
function sampleProcessor(string|array $inputData): string|array
{
    echo "Input type for sampleProcessor: " . gettype($inputData) . PHP_EOL;
    if (is_array($inputData)) {
        return ["Result: Array processed"];
    } elseif (is_string($inputData)) {
        return "Result: String processed";
    }

    return "Unhandled Type: " . gettype($inputData);
    // A default return or error handling would typically be here for other cases,
    // though the type hint already restricts input to string or array.
}

echo "\nCalling sampleProcessor with a string ('Hello World'):" . PHP_EOL;
var_dump(sampleProcessor("Hello World"));

echo "\nCalling sampleProcessor with an empty array ([]):" . PHP_EOL;
var_dump(sampleProcessor([]));

echo "\nCalling sampleProcessor with a non-empty array (['apple', 'banana']):" .
    PHP_EOL;
var_dump(sampleProcessor(["apple", "banana"]));

// Attempting to call with an unsupported type would result in a TypeError.
/*
echo "\nAttempting to call sampleProcessor with an integer (will cause TypeError):" . PHP_EOL;
try {
    var_dump(sampleProcessor(123)); // This would throw a TypeError
} catch (TypeError $e) {
    echo "Caught Error: " . $e->getMessage() . PHP_EOL;
}
*/
