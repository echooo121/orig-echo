<?php
require('db(be).php');
require('mail.php');
$message = "";
$type = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($password !== $confirm_password){
        $message = "Passwords do not match.";
        $type = "danger";
    }
    elseif(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
        $message = "Please enter a valid email address.";
        $type = "danger";
    }
    elseif (!preg_match('/^(0?9\d{9})$/', $contact)) {
        $message = "Please enter a valid PH mobile number (e.g. 9171234567).";
        $type = "danger";
    }
    else{
        //replace leading 0 to +63 z
        $contact_digits = preg_replace('/^0/', '', $contact);
        $contact = "+63" . $contact_digits;

        $userID = "2026".rand(1000, 9999);
        while (true){
            $checkQuery = "SELECT * FROM users WHERE user_id = '$userID'";
            $checkResult = mysqli_query($conn, $checkQuery);
            if (mysqli_num_rows($checkResult) == 0) {
                break;
            }
            $userID = "2026".rand(1000, 9999); 
        }
        $userType = "Buyer";
        $token = bin2hex(random_bytes(32));
        $sql = "INSERT INTO users (user_id, first_name, last_name, email, address, contact, password, user_type, token, is_confirmed) VALUES ('$userID', '$first_name', '$last_name', '$email', '$address', '$contact', '$password', '$userType', '$token', '0')";
        if(mysqli_query($conn, $sql)) {
        // SEND EMAIL
        try {
            send_confirmation_email($email, $first_name . " " . $last_name, $token);
            $message = "Registered Successfully! Please confirm email address to log in.";
            $type = "success";
        } catch (Exception $e) {
            $message = "Registration completed, but confirmation email was not sent: " . $e->getMessage();
            $type = "danger";
        }
        } else {
            $message = "Registration error: " . mysqli_error($conn);
            $type = "danger";
        }
    }
}
?>