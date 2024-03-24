<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user'])) {
    header('Location: ../student-login.php');  //IF NOT YET LOGGED IN
    exit;
}

if ($_SESSION['NewAcc'] == 1) {
    header('Location: student-changepass.php'); // redirect to password change form
    exit;
}

$fullname = $_SESSION['fullname'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="form">
        <h1>WELCOME BACK, <?php echo $fullname; ?></h1>
        <!-- Rest of the dashboard goes here -->
        <a href="../Models/logout.php" class="button">Logout</a>
    </div>
</body>
</html>