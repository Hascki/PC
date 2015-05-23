<?php
require_once ("conexiune.php");
$idAnunt = $_GET['idAnunt'];
$pret = $_GET['pretp'];
$datai = $_GET['datai'];
$datae = $_GET['datae'];
$pret = mysqli_real_escape_string($conexiune, $pret);
$datai = mysqli_real_escape_string($conexiune, $datai);
$datae = mysqli_real_escape_string($conexiune, $datae);
$pret = intval(filter_var($pret, FILTER_SANITIZE_NUMBER_INT));
$sql = "INSERT INTO `promotii`(`AnuntId`,`StartTime`,`EndTime`,`NewPrice`) VALUES('$idAnunt','$idAnunt',";
mysqli_query($conexiune,$sql);
if (mysqli_affected_rows($conexiune) > 0) {
    echo "Înregistrare ștearsă cu succes! ";
}
else {
    echo "Înregistrarea pe care doriți să o ștergeți nu a fost găsită!";
}

  ?> 