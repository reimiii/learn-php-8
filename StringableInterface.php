<?php

/**
 * Stringable Interface (PHP 8+)
 *
 * PHP 8 introduced the `Stringable` interface. This is a built-in interface
 * that is **automatically implemented** by any class that defines the `__toString()` magic method.
 *
 * The `Stringable` interface can be used as a type hint. This allows you
 * to explicitly declare that a function parameter, a return type, or a property
 * expects a value that can be converted to a string (i.e., has a `__toString()` method).
 * It provides better type safety and clarity compared to just accepting `string` or `object`.
 */

echo "--- Defining a Function that Accepts `Stringable` ---" . PHP_EOL;

/**
 * Function printGreeting
 * Accepts any object that implements the `Stringable` interface (i.e., has a __toString() method).
 *
 * @param Stringable $stringable An object that can be converted to a string.
 */
function printGreeting(Stringable $stringable): void // Renamed from sayHello for clarity
{
    // The Stringable interface guarantees the __toString() method exists.
    echo "Greeting from Stringable: " . $stringable->__toString() . PHP_EOL;
}

echo "\n--- Defining a Class that Implements __toString() ---" . PHP_EOL;

/**
 * Class UserProfile
 * Implements the __toString() magic method, making it implicitly Stringable.
 */
class UserProfile // Renamed from Person for broader context
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * The magic method `__toString()` is automatically called when an object
     * of this class is treated as a string (e.g., echoed or type-hinted as Stringable).
     *
     * @return string A string representation of the object.
     */
    public function __toString(): string
    {
        return "User: {$this->name}"; // Return a meaningful string representation
    }
}

echo "\n--- Demonstrating `Stringable` Interface Usage ---" . PHP_EOL;

// Create an instance of UserProfile.
$user = new UserProfile("Alice");

// Pass the UserProfile object to printGreeting.
// This is valid because UserProfile defines __toString(), making it Stringable.
echo "Calling printGreeting with a UserProfile object:" . PHP_EOL;
printGreeting($user);

// Demonstrate direct string conversion of the object
echo "\nDirectly echoing UserProfile object (implicitly calls __toString()):" . PHP_EOL;
echo $user . PHP_EOL;

echo "\n--- Demonstrating with a built-in Stringable object (e.g., DateTime) ---" . PHP_EOL;

// DateTime objects also implement __toString() internally, so they are Stringable.
$now = new DateTime();
echo "Calling printGreeting with a DateTime object:" . PHP_EOL;
printGreeting($now);

echo "\n--- Demonstrating Type Error if not Stringable ---" . PHP_EOL;

// Create a class that does NOT implement __toString().
class NonStringableObject
{
    public int $id;
    public function __construct(int $id) { $this->id = $id; }
}

$nonStringable = new NonStringableObject(101);

echo "Attempting to call printGreeting with a NonStringableObject (expecting TypeError):" . PHP_EOL;
try {
    printGreeting($nonStringable); // This will cause a TypeError in PHP 8+
    echo "This line will not be reached if TypeError occurs." . PHP_EOL;
} catch (TypeError $e) {
    echo "Caught expected TypeError: " . $e->getMessage() . PHP_EOL;
    echo "Explanation: `NonStringableObject` does not implement `__toString()`, so it cannot be passed as `Stringable`." . PHP_EOL;
}


echo "\n--- Feature Explanation ---" . PHP_EOL;
echo "The `Stringable` interface provides a robust way to declare that a function or property " . PHP_EOL;
echo "expects any value that can be safely converted to a string. " . PHP_EOL;
echo "This improves type predictability and helps catch errors at development time." . PHP_EOL;
echo "It also makes code more self-documenting by clearly stating the intent regarding string conversion." . PHP_EOL;
