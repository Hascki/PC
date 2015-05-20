<?php
error_reporting(E_ALL);
$hostname="localhost";
$username="root";
$password="";
$database="proiectcolectiv";
$conexiune = mysqli_connect($hostname,$username,$password,$database) 
or die("Nu se poate stabili o conexiune către baza de date!");
mysqli_set_charset($conexiune, "utf8");
?>