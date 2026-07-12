<?php
require('db(be).php');
$message = "";
$type = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
        $type = "danger";
    } else {
        $userID = "2026".rand(1000, 9999);
        while (true) {
            $checkQuery = "SELECT * FROM users WHERE user_id = '$userID'";
            $checkResult = mysqli_query($conn, $checkQuery);
            if (mysqli_num_rows($checkResult) == 0) {
                break;
            }
            $userID = "2026".rand(1000, 9999); 
        }
        $userType = "Buyer";
        $sql = "INSERT INTO users (user_id, first_name, last_name, email, address, contact, password, user_type) VALUES ('$userID', '$first_name', '$last_name', '$email', '$address', $contact, '$password', '$userType')";

        if (mysqli_query($conn, $sql)) {
            $message = "Registration completed successfully.";
            $type = "success";
        } else {
            $message = "Registration error: " . mysqli_error($conn);
            $type = "danger";
        }
    }
}

?>