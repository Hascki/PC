<?php
	require_once "conexiune.php";
	$idAnunt = $_GET['id'];
	$sql = "SELECT `poza` FROM `pozeanunturi` WHERE `IdAnunt`=$idAnunt";
	$result = mysqli_query($conexiune,"$sql");
	$row = mysqli_fetch_array($result);
	ob_clean();
	if(mysqli_num_rows($result) != 0){
	echo $row['poza'];
	}
	else{
	$sql1 = "SELECT `Categorie` FROM `produse` WHERE `IdAnunt`=$idAnunt";
	$result1 = mysqli_query($conexiune,"$sql1");
	$row1 = mysqli_fetch_array($result1);
	$fname = dirname(__FILE__) . "/imagini/";
		if ($row1['Categorie'] == 1){
			$fname .= "defaultCar.png";
			$fsize = filesize($fname);
			$fp = fopen($fname, "r");
			$data = "";
			while (!feof($fp))
				$data .= fread($fp, $fsize);
			fclose($fp);
		}
		elseif ($row1['Categorie'] == 2){
			$fname .= "defaultMoto.png";
			$fsize = filesize($fname);
			$fp = fopen($fname, "r");
			$data = "";
			while (!feof($fp))
				$data .= fread($fp, $fsize);
			fclose($fp);
		}
		elseif ($row1['Categorie'] == 3){
			$fname .= "defaultATV.png";
			$fsize = filesize($fname);
			$fp = fopen($fname, "r");
			$data = "";
			while (!feof($fp))
				$data .= fread($fp, $fsize);
			fclose($fp);
		}
		ob_clean();
	header("Content-type: image/jpg");
	echo $data;
	}
	
	
	?>