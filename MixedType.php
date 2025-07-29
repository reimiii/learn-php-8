<?php

/**
 * Mixed Type (PHP 8+)
 *
 * The `mixed` pseudo-type was introduced in PHP 8. It signifies that a parameter,
 * property, or return value can be of *any* type, including `null`.
 *
 * This is useful for functions or properties that genuinely need to handle
 * data of various, unpredictable types without losing type safety.
 * It's equivalent to `array|bool|callable|int|float|object|resource|string|null`.
 */

echo "--- Defining a Function with `mixed` Type Hints ---" . PHP_EOL;

/**
 * Function processMixedData
 *
 * This function accepts any type of data (`mixed $data`) and can return any type of data (`mixed`).
 * It demonstrates handling different input types and returning appropriate results.
 *
 * @param mixed $data The input data, which can be of any type.
 * @return mixed The processed result, which can also be of any type.
 */
function processMixedData(mixed $data): mixed // Renamed 'testMixed' to 'processMixedData' for clarity
{
    echo "Processing input of type: " . gettype($data) . PHP_EOL;

    if (is_array($data)) {
        echo "  Input is an array. Returning an empty array." . PHP_EOL;
        return []; // Returns an empty array if input is an array
    } elseif (is_string($data)) {
        echo "  Input is a string. Returning a fixed string." . PHP_EOL;
        return "Processed String"; // Returns a string if input is a string
    } elseif (is_int($data)) {
        echo "  Input is an integer. Returning a fixed integer." . PHP_EOL;
        return 123; // Returns an integer if input is an integer (changed from 1 for example)
    } elseif (is_object($data)) {
        echo "  Input is an object. Returning a boolean." . PHP_EOL;
        return true; // Returns a boolean if input is an object (new case added)
    } else {
        echo "  Input is of an unhandled type. Returning null." . PHP_EOL;
        return null; // Returns null for any other type not explicitly handled
    }
}

echo "\n--- Testing `processMixedData` with Various Types ---" . PHP_EOL;

// Test with an array
echo "\nCalling with an empty array ([]):" . PHP_EOL;
var_dump(processMixedData([]));

// Test with a string
echo "\nCalling with a string ('Sample Text'):" . PHP_EOL; // Changed from "Eko"
var_dump(processMixedData("Sample Text"));

// Test with an integer
echo "\nCalling with an integer (42):" . PHP_EOL; // Changed from 1
var_dump(processMixedData(42));

// Test with an object
echo "\nCalling with a new StdClass object:" . PHP_EOL;
var_dump(processMixedData(new stdClass()));

// Test with a boolean
echo "\nCalling with a boolean (false):" . PHP_EOL;
var_dump(processMixedData(false));

// Test with a float
echo "\nCalling with a float (3.14):" . PHP_EOL;
var_dump(processMixedData(3.14));

// Test with null
echo "\nCalling with null:" . PHP_EOL;
var_dump(processMixedData(null));

echo "\n--- Feature Explanation ---" . PHP_EOL;
echo "The `mixed` type hint provides maximum flexibility, allowing any value type. " . PHP_EOL;
echo "It is a clear way to express that a variable, parameter, or return value " . PHP_EOL;
echo "is intentionally designed to handle multiple distinct types, aiding readability " . PHP_EOL;
echo "and ensuring PHP's type system is not circumvented entirely when such flexibility is required." . PHP_EOL;
