<?php
	require_once "conexiune.php";
	$tip = $_GET['tip'];
	if (is_numeric($tip))
	{
		$tip = intval($tip);
		$query = "SELECT `styleid`, `tip` FROM `style` WHERE `typeid` = '$tip'";
		$sql = mysqli_query($conexiune, $query);
		if ($sql !== false && mysqli_num_rows($sql) !== 0)
		{
			$json = array();
			while ($row = mysqli_fetch_array($sql))
			{
				$json[] = array("id" => $row['styleid'], "stil" => $row['tip']);
			}
			echo json_encode($json, JSON_UNESCAPED_UNICODE);
		}else echo 0;
	}
?>