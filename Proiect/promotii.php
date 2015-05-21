<?php
	if (!isset($_SESSION))
	{
		session_start();
	}
	$pagCurenta = basename(__FILE__, '.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" type = "text/css" href = "styles/fundal.css">
<link rel = "stylesheet" type = "text/css" href = "styles/meniu.css">
<title>Produse</title>
</head>

<body>
<div class = "header">
<?php include "meniu.php" ?>
</div>
<div id="sidebar1">
<h3><a href="autoturisme.php" target="mf">Autoturisme</a><br>
&nbsp;</h3>

<h3><a href="moto.html" target="mf">Motociclete</a><br>
&nbsp;</h3>

<h3><a href="atv.html" target="mf">Atv-uri</a><br>
&nbsp;</h3>


<h3><a href="cauta.php" target="mf">Cautare</a><br>
&nbsp;</h3>
</div>

<div id="tvf">
<iframe name="mf" id="mf" scrolling="yes" height="1100" width="1200" ></iframe></div>
</div>
</body>

</html>

