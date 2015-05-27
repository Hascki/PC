<?php
require_once ("conexiune.php");
if (!isset($_SESSION))
{
	session_start();
}
$idAnunt = $_GET['idAnunt'];
if (isset($_GET['promovare'])){
$promovare=$_GET['promovare'];
$sold = $_GET['sold'];
if($promovare==1)
$sold=$sold-50;
elseif($promovare==0)
$sold=$sold-100;
echo $idAnunt;
echo $promovare;
$sql = "UPDATE `produse` SET `Promovare`='$promovare' where `produse`.`idAnunt`='$idAnunt'";
mysqli_query($conexiune,$sql);
if (mysqli_affected_rows($conexiune) > 0) {
    echo "Actualizare promovare efectuată cu succes!<br> ";
}
else {
    echo "Promovarea nu a putut fi actualizată!<br>";
}
$sql = "UPDATE `profiles`,`utilizatori` SET `sold`='$sold' where `profiles`.`profileid` = `utilizatori`.`userid` AND `profileid` = '" . $_SESSION['userID'] ."' AND `username` = '" . $_SESSION['login'] ."'";
mysqli_query($conexiune,$sql);

if (mysqli_affected_rows($conexiune) > 0) {
    echo "Actualizare sold efectuată cu succes! ";
}
else {
    echo "Soldul nu a putut fi actualizat!";
}
}
else{
echo "Sold insuficient!";
}
  ?> 