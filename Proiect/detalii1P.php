<?php
require_once ("conexiune.php");
if (!isset($_SESSION))
{
	session_start();
}
function get_combustibil($field)
{
$r='';
if($field=="1")
{
$r="Benzină";
}
elseif($field=="2")
{
$r="Motorină";
}
elseif($field=="3")
{
$r="Hibrid";
}
return $r;
}

function get_distributie($field)
{
$r='';
if($field=="1")
{
$r="Manuală";
}
elseif($field=="2")
{
$r="Secvențială";
}
elseif($field=="3")
{
$r="Automată";
}
return $r;
}

function get_climatizare($field)
{
$r='';
if($field=="0")
{
$r="Nu are";
}
elseif($field=="1")
{
$r="Manual";
}
elseif($field=="2")
{
$r="Automat";
}
return $r;
}

function get_bit_fields($field)
{
$r='';
if($field=="0")
{
$r="NU";
}
elseif($field=="1")
{
$r="DA";
}
return $r;
}


$_SESSION['idanunt']=$_GET['idAnunt'];
$rezultat = "";
$selMaker=$_SESSION['selMaker'];
$selModel=$_SESSION['selModel'];
	$sql = "SELECT `emisii`.`EuroName`,`Producator`,`ModelName`,`produse`.`idanunt`, `pozaid`, `kilometraj`, DATE_FORMAT(`datafabricatie`,'%d-%m-%Y' )`datafabricatie`,`pret`, `caiputere`, `capacitate`, `culoare` ,`combustibil`, `distributie`, `climatizare`,`SIA`,`IC`,`RV`,`SIE`,`GE`,`Nav`,`SP`,`Servo`,`TD`,`JA`,`Carlig`,`ABS`,`ESP`,`Integrala`,`Xenon` FROM `emisii`,`pozeanunturi`, `produse`,`modele`,`marci` WHERE `produse`.`ClasaEuro`=`emisii`.`EcoId` and `Categorie`=1 and`produse`.`ModelId`=`modele`.`ModelId` and `produse`.`MakeId`=`marci`.`MakeId` and `pozeanunturi`.`IdAnunt` = `produse`.`IdAnunt` AND `produse`.`MakeId`='$selMaker'";
	if ($selModel != 9999)
		$sql .= " AND `produse`.`ModelId` = '$selModel'";
		$sql .=" ORDER by Promovare ASC";
	$result = mysqli_query($conexiune,$sql);
	do{
	$row = mysqli_fetch_array($result);
   }while ($row['idanunt']!=$_SESSION['idanunt']);
		
			$rezultat .= "<tr align = 'center'><th style = 'width:230' height='40' >". $row['Producator'] ." " . $row['ModelName'] . "</th><th width='300'>Culoare</th><td></td><th style>Data fabricației</th><td></td><th>Combustibil</th><td></td><th>Cai Putere</th><td width='1'></td></td><td></td><td><th align = 'center'>Kilometraj</th></tr>";
			$rezultat .= "<tr align = 'center'><td rowspan='3' align='left'><img  src = " . '"getImage.php?id=' . $row['pozaid'] . "\" width = '250' height = '225'></td> <td height = '60' >";
			$sql = "SELECT `culoare` FROM `culori` WHERE `colorid` = '" . $row['culoare'] . "'";
			$col = mysqli_query($conexiune,$sql);
			$col = mysqli_fetch_array($col);
			$rezultat .= "" . $col['culoare'] . "</td><td></td><td>" . $row['datafabricatie'] . "</td><td></td><td>";
			$rezultat .= get_combustibil($row['combustibil']);
			$rezultat .= "<td></td><td>"  . $row['caiputere'] . " </td><td></td></td><td></td><td><td>"  . $row['kilometraj'] . " </td><tr align = 'center'><th align = 'center' height='30'>Aer condiționat</th><td></td><th>Transmisie</th><td></td><th style>Capacitate cilindrică</th><td></td><th>Normă poluare</th><td></td><td></td><td></td><th >Preț(€)</th></tr><tr>";
			$rezultat .= "<td height = '60' align='center'>".get_climatizare($row['climatizare'])."</td><td></td><td td align='center'>";
			$rezultat .= "".get_distributie($row['distributie'])."</td><td></td><td align='center'>" . $row['capacitate'] ." cm³</td><td></td>";
			$rezultat .= "<td align='center'>" . $row['EuroName'] . "</td><td></td><td>";
			$rezultat .= "<td></td> <td align='center'>" . $row['pret'] . " </td>";
			//if(isset($_SESSION['userType'])&&$_SESSION['userType']===2)
			//$rezultat .="<td border = '0' align='center'><form action='sterge.php' method=GET><input type='hidden' name = 'idAnunt' value='" . $row['idanunt'] . "'><input type=submit name='sterge' value='Șterge anunț' /></form></td></tr>";
			//else
			$rezultat .="<tr><th height='30' rowspan='6'>Dotări opționale</th><th height='40' align='center'>Sistem de încălzire auxiliar</th><th></th><th>Închidere centralizată</th><th></th><th>Regulator de viteză</th><th></th><th>Scaune încălzite electric</th><th></th><th></th><th></th><th>Geamuri electrice</th></tr>";
			$rezultat .="<tr align='center'><td height='20'>".get_bit_fields($row['SIA'])."</td><td></td><td>".get_bit_fields($row['IC'])."</td><td></td><td>".get_bit_fields($row['RV'])."</td><td></td><td>".get_bit_fields($row['SIE'])."</td><td></td><td></td><td></td><td>".get_bit_fields($row['GE'])."</td></tr>";
			$rezultat .="<tr><th height='40' align='center'>Sistem de navigație</th><th></th><th>Senzori de parcare</th><th></th><th>Servodirecție</th><th></th><th>Trapă decapotabilă</th><th></th><th></th><th></th><th>Jante de aliaj</th></tr>";
			$rezultat .="<tr align='center'><td height='20'>".get_bit_fields($row['Nav'])."</td><td></td><td>".get_bit_fields($row['SP'])."</td><td></td><td>".get_bit_fields($row['Servo'])."</td><td></td><td>".get_bit_fields($row['TD'])."</td><td></td><td></td><td></td><td>".get_bit_fields($row['JA'])."</td></tr>";
			$rezultat .="<tr><th height='40' align='center'>Cârlig de remorcare</th><th></th><th>ABS</th><th></th><th>ESP</th><th></th><th>Tracțiune integrală</th><th></th><th></th><th></th><th>Faruri Xenon</th></tr>";
			$rezultat .="<tr align='center'><td height='20'>".get_bit_fields($row['Carlig'])."</td><td></td><td>".get_bit_fields($row['ABS'])."</td><td></td><td>".get_bit_fields($row['ESP'])."</td><td></td><td>".get_bit_fields($row['Integrala'])."</td><td></td><td></td><td></td><td>".get_bit_fields($row['Xenon'])."</td></tr>";
			$rezultat .="<tr><th height='120' >Descriere vehicul</th><td colspan='7' id='t'></td>";
			$rezultat .="<tr><td height='40' colspan='13'></td></tr>";
			$rezultat .="<tr><th align='center' rowspan='3'>Adăugare preț promoțional</th><th align='left' colspan='2'>Introduceți prețul promoțional:<form action='modificaPret.php' method=GET><input type='hidden' name = 'idAnunt' value='" . $row['idanunt'] . "'><input type=text name='pretp'></th></tr>";
			$rezultat .="<tr><th  align='left' colspan='2'>Data de la care începe promoția:(zi-luna-an) <input type=text name='datai'></th><td rowspan='2' align='right'><input type=submit name='modifica' value='Actualizează' ></td></tr>";
			$rezultat .="<tr><th align='left' colspan='2'>Data la care expiră promoția:(zi-luna-an)   <input type=text name='datae'></th></form></td></tr>";
?>


<!DOCTYPE html> 
<html>
<head>
<style type="text/css"> 

#t{
border: 1px solid black;
}

#lista_marci
{
	position: fixed;
    top: 20px;
	left:30px;
}
#lista_modele
{
	position: fixed;
    top: 60px;
	left:25px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<div id = "rezultate">
	<table style = "width:100%" border='1'>
		<?php echo $rezultat ?>
	</table>
</div>

</body>
</html>