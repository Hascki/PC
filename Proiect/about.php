<?php
	if (!isset($_SESSION))
	{
		session_start();
	}
	$pagCurenta = basename(__FILE__, '.php');
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" type = "text/css" href = "styles/fundal.css">
<link rel = "stylesheet" type = "text/css" href = "styles/meniu.css">
<title>About</title>
</head>


<body>
<div class = "header">
<?php include "meniu.php" ?>
</div>
<div class = "container">
	<div id="content" class = "pane">
		<h1 align="center"><font size="20"><b>Pentru orice nelamurire,contactati-ne !</b></font></h1>
		<table>
			<tr>
				<td width="150"></td>
				<td width="350">
					Tel: 0747474747
					E-mail: masini@yahoo.com
					Fax:  0356805690
					Adresa: Timisoara,Calea Aradului,nr 52
				</td>
			</tr>
		</table>
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
