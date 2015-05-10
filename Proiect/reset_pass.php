<?php
	require_once "conexiune.php";
	if (!isset($_SESSION))
	{
		session_start();
	}
	$pagCurenta = "reset";
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
			$nume = mysqli_real_escape_string($conexiune2, $nume);
			if ($isEmail)
				$cerere = "SELECT * FROM `utilizatori` WHERE `emailadd` = '$nume'";
			else $cerere = "SELECT * FROM `utilizatori` WHERE `username` = '$nume'";
			$rez = mysqli_query($conexiune2, $cerere);
			if (mysqli_num_rows($rez) === 0)
			{
				$numeErr = "Numele sau adresa introdusă nu a fost găsită! Dacă nu aveți cont va rugăm să vă <a /Proiect/href = 'register.php'>înregistrați</a>.";
			}
			else
			{
				$parola = md5($parola);
				$parola = mysqli_real_escape_string($conexiune2, $parola);
				if ($isEmail)
				{
					$cerere = "UPDATE `utilizatori` SET `Password`='$parola' WHERE `emailadd` = '$nume'";
				}
				else $cerere = "UPDATE `utilizatori` SET `Password`='$parola' WHERE `username` = '$nume'";
				$sql = mysqli_query($conexiune2, $cerere);
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

.error
{
	color: #FF0000;
}
</style><!--[if IE]>
<style type="text/css"> 

.twoColElsLtHdr #sidebar1 { padding-top: 30px; }
.twoColElsLtHdr #mainContent { zoom: 1; padding-top: 15px; }

</style>
<![endif]-->
<title>Resetare parola</title>
</head>

<body class="twoColElsLtHdr">

<div id="container">
	<div id="header">
		<h1 align="center"><font size="7" color="#0C090A"> Resetare parolă </font></h1>
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