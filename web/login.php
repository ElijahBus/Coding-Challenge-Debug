<?php

$database_host = '';
$database_user = '';
$database_password = '';
$database_name = '';

$validString = function ($source) {
    return function ($value) use ($source) {
        return isset($source[$value]) && is_string($source[$value]) && strlen(trim($source[$value])) > 0
            ? $source[$value]
            : die(" ' $value ' is not a valid string.");
    };
};

$username = $validString($_POST)('username');
$password = $validString($_POST)('password');

if (!($connection = mysqli_connect($database_host, $database_user, $database_password, $database_name))) {
	die(mysqli_connect_error());
}

$query     = "SELECT id, username, password FROM users WHERE username=?";
$statement = $connection->prepare($query);
$statement->bind_param("s", $username);
$statement->execute();
$statementResult = $statement->get_result();

$result = [];

if ($userEntry = $statementResult->fetch_assoc()) {
    // md5() not recommended to use, it presents possible issues
    // @link : https://www.php.net/manual/en/function.md5.php#:~:text=It%20is%20not%20recommended%20to,for%20details%20and%20best%20practices.
    if (password_verify($password, $userEntry['password'])) {
        session_start();

        $_SESSION['user_id'] = $userEntry['id'];
        $result              = ['status' => true];
    } else {
        $result = ['status' => false];
    }
} else {
    $result = ['status' => false];
}

$statement->close();
mysqli_close($connection);

die(json_encode($result));
