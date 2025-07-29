<?php

/**
 * Function Overriding in Classes (PHP 8+)
 *
 * This example demonstrates the stricter method signature compatibility checks
 * introduced in PHP 8 for method overriding in inheritance.
 *
 * In PHP 8+, when a child class overrides a method from its parent class,
 * the overriding method's signature must be compatible with the parent's method.
 * This includes parameter types, return types, and static modifiers.
 *
 * The original code shows a scenario where `ParentClass::method` expects a `string`
 * parameter, but `ChildClass::method` attempts to override it with an `int` parameter.
 * In PHP 8+, this will result in a Fatal Error (specifically, a `TypeError` on class definition).
 */

echo "--- Defining Parent Class ---" . PHP_EOL;

/**
 * Class ParentClass
 * Defines a method `processInput` with a string parameter.
 */
class ParentClass
{
    /**
     * Processes a string input.
     * @param string $inputName The name to process.
     */
    public function processInput(string $inputName): void
    {
        // Changed method name to processInput for clarity, added void return type
        echo "ParentClass: Processing string: " . $inputName . PHP_EOL;
    }
}

echo "\n--- Demonstrating Type Mismatch Error (PHP 8+) ---" . PHP_EOL;

/**
 * Class ChildClass
 * Attempts to extend ParentClass and override `processInput` with an incompatible parameter type.
 *
 * NOTE: This class definition will cause a **Fatal Error (TypeError)** in PHP 8+
 * because the parameter type for `processInput` (int) does not match the parent's declaration (string).
 */
class ChildClass extends ParentClass
{
    /**
     * Overrides the parent method.
     *
     * @param int $inputName This parameter type (int) is incompatible with the parent's method (string).
     */
    public function processInput(int $inputName): void
    {
        // Changed method name for consistency
        // This method body will not be reached due to the fatal error at class loading time.
        echo "ChildClass: Attempting to process integer: " .
            $inputName .
            PHP_EOL;
    }
}

echo "Attempting to define ChildClass (expecting error if type mismatch)..." .
    PHP_EOL;

try {
    // PHP will throw a Fatal Error (TypeError) during the compilation/loading of ChildClass
    // because the method signature is incompatible.
    $child = new ChildClass();
    echo "ChildClass instantiated successfully (this line will not print if error occurs)." .
        PHP_EOL;

    // If instantiated, calling the method (hypothetically)
    // $child->processInput(123);
} catch (Throwable $e) {
    // Catching Throwable to demonstrate the fatal error handling
    echo "Caught expected Fatal Error: " . $e->getMessage() . PHP_EOL;
    echo "Explanation: The `processInput` method in `ChildClass` has an incompatible parameter type (int) " .
        PHP_EOL;
    echo "compared to the parent's method (string). PHP 8+ enforces stricter method signature compatibility in overriding." .
        PHP_EOL;
}

echo "\n--- Corrected Implementation (Compatible Signature) ---" . PHP_EOL;

/**
 * Class CorrectedChildClass
 * Shows the correct way to override the method, maintaining signature compatibility.
 */
class CorrectedChildClass extends ParentClass
{
    /**
     * Correct implementation: The parameter type `string` matches the parent's method.
     *
     * @param string $inputName
     */
    public function processInput(string $inputName): void
    {
        echo "CorrectedChildClass: Successfully processed string: " .
            strtoupper($inputName) .
            PHP_EOL;
    }
}

echo "Defining and Instantiating CorrectedChildClass..." . PHP_EOL;
$correctChild = new CorrectedChildClass();
echo "CorrectedChildClass instantiated successfully." . PHP_EOL;

echo "Calling processInput with a string: 'sample text'" . PHP_EOL;
$correctChild->processInput("sample text");

echo "\n--- Feature Explanation ---" . PHP_EOL;
echo "This PHP 8+ feature enhances type safety and reduces potential bugs in inheritance hierarchies. " .
    PHP_EOL;
echo "It ensures that child classes adhere to the contracts defined by their parent classes, leading to more robust and predictable code." .
    PHP_EOL;
