<?php
//error_reporting(E_ALL); - Comentat fiindca afiseaza warning-uri fiindca se foloseste mysql
$hostname="localhost";
$username="root";
$password="";
$database="proiectcolectiv";
// Recomand sa inlocuim mysql cu mysqli fiindca mysql ii deprecated. Nu l-am sters fiindca n-am vrut sa stric tot site-ul.
$conexiune=mysql_connect($hostname,$username,$password)
or die ("Nu s-a putut stabili conexiunea cu baza de date ! ");

$bazadate=mysql_select_db($database,$conexiune)
or die ("Baza de date nu a fost gasita ! ");

$conexiune2 = mysqli_connect($hostname,$username,$password,$database) 
or die("Nu se poate stabili o conexiune către baza de date!");
?> 