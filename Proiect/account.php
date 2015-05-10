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
	$errNumeCont = $errEmail = $errDatePers = "";
	if (isset($_POST["modifNume"]))
	{
		if (empty($_POST["numeCont"]))
		{
			$errNumeCont = "Nu se poate schimba numele contului deoarece rubrica este goala!";
		}
		else
		{
			//TODO
		}
	}
	else if (isset($_POST["modifEmail"]))
	{
		if (empty($_POST["email"]))
		{
			$errEmail = "Nu se poate schimba adresa de email deoarece rubrica este goala!";
		}
		elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
		{
			$errEmail = "Rubrica nu contine o adresa de email!";
		}
		else
		{
			//TODO
		}
	}
	else if (isset($_POST["modifDatePers"]))
	{
		if (empty($_POST["numePers"]) && empty($_POST["prenume"]) && empty($_POST["nrTel"]) /*&& empty($_POST["judet"])*/ && empty($_POST["localitate"]) && empty($_POST["strada"]) && empty($_POST["nrStr"]) && empty($_POST["bloc"]) && empty($_POST["scara"]) && empty($_POST["apt"])  && empty($_POST["avatar"]))
		{
			$errDatePers = "Toate rubricile sunt goale!";
		}
		else
		{
			//TODO
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







</style><!--[if IE]>
<style type="text/css"> 

.twoColElsLtHdr #sidebar1 { padding-top: 30px; }
.twoColElsLtHdr #mainContent { zoom: 1; padding-top: 15px; }

</style>
<![endif]-->
<title>Cont</title>
</head>

</body>
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
			<input type = "text" placeholder = "Nume cont" name = "numeCont">
			<input type = "submit" value = "Modifica numele contului" name = "modifNume">
			<?php echo $errNumeCont ?>
		</form>
		<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
				<input type = "email" placeholder = "Email" name = "email">
				<input type = "submit" value = "Modifica email-ul" name = "modifEmail">
				<?php echo $errEmail ?>
		</form>
		Resetare parolă:<input id = "reset_pass" type = "button" value = "Schimbă parola" onclick = "window.location.href = 'reset_pass.php'">
	</fieldset>
	<fieldset>
		<legend>Modificare date personale</legend>
		<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
			<input type = "text" placeholder = "Nume" name = "numePers"><input type = "text" placeholder = "Prenume" name = "prenume"><br>
			<input type = "tel" placeholder = "Numar de telefon" name = "nrTel"><br>
			<input type = "text" placeholder = "Judet" name = "judet"><input type = "text" placeholder = "Localitate" name = "localitate"><br>
			<input type = "text" placeholder = "Strada" name = "strada"><input type = "text" placeholder = "Nr." size = "4" maxlength = "4" name = "nrStr"><br>
			<input type = "text" placeholder = "Bloc" name = "bloc"><input type = "text" placeholder = "Scara" name = "scara"><br>
			<input type = "text" placeholder = "Etaj" size = "3" maxlength = "3" name = "etaj"><input type = "text" placeholder = "Apt." size = "3" maxlength = "3" name = "apt"><br>
			<input type = "file" accept = "image/*" name = "avatar">*Maxim 16 MB<br>
			<input type = "submit" value = "Modifica" name = "modifDatePers">
			<input type = "reset" value = "Reseteaza">
			<?php echo "<br>" . $errDatePers ?>
		</form>
	</fieldset>
</div>
</body>
</html>