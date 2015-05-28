<?php
require_once ("conexiune.php");
$idAnunt = $_GET['idAnunt'];
$sql = "DELETE FROM `produse` WHERE `IdAnunt`='$idAnunt'";
mysqli_query($conexiune,$sql);
if (mysqli_affected_rows($conexiune) > 0) {
    echo "Înregistrare ștearsă cu succes! ";
}
else {
    echo "Înregistrarea pe care doriți să o ștergeți nu a fost găsită!";
}

  ?> 