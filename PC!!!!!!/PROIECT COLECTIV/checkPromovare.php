<?php
require_once ("conexiune.php");
if (!isset($_SESSION))
{
	session_start();
}
$query = "SELECT `sold` FROM `profiles`, `utilizatori` WHERE `profiles`.`profileid` = `utilizatori`.`userid` AND `profileid` = '" . $_SESSION['userID'] ."' AND `username` = '" . $_SESSION['login'] ."'";
	$sql = mysqli_query($conexiune, $query);
	if ($sql !== false && mysqli_num_rows($sql) === 1)
	{
		 $row = mysqli_fetch_array($sql);
		 $sold = $row['sold'];
	}
$idAnunt = $_GET['idAnunt'];
if (isset($_GET['promovare'])){
$promovare=$_GET['promovare'];
if($promovare==1)
$sold=$sold-50;
elseif($promovare==0)
$sold=$sold-100;

$promovare= mysqli_real_escape_string($conexiune,$promovare);
$sold= mysqli_real_escape_string($conexiune,$sold);
$sql = "UPDATE `produse` SET `Promovare`='$promovare' where `produse`.`idAnunt`='$idAnunt'";
mysqli_query($conexiune,$sql);
if (mysqli_affected_rows($conexiune) > 0) {
    echo "Actualizare promovare efectuată cu succes!<br> ";
	if($promovare!=2){
	$sql = "UPDATE `profiles`,`utilizatori` SET `sold`='$sold' where `profiles`.`profileid` = `utilizatori`.`userid` AND `profileid` = '" . $_SESSION['userID'] ."' AND `username` = '" . $_SESSION['login'] ."'";
mysqli_query($conexiune,$sql);

if (mysqli_affected_rows($conexiune) > 0) {
    echo "Actualizare sold efectuată cu succes! ";
}
else {
    echo "Soldul nu a putut fi actualizat!";
}
}
elseif($promovare==2)
{
echo "Nu a fost nevoie ca soldul să fie actualizat!";
}
}

else {
    echo "Promovarea nu a putut fi actualizată, deoarece produsul se află deja la această categorie de promovare!<br>";
}
}
else{
echo "Sold insuficient!";
}
  ?> 