<?php

/**
 * Function Overriding in Traits (PHP 8+)
 *
 * This example demonstrates a change in PHP 8 regarding how methods
 * from a trait that implement an abstract method in the same trait
 * interact with methods in the consuming class.
 *
 * In PHP 8+, when a trait defines an abstract method and then a class
 * using that trait implements the abstract method, PHP now enforces
 * method signature compatibility. Overriding methods must maintain
 * compatibility with the abstract method's signature.
 *
 * The original code shows a scenario where the abstract method in the trait
 * expects a `string` parameter, but the implementing method in the class
 * expects an `int` parameter. Prior to PHP 8, this might have resulted in
 * a warning or behaved unexpectedly. In PHP 8+, this will lead to a Fatal Error.
 */

echo "--- Defining Trait with Abstract Method ---" . PHP_EOL;

/**
 * Trait SampleTrait
 * Defines an abstract method `sampleMethod` that must be implemented by any class using this trait.
 */
trait SampleTrait
{
    /**
     * @param string $inputName This abstract method expects a string parameter.
     * @return string
     */
    abstract public function sampleMethod(string $inputName): string;
}

echo "\n--- Demonstrating Type Mismatch Error (PHP 8+) ---" . PHP_EOL;

/**
 * Class SampleClass
 * Attempts to use SampleTrait and implement its abstract method.
 *
 * NOTE: The implementation below will cause a **Fatal Error** in PHP 8+
 * because the type of `$inputName` in `sampleMethod` (int)
 * does not match the abstract declaration in `SampleTrait` (string).
 * PHP 8 enforces stricter signature compatibility.
 */
class SampleClass
{
    use SampleTrait;

    /**
     * Implementing the abstract method from SampleTrait.
     *
     * @param int $inputName This parameter type (int) is incompatible with the abstract declaration (string).
     * @return string
     */
    public function sampleMethod(int $inputName): string
    {
        // Changed method name for clarity from 'sampleFunction' to 'sampleMethod'
        // This method body will not be reached due to the fatal error at class loading time.
        // For demonstration, if this were valid, it might process the integer.
        echo "Inside SampleClass::sampleMethod with integer: " .
            $inputName .
            PHP_EOL;
        return "Processed int: " . $inputName;
    }
}

echo "Attempting to instantiate SampleClass..." . PHP_EOL;

try {
    // Instantiating the class will trigger the Fatal Error if the signature is incompatible.
    $obj = new SampleClass();
    echo "Class instantiated successfully (this line will not print if error occurs)." .
        PHP_EOL;

    // If instantiation was successful, demonstrating method call (hypothetically)
    // echo $obj->sampleMethod(123) . PHP_EOL;
} catch (Throwable $e) {
    // Catching Throwable to demonstrate the fatal error handling
    echo "Caught expected Fatal Error (or similar error): " .
        $e->getMessage() .
        PHP_EOL;
    echo "Explanation: The `sampleMethod` in `SampleClass` has an incompatible parameter type (int) " .
        PHP_EOL;
    echo "compared to the abstract declaration in `SampleTrait` (string). PHP 8+ enforces this compatibility." .
        PHP_EOL;
}

echo "\n--- Corrected Implementation (Compatible Signature) ---" . PHP_EOL;

/**
 * Class CorrectedSampleClass
 * Shows the correct way to implement the abstract method, adhering to the signature.
 */
class CorrectedSampleClass
{
    use SampleTrait; // Uses the same trait

    /**
     * Correct implementation: The parameter type `string` matches the abstract declaration.
     *
     * @param string $inputName
     * @return string
     */
    public function sampleMethod(string $inputName): string
    {
        return "Correctly processed string: " . strtoupper($inputName);
    }
}

echo "Instantiating CorrectedSampleClass..." . PHP_EOL;
$correctObj = new CorrectedSampleClass();
echo "CorrectedSampleClass instantiated successfully." . PHP_EOL;

echo "Calling sampleMethod with a string: 'hello world'" . PHP_EOL;
echo $correctObj->sampleMethod("hello world") . PHP_EOL;

echo "\n--- Feature Explanation ---" . PHP_EOL;
echo "This PHP 8+ feature ensures greater type safety and predictability when working with traits and abstract methods. " .
    PHP_EOL;
echo "It prevents silent bugs that might arise from type mismatches between trait definitions and class implementations." .
    PHP_EOL;
