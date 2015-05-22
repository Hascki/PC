<?php
	require_once "conexiune.php";
	if (!isset($_SESSION))
	{
		session_start();
	}
	$id = $_GET['id'];
	$sql = "SELECT `avatar` FROM `profiles` WHERE `profileid` = " . $_SESSION['userID'];
	$result = mysqli_query($conexiune,"$sql");
	$row = mysqli_fetch_array($result);
	ob_clean();
	header("Content-type: image/jpg");
	echo $row['avatar'];
	?>