<?php
session_start();
include 'config.php'; //connection ng db
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user'])) {
    header('Location: ../student-login.php');  //IF NOT LOGGED IN
    exit;
}

$new_pass = $_POST['new_pass'];
$confirm_pass = $_POST['confirm_pass'];

if ($new_pass !== $confirm_pass) {
    $_SESSION['error'] = "Passwords do not match";
    header('Location: ../Students/student-changepass.php');
    exit;
}

// Hash the new password
$hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

$username = $_SESSION['user'];

// Update the password and AccNew in the database
$sql = "UPDATE Students_Tbl SET Password='$hashed_password', NewAcc=0 WHERE Username='$username'";

if ($conn->query($sql) === TRUE) {
    unset($_SESSION['error']);
    $_SESSION['NewAcc'] = 0; //sinet ko to kasi buset nag reredirect parin sa changepass kahit 0 na value
    header('Location: ../Students/student-home.php');
} else {
    echo "Error updating password: " . $conn->error;
}

$conn->close();
?>
