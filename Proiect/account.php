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
	$msgNumeCont = $msgEmail = $msgDatePers = "";
	$tipMsgNumeCont = $tipMsgEmail = $tipMsgDatePers = "";
	$errorsArray = array("tel" => "", "judet" => "", "nrStr" => "", "etaj" => "", "ap" => "", "avatar" => ""); //Folosit la cateva campuri din formularul cu date de profil
	$errorColor = "style = \"color:darkred\"";
	$warningColor = "style = \"color:orange\"";
	$succesColor = "style = \"color:green\"";
	if (isset($_POST["modifNume"]))
	{
		if (empty($_POST["numeCont"]))
		{
			$msgNumeCont = "Nu se poate schimba numele contului deoarece rubrica este goala!";
			$tipMsgNumeCont = $errorColor;
		}
		else
		{
			$query = "UPDATE `utilizatori` SET `UserName` = ? WHERE `username` = ? ";
			if ($stmt = mysqli_prepare($conexiune2, $query))
			{
				$numeContNou = mysqli_real_escape_string($conexiune2, $_POST['numeCont']);
				$numeContVechi = mysqli_real_escape_string($conexiune2, $_SESSION['login']);
				mysqli_stmt_bind_param($stmt, "ss", $numeContNou, $numeContVechi);
				mysqli_stmt_execute($stmt);
				if (mysqli_stmt_affected_rows($stmt) === 1)
				{
					$msgNumeCont = "Numele contului s-a actualizat cu succes.";
					$tipMsgNumeCont = $succesColor;
					$_SESSION['login'] = $numeContNou;
				}
				else 
				{
					$msgNumeCont = "Numele contului este identic cu numele vechi.";
					$tipMsgNumeCont = $warningColor;
				}
			}
			mysqli_stmt_close($stmt);
		}
	}
	else if (isset($_POST["modifEmail"]))
	{
		if (empty($_POST["email"]))
		{
			$msgEmail = "Nu se poate schimba adresa de email deoarece rubrica este goala!";
			$tipMsgEmail = $errorColor;
		}
		else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
		{
			$msgEmail = "Rubrica nu contine o adresa de email!";
			$tipMsgEmail = $errorColor;
		}
		else
		{
			$query = "UPDATE `utilizatori` SET `emailadd` = ? WHERE `username` = ?";
			if ($stmt = mysqli_prepare($conexiune2, $query))
			{
				$emailNou = mysqli_real_escape_string($conexiune2, $_POST['email']);
				$numeCont = mysqli_real_escape_string($conexiune2, $_SESSION['login']);
				mysqli_stmt_bind_param($stmt, "ss", $emailNou, $numeCont);
				mysqli_stmt_execute($stmt);
				if (mysqli_stmt_affected_rows($stmt) === 1)
				{
					$msgEmail = "Email-ul s-a actualizat cu succes.";
					$tipMsgEmail = $succesColor;
				}
				else 
				{
					$msgEmail = "Emailul este folosit deja de un alt cont sau este identic cu emailul vechi.";
					$tipMsgEmail = $warningColor;
				}
			}
			mysqli_stmt_close($stmt);
			
		}
	}
	else if (!isset($_POST['modifDatePers']) && count($_POST) === 11)
	{
		//Daca s-a apasat pe butonul de reset al profilului
		$query = "UPDATE `profiles` SET `nume` = NULL, `prenume` = NULL, `telefon` = NULL, `judet` = NULL, `localitate` = NULL, `strada` = NULL, `bloc` = NULL, `numar` = NULL, `scara` = NULL, `etaj` = NULL, `apartament` = NULL WHERE `profileid` = ?";
			if ($stmt = mysqli_prepare($conexiune2, $query))
			{
				$userID = mysqli_real_escape_string($conexiune2, $_SESSION['userID']);
				mysqli_stmt_bind_param($stmt, "s", $userID);
				mysqli_stmt_execute($stmt);
			}
			mysqli_stmt_close($stmt);
			$msgDatePers = "Profilul a fost resetat.";
			$tipMsgDatePers = $succesColor;
	}
	else if (isset($_POST["modifDatePers"]))
	{
		if (empty($_POST["numePers"]) && empty($_POST["prenume"]) && empty($_POST["nrTel"]) && ($_POST["judet"]) == 0 && empty($_POST["localitate"]) && empty($_POST["strada"]) && empty($_POST["nrStr"]) && empty($_POST["bloc"]) && empty($_POST["scara"]) && empty($_POST["apt"]) && $_FILES['avatar']['error'] === UPLOAD_ERR_NO_FILE)
		{
			$msgDatePers = "Toate rubricile sunt goale!";
			$tipMsgDatePers = $errorColor;
		}
		else
		{
			$query = "UPDATE `profiles` SET";
			$parameters = array();
			$paramsArray = array();
			$paramsTypes = '';
			//Se ocupa cu modificarea numelui din profil
			if (!empty($_POST['numePers']))
			{
				$query .= " `nume` = ?";
				$parameters[] = mysqli_real_escape_string($conexiune2, trim($_POST['numePers']));
				$paramsTypes .= 's';
			}
			//Se ocupa cu modificarea prenumelui din profil
			if (!empty($_POST['prenume']))
			{
				if (strrpos($query, '?') !== false)
					$query .= ",";
				$query .= " `prenume` = ?";
				$parameters[] = mysqli_real_escape_string($conexiune2, trim($_POST['prenume']));
				$paramsTypes .= 's';
			}
			//Se ocupa cu modificarea numarului de telefon din profil
			if (!empty($_POST['nrTel']))
			{
				if (is_numeric(trim($_POST['nrTel'])))
				{
					if (strrpos($query, '?') !== false)
						$query .= ",";
					$query .= " `telefon` = ?";
					$parameters[] = intval(trim($_POST['nrTel']));
					$paramsTypes .= 'i';
				}
				else $errorsArray["tel"] = "Rubrica numar telefon nu contine un numar de telefon!";
			}
			//Se ocupa cu modificarea judetului din profil
			if (($_POST['judet']) == 0)
				$errorsArray["judet"] = "Trebuie ales un judet!";
			else
			{
				if (strrpos($query, '?') !== false)
						$query .= ",";
					$query .= " `judet` = ?";
					$parameters[] = intval($_POST['judet']);
					$paramsTypes .= 'i';
			}
			//Se ocupa cu modificarea localitatii din profil
			if (!empty($_POST['localitate']))
			{
				if (strrpos($query, '?') !== false)
					$query .= ",";
				$query .= " `localitate` = ?";
				$parameters[] = mysqli_real_escape_string($conexiune2, trim($_POST['localitate']));
				$paramsTypes .= 's';
			}
			//Se ocupa cu modificarea strazii din profil
			if (!empty($_POST['strada']))
			{
				if (strrpos($query, '?') !== false)
					$query .= ",";
				$query .= " `strada` = ?";
				$parameters[] = mysqli_real_escape_string($conexiune2, trim($_POST['strada']));
				$paramsTypes .= 's';
			}
			//Se ocupa cu modificarea numarului strazii din profil
			if (!empty($_POST['nrStr']))
			{
				if (is_numeric(trim($_POST['nrStr'])))
				{
					if (strrpos($query, '?') !== false)
						$query .= ",";
					$query .= " `numar` = ?";
					$parameters[] = intval(trim($_POST['nrStr']));
					$paramsTypes .= 'i';
				}
				else $errorsArray["nrStr"] = "Rubrica numar strada nu contine un numar!";
			}
			//Se ocupa cu modificarea blocului din profil
			if (!empty($_POST['bloc']))
			{
				if (strrpos($query, '?') !== false)
					$query .= ",";
				$query .= " `bloc` = ?";
				$parameters[] = mysqli_real_escape_string($conexiune2, trim($_POST['bloc']));
				$paramsTypes .= 's';
			}
			//Se ocupa cu modificarea scarii din profil
			if (!empty($_POST['scara']))
			{
				if (strrpos($query, '?') !== false)
					$query .= ",";
				$query .= " `scara` = ?";
				$parameters[] = mysqli_real_escape_string($conexiune2, trim($_POST['scara']));
				$paramsTypes .= 's';
			}
			//Se ocupa cu modificarea etajului din profil
			if (!empty($_POST['etaj']))
			{
				if (is_numeric(trim($_POST['etaj'])))
				{
					if (strrpos($query, '?') !== false)
						$query .= ",";
					$query .= " `etaj` = ?";
					$parameters[] = intval(trim($_POST['etaj']));
					$paramsTypes .= 'i';
				}
				else $errorsArray["etaj"] = "Rubrica etaj nu contine un numar!";
			}
			//Se ocupa cu modificarea apartamentului din profil
			if (!empty($_POST['apt']))
			{
				if (is_numeric(trim($_POST['apt'])))
				{
					if (strrpos($query, '?') !== false)
						$query .= ",";
					$query .= " `apartament` = ?";
					$parameters[] = intval(trim($_POST['apt']));
					$paramsTypes .= 'i';
				}
				else $errorsArray["ap"] = "Rubrica apartament nu contine un numar!";
			}
			//post_max_size = 32M
			//upload_max_filesize=32M
			//Se ocupa cu modificarea avatarului din profil daca s-a incarcat poza si este mai mica decat 6 MB
			$avatarUploaded = false;
			if ($_FILES['avatar']['error'] !== UPLOAD_ERR_NO_FILE)
			{
				$avatarUploaded = true;
				if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK)
				{
					$avatarError = false;
					$avatarName = $_FILES['avatar']['name'];
					$tmpName = $_FILES['avatar']['tmp_name'];
					$avatarSize = $_FILES['avatar']['size'];
					$avatarType = $_FILES['avatar']['type'];
					if ($avatarSize >= 6000000)
					{
						$avatarError = true;
						$errorsArray['avatar'] = "Poza este prea mare!";
					}
					else $avatarError = false;
					if(!$avatarError)
					{
						$info = getimagesize($_FILES['avatar']['tmp_name']);
						if ($info === FALSE) 
						{
							$errorsArray['avatar'] = "Fisierul incarcat nu este o poza!";
						}
						else
						{
							if (strrpos($query, '?') !== false)
								$query .= ",";
							$query .= " `avatar` = ?";
							$parameters[] = NULL;
							$paramsTypes .= 'b';
						}
					}
				}
				else $errorsArray['avatar'] = "Poza nu s-a putut trimite!";
			}
			
			$query .= " WHERE `profileid` = ?";
			$parameters[] = mysqli_real_escape_string($conexiune2, $_SESSION['userID']);
			$paramsTypes .= 's';
			
			$n = count($parameters);
			$paramsArray[] = & $paramsTypes;
			for ($i = 0;$i < $n;$i++)
				$paramsArray[] = & $parameters[$i];
			if (strlen(implode($errorsArray)) === 0)
			{
				if ($stmt = mysqli_prepare($conexiune2, $query))
				{
					call_user_func_array(array($stmt, 'bind_param'), $paramsArray);
					if ($avatarUploaded)
					{
						$fp = fopen($tmpName, 'r');
						while (!feof($fp))
							mysqli_stmt_send_long_data($stmt, strpos($paramsArray[0], 'b'), fread($fp, filesize($tmpName)));
						fclose($fp);
					}
					mysqli_stmt_execute($stmt);
					if (mysqli_stmt_affected_rows($stmt) === 1)
					{
						$msgDatePers = "Profil actualizat cu succes.";
						$tipMsgDatePers = $succesColor;
					}
					else
					{
						$msgDatePers = "Nu s-a actualizat nimic deoarece nu s-au introdus date noi.";
						$tipMsgDatePers = $warningColor;
					}
				}
				mysqli_stmt_close($stmt);
			}
			else
			{
				$msgDatePers = "Unele rubrici contin erori!";
				$tipMsgDatePers = $errorColor;
			}
		}
	}
	
	$query = "SELECT * FROM `profiles` WHERE `profileid` = ?";
	if ($stmt = mysqli_prepare($conexiune2, $query))
	{
		$userID = mysqli_real_escape_string($conexiune2, $_SESSION['userID']);
		mysqli_stmt_bind_param($stmt, "s", $userID);
		mysqli_stmt_execute($stmt);
	}
	$profil = mysqli_fetch_row(mysqli_stmt_get_result($stmt));
	mysqli_stmt_close($stmt);
	
	$judete = "<option value = '0'>Alege judetul</option>";
	$query = "SELECT `judetid`, `numejudet` FROM `judete` WHERE 1";
	$sql = mysqli_query($conexiune2, $query);
	while ($row = mysqli_fetch_array($sql))
	{
		$judete .= "<option value = '" . $row[0] . "'";
		if ($profil[5] == $row[0])
			$judete .= " selected";
		$judete .= ">" . $row[1] . "</option>";
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css"> 

body  {
	font-family:Lucida Console, Monospace;
	background-image: url("imagini/bam3.jpg");
	
	text-align: center; 
		
}

.twoColElsLtHdr #container { 
	width: 1200px;  
	
	margin: auto auto;
	
	text-align: left;
	} 
	
