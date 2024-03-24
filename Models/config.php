<?php //Medyo madali nalang intindihin to pero lagyan ko nalang comment for dev review :P
$host = 'localhost'; //host name ng db server
$user = 'root'; //kemeroot
$pass = ''; //password pero di kasi ako marunong maglagay kaya wala
$db_name = 'lms'; //name ng db malamang

$conn = new mysqli($host, $user, $pass, $db_name); //create ng new connection sa db

if ($conn->connect_error) { //error validation / message
    die('Database connection error: ' . $conn->connect_error);
}
?>
