<?php
	require_once "conexiune.php";
	$id = $_GET['id'];
	$sql = "SELECT `poza` FROM `pozeanunturi` WHERE `pozaid` = '$id'";
	$result = mysqli_query($conexiune,"$sql");
	$row = mysqli_fetch_array($result);
	ob_clean();
	
	$tmpName="imagini/defaultCar.png";
	$fp = fopen($tmpName, 'r');
		while (!feof($fp))
		$poza=fread($fp, filesize($tmpName));
		fclose($fp);
	header("Content-type: image/jpg");
	echo $poza;
	
	//echo $row['poza'];
	?>