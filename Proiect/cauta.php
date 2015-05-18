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

function get_poluare($field)
{
$r='';
if($field=="0")
{
$r="Non-euro";
}
else{
$r="Euro ".$field;
}
return $r;
}
/*$c=0;
	if ($c==1){
	unset ($_SESSION['makers']);
	
	unset ($_SESSION['models']);
	
	unset ($_SESSION['categories']);
	$_SESSION['makers']='';
	$_SESSION['models']='';
	$_SESSION['categories']='';
	unset ($models);
	*/
	/*
	if (!(isset($_SESSION['selMaker'])))
	$_SESSION['selMaker']='';
	if (!(isset($_SESSION['selModel'])))
	$_SESSION['selModel']='';
	(isset($_POST['marci']))&&(isset($_POST['modele']))&&(isset($_POST['categorii']))&&
*/

$selCategory = $selMaker = $selModel = ""; //Marca selectata/Model selectat
$stareListaCategorii = $stareListaModele =$stareListaMarci = ""; // Activeaza sau dezactiveaza casuta cu modele
$categories = $makers = $models = "0";
$rezultate = "";

function get_categories()
{
	global $conexiune;
	$sql = "SELECT Type,CatName FROM categorie";
	$result = mysqli_query($conexiune,$sql);
	global $categories;
	$categories = '<option value = "0"> Alegeti categoria </option>';
	while ($row = mysqli_fetch_array($result)) 
	{
		$categories.='<option value="' . $row["Type"] . '">' . $row["CatName"] . '</option>';
	}
}

function get_makers($selCategory)
{
	global $conexiune;
	// Extrage din baza de date marcile de masini
	$category = mysqli_real_escape_string($conexiune,$selCategory);
	$sql = "SELECT MakeId,Producator FROM marci";
	
	if ($category == 1)
		$sql .= " where Auto = 1";
	elseif ($category == 2){
		$sql .= " where `Moto` = 1";
	}
	elseif ($category == 3){
		$sql .= " where ATV = 1";
	}
	elseif ($category == 9999){
		$sql .= "";
	}
	$result = mysqli_query($conexiune,$sql);
	global $makers;
	$makers = '<option value = "0"> Alegeti marca </option>';
	//$makers .= '<option value="9999">Toate</option>';
	while ($row = mysqli_fetch_array($result)) 
	{
		$makers.='<option value="' . $row["MakeId"] . '">' . $row["Producator"] . '</option>';
	}
	
}
 
