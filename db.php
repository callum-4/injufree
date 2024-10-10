<?php

$server ="localhost";
$user ="username";
$password = "injufree123";
$dbname = "injufree";

$conn = mysqli_connect($server, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>