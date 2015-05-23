<?php 
require_once "conexiune.php";
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



$selMaker = $selModel = ""; //Marca selectata/Model selectat
$stareListaModele = ""; // Activeaza sau dezactiveaza casuta cu modele
$makers = $models = "";
$rezultate = "";

function get_makers()
{
	// Extrage din baza de date marcile de masini
	$sql = "SELECT MakeId,Producator FROM marci where ATV=1";
    global $conexiune;
	$result = mysqli_query($conexiune,$sql);
	global $makers;
	$makers = '<option value = "0"> Alegeti marca </option>';
	while ($row = mysqli_fetch_array($result)) 
	{
		$makers.='<option value="' . $row["MakeId"] . '">' . $row["Producator"] . '</option>';
	}
}
function get_models($selMaker)
{
	// Extrage modelele in functie de marca primita ca parametru
	 global $conexiune;
	$maker = mysqli_real_escape_string($conexiune,$selMaker);
	$sql = "SELECT `modelid`, `modelname` FROM `modele` WHERE `makeid` = '$maker' and `Type`=3";
	$result = mysqli_query($conexiune,$sql);
	global $models;
	$models = '<option value="0" selected>Selectati modelul</option>';
	$models .= '<option value="9999">Toate</option>';
	While ($row = mysqli_fetch_array($result))
		$models .= '<option value="' . $row["modelid"] . '"> ' . $row["modelname"] . ' </option>';
}

function change_selected($optionList, $selected = '0')
{
	// Modifica in lista optionList care optiune va avea atributul selected bazandu-se pe valoarea acestuia.
	// Mai intai sterge unde gaseste substring-ul selected apoi adauga acest atribut dupa o valoare egala cu $selected.
	 global $conexiune2;
	$tempList = $optionList;
	$tempList = str_replace(' selected', '', $tempList);
	$poz = strpos($tempList, "value=\"$selected\"");
	if ($selected < 10)
		$off = 9;
	else if ($selected > 9 && $selected < 100)
		$off = 10;
	else if ($selected > 99 && $selected < 1000)
		$off = 11;
	else $off = 12;
	$optionList = substr($tempList, 0, $poz + $off);
	$optionList .= " selected";
	$optionList .= substr($tempList, $poz + $off);
	return $optionList;
	
}

