<?php

$database_host = '';
$database_user = '';
$database_password = '';
$database_name = '';

$validId = function ($source) {
    return function ($value) use ($source) {
        return isset($source[$value]) && is_int($source[$value]) && $source[$value] > 0
            ? $source[$value]
            : die(" ' $value ' is not a valid id.");
    };
};

$question_id = $validId($_POST)('id');

if (!isset($question_id) && !is_int($question_id) && !$question_id > 0) {
    die("Invalid question_id");
}

if (!($connection = mysqli_connect($database_host, $database_user, $database_password, $database_name))) {
	die(mysqli_connect_error());
}

$query = "DELETE FROM questions WHERE id=? LIMIT 1";
$statement = $connection->prepare($query);
$statement->bind_param('i', $question_id);
$statement->execute();
$statementResult =  $statement->get_result();

if (mysqli_affected_rows($connection) > 0) {
	$result = ['status' => true];
} else {
	$result = ['status' => false];
}

$statement->close();
mysqli_close($connection);

die(json_encode($result));