function get_models($selMaker)
{
	global $conexiune;
	// Extrage modelele in functie de marca primita ca parametru
	$maker = mysqli_real_escape_string($conexiune,$selMaker);
	$sql = "SELECT `modelid`, `modelname` FROM `modele` WHERE `makeid` = '$maker'";
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

if (!isset($_POST['categorii'])&&!isset($_POST['marci']) && !isset($_POST['modele']))
{
echo "f1";
//global $c;$c=1;
	// Prima data cand se intra pe pagina
	get_categories();
	$_SESSION['categories'] = $categories;
	//get_makers();
	//$_SESSION['makers'] = $makers;
	//$stareListaModele = "disabled";
}

else if (isset($_POST['categorii'])&&!isset($_POST['marci']) && !isset($_POST['modele']))
{echo "f2";
	//
	$categories = $_SESSION['categories'];
	$selCategory = $_POST['categorii'];
	$categories= change_selected($categories, $selCategory);
	get_makers($selCategory);
	$_SESSION['categories'] = $categories;
	$_SESSION['makers'] = $makers;
	$selMaker = "0";
	//$stareListaModele = "disabled";
}

else if (isset($_POST['categorii'])&&isset($_POST['marci']) && !isset($_POST['modele'])&& $_POST['marci'] === $_POST['lastSelMaker'])
{echo "f2.2";
	//
	$categories = $_SESSION['categories'];
	$selCategory = $_POST['categorii'];
	$categories= change_selected($categories, $selCategory);
	get_makers($selCategory);
	$_SESSION['categories'] = $categories;
	$_SESSION['makers'] = $makers;
	$selMaker=$_POST['marci'];
}

else if (isset($_POST['categorii'])&&isset($_POST['marci']) && !isset($_POST['modele'])&& $_POST['marci'] !== $_POST['lastSelMaker']&& $_POST['categorii'] === $_POST['lastSelCategory'])
{echo "f3";
	//
	$categories = $_SESSION['categories'];
	$makers = $_SESSION['makers'];
	$selMaker = $_POST['marci'];
	$selCategory = $_POST['categorii'];
	$makers= change_selected($makers, $selMaker);
	get_models($selMaker);
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
}

/*else if (isset($_POST['categorii'])&&isset($_POST['marci']) && !isset($_POST['modele'])&& $_POST['marci'] !== $_POST['lastSelMaker']&& $_POST['categorii'] !== $_POST['lastSelCategory'])
{echo "f3.1";
	//
	$categories = $_SESSION['categories'];
	$makers = $_SESSION['makers'];
	$selMaker = $_POST['marci'];
	$selCategory = $_POST['categorii'];
	$makers= change_selected($makers, $selMaker);
	get_models($selMaker);
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
}*/
else if (isset($_POST['categorii'])&&isset($_POST['marci']) && !isset($_POST['modele'])&& $_POST['categorii'] !== $_POST['lastSelCategory'])
{echo "f3.3";
	//
	$categories = $_SESSION['categories'];
	//$makers=$_SESSION['makers'];
	$selCategory = $_POST['categorii'];
	$categories= change_selected($categories, $selCategory);
	get_makers($selCategory);
	//$makers= change_selected($makers);
	$_SESSION['categories'] = $categories;
	$_SESSION['makers']=$makers;
	//$stareListaModele = "disabled";

}

else if ((isset($_POST['marci']) && isset($_POST['modele'])) && $_POST['marci'] == 0)
{echo "f4";
	// Daca se alege prima optiune din lista marcilor se dezactiveaza lista de modele. Un fel de buton de restart.
	$stareListaModele = "disabled";
	$makers = $_SESSION['makers'];
	$makers = change_selected($makers);
}
else if ((isset($_POST['categorii']))&&(isset($_POST['marci']) && isset($_POST['modele']))&&$_POST['modele'] == 0)
{echo "f5";
	// Daca este activa optiunea default din lista de modele.
	$categories = $_SESSION['categories'];
	$selMaker = $_POST['marci'];
	$makers = $_SESSION['makers'];
	$makers = change_selected($makers, $selMaker);
	$models = $_SESSION['models'];
	get_models($selMaker);
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
}
else if ((isset($_POST['categorii']))&&(isset($_POST['marci']) && isset($_POST['modele']) && isset($_POST['lastSelMaker'])) && $_POST['marci'] !== $_POST['lastSelMaker'])
{echo "f33333";
	// Cand se trece de la o marca la alta sa se reseteze lista de modele, id-ul marcii selectate.
	$categories = $_SESSION['categories'];
	$selMaker = $_POST['marci'];
	$makers = $_SESSION['makers'];
	$makers = change_selected($makers, $selMaker);
	get_models($selMaker);
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
}
else if (((isset($_POST['categorii']))&&(isset($_POST['marci']) && (isset($_POST['modele']))) && isset($_POST['lastSelCategory'])) && $_POST['categorii'] !== $_POST['lastSelCategory'])
{echo "f4444";
//echo $_POST['categorii'];
//echo $_POST['lastSelCategory'];
$categories = $_SESSION['categories'];
//$makers=$_SESSION['makers'];
$selCategory = $_POST['categorii'];
$categories= change_selected($categories, $selCategory);
get_makers($selCategory);
//$makers= change_selected($makers);
$_SESSION['categories'] = $categories;
$_SESSION['makers']=$makers;
//$stareListaModele = "disabled";
}
else
{echo "f5555";
	// Aici se ajunge cand s-a ales o marca si un model si se poate cauta in tabelul de anunturi.
	// Daca numarul de randuri este 0 inseamna ca nu exista nici un anunt care sa respecte cerintele selectate
	// si se va afisa un mesaj.
	if ((isset($_POST['marci'])))
	$selMaker = $_POST['marci'];
	if ((isset($_POST['modele'])))
	$selModel = $_POST['modele'];
	global $rezultate;
	if ((isset($_POST['categorii'])))
	$selCategory = $_POST['categorii'];
	if ((isset($_SESSION['categories'])))
	$categories = $_SESSION['categories'];
	if ((isset($_SESSION['makers'])))
	$makers = $_SESSION['makers'];
	if ((isset($_SESSION['models'])))
	$models = $_SESSION['models'];
	$makers = change_selected($makers, $selMaker);
	$models = change_selected($models, $selModel);
	$_SESSION['categories']=$categories;
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
	$selCategory = mysqli_real_escape_string($conexiune,$selCategory);
	$selMaker = mysqli_real_escape_string($conexiune,$selMaker);
	$selModel = mysqli_real_escape_string($conexiune,$selModel);
	echo $selMaker;
	$_SESSION['selMaker']=$selMaker;
	$_SESSION['selModel']=$selModel;
	$sql = "SELECT `Producator`,`ModelName`,`produse`.`idanunt`, `pozaid`, `kilometraj`, DATE_FORMAT(`datafabricatie`,'%d-%m-%Y' )`datafabricatie`,`pret`, `caiputere`, `capacitate`, `clasaeuro`, `culoare` ,`combustibil`, `distributie`, `climatizare`,`SIA`,`IC`,`RV`,`SIE`,`GE`,`Nav`,`SP`,`Servo`,`TD`,`JA`,`Carlig`,`ABS`,`ESP`,`Integrala`,`Xenon` FROM `pozeanunturi`, `produse`,`modele`,`marci` WHERE `Categorie`=1 and`produse`.`ModelId`=`modele`.`ModelId` and `produse`.`MakeId`=`marci`.`MakeId` and `pozeanunturi`.`IdAnunt` = `produse`.`IdAnunt` AND `produse`.`MakeId`='$selMaker'";
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
			$rezultate .= "<td></td><td>"  . $row['caiputere'] . " </td><td></td></td><td></td><td><td>"  . $row['kilometraj'] . " </td><tr align = 'center'><th align = 'center' height='30'>Aer condiționat</th><td></td><th>Cutie</th><td></td><th style>Capacitate cilindrică</th><td></td><th>Normă poluare</th><td></td><td></td><td></td><th >Pret(€)</th></tr><tr>";
			$rezultate .= "<td height = '60' align='center'>".get_climatizare($row['climatizare'])."</td><td></td><td td align='center'>";
			$rezultate .= "".get_distributie($row['distributie'])."</td><td></td><td align='center'>" . $row['capacitate'] ." cm³</td><td></td>";
			$rezultate .= "<td align='center'>" . get_poluare($row['clasaeuro'])  . "</td><td></td><td>";
			$rezultate .= "<td></td> <td align='center'>" . $row['pret'] . " </td>";
			$rezultate .="<td border = '0'><form action='detalii1.php' method=POST><input type='hidden' name = 'idAnunt' value='" . $row['idanunt'] . "'><input type=submit name='detalii' value='Detalii' /></form></td></tr><tr><td height='20' colspan='13'></td></tr>";
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
<form name="autoturisme" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
	<div id="categorii">
		<select name="categorii" onchange = "this.form.submit();">
			<?php  echo $categories; ?>
		</select>
	</div>
	<div id="lista_marci1">
		<select name="marci" <?php echo $stareListaMarci ?> onchange = "this.form.submit();">
			<?php  echo $makers; ?>
		</select>
	</div>
	<div id = "lista_modele1">
		<select name = "modele" <?php echo $stareListaModele ?> onchange = "this.form.submit();">
			<?php echo $models; ?>
		</select>
	</div>
	<input type = "hidden" name = "lastSelCategory" value = "<?php echo $selCategory; ?>">
	<input type = "hidden" name = "lastSelMaker" value = "<?php echo $selMaker; ?>">
</form>
<div id = "rezultate">
	<table style = "width:100%" >
		<?php echo $rezultate ?>
	</table>
</div>

</body>
</html>