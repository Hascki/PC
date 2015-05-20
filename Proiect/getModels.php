<?php
	require_once "conexiune.php";
	
	$marca = $_GET['marca'];
	$tip = $_GET['tip'];
	if (is_numeric($marca) && is_numeric($tip))
	{
		$marca = intval($marca);
		$tip = intval($tip);
		$query = "SELECT `modelid`, `modelname` FROM `modele`, `marci`, `categorie` WHERE `modele`.`makeid` = `marci`.`makeid` AND `modele`.`type` = `categorie`.`type` AND `modele`.`makeid` = '$marca' AND `modele`.`type` = '$tip'";
		$sql = mysqli_query($conexiune, $query);
		if ($sql !== false && mysqli_num_rows($sql) !== 0)
		{
			$json = array();
			while ($row = mysqli_fetch_array($sql))
			{
				$json[] = array("id" => $row['modelid'], "model" => $row['modelname']);
			}
			echo json_encode($json, JSON_UNESCAPED_UNICODE);
		}
		else echo 0;
	}
?>