<?php 
$user = "arya";
$pass = "";
$host = "localhost";
$db = "tugasPrakWeb";

$conn =  new mysqli($host, $user, $pass, $db);

if ($conn->connect_error){
    die("Connection Failed" . $conn->connect_error);
}




?>