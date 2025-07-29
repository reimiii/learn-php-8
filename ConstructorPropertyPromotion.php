<?php

/**
 * Class Product
 *
 * This class demonstrates **Constructor Property Promotion**, a PHP 8+ feature.
 * Instead of declaring properties and then assigning them in the constructor,
 * you can declare them directly in the constructor's signature. This significantly
 * reduces boilerplate code, making classes more concise.
 */
class Product
{
    public function __construct(
        public string $id,
        public string $name,
        public int $price = 0,
        public int $quantity = 0,
        private bool $isExpensive = false,
    ) {
        // With constructor property promotion, there's no need to manually
        // assign parameters to properties (e.g., $this->id = $id;).
        // PHP handles this automatically for properties declared with visibility (public, private, protected)
        // in the constructor signature.
    }

    /**
     * Method to get the full product details.
     * This demonstrates how to access class properties.
     *
     * @return string A formatted string with product information.
     */
    public function getProductDetails(): string
    {
        // Accessing properties directly using $this->propertyName
        $details = "Product ID: {$this->id}\n";
        $details .= "Name: {$this->name}\n";
        $details .= "Price: $" . number_format($this->price, 2) . "\n";
        $details .= "Quantity: {$this->quantity}\n";
        $details .= "Expensive: " . ($this->isExpensive ? "Yes" : "No") . "\n";
        return $details;
    }
}

// --- Example Usage ---

echo "--- Creating Products ---" . PHP_EOL;

// Creating a new Product object.
// PHP 8+ allows **Named Arguments**, making it clear which value corresponds to which parameter.
// This improves code readability, especially for constructors with many parameters.
$firstProduct = new Product(
    id: "PROD001",
    name: "Chicken Noodles", // Changed from "Mie Ayam"
    price: 15000,
    quantity: 5,
    isExpensive: false,
);

// Another example with default values for price and quantity
$secondProduct = new Product(
    id: "PROD002",
    name: "Smartphone XYZ",
    price: 8990000, // A higher price
);

// Displaying the first product object's structure using var_dump().
// This shows all public and private properties of the object.
echo "\n--- var_dump() of First Product ---" . PHP_EOL;
var_dump($firstProduct);

// Accessing a public property directly.
echo "\n--- Accessing Public Property ---" . PHP_EOL;
echo "First Product Name: " . $firstProduct->name . PHP_EOL;

// Using the custom method to get product details.
echo "\n--- Product Details using getProductDetails() ---" . PHP_EOL;
echo "Details for First Product:\n" . $firstProduct->getProductDetails();
echo "\nDetails for Second Product:\n" . $secondProduct->getProductDetails();

// --- Demonstrating attempts to access private property (will cause error) ---
echo "\n--- Attempting to access private property (Expected Error) ---" .
    PHP_EOL;
try {
    // Attempting to access the private 'isExpensive' property directly from outside the class
    echo $firstProduct->isExpensive . PHP_EOL;
} catch (Error $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    echo "This error occurs because 'isExpensive' is a private property and cannot be accessed directly from outside the class." .
        PHP_EOL;
}
