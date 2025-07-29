<?php

/**
 * Match Expression (PHP 8+)
 *
 * The `match` expression is a new control structure introduced in PHP 8.
 * It's similar to `switch` but offers more concise syntax and stricter comparisons.
 * Key features:
 * - It's an **expression**, meaning it returns a value.
 * - Uses **strict comparison** (`===`).
 * - Does not fall through, so `break` statements are not needed.
 * - Supports **multiple comma-separated conditions** per arm.
 */

echo "--- Original Switch Statement (PHP < 8 and PHP 8+) ---" . PHP_EOL;

$grade = "E";
$message = ""; // Renamed $result to $message for clarity

// Standard switch statement for comparison.
switch ($grade) {
    case "A":
    case "B":
    case "C":
        $message = "You Passed"; // Translated from "Anda Lulus"
        break;
    case "D":
        $message = "You Did Not Pass"; // Translated from "Anda tidak lulus"
        break;
    case "E":
        $message = "Perhaps you are in the wrong major"; // Translated from "Mungkin Anda salah jurusan"
        break;
    default:
        $message = "What kind of grade is that?"; // Translated from "Nilai apa itu?"
}

echo "Switch result for grade 'E': " . $message . PHP_EOL;

echo "\n--- Match Expression (Basic Usage) ---" . PHP_EOL;

// A direct replacement for the above switch statement using `match`.
// The `match` expression is assigned directly to the variable $message.
$message = match ($grade) {
    "A", "B", "C" => "You Passed", // Multiple conditions separated by commas
    "D" => "You Did Not Pass",
    "E" => "Perhaps you are in the wrong major",
    default
        => "What kind of grade is that?", // `default` keyword replaces `default:`
};

echo "Match result for grade 'E': " . $message . PHP_EOL;

// Example with a different value
$grade = "B";
$message = match ($grade) {
    "A", "B", "C" => "You Passed",
    "D" => "You Did Not Pass",
    "E" => "Perhaps you are in the wrong major",
    default => "What kind of grade is that?",
};
echo "Match result for grade 'B': " . $message . PHP_EOL;

echo "\n--- Match Expression (Conditional Logic) ---" . PHP_EOL;

$score = 65; // Renamed $value to $score for clarity

// The `match` expression can evaluate complex conditions by matching against `true`.
// This allows for range checks and other logical conditions directly in the arms.
$letterGrade = match (true) {
    $score >= 80 => "A",
    $score >= 70 => "B",
    $score >= 60 => "C",
    $score >= 50 => "D",
    default => "E",
};

echo "Score of {$score} results in letter grade: " . $letterGrade . PHP_EOL;

// Another example with a different score
$score = 88;
$letterGrade = match (true) {
    $score >= 80 => "A",
    $score >= 70 => "B",
    $score >= 60 => "C",
    $score >= 50 => "D",
    default => "E",
};
echo "Score of {$score} results in letter grade: " . $letterGrade . PHP_EOL;

echo "\n--- Match Expression (String Operations) ---" . PHP_EOL;

$userName = "Mrs. Nani"; // Renamed $name to $userName for clarity

// Match can be used with function calls inside its conditions.
$greeting = match (true) {
    str_contains($userName, "Mr.") => "Hello Sir",
    str_contains($userName, "Mrs.")
        => "Hello Ma'am", // Translated from "Hello Mam"
    default => "Hello",
};

echo "Greeting for '{$userName}': " . $greeting . PHP_EOL;

// Example with a different name
$userName = "Mr. John";
$greeting = match (true) {
    str_contains($userName, "Mr.") => "Hello Sir",
    str_contains($userName, "Mrs.") => "Hello Ma'am",
    default => "Hello",
};
echo "Greeting for '{$userName}': " . $greeting . PHP_EOL;

echo "\n--- Match Expression (Enums - PHP 8.1+ Feature) ---" . PHP_EOL;

// Enums are a PHP 8.1+ feature, often used with match for cleaner code.
// While not in the original code, this shows a common advanced use case.

// Define a simple Enum (requires PHP 8.1 or higher)
// enum UserRole: string
// {
//     case Admin = 'admin';
//     case Editor = 'editor';
//     case Viewer = 'viewer';
// }

// $userRole = UserRole::Editor;
// $accessLevel = match ($userRole) {
//     UserRole::Admin  => "Full Access",
//     UserRole::Editor => "Moderate Access",
//     UserRole::Viewer => "Read-Only Access",
//     default          => "Unknown Role" // Not typically needed with exhaustive Enums
// };
// echo "User role: " . $userRole->value . ", Access Level: " . $accessLevel . PHP_EOL;

echo "Note: Enum example commented out as it requires PHP 8.1+ and a separate Enum definition." .
    PHP_EOL;
echo "This demonstrates how 'match' is often used with Enums for expressive and safe conditional logic." .
    PHP_EOL;
