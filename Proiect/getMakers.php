<?php
	require_once "conexiune.php";
	$tip = $_GET['tip'];
	if (is_numeric($tip))
	{
		$tip = intval($tip);
		$query = "SELECT `makeid`, `producator` FROM `marci` WHERE ";
		if ($tip === 1)
			$query .= "`auto` = '1'";
		else if ($tip === 2)
			$query .= "`moto` = '1'";
		else if ($tip === 3)
			$query .= "`atv` = '1'";
		$sql = mysqli_query($conexiune, $query);
		if ($sql !== false && mysqli_num_rows($sql) !== 0)
		{
			$json = array();
			while ($row = mysqli_fetch_array($sql))
			{
				$json[] = array("id" => $row['makeid'], "maker" => $row['producator']);
			}
			echo json_encode($json, JSON_UNESCAPED_UNICODE);
		}
		else echo 0;
	}
?>