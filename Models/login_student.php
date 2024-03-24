<?php
session_start();
include 'config.php'; //connection ng db
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = $_POST['user'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM Users_Tbl WHERE Username='$username'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['Password'])) {
        $_SESSION['user'] = $username;
        $_SESSION['userType'] = $row['UserType']; // Store UserType in session
        if($row['NewAcc'] == 1) {
            header('Location: ../' . $row['UserType'] . '/changepass.php'); // redirect to password change form
            exit;
        } else {
            header('Location: ../' . $row['UserType'] . '/home.php'); // redirect to dashboard based on UserType
            exit;
        }
    } else {
        $_SESSION['error'] = "Username or password is incorrect.";
        header('Location: ../login.php');
        exit;
    }
} else {
    $_SESSION['error'] = "Username or password is incorrect.";
    header('Location: ../login.php');
    exit;
}

$conn->close();
?>
