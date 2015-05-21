<?php
	require_once "conexiune.php";
	$query = "INSERT INTO `produse` (`idanunt`, ";
	//echo date("Y-m-d");
	$post = array();
	$files = array();
	/*
	for ($i = 0;$i < count($_POST);$i++)
	{
		$post[array_keys($_POST)[$i]] = mysqli_real_escape_string($conexiune, trim(array_values($_POST)[$i]));
		if (array_keys($_POST)[$i] === "MMA" && (strpos($post[array_keys($_POST)[$i]], ",") !== false))
			$post[array_keys($_POST)[$i]] = str_replace(",", ".", $post["MMA"]);
	}
	for ($i = 0;$i < count($_FILES);$i++)
	{
		$files[array_keys($_FILES)[$i]] = array_values($_FILES)[$i];
	}
	*/
	$post = array(
	"categorie" => "1",
    "marca" => "1",
    "model" => "1",
    "stil" => "2",
    "fabricatie" => "1999",
    "combustibil" => "2",
    "culoare" => "4",
    "capacitate" => "1200",
    "putere" => "120",
    "tipPutere" => "kW",
    "distributie" => "2",
    "MMA" => "2.5",
    "nrLocuri" => "2",
    "VIN" => "xyz00000000000000",
    "rulaj" => "1200",
    "clasaEuro" => "4",
    "emisii" => "2",
    "climatizare" => "2",
    "sia" => "on",
    "ic" => "on",
    "rv" => "on",
    "sie" => "on",
    "ge" => "on",
    "nav" => "on",
    "sp" => "on",
    "servo" => "on",
    "td" => "on",
    "ja" => "on",
    "carlig" => "on",
    "abs" => "on",
    "esp" => "on",
    "integrala" => "on",
    "xenon" => "on",
    "descriere" => "12121",
    "pret" => "12000",
    "promovare" => "2",
    "submit" => "Adauga anunt");
	for ($i = 0;$i < count($post);$i++)
	{
		$files[array_keys($post)[$i]] = mysqli_real_escape_string($conexiune, trim(array_values($post)[$i]));
		if (array_keys($post)[$i] === "MMA" && (strpos($files[array_keys($post)[$i]], ",") !== false))
			$files[array_keys($post)[$i]] = str_replace(",", ".", $files["MMA"]);
	}
	$files = array(
	"name" => "defaultCar.png",
	"type" => "image/png",
	"tmp_name" => "C:\xampp\tmp\phpD0CB.tmp",
	"error" => "0",
	"size" => "7818");
	
	$returnArray = array("returnType" => "", "returnMessage" => "");
	function returnHandler($type, $message)
	{
		global $returnArray;
		$returnArray['returnType'] = $type;
		$returnArray['returnMessage'] = $message;
		echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);
	}
	if (isset($post['submit']))
	{
		if (is_numeric($post['categorie']) && $post['categorie'] === "1")
		{
			
		}
		else if (is_numeric($post['categorie']) && ($post['categorie'] === "2" || $post['categorie'] === "3"))
		{
			
		}
		else returnHandler("eroareCat", "Categoria este gresita!");
		//returnHandler("succes", "Anuntul a fost postat cu succes.");
	}
	else returnHandler("eroareSubmit", "Datele nu au fost trimise cum trebuie!");
?>