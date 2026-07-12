<?php
$host = "localhost";
$user = "Echo_System";
$password = "ech0syst3m";
$dbname = "echosystem";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}

?>