.twoColElsLtHdr #header { 
	
	padding: 10px 10px;
	height: 100px;
	} 
	
.twoColElsLtHdr #navigare { 
	
	padding: 10px 10px;
	height: 50px;
	font-size : 1em;
	font-weight:bolder;
	
} 

label
{
    display: inline-block;
    padding-top: 4px;
}




</style><!--[if IE]>
<style type="text/css"> 

.twoColElsLtHdr #sidebar1 { padding-top: 30px; }
.twoColElsLtHdr #mainContent { zoom: 1; padding-top: 15px; }

</style>
<![endif]-->
<title>Cont</title>
</head>

<body>
<div id="container">
	<div id="header">
		<h1 align="center"><font size="7" color="#0C090A"> Setari Cont </font></h1>
	</div>
   <div id="navigare" align="center">
            <a href="index.php">Acasa</a>
            
            <a href="produse.html">Produse</a>
            
            <a href="contact.html">Contact</a>
			
			<a href="account.php">Setari cont</a>
			
			<a href="inregistrare.php">Inregistrare</a>
			
			<a href="login.php">Login</a>
			
			<a href="logout.php">Logout</a>
    </div>
</div>
<div align = "left">
	<fieldset>
		<legend>Modificare date ale contului</legend>
		<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
			<label for = "numeCont">Numele contului:</label><br>
			<input type = "text" id = "numeCont" name = "numeCont" value = "<?php echo $_SESSION['login']; ?>">
			<input type = "submit" value = "Modifica numele contului" name = "modifNume">
			<span <?php echo $tipMsgNumeCont ?>><?php echo $msgNumeCont ?></span>
		</form>
		<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
			<label for = "email">Email:</label><br>
			<input type = "email" id = "email" name = "email" value = "<?php echo $profil[4] ?>">
			<input type = "submit" value = "Modifica emailul" name = "modifEmail">
			<span <?php echo $tipMsgEmail ?>><?php echo $msgEmail ?></span>
		</form>
		<label for = "resetPass">Resetare parolă:</label><br>
		<input id = "resetPass" type = "button" value = "Schimbă parola" onclick = "window.location.href = 'reset_pass.php'">
	</fieldset>
	<fieldset>
		<legend>Modificare date personale</legend>
		<form method = "POST" enctype="multipart/form-data" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
			Rubricile marcate cu * sunt obligatorii!<br>
			<label for = "nume">Nume:</label><input type = "text" id = "nume" name = "numePers" value = "<?php $profil[1] === NULL ? print("") : print($profil[1]) ?>"><br>
			<label for = "prenume">Prenume:</label><input type = "text" id = "prenume" name = "prenume" value = "<?php $profil[2] === NULL ? print("") : print($profil[2]) ?>"><br>
			<label for = "nrTel">Nr. telefon:</label><input type = "tel" id = "nrTel" name = "nrTel" value = "<?php $profil[3] === NULL ? print("") : print($profil[3]) ?>"><span <?php echo $errorColor ?>><?php echo $errorsArray['tel'] ?></span><br>
			<label for = "judet">Judet:</label><select name = "judet" id = "judet"><?php echo $judete; ?></select>*  <span <?php echo $errorColor ?>><?php echo $errorsArray['judet'] ?></span><br>
			<label for = "localitate">Localitate:</label><input type = "text" id = "localitate" name = "localitate" value = "<?php $profil[6] === NULL ? print("") : print($profil[6]) ?>"><br>
			<label for = "strada">Strada:</label>
			<input type = "text" id = "strada" name = "strada" value = "<?php $profil[7] === NULL ? print("") : print($profil[7]) ?>">
			<label for = "nrStr">Nr:</label>
			<input type = "text" id = "nr." size = "4" maxlength = "4" name = "nrStr" value = "<?php $profil[9] === NULL ? print("") : print($profil[9]) ?>"><span <?php echo $errorColor ?>><?php echo $errorsArray['nrStr'] ?></span><br>
			<label for = "bloc">Bloc:</label><input type = "text" id = "bloc" size = "5" name = "bloc" value = "<?php $profil[8] === NULL ? print("") : print($profil[8]) ?>">
			<label for = "scara">Scara</label><input type = "text" id = "scara" size = "5" name = "scara" value = "<?php $profil[10] === NULL ? print("") : print($profil[10]) ?>"><br>
			<label for = "etaj">Etaj:</label><input type = "text" id = "etaj" size = "3" maxlength = "3" name = "etaj" value = "<?php $profil[11] === NULL ? print("") : print($profil[11]) ?>"><span <?php echo $errorColor ?>><?php echo $errorsArray['etaj'] ?></span><br>
			<label for = "apt">Apartament:</label><input type = "text" id = "apt" size = "3" maxlength = "3" name = "apt" value = "<?php $profil[12] === NULL ? print("") : print($profil[12]) ?>"><span <?php echo $errorColor ?>><?php echo $errorsArray['ap'] ?></span><br>
			<label for = "avatar">Avatar:</label><input type = "file" accept = "image/*" id = "avatar" name = "avatar"><span <?php echo $errorColor ?>><?php echo $errorsArray['avatar'] ?></span><br>Dimensiunea maxima a avatarului: 6 MB<br>
			<input type = "submit" value = "Modifica" name = "modifDatePers">
			<input type = "button" value = "Reseteaza profilul" name = "resetDatePers" onclick = "this.form.submit();">
			<br><span <?php echo $tipMsgDatePers ?>><?php echo $msgDatePers ?></span>
		</form>
	</fieldset>
</div>
</body>
</html>