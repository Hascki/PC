<?php
include("conexiune.php");

$nume=$_POST['nume'];
$prenume=$_POST['prenume'];
$telefon=$_POST['telefon'];
$email=$_POST['email'];
$adresa=$_POST['adresa'];
$id_produs=$_POST['produs'];
$nr=$_POST['nr_buc'];
$sql1=mysql_query("SELECT nume FROM produse WHERE id='$id_produs'");
$rand=mysql_fetch_row($sql1);
$sql=mysql_query("SELECT nr FROM produse WHERE id='$id_produs'");

$row=mysql_fetch_row($sql);

if($nume=="" || $adresa==""){


echo '<script language="javascript">';
echo 'alert("Nu ati completat numele sau adresa !!")';
echo '</script>';
}

else if ($nr>$row[0]) {


echo '<script language="javascript">';
echo 'alert("Ne pare rau nu mai avem acest produs in stoc. Va rugam sa reveniti in cateva zile.")';
echo '</script>';
}
else {
$query=mysql_query("INSERT INTO cereri (nume, prenume, telefon, email, adresa, produs, nr_buc) VALUES ('$nume','$prenume','$telefon','$email','$adresa','$rand[0]','$nr')");
$ramas=mysql_query("UPDATE produse SET nr=($row[0]-$nr) WHERE id='$id_produs'");

echo '<script language="javascript">';
echo 'alert("Datele tale au fost introduse")';
echo '</script>';


}

mysql_close($conexiune);
?>