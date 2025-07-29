<?php

/**
 * Nullsafe Operator (PHP 8+)
 *
 * The nullsafe operator (`?->`) allows you to safely access properties and methods
 * on an object that might be `null` without throwing a `TypeError`.
 * If any part of the chain evaluates to `null`, the entire expression
 * short-circuits and evaluates to `null`, preventing errors.
 */

echo "--- Defining Classes for Nullsafe Demonstration ---" . PHP_EOL;

/**
 * Class Address
 * Represents a user's address, which may or may not have a country.
 */
class Address
{
    /**
     * @var ?string $country The country name, or null if not set.
     * The `?string` type hint signifies that this property can be either a string or `null`.
     */
    public ?string $country;
}

/**
 * Class User
 * Represents a user, who may or may not have an address.
 */
class User
{
    /**
     * @var ?Address $address The user's address object, or null if not set.
     * The `?Address` type hint signifies that this property can be an Address object or `null`.
     */
    public ?Address $address;
}

echo "\n--- Demonstrating Nullsafe Operator in a Function ---" . PHP_EOL;

/**
 * Function getCountry
 *
 * Safely retrieves the country name from a User object using the nullsafe operator.
 *
 * @param ?User $user A User object, or null.
 * @return ?string The country name if available, otherwise null.
 */
function getCountry(?User $user): ?string
{
    echo "Attempting to get country from user... " . PHP_EOL;
    // The nullsafe operator `?->` checks each part of the chain.
    // If $user is null, it immediately returns null.
    // If $user is not null but $user->address is null, it returns null.
    // Only if both $user and $user->address are not null, it accesses $user->address->country.
    return $user?->address?->country;
}

// Scenario 1: User object is null
echo "Scenario 1: Input is null." . PHP_EOL;
echo "Result: " . (getCountry(null) ?? "NULL (as expected)") . PHP_EOL; // Use null coalescing for output clarity

// Scenario 2: User object exists, but address is null
echo "\nScenario 2: User exists, but address is null." . PHP_EOL;
$userWithoutAddress = new User();
$userWithoutAddress->address = null; // Explicitly setting address to null
echo "Result: " .
    (getCountry($userWithoutAddress) ?? "NULL (as expected)") .
    PHP_EOL;

// Scenario 3: User object and address exist, but country is null
echo "\nScenario 3: User and Address exist, but country is null." . PHP_EOL;
$userWithEmptyAddress = new User();
$userWithEmptyAddress->address = new Address();
$userWithEmptyAddress->address->country = null; // Explicitly setting country to null
echo "Result: " .
    (getCountry($userWithEmptyAddress) ?? "NULL (as expected)") .
    PHP_EOL;

// Scenario 4: User, address, and country all exist
echo "\nScenario 4: User, Address, and Country all exist." . PHP_EOL;
$userWithFullAddress = new User();
$userWithFullAddress->address = new Address();
$userWithFullAddress->address->country = "Indonesia"; // Setting a country
echo "Result: " .
    (getCountry($userWithFullAddress) ?? "NULL (error in logic)") .
    PHP_EOL;

// Scenario 5: User, address, and country all exist (another country)
echo "\nScenario 5: User, Address, and Country (another example)." . PHP_EOL;
$anotherUser = new User();
$anotherUser->address = new Address();
$anotherUser->address->country = "United States";
echo "Result: " .
    (getCountry($anotherUser) ?? "NULL (error in logic)") .
    PHP_EOL;

echo "\n--- Without Nullsafe Operator (for comparison - would cause errors) ---" .
    PHP_EOL;
echo "Accessing a property on a potentially null object *without* the nullsafe operator would result in a Fatal Error (TypeError in PHP 8+)." .
    PHP_EOL;

/*
// This code block is commented out because it would cause a fatal error.
try {
    $nullUser = null;
    // This line would cause a Fatal Error: Attempt to read property "address" on null
    echo $nullUser->address->country;
} catch (TypeError $e) {
    echo "Caught expected TypeError: " . $e->getMessage() . PHP_EOL;
}

try {
    $userWithNullAddress = new User();
    $userWithNullAddress->address = null;
    // This line would cause a Fatal Error: Attempt to read property "country" on null
    echo $userWithNullAddress->address->country;
} catch (TypeError $e) {
    echo "Caught expected TypeError: " . $e->getMessage() . PHP_EOL;
}
*/
echo "The nullsafe operator avoids these errors by returning null gracefully." .
    PHP_EOL;
