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
			if (strlen($nume) !== (strlen($nume) - strlen(substr(strrev($nume), 0, strpos(strrev($nume), '@')))))
				$isEmail = true;
			$nume = mysqli_real_escape_string($conexiune2, $nume);
			$parola = mysqli_real_escape_string($conexiune2, $parola);
			$parola = md5($parola);
			if ($isEmail)
				$cerere = "SELECT * FROM `utilizatori` WHERE `emailadd` = '$nume' AND `password` = '$parola'";
			else $cerere = "SELECT * FROM `utilizatori` WHERE `username` = '$nume' AND `password` = '$parola'";
			$rez = mysqli_query($conexiune2, $cerere);
			if (mysqli_num_rows($rez) === 1)
			{
				$rez = mysqli_fetch_array($rez);
				$nume = $_SESSION["login"] = $rez[1];
				header("location:index.php");
			}
			else
			{			
				$mesaj =  "Numele sau parola sunt incorecte! Daca nu v-ați creat un cont vă puteți înregistra <a href = \"inregistrare.php\">aici</a>.";
				$_SESSION["login"] = "";
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
<title>Login</title>
</head>

<body class="twoColElsLtHdr">
<div id="container">
	<div id="header">
		<h1 align="center"><font size="7" color="#0C090A"> Login </font></h1>
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
<div align = "left">
	<?php echo $mesaj ?>
</div>
</body>
</html>