if (!isset($_GET['marci']) && !isset($_GET['modele']))
{
	// Prima data cand se intra pe pagina
	get_makers();
	$_SESSION['makers'] = $makers;
	$stareListaModele = "disabled";
}
else if (isset($_GET['marci']) && !isset($_GET['modele']))
{
	// Daca s-a ales un model iar lista de modele era dezactivata
	$makers = $_SESSION['makers'];
	$selMaker = $_GET['marci'];
	$makers = change_selected($makers, $selMaker);
	get_models($selMaker);
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
}
else if ((isset($_GET['marci']) && isset($_GET['modele'])) && $_GET['marci'] == 0)
{
	// Daca se alege prima optiune din lista marcilor se dezactiveaza lista de modele. Un fel de buton de restart.
	$stareListaModele = "disabled";
	$makers = $_SESSION['makers'];
	$makers = change_selected($makers);
}
else if ((isset($_GET['marci']) && isset($_GET['modele'])) && $_GET['modele'] == 0)
{
	// Daca este activa optiunea default din lista de modele.
	$selMaker = $_GET['marci'];
	$makers = $_SESSION['makers'];
	$makers = change_selected($makers, $selMaker);
	$models = $_SESSION['models'];
	get_models($selMaker);
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
}
else if ((isset($_GET['marci']) && isset($_GET['modele']) && isset($_GET['lastSelMaker'])) && $_GET['marci'] !== $_GET['lastSelMaker'])
{
	// Cand se trece de la o marca la alta sa se reseteze lista de modele, id-ul marcii selectate.
	$selMaker = $_GET['marci'];
	$makers = $_SESSION['makers'];
	$makers = change_selected($makers, $selMaker);
	get_models($selMaker);
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
}
else
{
	// Aici se ajunge cand s-a ales o marca si un model si se poate cauta in tabelul de anunturi.
	// Daca numarul de randuri este 0 inseamna ca nu exista nici un anunt care sa respecte cerintele selectate
	// si se va afisa un mesaj.
	$selMaker = $_GET['marci'];
	$selModel = $_GET['modele'];
	$makers = $_SESSION['makers'];
	$models = $_SESSION['models'];
	$models = change_selected($models, $selModel);
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
	$selMaker = mysqli_real_escape_string($conexiune,$selMaker);
	$selModel = mysqli_real_escape_string($conexiune,$selModel);
	$_SESSION['selMaker']=$selMaker;
	$_SESSION['selModel']=$selModel;
	$sql = "SELECT `emisii`.`EuroName`,`Producator`,`ModelName`,`produse`.`idanunt`, `pozaid`, `kilometraj`, DATE_FORMAT(`datafabricatie`,'%d-%m-%Y' )`datafabricatie`,`pret`, `caiputere`, `capacitate`, `clasaeuro`, `culoare` ,`combustibil`, `distributie`, `climatizare`,`SIA`,`IC`,`RV`,`SIE`,`GE`,`Nav`,`SP`,`Servo`,`TD`,`JA`,`Carlig`,`ABS`,`ESP`,`Integrala`,`Xenon` FROM `emisii`,`pozeanunturi`, `produse`,`modele`,`marci` WHERE `produse`.`ClasaEuro`=`emisii`.`EcoId` and `Categorie`=3 and`produse`.`ModelId`=`modele`.`ModelId` and `produse`.`MakeId`=`marci`.`MakeId` and `pozeanunturi`.`IdAnunt` = `produse`.`IdAnunt` AND `produse`.`MakeId`='$selMaker'";
	// Daca nu s-a ales optiunea Toate
	if ($selModel != 9999)
		$sql .= " AND `produse`.`ModelId` = '$selModel'";
		$sql .=" ORDER by Promovare ASC";
	$result = mysqli_query($conexiune,$sql);
	if (mysqli_num_rows($result) === 0)
		$rezultate = "<tr><td>Ne pare rau, nu a fost gasit niciun anunt dupa criteriile de cautare selectate!</td></tr>";
	else
	{
		while ($row = mysqli_fetch_array($result))
		{
			$rezultate .= "<tr align = 'center'><th style = 'width:230' height='40' >". $row['Producator'] ." " . $row['ModelName'] . "</th><th>Culoare</th><td></td><th style>Data fabricației</th><td></td><th>Combustibil</th><td></td><th>Cai Putere</th><td width='1'></td></td><td></td><td><th align = 'center'>Kilometraj</th></tr>";
			$rezultate .= "<tr align = 'center'><td rowspan='3' align='left'><img  src = " . '"getImage.php?id=' . $row['pozaid'] . "\" width = '250' height = '225'></td> <td height = '60' >";
			$sql = "SELECT `culoare` FROM `culori` WHERE `colorid` = '" . $row['culoare'] . "'";
			$col = mysqli_query($conexiune,$sql);
			$col = mysqli_fetch_array($col);
			$rezultate .= "" . $col['culoare'] . "</td><td></td><td>" . $row['datafabricatie'] . "</td><td></td><td>";
			$rezultate .= get_combustibil($row['combustibil']);
			$rezultate .= "<td></td><td>"  . $row['caiputere'] . " </td><td></td></td><td></td><td><td>"  . $row['kilometraj'] . " </td><tr align = 'center'><th align = 'center' height='30'>Cârlig de remorcare</th><td></td><th>Tracțiune integrală</th><td></td><th style>Capacitate cilindrică</th><td></td><th>Normă poluare</th><td></td><td></td><td></td><th >Preț(€)</th></tr><tr>";
			$rezultate .= "<td height = '60' align='center'>".get_bit_fields($row['Carlig'])."</td><td></td><td td align='center'>";
			$rezultate .= "".get_bit_fields($row['Integrala'])."</td><td></td><td align='center'>" . $row['capacitate'] ." cm³</td><td></td>";
			$rezultate .= "<td align='center'>".$row['EuroName']. "</td><td></td><td>";
			$rezultate .= "<td></td> <td align='center'>" . $row['pret'] . " </td>";
			$rezultate .="<td border = '0'><form action='detalii3P.php' method=GET><input type='hidden' name = 'idAnunt' value='" . $row['idanunt'] . "'><input type=submit name='detalii3' value='Detalii' /></form></td></tr><tr><td height='20' colspan='13'></td></tr>";
		}
	}
	
}
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
<form name="autoturisme" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get" >
	<div id="lista_marci1">
		<select name="marci" onchange = "this.form.submit();">
			<?php  echo $makers; ?>
		</select>
	</div>
	<div id = "lista_modele1">
		<select name = "modele" <?php echo $stareListaModele ?> onchange = "this.form.submit();">
			<?php echo $models; ?>
		</select>
	</div>
	<input type = "hidden" name = "lastSelMaker" value = "<?php echo $selMaker; ?>">
</form>
<div id = "rezultate">
	<table style = "width:100%" >
		<?php echo $rezultate ?>
	</table>
</div>

</body>
</html>