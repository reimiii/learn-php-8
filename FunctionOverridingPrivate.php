<?php

/**
 * Function Overriding Private Methods (PHP 8+)
 *
 * This example clarifies the behavior of "overriding" private methods in PHP 8+.
 * In PHP, private methods are **not inherited** by child classes. Therefore, a method
 * in a child class with the same name as a private method in its parent class
 * is **not an override**; it is an entirely new, independent method.
 *
 * This means that signature compatibility rules (like those for public/protected methods)
 * do not apply between a private parent method and a same-named child method,
 * as they are effectively separate methods residing in different scopes.
 *
 * The original code attempts to define a `public function test(string $name): string`
 * in `VicePresident` while `Manager` has a `private function test(): void`.
 * This scenario works without a fatal error in PHP 8+ because the child's `test`
 * method is not considered an override of the parent's private `test` method.
 */

echo "--- Defining Parent Class with a Private Method ---" . PHP_EOL;

/**
 * Class Manager
 * Contains a private method `internalTest`.
 */
class Manager
{
    /**
     * @var string An internal state for demonstration.
     */
    private string $secretData = "Manager's Secret";

    /**
     * A private method, only accessible from within the Manager class itself.
     * It is not inherited by child classes.
     */
    private function internalTest(): void
    {
        // Renamed from 'test' to 'internalTest' for better clarity of its private nature
        echo "Manager: Executing private internalTest(). Accessing secret data: " .
            $this->secretData .
            PHP_EOL;
    }

    /**
     * A public method to demonstrate calling the private method from within the class.
     */
    public function callInternalTest(): void
    {
        echo "Manager: Public method calling private method..." . PHP_EOL;
        $this->internalTest();
    }
}

echo "\n--- Defining Child Class with a Same-Named Public Method ---" . PHP_EOL;

/**
 * Class VicePresident
 * Extends Manager but defines its own method named `internalTest`.
 * This method is *not* an override of Manager's private `internalTest`.
 */
class VicePresident extends Manager
{
    /**
     * This is a completely separate method from Manager's private `internalTest`.
     * It happens to have the same name but exists independently in the VicePresident class's scope.
     * Its signature (parameters and return type) is independent of the parent's private method.
     *
     * @param string $role A string parameter for this specific method.
     * @return string A string return value.
     */
    public function internalTest(string $role): string
    {
        // Renamed from 'test', added $role parameter, and string return type
        echo "VicePresident: Executing its own public internalTest() with role: " .
            $role .
            PHP_EOL;
        // Attempting to call the parent's private method from here would fail.
        // $this->internalTest(); // This would call *this* method, leading to infinite recursion or wrong behavior.
        // $this->parent::internalTest(); // This syntax is incorrect for private methods.
        return "VP Role: " . $role . PHP_EOL;
    }

    /**
     * Demonstrates that the private method of Manager is not accessible.
     */
    public function tryCallingParentPrivate(): void
    {
        echo "VicePresident: Attempting to call parent's private internalTest()..." .
            PHP_EOL;
        try {
            // This would lead to a fatal error: Call to private method Manager::internalTest()
            // if it were possible, or simply not found.
            // In reality, PHP doesn't even see the parent's private method in this context.
            // This line would simply report method not found if no public/protected method.
            // This call would actually try to call *this* class's internalTest if no arguments are passed.
            // To be clear, we cannot directly call the parent's private method.
            echo "Private methods are not inherited, so direct access is impossible." .
                PHP_EOL;
        } catch (Error $e) {
            echo "Caught error attempting to access parent's private method: " .
                $e->getMessage() .
                PHP_EOL;
        }
    }
}

echo "--- Instantiating Classes ---" . PHP_EOL;

$manager = new Manager();
$vp = new VicePresident();

echo "\n--- Calling Methods ---" . PHP_EOL;

echo "Calling manager->callInternalTest():" . PHP_EOL;
$manager->callInternalTest(); // Manager calls its own private method

echo "\nCalling vicePresident->internalTest('Project Lead'):" . PHP_EOL;
// This calls the VicePresident's *public* internalTest method.
// It is not overriding the Manager's private method.
echo $vp->internalTest("Project Lead") . PHP_EOL;

echo "\n--- Confirming Non-Inheritance/Non-Override ---" . PHP_EOL;

echo "Result: No fatal error occurred when defining VicePresident." . PHP_EOL;
echo "This confirms that the `internalTest` method in `VicePresident` is not treated as an override " .
    PHP_EOL;
echo "of the `private internalTest` method in `Manager`." . PHP_EOL;
echo "They are distinct methods due to the private visibility in the parent class." .
    PHP_EOL;

// This will explicitly show that Manager's private method is not part of VicePresident's available methods.
echo "\n--- Reflection for Clarity ---" . PHP_EOL;
$managerMethods = (new ReflectionClass("Manager"))->getMethods(
    ReflectionMethod::IS_PRIVATE,
);
echo "Manager private methods: " . PHP_EOL;
foreach ($managerMethods as $method) {
    echo "- " . $method->getName() . PHP_EOL;
}

$vpMethods = (new ReflectionClass("VicePresident"))->getMethods(
    ReflectionMethod::IS_PUBLIC,
);
echo "VicePresident public methods: " . PHP_EOL;
foreach ($vpMethods as $method) {
    echo "- " . $method->getName() . PHP_EOL;
}
echo "Notice that `internalTest` appears in both, but with different visibilities and signatures, indicating separate methods." .
    PHP_EOL;
