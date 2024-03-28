<?php
session_start();
$userid=$_SESSION['userid'];
$name = $_SESSION['name'];
$candi = $_REQUEST['txtCand'];
$reason =  $_REQUEST['txtReason'];






//database connection
include('dbConnect.php');

$sql = "INSERT into user_s(userid,name,candidate,reason) values(:userid,:name,:candidate,:reason)";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(":userid",$userid);
$stmt->bindParam(":name",$name);
$stmt->bindParam(":candidate",$candi);
$stmt->bindParam(":reason",$reason);
$stmt->execute();

header('location:successfully.php');
?>  