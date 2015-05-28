<?php
error_reporting(E_ALL);

$hostname="localhost";
$username="root";
$password="";
$database="proiectcolectiv";

$conexiune = mysqli_connect($hostname,$username,$password,$database);
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die("\nNu se poate stabili o conexiune catre baza de date!");
}

mysqli_set_charset($conexiune, "utf8");
?>