<?php
	require_once "conexiune.php";
	$id = $_GET['id'];
	$sql = "SELECT `poza` FROM `pozeanunturi` WHERE `pozaid` = '$id'";
	$result = mysqli_query($conexiune,"$sql");
	$row = mysqli_fetch_array($result);
	ob_clean();
	header("Content-type: image/jpg");
	echo $row['poza'];
	?>