<?php
/**
 * PHP7 example using the deprecated each() function
 * 
 * This file contains several examples of how the each() function was
 * commonly used in PHP7 and earlier versions.
 */

// Example 1: Basic array iteration with each()
function displayUserData($userData) {
    echo "User Information:\n";
    while (list($key, $value) = each($userData)) {
        echo "$key: $value\n";
    }
    echo "\n";
}

// Example 2: Nested array traversal using each()
function processNestedData($nestedArray) {
    $result = [];
    
    reset($nestedArray);
    while ($outerPair = each($nestedArray)) {
        $category = $outerPair['key'];
        $items = $outerPair['value'];
        
        echo "Processing category: $category\n";
        
        reset($items);
        while ($innerPair = each($items)) {
            $itemId = $innerPair['key'];
            $itemDetails = $innerPair['value'];
            
            $result[$category][$itemId] = $itemDetails;
            echo "  - Processed item: $itemId\n";
        }
    }
    
    return $result;
}

// Example 3: Using each() with associative arrays for configuration
function parseConfig($configArray) {
    $parsedConfig = [];
    
    reset($configArray);
    while (list($section, $options) = each($configArray)) {
        echo "Loading configuration section: $section\n";
        
        if (is_array($options)) {
            reset($options);
            while (list($option, $value) = each($options)) {
                $parsedConfig[$section][$option] = $value;
                echo "  - Option '$option' set to '$value'\n";
            }
        } else {
            $parsedConfig[$section] = $options;
            echo "  - Set to '$options'\n";
        }
    }
    
    return $parsedConfig;
}

// Example data
$userData = [
    'name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'age' => 32,
    'location' => 'New York'
];

$inventory = [
    'electronics' => [
        'laptop' => ['brand' => 'Dell', 'price' => 999.99],
        'phone' => ['brand' => 'Samsung', 'price' => 799.99],
        'tablet' => ['brand' => 'Apple', 'price' => 599.99]
    ],
    'books' => [
        'novel' => ['title' => '1984', 'author' => 'George Orwell'],
        'textbook' => ['title' => 'PHP Advanced', 'author' => 'Jane Smith']
    ]
];

$config = [
    'database' => [
        'host' => 'localhost',
        'username' => 'admin',
        'password' => 'secret',
        'dbname' => 'myapp'
    ],
    'cache' => 'redis',
    'debug' => true
];

echo "=== Example 1 ===\n";
displayUserData($userData);

echo "=== Example 2 ===\n";
processNestedData($inventory);

echo "=== Example 3 ===\n";
parseConfig($config);
