<?php

function sayHello(string $first, string $middle, string $last): void
{
    echo "Hello $first $middle $last" . PHP_EOL;
}

sayHello("Noir", "Is", "Here");
// sayHello("Huh", "What"); // error

sayHello(last: "Here", first: "Noir", middle: "Is");
// sayHello(first: "What", last: "Do you?");
