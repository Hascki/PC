<?php
	require_once "conexiune.php";
	if (!isset($_SESSION))
	{
		session_start();
	}
	if (empty($_SESSION["login"]))
	{
		header("location:index.php");
		exit;
	}
	$query = "INSERT INTO `produse` (`IdAnunt`, `DataCreere`, `Categorie`, `IdVanzator`, `MakeId`, `ModelId`, `Kilometraj`, `DataFabricatie`, `Pret`, `Putere`, `CaiPutere`, `Capacitate`, `NrLocuri`, `MMA`, `ClasaEuro`, `CostTimbru`, `Emisi`, `Culoare`, `VIN`, `Combustibil`, `Distributie`, `Climatizare`, `SIA`, `IC`, `RV`, `SIE`, `GE`, `Nav`, `SP`, `Servo`, `TD`, `JA`, `Carlig`, `ABS`, `ESP`, `Integrala`, `Xenon`, `Promovare`, `Descriere`) VALUES (NULL, ";
	$errorsArray = array();
	$post = array();
	$files = array();
	for ($i = 0;$i < count($_POST);$i++)
	{
		if (strlen(array_values($_POST)[$i]) !== 0)
		{
			if (filter_var(array_values($_POST)[$i], FILTER_VALIDATE_INT) && array_keys($_POST)[$i] !== "descriere")
				$post[array_keys($_POST)[$i]] = intval(filter_var(array_values($_POST)[$i], FILTER_SANITIZE_NUMBER_INT));
			else $post[array_keys($_POST)[$i]] = mysqli_real_escape_string($conexiune, filter_var(array_values($_POST)[$i], FILTER_SANITIZE_STRING));
		}
		else $post[array_keys($_POST)[$i]] = "";
	}
	function returnHandler($type)
	{
		global $errorsArray;
		$returnArray = array();
		$returnArray['returnType'] = $type;
		ob_clean();
		header('Content-Type: application/json');
		if (empty($errorsArray))
			echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);
		else
		{
			$n = count($errorsArray);
			$returnArray["errNum"] = $n;
			for ($i = 1;$i <= $n;$i++)
				$returnArray["Err " . $i] = $errorsArray[$i - 1];
			echo json_encode($returnArray, JSON_UNESCAPED_UNICODE);
		}
	}
	if (isset($post['submit']))
	{
		$query .= "'" . date("Y-m-d") . "', "; // Adauga data cand s-a pus anuntul
		// Adauga categoria anuntului
		if (isset($post['categorie']) && filter_var($post['categorie'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1, 'max_range' => 1))))
		{
			$query .= $post['categorie'] . ", ";
		}
		else if (is_numeric($post['categorie']) && filter_var($post['categorie'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 2, 'max_range' => 3))))
		{
			if ($post['categorie'] === "2")
				$query .= $post['categorie'] . ", ";
			else $query .= $post['categorie'] . ", ";
		}
		else $errorsArray[] = "Categoria este invalida!";
		// Adauga ID-ul utilizatorului ce a pus anuntul
		if (isset($_SESSION['userID']) && !empty($_SESSION['userID']))
			$query .= intval($_SESSION['userID']) . ", ";
		else $errorsArray[] = "Nu s-a gasit niciun userID!";
		// Adauga marca
		if (isset($post['marca']) && filter_var($post['marca'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))))
			$query .= $post['marca'] . ", ";
		else $errorsArray[] = ("Marca este invalida!");
		// Adauga model
		if (isset($post['model']) && filter_var($post['model'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))))
			$query .= $post['model'] . ", ";
		else $errorsArray[] = ("Modelul este invalid!");
		// Adauga kilometraj
		if (isset($post['rulaj']) && filter_var($post['rulaj'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 0))) >= 0)
			$query .= $post['rulaj'] . ", ";
		else $errorsArray[] = "Rulajul este invalid!";
		// Adauga data fabricarii
		if (isset($post['fabricatie']) && checkdate(intval(substr($post['fabricatie'], 5, 2)), intval(substr($post['fabricatie'], 5, 2)), intval(substr($post['fabricatie'], 0, 4))))
			$query .= "'" . $post['fabricatie'] . "', ";
		else $errorsArray[] = "Data fabricarii este invalid!";
		// Adauga pret
		if (isset($post['pret']) && filter_var($post['pret'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))))
			$query .= $post['pret'] . ", ";
		else $errorsArray[] = "Pretul este invalid!";
		// Adauga putere (kW + CP)
		if ((isset($post['putere']) && isset($post['tipPutere'])) && filter_var($post['putere'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))))
		{
			if ($post['tipPutere'] === "kW")
				$query .= $post['putere'] . ", " . (int)($post['putere'] * 1.341) . ", ";
			else $query .= (int)($post['putere'] * 0.745) . ", " . $post['putere'] . ", ";
		}
		else if ((isset($post['putere']) && empty($post['putere'])))
			$query .= "'', '', ";
		else $errorsArray[] = "Puterea este invalida!";
		// Adauga capacitate cilindrica
		if (isset($post['capacitate']) && filter_var($post['capacitate'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))))
			$query .= $post['capacitate'] . ", ";
		else if (isset($post['capacitate']) && empty($post['capacitate']))
			$query .= "'', ";
		else $errorsArray[] = "Capacitatea cilindrica este invalida!";
		// Adauga numar locuri
		if (isset($post['nrLocuri']) && filter_var($post['nrLocuri'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))))
			$query .= $post['nrLocuri'] . ", ";
		else if (isset($post['nrLocuri']) && empty($post['nrLocuri']))
			$query .= "'', ";
		else $errorsArray[] = "Numarul de locuri este invalid!";
		// Adauga MMA
		if (isset($post['MMA']) && filter_var($post['MMA'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))))
			$query .= $post['MMA'] . ", ";
		else if (isset($post['MMA']) && empty($post['MMA']))
			$query .= "'', ";
		else $errorsArray[] = "Masa maxima admisa este invalida!";
		// Adauga clasa EURO
		if (isset($post['clasaEuro']) && filter_var($post['clasaEuro'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1, 'max_range' => 7))))
			$query .= $post['clasaEuro'] . ", ";
		else $errorsArray[] = "Clasa Euro este invalida!";
		// Adauga costul timbrului de mediu
		echo 1;
		if (isset($post['timbruMediu']) && (filter_var($post['timbruMediu'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 0))) || filter_var($post['timbruMediu'], FILTER_VALIDATE_INT) === 0))
			$query .= $post['timbruMediu'] . ", ";
		else $errorsArray[] = "Costul timbrului este invalid!";
		// Adauga emisii CO2
		if (isset($post['emisii']) && filter_var($post['emisii'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))))
			$query .= $post['emisii'] . ", ";
		else if (isset($post['emisii']) && empty($post['emisii']))
			$query .= "'', ";
		else $errorsArray[] = "Emisiile de CO2 sunt invalide!";
		// Adauga culoare
		if (isset($post['culoare']) && filter_var($post['culoare'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1, 'max_range' => 13))))
			$query .= $post['culoare'] . ", ";
		else $errorsArray[] = "Culoarea este invalida!";
		// Adauga VIN
		if (isset($post['VIN']) && strlen($post['VIN']) === 17 && !is_numeric(substr($post['VIN'], 0, 3)) && is_numeric(substr($post['VIN'], 3)))
			$query .= "'" . $post['VIN'] . "', ";
		else if (isset($post['VIN']) && empty($post['VIN']))
			$query .= "'', ";
		else $errorsArray[] = "VIN-ul este invalid!";
		// Adauga combustibil
		if (isset($post['combustibil']) && filter_var($post['combustibil'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1, 'max_range' => 4))))
			$query .= $post['combustibil'] .= ", ";
		else $errorsArray[] = "Tipul de combustibil este invalid!";
		// Adauga Distributie
		if (isset($post['distributie']) && filter_var($post['distributie'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1, 'max_range' => 3))))
			$query .= $post['distributie'] . ", ";
		else if (!isset($post['distributie']) && ($post['categorie'] === 2 || $post['categorie'] === 3))
			$query .= "3, ";
		else $errorsArray[] = "Distributia este invalida!";
		/// Adauga climatizare
		if (isset($post['climatizare']) && (filter_var($post['distributie'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 0, 'max_range' => 2))) || filter_var($post['promovare'], FILTER_VALIDATE_INT) === 0))
			$query .= $post['climatizare'] .", ";
		else if (!isset($post['climatizare']) && ($post['categorie'] === 2 || $post['categorie'] === 3))
			$query .= "0, ";
		else $errorsArray[] = "Climatizarea este invalida!";
		// Adauga SIA
		if (isset($post['sia']) && filter_var($post['sia'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga IC
		if (isset($post['ic']) && filter_var($post['ic'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga RV
		if (isset($post['rv']) && filter_var($post['rv'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga SIE
		if (isset($post['sie']) && filter_var($post['sie'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga GE
		if (isset($post['ge']) && filter_var($post['ge'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga NAV
		if (isset($post['nav']) && filter_var($post['nav'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga SP
		if (isset($post['sp']) && filter_var($post['sp'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga Servo
		if (isset($post['servo']) && filter_var($post['servo'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga TD
		if (isset($post['td']) && filter_var($post['td'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga JA
		if (isset($post['ja']) && filter_var($post['ja'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga Carlig
		if (isset($post['carlig']) && filter_var($post['carlig'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga ABS
		if (isset($post['abs']) && filter_var($post['abs'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga ESP
		if (isset($post['esp']) && filter_var($post['esp'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga Integrala
		if (isset($post['integrala']) && filter_var($post['integrala'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga Xenon
		if (isset($post['xenon']) && filter_var($post['xenon'], FILTER_VALIDATE_BOOLEAN))
			$query .= "1, ";
		else $query .= "0, ";
		// Adauga Promovare
		if (isset($post['promovare']) && (filter_var($post['promovare'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 0, 'max_range' => 2))) || filter_var($post['promovare'], FILTER_VALIDATE_INT) === 0))
			$query .=  $post['promovare'] . ", ";
		else $errorsArray[] = "Tipul promovarii este invalid!";
		// Adauga Descriere
		if (isset($post['descriere']) && !empty($post['descriere']))
			$query .= "'" . $post['descriere'] . "'";
		else if (isset($post['descriere']) && empty($post['descriere']))
			$query .= "''";
		else $errorsArray[] = "Descrierea este invalida!";
		$query .= ")";
		if ($_FILES['poza']['error'] !== 4)
		{
			$tmpName = $_FILES['poza']['tmp_name'];
			$pozaSize = $_FILES['poza']['size'];
			$pozaType = $_FILES['poza']['type'];
			if ($pozaSize > 6291456)
				$errorsArray[] = "Poza este prea mare!";
			if (getimagesize($tmpName) === false)
				$errorsArray[] = "Fisierul uploadat nu este o poza!";
		}
		else
		{
			$fname = dirname(__FILE__) . "/imagini/";
			if ($post['categorie'] === 1)
				$fname .= "defaultCar.png";
			else if ($post['categorie'] === 2)
				$fname .= "defaultMoto.png";
			else if ($post['categorie'] === 3)
				$fname .= "defaultATV.png";
			else $errorsArray[] = "Nu s-a putut uploada poza deoarece categoria autovehiculului este invalida!";	
		}
		// Trimite cerere
		if (count($errorsArray) === 0)
		{
			$sql = mysqli_query($conexiune, $query);
			// Verificare rezultat cerere
			if ($sql)
			{
				// Adauga poza la anunt
				$id = mysqli_insert_id($conexiune);
				$query = "INSERT INTO `pozeanunturi` (`PozaId`, `IdAnunt`, `Poza`) VALUES(NULL, $id, ";
				if ($_FILES['poza']['error'] !== 4)
				{
					if (empty($errorsArray))
					{
						$fp = fopen($tmpName, "r");
						$data = "";
						while (!feof($fp))
							$data .= fread($fp, $pozaSize);
						fclose($fp);
						$data = mysqli_real_escape_string($conexiune, $data);
						$query .= "'" . $data . "')";
					}
					$sql = mysqli_query($conexiune, $query);
					if (!$sql)
						$errorsArray[] = "Poza aleasa nu a putut fii uploadata!";
				}
				else 
				{
					if (count($errorsArray) === 0)
					{
						$fsize = filesize($fname);
						$fp = fopen($fname, "r");
						$data = "";
						while (!feof($fp))
							$data .= fread($fp, $fsize);
						fclose($fp);
						$data = mysqli_real_escape_string($conexiune, $data);
						$query .= "'" . $data . "')";
						$sql = mysqli_query($conexiune, $query);
						if (!$sql)
							$errorsArray[] = "Poza default nu a putut fii uploadata!";
					}
				}
				if (count($errorsArray) === 0)
					returnHandler("succes");
				else returnHandler("eroare");
			}
			else
			{
				$errorsArray[] = "Eroare la inserarea in tabel! " . $query;
				returnHandler("eroare");
			}
		}
		else returnHandler("eroare");
	}
	else 
	{
		$errorsArray[] = "Datele nu au fost trimise cum trebuie!";
		returnHandler("eroare");
	}
?>