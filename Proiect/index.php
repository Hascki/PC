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
<title>Index</title>
</head>

<body>
<div class = "header">
<?php include "meniu.php" ?>
</div>
<div class = "container">
	<div id="content" class = "pane">
		<img src="http://lorempixel.com/1009/800/cats"/>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam et ante eu lacus mattis egestas. Ut auctor massa id leo semper, sit amet finibus risus molestie. Proin rhoncus, erat sit amet aliquam maximus, nisi leo varius arcu, ut egestas ante urna ac metus. In rhoncus enim sed sodales consectetur. Donec massa arcu, elementum eu consectetur ac, consectetur ac nibh. Ut aliquet tortor id leo lacinia laoreet. Aenean id laoreet risus, semper dictum ipsum. Praesent pulvinar vestibulum facilisis. Maecenas vel dolor a ipsum convallis elementum sed sed est.
	</div>
	<div id = "left" class = "pane">
		<img src="http://lorempixel.com/180/300/nature"/>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam et ante eu lacus mattis egestas. Ut auctor massa id leo semper, sit amet finibus risus molestie. Proin rhoncus, erat sit amet aliquam maximus, nisi leo varius arcu, ut egestas ante urna ac metus. In rhoncus enim sed sodales consectetur. Donec massa arcu, elementum eu consectetur ac, consectetur ac nibh. Ut aliquet tortor id leo lacinia laoreet. Aenean id laoreet risus, semper dictum ipsum. Praesent pulvinar vestibulum facilisis. Maecenas vel dolor a ipsum convallis elementum sed sed est.
	</div>
	<div id = "right" class = "pane">
		<img src="http://lorempixel.com/180/500/food"/>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam et ante eu lacus mattis egestas. Ut auctor massa id leo semper, sit amet finibus risus molestie. Proin rhoncus, erat sit amet aliquam maximus, nisi leo varius arcu, ut egestas ante urna ac metus. In rhoncus enim sed sodales consectetur. Donec massa arcu, elementum eu consectetur ac, consectetur ac nibh. Ut aliquet tortor id leo lacinia laoreet. Aenean id laoreet risus, semper dictum ipsum. Praesent pulvinar vestibulum facilisis. Maecenas vel dolor a ipsum convallis elementum sed sed est.
	</div>
</div>
<div class = "footer">
	<a href = "about.php">About</a><br>
</div>
</body>
</html>
