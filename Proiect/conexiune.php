<?php
$hostname="localhost";
$username="root";
$password="";
$database="store";

$conexiune=mysql_connect($hostname,$username,$password)
or die ("Nu s-a putut stabili conexiunea cu baza de date ! ");

$bazadate=mysql_select_db($database,$conexiune)
or die ("Baza de date nu a fost gasita ! ");
?> 