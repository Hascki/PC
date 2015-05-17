<?php
if (!isset($_SESSION))
{
	session_start();
}
echo "<div class = \"meniu\">
		<ul>
			<li id = \"acasa\"><a href = \"index.php\">Acasă</a></li>
			<li id = \"produse\"><a href = \"produse.html\">Produse</a></li>
			<li id = \"contact\"><a href = \"contact.html\">Contact</a></li>";
	if (isset($_SESSION['login']) && !empty($_SESSION['login']))
	{
		echo "
			<li id = \"setari\"><a href = \"account.php\">Setări cont</a></li>
			<li id = \"logout\"><a href = \"logout.php\">Logout</a></li>";
	}
	else
	{
		echo "
			<li id = \"login\"><a href = \"login.php\">Login</a></li>
			<li id = \"register\"><a href = \"inregistrare.php\">Înregistrare</a></li>";
	}
	echo "
		</ul>
	</div>";
?>