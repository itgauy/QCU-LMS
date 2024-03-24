<?php
session_start();

if (isset($_SESSION['user'])) {
    $userType = $_SESSION['userType'];
    if ($userType == 'student') {
        header('Location: Student/student-home.php');
    } elseif ($userType == 'admin') {
        header('Location: Admin/admin-home.php');
    } elseif ($userType == 'teacher') {
        header('Location: Teacher/teacher-home.php');
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form">
        <h1>Login</h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>
        <form action="Models/login.php" method="post">
            <label for="user">Username:</label><br>
            <input type="text" id="user" name="user" required><br>
            <label for="pass">Password:</label><br>
            <input type="password" id="pass" name="pass" required><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
