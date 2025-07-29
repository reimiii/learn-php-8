<?php

/**
 * Non-Capturing Catches (PHP 8+)
 *
 * PHP 8 introduced the ability to omit the variable name when catching an exception.
 * This is useful when you only need to catch a specific type of exception
 * but do not need to access the exception object itself within the catch block.
 *
 * This feature makes the code cleaner by reducing unnecessary variable declarations.
 */

echo "--- Defining a Validation Function ---" . PHP_EOL;

/**
 * Function validateInput
 * Throws an Exception if the input string is empty or contains only whitespace.
 *
 * @param string $value The string value to validate.
 * @throws Exception If the string is invalid.
 */
function validateInput(string $value): void // Renamed from 'validate' for clarity
{
    echo "Validating string: '{$value}'..." . PHP_EOL;
    if (trim($value) === "") { // Using strict comparison
        throw new Exception("Input string cannot be empty or just whitespace."); // Improved exception message
    }
    echo "String '{$value}' is valid." . PHP_EOL;
}

echo "\n--- Demonstrating Non-Capturing Catch (PHP 8+) ---" . PHP_EOL;

// Scenario 1: Catching an exception without capturing the exception object.
echo "Scenario 1: Inputting an invalid string (whitespace only)." . PHP_EOL;
try {
    validateInput("   "); // Invalid input
} catch (Exception) { // Catching Exception without assigning it to a variable
    echo "Caught an exception: Invalid input detected!" . PHP_EOL;
    // We don't have access to the $e object here, so we can't print $e->getMessage()
    // This is useful when the type of exception itself is enough information.
}

echo "\n--- Demonstrating Traditional Catch (for comparison) ---" . PHP_EOL;

// Scenario 2: Catching an exception and capturing the exception object (traditional way).
echo "Scenario 2: Inputting another invalid string (empty)." . PHP_EOL;
try {
    validateInput(""); // Invalid input
} catch (Exception $e) { // Catching Exception and assigning it to $e
    echo "Caught an exception with object: " . $e->getMessage() . PHP_EOL;
    // Here, we have access to the $e object and can use its methods.
}

echo "\n--- Demonstrating No Exception Thrown ---" . PHP_EOL;

// Scenario 3: Valid input, no exception.
echo "Scenario 3: Inputting a valid string ('Hello World')." . PHP_EOL;
try {
    validateInput("Hello World"); // Valid input
    echo "Validation successful, no exception thrown." . PHP_EOL;
} catch (Exception) {
    echo "Unexpected exception caught (should not happen for valid input)." . PHP_EOL;
}

echo "\n--- Feature Explanation ---" . PHP_EOL;
echo "Non-capturing catches simplify catch blocks when the exception object itself is not needed." . PHP_EOL;
echo "It makes the code cleaner and more focused, especially for simple error signaling." . PHP_EOL;
echo "If you need to log details, modify the exception, or inspect its properties, " . PHP_EOL;
echo "you should use the traditional `catch (Exception $e)` syntax." . PHP_EOL;
