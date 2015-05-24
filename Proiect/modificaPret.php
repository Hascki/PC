<?php
require_once ("conexiune.php");
$ok=1;
$idAnunt = $_GET['idAnunt'];
$pret = $_GET['pretp'];
$datai = $_GET['datai'];
$datae = $_GET['datae'];
$pret = mysqli_real_escape_string($conexiune, $pret);
$datai = mysqli_real_escape_string($conexiune, $datai);
$datae = mysqli_real_escape_string($conexiune, $datae);
$sql1="SELECT STR_TO_DATE('$datai', '%d-%m-%Y');";
$result =mysqli_query($conexiune,$sql1);
$row = mysqli_fetch_row($result);
if ($row[0]==NULL)
{
$ok=0;    
}
$sql2="SELECT STR_TO_DATE('$datae', '%d-%m-%Y');";
$result =mysqli_query($conexiune,$sql2);
$row = mysqli_fetch_row($result);
if ($row[0]==NULL)
{
$ok=0;    
}
if(intval($pret)==0)
$ok=0;
else
$pret = intval($pret);
if($ok==1){
$sql3="SELECT * FROM promotii where `AnuntId`='$idAnunt'";
$result =mysqli_query($conexiune,$sql3);
if (mysqli_num_rows($result) === 0){
$sql = "INSERT INTO `promotii`(`AnuntId`,`StartTime`,`EndTime`,`NewPrice`) VALUES('$idAnunt',DATE_FORMAT(STR_TO_DATE('$datai','%d-%m-%Y'),'%Y-%m-%d'),DATE_FORMAT(STR_TO_DATE('$datae','%d-%m-%Y'),'%Y-%m-%d'),'$pret')";
mysqli_query($conexiune,$sql);
}
else{
//$sql ="UPDATE `promotii` SET `StartTime` =DATE_FORMAT(STR_TO_DATE('$datai','%d-%m-%Y'),'%YYYY-%MM-%DD') and `EndTime` = DATE_FORMAT(STR_TO_DATE('$datae','%d-%m-%Y'),'%Y-%m-%d') and `NewPrice`='$pret' WHERE `AnuntId`='$idAnunt'";
$sql ="DELETE FROM `promotii` WHERE `AnuntId`='$idAnunt'";
mysqli_query($conexiune,$sql);
$sql = "INSERT INTO `promotii`(`AnuntId`,`StartTime`,`EndTime`,`NewPrice`) VALUES('$idAnunt',DATE_FORMAT(STR_TO_DATE('$datai','%d-%m-%Y'),'%Y-%m-%d'),DATE_FORMAT(STR_TO_DATE('$datae','%d-%m-%Y'),'%Y-%m-%d'),'$pret')";
mysqli_query($conexiune,$sql);
}
echo "Promoție înregistrată cu succes!";
}
elseif($ok==0){
echo "Vă rugăm să verificați datele introduse, deoarece promoția nu s-a putut înregistra!";
}

  ?> 