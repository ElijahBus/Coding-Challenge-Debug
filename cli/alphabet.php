<?php

/**
 * The $arr array should contain the english alphabet in the format  Array ([0] => a, [1] => b, [2] => c, ...)
 */

$arr = [];
foreach (range('a', 'z') as $alphabet) {
	array_push($arr, $alphabet);
}

print_r($arr);
