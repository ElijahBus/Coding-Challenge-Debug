<?php

/**
 * The expected output is "apple, banana, cherry, tomato"
 * Please modify only the function itself, nothing else
 */

function filterArray($validOptions, $input) {
    $cleanValues = [];

    for ($i = 0; $i < count($input); $i++) {
        if (in_array($input[$i], $validOptions)) {
            $cleanValues[] = $input[$i];
        }
    }
    echo implode(', ', $cleanValues);
}

$input = ['apple', 'bear', 'beef', 'banana', 'cherry', 'tomato', 'car'];
$validOptions = ['apple', 'pear', 'banana', 'cherry', 'tomato'];


filterArray($validOptions, $input);
