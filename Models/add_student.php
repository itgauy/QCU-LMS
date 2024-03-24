<?php
session_start(); // Start the session
include 'config.php'; //connection ng db
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//pang retrieve ng form data galing sa index.html
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$suffix = isset($_POST['suffix']) ? $_POST['suffix'] : "";
if ($suffix == "NONE") {
    $suffix = "";
}
$sn = $_POST['sn'];
$dob = $_POST['dob'];
$prog = $_POST['prog'];
$class = $_POST['class'];
$section = $_POST['section'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$hashed_pass = password_hash($pass, PASSWORD_DEFAULT); // Hash the password
$yrLvl = $_POST['yrLvl'];
$username = $_POST['user'];

//sql query lang pag insert sa db. yan lang alam ko :) ty sir riz
$sql1 = "INSERT INTO Students_Tbl (FirstName, MiddleName, LastName, Suffix, StudentNum, BirthDate, Program, Class, Section, Email, Password, NewAcc, YrLvl, Username)
VALUES ('$fname', '$mname', '$lname', '$suffix', '$sn', '$dob', '$prog', '$class', '$section', '$email', '$hashed_pass', 1, '$yrLvl', '$username')";


// Insert into Users_Tbl
$sql2 = "INSERT INTO Users_Tbl (Username, Password, UserType)
VALUES ('$username', '$hashed_pass', 'Student')";

//execution ng sql query
if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
  echo 'success'; //FORDA AJAX
} else {
  echo "Error: " . $sql1 . "<br>" . $conn->error;
  echo "Error: " . $sql2 . "<br>" . $conn->error;
}


$conn->close();
?>
