<?php
	require_once "conexiune.php";
	if (!isset($_SESSION))
	{
		session_start();
	}
	$pagCurenta = basename(__FILE__, '.php');
	$nume = $parola = $parola_confirm = "";
	$numeErr = $parolaErr = $parola_confirmErr = "";
	$mesaj = "";
	if (!empty($_SESSION["login"]))
	{
		$nume = $_SESSION["login"];
	}
	if (isset($_POST["submit"]))
	{
		$nume = $_POST["nume"];
		$parola = $_POST["parola"];
		$parola_confirm = $_POST["parola_confirm"];
		$eroare = $isEmail = false;
		if (empty($nume))
		{
			$numeErr = "Rubrica nume trebuie completată!";
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
			if (strlen($nume) !== (strlen($nume) - strlen(substr(strrev($nume), 0, strpos(strrev($nume), '@')))))
				$isEmail = true;
			$nume = mysqli_real_escape_string($conexiune, $nume);
			if ($isEmail)
				$cerere = "SELECT * FROM `utilizatori` WHERE `emailadd` = '$nume'";
			else $cerere = "SELECT * FROM `utilizatori` WHERE `username` = '$nume'";
			$rez = mysqli_query($conexiune, $cerere);
			if (mysqli_num_rows($rez) === 0)
			{
				$numeErr = "Numele sau adresa introdusă nu a fost găsită! Dacă nu aveți cont va rugăm să vă <a /Proiect/href = 'register.php'>înregistrați</a>.";
			}
			else
			{
				$parola = md5($parola);
				$parola = mysqli_real_escape_string($conexiune, $parola);
				if ($isEmail)
				{
					$cerere = "UPDATE `utilizatori` SET `Password`='$parola' WHERE `emailadd` = '$nume'";
				}
				else $cerere = "UPDATE `utilizatori` SET `Password`='$parola' WHERE `username` = '$nume'";
				$sql = mysqli_query($conexiune, $cerere);
				if ($sql === false)
				{
					$mesaj = "S-a produs o eroare. Va rugăm încercați din nou.";
				}
				else
				{
					if (isset($_SESSION["login"]) && !empty($_SESSION["login"]))
					{
						$mesaj = "Parolă schimbată cu succes. Veți fi redirecționat către pagina cu setări ale contului în câteva momente.";
						header("refresh: 5;url = account.php");
					}
					else
					{
						$mesaj = "Parolă schimbată cu succes. Veți fi redirecționat către pagina de login în câteva momente.";
						header("refresh: 5;url = login.php");
					}
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
<title>Resetare parola</title>
</head>

<body>
<div class = "header">
<?php include "meniu.php" ?>
</div>
<div>
<?php echo $mesaj ?>
<form name = "form_reset" method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
	<table>
		<tr>
			<td>
				<input type = "text" name = "nume" maxlength = "30" placeholder = "Nume sau Email" value = "<?php echo $nume ?>">
				<span class = "error"><?php echo " " . $numeErr; ?></span>
			</td>
		</tr>
		<tr>
			<td>
				<input type = "password" name = "parola" maxlength = "10" placeholder = "Noua parolă">
				<span class = "error"><?php echo " ". $parolaErr; ?></span>
			</td>
		</tr>
		<tr>
			<td>
				<input type = "password" name = "parola_confirm" maxlength = "10" placeholder = "Confirmă noua parolă">
				<span class = "error"><?php echo " " . $parola_confirmErr; ?></span>
			</td>
		</tr>
		<tr>
			<td colspan = "2"><input type = "submit" name = "submit" value = "Schimbă parola"></td>
		</tr>
	</table>
</form>

</body>
</html>