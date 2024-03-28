<?php
session_start();

// form data received

$userid = $_REQUEST['userid'];
$name = $_REQUEST['name'];

include ('dbConnect.php');

$sql = "select * from voter where userid =:userid";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":userid", $userid);
$stmt->execute();

if ($stmt->rowCount() > 0) {

	$row = $stmt->fetch();
	if ($row['name']== $name ) {

		$_SESSION['userid'] = $userid;
		$_SESSION['name'] = $row['name'];
		header("location:voting.php");

	} else {
		$_SESSION['error'] = "Wrong Password";
		header("location:voter_login.php");
	}

} else {
	$_SESSION['error'] = "Wrong User ID";
	header("location:voter_login.php");
}
?>