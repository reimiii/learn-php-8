<?php

/**
 * Class On Object (PHP 8+)
 *
 * PHP 8 introduced the ability to use the `::class` syntax directly on objects,
 * similar to how it's used on class names. This provides a consistent way
 * to get the fully qualified class name of an object.
 *
 * Prior to PHP 8, `get_class($object)` was the standard way to achieve this.
 * `ClassName::class` was already used to get the fully qualified name of a class itself.
 */

echo "--- Defining a Sample Class ---" . PHP_EOL;

/**
 * Class UserAuthentication
 * A simple class to represent a login attempt.
 */
class UserAuthentication // Renamed from 'Login' for broader context
{
    public string $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}

echo "\n--- Instantiating an Object ---" . PHP_EOL;

// Create an instance of the UserAuthentication class.
$userLoginAttempt = new UserAuthentication("sampleUser"); // Renamed $login to $userLoginAttempt

echo "Created an object of type: " . get_class($userLoginAttempt) . PHP_EOL;

echo "\n--- Getting Class Name using `::class` on Object (PHP 8+) ---" . PHP_EOL;

// Use `::class` directly on the object instance.
// This is the new PHP 8+ feature.
echo "Using \$object::class: " . ($userLoginAttempt::class) . PHP_EOL;
var_dump($userLoginAttempt::class); // Demonstrates the output type and value

echo "\n--- Getting Class Name using `get_class()` (Traditional way) ---" . PHP_EOL;

// Use the traditional `get_class()` function.
echo "Using get_class(\$object): " . get_class($userLoginAttempt) . PHP_EOL;
var_dump(get_class($userLoginAttempt));

echo "\n--- Getting Class Name using `::class` on Class Name (Already supported) ---" . PHP_EOL;

// Use `::class` directly on the class name (not an object instance).
// This was already supported in previous PHP versions.
echo "Using ClassName::class: " . UserAuthentication::class . PHP_EOL;
var_dump(UserAuthentication::class);

echo "\n--- Feature Explanation ---" . PHP_EOL;
echo "The `\$object::class` syntax in PHP 8+ provides a consistent and often " . PHP_EOL;
echo "more readable way to retrieve the fully qualified class name from an object instance. " . PHP_EOL;
echo "It unifies the syntax with `ClassName::class`, making introspection more intuitive." . PHP_EOL;
echo "All three methods yield the same result for the class name string." . PHP_EOL;

// Demonstrating with anonymous class (PHP 7.0+)
echo "\n--- Demonstrating with Anonymous Class ---" . PHP_EOL;
$anonymousObject = new class {
    public function sayHi() {
        return "Hi from anonymous class";
    }
};
echo "Anonymous object::class: " . ($anonymousObject::class) . PHP_EOL;
echo "Anonymous get_class(): " . get_class($anonymousObject) . PHP_EOL;
// For anonymous classes, ::class on the class name itself is not applicable in the same way.
