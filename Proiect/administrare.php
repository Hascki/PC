<?php
	require_once "conexiune.php";
	if (!isset($_SESSION))
	{
		session_start();
	}
	$pagCurenta = basename(__FILE__, '.php');
	if (isset($_POST['submit']))
	{
		$eroare = false;
		$email = mysqli_real_escape_string($conexiune, $_POST['email']);
		$telefon = mysqli_real_escape_string($conexiune, $_POST['tel']);
		$sold = mysqli_real_escape_string($conexiune, $_POST['sold']);
		/*
		if (strlen($email) === 0)
		{
			$msgEmail = "Rubrica este goala!";
			$errEmail = " class = \"error\"";
			$eroare = true;
		}
		if (strlen($telefon) === 0)
		{
			$msgTel = "Rubrica este goala!";
			$errTel = " class = \"error\"";
			$eroare = true;
		}
		if (strlen($sold) === 0)
		{
			$msgSold = "Rubrica este goala!";
			$errSold = " class = \"error\"";
			$eroare = true;
		}
		*/
		if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
		{
			$msgEmail = "Emailul nu este valid!";
			$errEmail = " class = \"error\"";
			$eroare = true;
		}
		if (!is_int(filter_var($telefon, FILTER_VALIDATE_INT)))
		{
			$msgTel = "Nu este un numar!";
			$errTel = " class = \"error\"";
			$eroare = true;
		}
		else $telefon = intval(filter_var($telefon, FILTER_SANITIZE_NUMBER_INT));
		if (!is_int(filter_var($sold, FILTER_VALIDATE_INT)))
		{
			$msgSold = "Nu este un numar!";
			$errSold = " class = \"error\"";
			$eroare = true;
		}
		else $sold = intval(filter_var($sold, FILTER_SANITIZE_NUMBER_INT));
		if (!$eroare)
		{
			$query = "UPDATE `profiles` SET `sold` = $sold WHERE `telefon` = $telefon AND `adresaEmail` = $email";
			$sql = mysqli_query($conexiune, $query);
			if ($sql)
				$mesaj = "<span class = \"succes\">Sold actualizat cu succes.</span>";
			else $mesaj = "<span class = \"error\">Nu s-a putut actualiza soldul! Va rugam sa incercati din nou.</span>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" type = "text/css" href = "styles/fundal.css">
<link rel = "stylesheet" type = "text/css" href = "styles/meniu.css">
<title>Administrare</title>
</head>

<body>
<div class = "header">
<?php include "meniu.php" ?>
</div>
<div class = "container">
	<div id="content" class = "pane">
		<fieldset>
			<legend>Editare sold</legend>
			<form name = "editSold" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
				<label for "">Email utilizator</label><br>
				<input type = "email" id = "email" name = "email"> &nbsp; <span<?php if (isset($errEmail)) echo $errEmail; ?>><?php if (isset($msgEmail)) echo $msgEmail; ?></span><br>
				<label for "">Numar telefon</label><br>
				<input type = "text" id = "tel" name = "tel"> &nbsp; <span<?php if (isset($errTel)) echo $errTel; ?>><?php if (isset($msgTel)) echo $msgTel; ?></span><br>
				<label for "">Sold</label><br>
				<input type = "text" id = "sold" name = "sold"> &nbsp; <span<?php if (isset($errSold)) echo $errSold; ?>><?php if (isset($msgSold)) echo $msgSold; ?></span><br>
				<input type = "submit" id = "submit" name = "submit" value = "Modificare">
			</form>
			<?php if (isset($mesaj)) echo $mesaj; ?>
		</fieldset>
	</div>
	<div id = "left" class = "pane">
		
	</div>
	<div id = "right" class = "pane">
		
	</div>
</div>
<div class = "footer">
	<a href = "about.php">About</a><br>
</div>
</body>
</html>
