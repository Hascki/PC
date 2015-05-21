<?php
	require_once "conexiune.php";
	if (!isset($_SESSION))
	{
		session_start();
	}
	$nume = $parola = "";
	$numeErr = $parolaErr = "";
	$mesaj = "";
	if (isset($_SESSION["login"]) && !empty($_SESSION["login"]))
	{
		header("location:index.php");
		exit;
	}
	$pagCurenta = basename(__FILE__, '.php');
	if (isset($_POST["submit"]))
	{
		$nume = $_POST["nume"];
		$parola = $_POST["parola"];
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
		if (!$eroare)
		{
			/*
			if (strlen($nume) !== (strlen($nume) - strlen(substr(strrev($nume), 0, strpos(strrev($nume), '@')))))
				$isEmail = true;
			*/
			if (filter_var($nume, FILTER_VALIDATE_EMAIL))
				$isEmail = true;
			$nume = mysqli_real_escape_string($conexiune, $nume);
			$parola = mysqli_real_escape_string($conexiune, $parola);
			$parola = md5($parola);
			if ($isEmail)
				$cerere = "SELECT * FROM `utilizatori` WHERE `emailadd` = '$nume' AND `password` = '$parola'";
			else $cerere = "SELECT * FROM `utilizatori` WHERE `username` = '$nume' AND `password` = '$parola'";
			$rez = mysqli_query($conexiune, $cerere);
			if (mysqli_num_rows($rez) === 1)
			{
				$rez = mysqli_fetch_array($rez);
				$nume = $_SESSION["login"] = $rez[1];
				$_SESSION['userID'] = $rez[0];
				$_SESSION['userType'] = $rez[4];
				header("location:index.php");
			}
			else
			{			
				$mesaj =  "Numele sau parola sunt incorecte! Daca nu v-ați creat un cont vă puteți înregistra <a href = \"inregistrare.php\">aici</a>.";
				$_SESSION["login"] = "";
				$_SESSION["userID"] = "";
				$_SESSION['userType'] = "";
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
<title>Login</title>
</head>

<body>
<div class = "header">
<?php include "meniu.php" ?>
</div>
<div>
<form name = "form_login" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
	<table>
		<tr>
			<td>
				<input type = "text" name = "nume" maxlength = "30" placeholder = "Nume sau Email" value = "<?php echo $nume ?>">
				<span class = "error"><?php echo $numeErr ?></span>
			</td>
		</tr>
		<tr>
			<td>
				<input type = "password" name = "parola" maxlength = "10" placeholder = "Parola">
				<span class = "error"><?php echo $parolaErr ?></span>
			</td>
		</tr>
		<tr>
			<td colspan = "2">Ți-ai uitat parola? Reseteaz-o <a href = "reset_pass.php">aici</a>.</td>
		</tr>
		<tr>
			<td colspan = "2"><input type = "submit" name = "submit" value = "Login"></td>
		</tr>
	</table>
</form>
</div>
<div align = "left">
	<?php echo $mesaj ?>
</div>
</body>
</html>