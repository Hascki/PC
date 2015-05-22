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
	$pagCurenta = basename(__FILE__, '.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" type = "text/css" href = "styles/meniu.css">
<link rel = "stylesheet" type = "text/css" href = "styles/fundal.css">
<title>Cont</title>
</head>

<body>
<div class = "header">
<?php include "meniu.php" ?>
</div>
<div class = "container">
	<div id="content" class = "pane">
		<div id = "profil" style = "border:2px solid black;">
			<input type = "button" id = "schProfil" name = "schProfil" value = "Modificare profil" onclick = "window.location.href = 'edit_profile.php'">
		</div>
		<div id = "anunturi">
			<iframe name="anunturiFrame" id="anunturiFrame" src= "cauta.php" scrolling="yes" style = "width: 1000px;height: 1000px;border:0px;"></iframe>
		</div>
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