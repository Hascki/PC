<?php
	if (!isset($_SESSION))
	{
		session_start();
	}
	$pagCurenta = basename(__FILE__, '.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" type = "text/css" href = "styles/fundal.css">
<link rel = "stylesheet" type = "text/css" href = "styles/meniu.css">
<style>


</style>
<title>Index</title>
</head>

<body>
<div class = "header">
<?php include "meniu.php" ?>
</div>
<div class = "container">
	<div id="content" class = "pane">
	
		<img src = "centru.jpg" height="500" width="840">
		
	</div>
	<div id = "left" class = "pane">
		
		<img src = "semafor.png" height="500" width="190">
		
	</div>
	<div id = "right" class = "pane">
		
		<img src = "semafor.png" height="500" width="190">
		
	</div>
</div>
<div class = "footer">
	<a href = "about.php">About</a><br>
</div>
</body>
</html>
