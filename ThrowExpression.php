<?php

/**
 * Throw Expression (PHP 8+)
 *
 * In PHP 8, `throw` became an expression, not just a statement.
 * This means you can use `throw` in contexts where only an expression is allowed,
 * such as in ternary operators (`?:`), null coalescing operator (`??`),
 * arrow functions (`fn`), and property initializers.
 * This allows for more concise error handling logic directly within expressions.
 */

echo "--- Traditional Function for Greeting (Pre-PHP 8 Style) ---" . PHP_EOL;

/**
 * Function greetUserOldStyle
 * Demonstrates traditional conditional throwing of an exception.
 *
 * @param ?string $userName The user's name, or null.
 * @throws Exception If the name is null.
 */
function greetUserOldStyle(?string $userName): void // Renamed from sayHello for clarity
{
    echo "Attempting to greet (old style): ";
    if ($userName === null) { // Using strict comparison
        throw new Exception("Name cannot be null."); // Improved message
    }

    echo "Hello {$userName}" . PHP_EOL;
}

// Demonstrate old style
echo "Calling greetUserOldStyle with 'Alice':" . PHP_EOL;
try {
    greetUserOldStyle("Alice");
} catch (Exception $e) {
    echo "Caught exception: " . $e->getMessage() . PHP_EOL;
}

echo "Calling greetUserOldStyle with null (expecting exception):" . PHP_EOL;
try {
    greetUserOldStyle(null);
} catch (Exception $e) {
    echo "Caught exception: " . $e->getMessage() . PHP_EOL;
}


echo "\n--- Function with Throw Expression (PHP 8+) ---" . PHP_EOL;

/**
 * Function greetUserNewStyle
 * Demonstrates using `throw` as an expression within a ternary operator.
 * This makes the code more compact for simple conditional logic with exceptions.
 *
 * @param ?string $userName The user's name, or null.
 * @throws Exception If the name is null.
 */
function greetUserNewStyle(?string $userName): void // Renamed from sayHelloExpression for clarity
{
    echo "Attempting to greet (new style): ";
    // The result variable is assigned the string "Hello $userName" if $userName is not null.
    // Otherwise, the `throw new Exception(...)` expression is executed.
    $outputMessage = $userName !== null ? "Hello {$userName}" : throw new Exception("Name cannot be null.");
    echo $outputMessage . PHP_EOL;
}

// Demonstrate new style
echo "\nCalling greetUserNewStyle with 'Bob':" . PHP_EOL;
try {
    greetUserNewStyle("Bob");
} catch (Exception $e) {
    echo "Caught exception: " . $e->getMessage() . PHP_EOL;
}

echo "\nCalling greetUserNewStyle with null (expecting exception):" . PHP_EOL;
try {
    greetUserNewStyle(null);
} catch (Exception $e) {
    echo "Caught exception: " . $e->getMessage() . PHP_EOL;
}

echo "\n--- Another Example: Short-Circuiting with Throw Expression ---" . PHP_EOL;

// Throw expression with null coalescing operator (??)
// This is common for parameter validation or setting default values.
function getUserName(string $inputName = null): string
{
    // If $inputName is null, throw an exception instead of using a default.
    return $inputName ?? throw new Exception("User name must be provided.");
}

echo "\nCalling getUserName with 'Charlie':" . PHP_EOL;
try {
    $name1 = getUserName("Charlie");
    echo "Retrieved user name: {$name1}" . PHP_EOL;
} catch (Exception $e) {
    echo "Caught exception: " . $e->getMessage() . PHP_EOL;
}

echo "\nCalling getUserName with null (expecting exception):" . PHP_EOL;
try {
    $name2 = getUserName(null);
    echo "Retrieved user name: {$name2}" . PHP_EOL; // This line will not be reached
} catch (Exception $e) {
    echo "Caught exception: " . $e->getMessage() . PHP_EOL;
}

echo "\n--- Feature Explanation ---" . PHP_EOL;
echo "Making `throw` an expression allows for more compact and functional-style code. " . PHP_EOL;
echo "It can reduce the need for multi-line `if-throw` blocks, especially in places " . PHP_EOL;
echo "where an expression is expected, like property initializers or arrow functions. " . PHP_EOL;
echo "This leads to cleaner and often more readable code for validation and error signaling." . PHP_EOL;
