<?php 
include 'koneksi.php';
session_start();

if (!isset($_GET["orderId"])){
    header("Location: index.php");
}
$result_id = $_GET["orderId"];

$del_query = $conn->prepare("DELETE FROM Orders WHERE OrderId=?");
$del_query->bind_param("i", $result_id);
$del_query->execute();

$_SESSION["deleteMsg"] = "Succesfully Delete Data!";
header("Location: index.php");


?>