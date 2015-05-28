<?php
error_reporting(E_ALL);
// Datele de login in baza de date de pe site
/*
$hostname="localhost";
$username="pc";
$password="petrov";
$database="pc";
*/
// Datele de login in baza de date pe localhost

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
//or die("Nu se poate stabili o conexiune către baza de date!");
mysqli_set_charset($conexiune, "utf8");
?>