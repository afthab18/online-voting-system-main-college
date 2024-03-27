<?php
$name = $_REQUEST['txtName'];
$email   = $_REQUEST['txtEmail'];
$number = $_REQUEST['txtNumber'];
$branch =  $_REQUEST['txtbranch'];
$enroll =  $_REQUEST['txtEnrollID'];





//database connection
include('dbConnect.php');

$sql = "INSERT into candidates_vcp(name,email,mobile,branch,enrollid) values(:name,:email,:mobile,:branch,:enrollid)";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(":name",$name);
$stmt->bindParam(":email",$email);
$stmt->bindParam(":mobile",$number);
$stmt->bindParam(":branch",$branch);
$stmt->bindParam(":enrollid",$enroll);

$stmt->execute();

header('location: pending.php');
?>
