<?php
	require_once "conexiune.php";
	//substring(`emailadd`, 1, (length(`emailadd`) - length(substring_index(`emailadd`, '@', -1))) / 2 - 1) = '$nume'"
	if (!isset($_SESSION))
	{
		session_start();
	}
	if (isset($_SESSION["login"]) && !empty($_SESSION["login"]))
	{
		header("location:index.php");
		exit;
	}
	$pagCurenta = basename(__FILE__, '.php');
	$email = $parola = $parola_confirm = "";
	$emailErr = $parolaErr = $parola_confirmErr = "";
	$mesaj = "";
	if (isset($_POST["submit"]))
	{
		$email = $_POST["email"];
		$parola = $_POST["parola"];
		$parola_confirm = $_POST["parola_confirm"];
		$eroare = false;
		if (empty($email))
		{
			$emailErr = "Rubrica email trebuie completată!";
			$eroare = true;
		}
		else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
		{
			$emailErr = "Rubrica nu contine o adresa de email!";
			$eroare = true;
		}
		if (empty($parola))
		{
			$parolaErr = "Rubrica parolă trebuie completată!";
			$eroare = true;
		}
		if ($parola !== $parola_confirm)
		{
			$parola_confirmErr = "Parolele nu se potrivesc!";
			$eroare = true;
		}
		if (!$eroare)
		{
			$email = mysqli_real_escape_string($conexiune2, $email);
			$cerere = "SELECT `emailadd` FROM `utilizatori` WHERE `emailadd` = '$email'";
			$rez = mysqli_query($conexiune2, $cerere);
			if (mysqli_num_rows($rez) != 0)
			{
				$emailErr = "Adresa de email este folosita deja! Va rugăm incercați alta adresa de email.";
			}
			else
			{
				$nume = substr($email, 0, strlen($email) - strlen(substr(strrev($email), 0, strpos(strrev($email), '@'))) - 1);
				$parola = md5($parola);
				$email = mysqli_real_escape_string($conexiune2, $email);
				$nume = mysqli_real_escape_string($conexiune2, $nume);
				$parola = mysqli_real_escape_string($conexiune2, $parola);
				$cerere = "INSERT INTO `utilizatori` (`UserId`, `UserName`, `Password`, `EmailAdd`, `Type`) VALUES (NULL, '$nume', '$parola', '$email', '2')";
				$sql = mysqli_query($conexiune2, $cerere);
				if ($sql === false)
				{
					$mesaj =  "S-a produs o eroare. Va rugăm incercați din nou.<br>";
				}
				else 
				{
					$interogare = "SELECT `userid`, `emailadd` FROM `utilizatori` WHERE `emailadd` = '$email' AND `password` = '$parola'";
					$select = mysqli_query($conexiune2, $interogare);
					if (mysqli_num_rows($select) === 1)
					{
						$row = mysqli_fetch_array($select);
						
						$cerere = "INSERT INTO `proiectcolectiv`.`profiles` (`ProfileId`, `Nume`, `Prenume`, `Telefon`, `AdresaEmail`, `Localitate`, `Strada`, `Bloc`, `Numar`, `Scara`, `Etaj`, `Apartament`, `Avatar`) VALUES ('$row[0]', NULL, NULL, NULL, '$row[1]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
						$sql = mysqli_query($conexiune2, $cerere);
						if ($sql === false)
							$mesaj = "Eroare la inserarea in tabelul profiles!<br>";
						else $mesaj = "V-ați înregistrat cu succes. Veți fi redirecționat către pagina de login în câteva momente.";
					}
					else $mesaj = "Eroare la SELECT din profiles!";
					mysqli_free_result($select);
					header("refresh: 5;url = login.php");
				}
			}
			mysqli_free_result($rez);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" type = "text/css" href = "styles/fundal.css">
<link rel = "stylesheet" type = "text/css" href = "styles/meniu.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function()
{
	$("#email").focusout(function()
	{
		$.post("checkEmail.php",
		{
			email: $("#email").val()
		},
		function(data)
		{
			data = $.trim(data);
			if (data === "Email valabil.")
			{
				$("span:first").removeClass("error");
				$("span:first").addClass("succes");
			}
			else
			{
				$("span:first").removeClass("succes");
				$("span:first").addClass("error");
			}
			$("span:first").text(" " + data);
		});
	});
});
</script>
<title>Înregistrare</title>
</head>

<body class="twoColElsLtHdr">
<div class = "header">
<?php include "meniu.php" ?>
</div>
<?php echo $mesaj ?>
<form name = "form_inregistrare" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
	<table>
	<tr>
		<td><input id = "email" type = "email" name = "email" maxlength = "30" value = "<?php echo $email ?>" placeholder = "Email utilizator"></td>
		<td><span class = "error"><?php echo " " . $emailErr; ?></span></td>
	</tr>
	<tr>
		<td><input type = "password" name = "parola" maxlength = "10" placeholder = "Parolă"></td>
		<td><span class = "error"><?php echo " " . $parolaErr; ?></span></td>
	</tr>
	<tr>
		<td><input type = "password" name = "parola_confirm" maxlength = "10" placeholder = "Confirmă parola"></td>
		<td><span class = "error"><?php echo " " . $parola_confirmErr; ?></span></td>
	</tr>
	<tr align = "left">
		<td><input type = "submit" name = "submit" value = "Înregistrează"></td>
	</tr>
	</table>
</form>
<div align = "left">
	<br>Parola poate avea maxim 10 caractere!
</div>
</body>
</html>