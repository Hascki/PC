<?php
if (!isset($_SESSION))
{
	session_start();
}
echo "<div class = \"meniu\">
		<ul>
			<li id = \"curenta\" class = \"leftBtn\"><a href = \"index.php\">Acasă</a></li>
			<li class = \"leftBtn\"><a href = \"produse.html\">Produse</a></li>
			<li class = \"leftBtn\"><a href = \"contact.html\">Contact</a></li>";
	if (isset($_SESSION['login']) && !empty($_SESSION['login']))
	{
		echo "
			<li class = \"leftBtn\"><a href = \"account.php\">Cont</a></li>
			<li class = \"rightBtn\"><a href = \"logout.php\">Logout</a></li>";
	}
	else
	{
		echo "
			<li class = \"rightBtn\"><a href = \"login.php\">Login</a></li>
			<li class = \"rightBtn\"><a href = \"inregistrare.php\">Înregistrare</a></li>";
	}
	echo "
		</ul>
	</div>";
?>