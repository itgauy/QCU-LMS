<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user'])) {
    header('Location: ../student-login.php');  //IF NOT YET LOGGED IN
    exit;
} else if (isset($_SESSION['NewAcc']) == 0) {
    header('Location: student-home.php');  //PAG DI NA BAGO :P
    exit;
}

$fullname = $_SESSION['fullname'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="form">
        <h1>Change Password</h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>
        <form action="../Models/change_studentpass.php" method="post">
            <label for="new_pass">New Password:</label><br>
            <input type="password" id="new_pass" name="new_pass" required><br>
            <label for="confirm_pass">Confirm New Password:</label><br>
            <input type="password" id="confirm_pass" name="confirm_pass" required><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
