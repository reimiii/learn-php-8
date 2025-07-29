<?php

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS)]
class NotBlank {}

#[Attribute(Attribute::TARGET_PROPERTY)]
class Length
{
    public int $min;
    public int $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }
}

class LoginRequest
{
    #[Length(min: 4, max: 10)]
    #[NotBlank]
    public ?string $username;

    #[NotBlank]
    #[Length(min: 8, max: 10)]
    public ?string $password;
}

function validate(object $object): void
{
    echo "--- Starting validation for object of type: " .
        get_class($object) .
        " ---\n"; // Log: Start validation
    $class = new ReflectionClass($object);
    $properties = $class->getProperties();
    foreach ($properties as $property) {
        echo "  Validating property: " . $property->name . "\n"; // Log: Current property being validated
        validateNotBlank($property, $object);
        validateLength($property, $object);
    }
    echo "--- Validation completed for object of type: " .
        get_class($object) .
        " ---\n\n"; // Log: End validation
}

function validateNotBlank(ReflectionProperty $property, object $object): void
{
    echo "    Checking NotBlank attribute for property: " .
        $property->name .
        "\n"; // Log: Checking NotBlank
    $attributes = $property->getAttributes(NotBlank::class);
    if (count($attributes) > 0) {
        echo "      NotBlank attribute found for property: " .
            $property->name .
            "\n"; // Log: NotBlank attribute found
        if (!$property->isInitialized($object)) {
            echo "      ERROR: Property " .
                $property->name .
                " is not initialized (null).\n"; // Log: Error - not initialized
            throw new Exception("Property $property->name is null");
        }
        if ($property->getValue($object) == null) {
            echo "      ERROR: Property " .
                $property->name .
                " has a null value.\n"; // Log: Error - null value
            throw new Exception("Property $property->name is null");
        }
        echo "      Property " . $property->name . " is not blank (OK).\n"; // Log: Not blank check passed
    } else {
        echo "      No NotBlank attribute found for property: " .
            $property->name .
            "\n"; // Log: No NotBlank attribute
    }
}

function validateLength(ReflectionProperty $property, object $object): void
{
    echo "    Checking Length attribute for property: " .
        $property->name .
        "\n"; // Log: Checking Length
    if (
        !$property->isInitialized($object) ||
        $property->getValue($object) == null
    ) {
        echo "      Property " .
            $property->name .
            " is not initialized or is null. Skipping length validation.\n"; // Log: Skipping length validation
        return;
    }

    $value = $property->getValue($object);
    $attributes = $property->getAttributes(Length::class);
    foreach ($attributes as $attribute) {
        $length = $attribute->newInstance();
        echo "      Length attribute found for property: " .
            $property->name .
            " with min: " .
            $length->min .
            ", max: " .
            $length->max .
            ".\n"; // Log: Length attribute details
        $valueLength = strlen($value);
        echo "      Current value length for " .
            $property->name .
            ": " .
            $valueLength .
            "\n"; // Log: Actual value length
        if ($valueLength < $length->min) {
            echo "      ERROR: Property " .
                $property->name .
                " is too short. (Length: " .
                $valueLength .
                ", Min: " .
                $length->min .
                ")\n"; // Log: Error - too short
            throw new Exception("Property $property->name is too short");
        }
        if ($valueLength > $length->max) {
            echo "      ERROR: Property " .
                $property->name .
                " is too long. (Length: " .
                $valueLength .
                ", Max: " .
                $length->max .
                ")\n"; // Log: Error - too long
            throw new Exception("Property $property->name is too long");
        }
        echo "      Property " .
            $property->name .
            " length is within limits (OK).\n"; // Log: Length check passed
    }

    if (count($attributes) == 0) {
        echo "      No Length attribute found for property: " .
            $property->name .
            "\n"; // Log: No Length attribute
    }
}

$request = new LoginRequest();
$request->username = "Noir is Me";
$request->password = "Thisz11mac";
validate($request);

// Example to show a validation error for username being too long
echo "\n--- Demonstrating a validation error (username too long) ---\n";
$invalidRequestLongUsername = new LoginRequest();
$invalidRequestLongUsername->username = "VeryLongUsername123"; // This is too long (max 10)
$invalidRequestLongUsername->password = "ValidPass";
try {
    validate($invalidRequestLongUsername);
} catch (Exception $e) {
    echo "Caught validation error: " . $e->getMessage() . "\n";
}

// Example to show a validation error for password being too short
echo "\n--- Demonstrating a validation error (password too short) ---\n";
$invalidRequestShortPassword = new LoginRequest();
$invalidRequestShortPassword->username = "ValidUser";
$invalidRequestShortPassword->password = "short"; // This is too short (min 8)
try {
    validate($invalidRequestShortPassword);
} catch (Exception $e) {
    echo "Caught validation error: " . $e->getMessage() . "\n";
}

// Example to show a validation error for missing username (NotBlank)
echo "\n--- Demonstrating a validation error (missing username - NotBlank) ---\n";
$invalidRequestMissingUsername = new LoginRequest();
$invalidRequestMissingUsername->password = "ValidPassword";
try {
    validate($invalidRequestMissingUsername);
} catch (Exception $e) {
    echo "Caught validation error: " . $e->getMessage() . "\n";
}
