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
$r="Benzina";
}
elseif($field=="2")
{
$r="Motorina";
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
$r="Manuala";
}
elseif($field=="2")
{
$r="Secventiala";
}
elseif($field=="3")
{
$r="Automata";
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

$_SESSION['idanunt']=$_POST['idAnunt'];
$rezultat = "";
$selMaker=$_SESSION['selMaker'];
$selModel=$_SESSION['selModel'];
	$sql = "SELECT `Producator`,`ModelName`,`produse`.`idanunt`, `pozaid`, `kilometraj`, DATE_FORMAT(`datafabricatie`,'%d-%m-%Y' )`datafabricatie`,`pret`, `caiputere`, `capacitate`, `clasaeuro`, `culoare` ,`combustibil`, `distributie`, `climatizare`,`SIA`,`IC`,`RV`,`SIE`,`GE`,`Nav`,`SP`,`Servo`,`TD`,`JA`,`Carlig`,`ABS`,`ESP`,`Integrala`,`Xenon` FROM `pozeanunturi`, `produse`,`modele`,`marci` WHERE `Categorie`=1 and`produse`.`ModelId`=`modele`.`ModelId` and `produse`.`MakeId`=`marci`.`MakeId` and `pozeanunturi`.`IdAnunt` = `produse`.`IdAnunt` AND `produse`.`MakeId`='$selMaker'";
	if ($selModel != 9999)
		$sql .= " AND `produse`.`ModelId` = '$selModel'";
		$sql .=" ORDER by Promovare ASC";
	$result = mysql_query($sql);
	do{
	$row = mysql_fetch_array($result);
   }while ($row['idanunt']!=$_SESSION['idanunt']);
		
			
	
		$rezultat .= "<tr align = 'center'><th style = 'width:230' height='40' >". $row['Producator'] ." " . $row['ModelName'] . "</th><th>Culoare</th><td></td><th style>Data fabricatiei</th><td></td><th>Combustibil</th><td></td><th>Cai Putere</th><td width='1'></td></td><td></td><td><th align = 'center'>Kilometraj</th></tr>";
			$rezultat .= "<tr align = 'center'><td rowspan='3' align='left'><img  src = " . '"getImage.php?id=' . $row['pozaid'] . "\" width = '250' height = '225'></td> <td height = '60' >";
			$sql = "SELECT `culoare` FROM `culori` WHERE `colorid` = '" . $row['culoare'] . "'";
			$col = mysql_query($sql);
			$col = mysql_fetch_array($col);
			$rezultat .= "" . $col['culoare'] . "</td><td></td><td>" . $row['datafabricatie'] . "</td><td></td><td>";
			$rezultat .= get_combustibil($row['combustibil']);
			$rezultat .= "<td></td><td>"  . $row['caiputere'] . " </td><td></td></td><td></td><td><td>"  . $row['kilometraj'] . " </td><tr align = 'center'><th align = 'center' height='30'>Aer conditionat</th><td></td><th>Cutie</th><td></td><th style>Capacitate cilindrica</th><td></td><th>Norma poluare</th><td></td><td></td><td></td><th >Pret(€)</th></tr><tr>";
			$rezultat .= "<td height = '60' align='center'>".get_climatizare($row['climatizare'])."</td><td></td><td td align='center'>";
			$rezultat .= "".get_distributie($row['distributie'])."</td><td></td><td align='center'>" . $row['capacitate'] ." cm³</td><td></td>";
			$rezultat .= "<td align='center'>Euro " . $row['clasaeuro'] . "</td><td></td><td>";
			$rezultat .= "<td></td> <td align='center'>" . $row['pret'] . " Euro</td>";
			$rezultat .="<td border = '0'><form action='tel.php' method=POST><input type='hidden' name = 'idAnunt' value='" . $row['idanunt'] . "'><input type=submit name='cumpara' value='Cumpara' /></form></td></tr><tr><td height='20' colspan='13'></td></tr>";
?>


<!DOCTYPE html> 
<html>
<head>
<style type="text/css"> 



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
	<table style = "width:100%" >
		<?php echo $rezultat ?>
	</table>
</div>

</body>
</html>