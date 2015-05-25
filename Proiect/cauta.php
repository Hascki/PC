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

//if(isset($_SESSION['div']))
	 $_SESSION['div']="<div id='pret'>Pret(€)
	 <div>
	<input type='number' name='mic' id='input1'> <input type='number' name='mare' id='input1'>
	 <div>
	  &nbsp &nbsp &nbsp  de la  &nbsp &nbsp &nbsp &nbsp pana la
	  </div>
	</div>
	</div>";
$ok=1;
$stareCauta = "hidden";
$selXenon=$selIntegrala=$selESP=$selcarlig=$selABS=$selJante=$selTrapa=$selServo=$selSenzori=$selNavigatie=$selGeamuriEl=$selScauneInc=$selRegulatorV=$selInchidere=$selIncalzire=$selPoluare=$selClimatizare=$selDistributie=$selCategory = $selMaker = $selModel = $selCombustibil= $selCuloare=""; //Marca selectata/Model selectat
$stareListaCategorii = $stareListaModele =$stareListaMarci = ""; // Activeaza sau dezactiveaza casuta cu modele
$categories = $makers = $models = "";
$div="";
$xenon=$integrala=$ESP=$carlig=$ABS=$jante=$trapa=$servo=$senzori=$navigatie=$geamuriEl=$scauneInc=$regulatorV=$inchidere=$incalzire=$combustibil =$distributie =$culori =$climatizare =$poluare="";
$rezultate = "";

function set_filtre()
{	
	global $combustibil;
	$combustibil = '<option value="99"> Combustibil </option>';
	$combustibil .= '<option value="1"> Benzina </option>';
	$combustibil .= '<option value="2"> Motorina </option>';
	$combustibil .= '<option value="3"> Hibrid </option>';
	$combustibil .= '<option value="4"> Electric </option>';
	global $culori;
	$culori = '<option value="99"> Culori </option>';
	$culori .= '<option value="1"> Alb </option>';
	$culori .= '<option value="2"> Albastru </option>';
	$culori .= '<option value="3"> Argintiu </option>';
	$culori .= '<option value="4"> Auriu </option>';
	$culori .= '<option value="5"> Bej </option>';
	$culori .= '<option value="6"> Galben </option>';
	$culori .= '<option value="7"> Gri </option>';
	$culori .= '<option value="8"> Maro </option>';
	$culori .= '<option value="9"> Negru </option>';
	$culori .= '<option value="10"> Portocaliu </option>';
	$culori .= '<option value="11"> Rosu </option>';
	$culori .= '<option value="12"> Verde </option>';
	$culori .= '<option value="13"> Violet </option>';
	global $distributie;
	$distributie = '<option value="99"> Transmisie </option>';
	$distributie .= '<option value="1"> Manuala </option>';
	$distributie .= '<option value="2"> Secventiala </option>';
	$distributie .= '<option value="3"> Automata </option>';
	global $climatizare;
	$climatizare = '<option value="99"> Aer conditionat </option>';
	$climatizare .= '<option value="0"> Fara </option>';
	$climatizare .= '<option value="1"> Manual </option>';
	$climatizare .= '<option value="2"> Automat </option>';
	global $poluare;
	$poluare = '<option value="99"> Norma poluare </option>';
	$poluare .= '<option value="1"> Non-Euro</option>';
	$poluare .= '<option value="2"> Euro1 </option>';
	$poluare .= '<option value="3"> Euro2 </option>';
	$poluare .= '<option value="4"> Euro3 </option>';
	$poluare .= '<option value="5"> Euro4 </option>';
	$poluare .= '<option value="6"> Euro5 </option>';
	$poluare.= '<option value="7"> Hibrid </option>';
	global $incalzire;
	$incalzire = '<option value="9"> Incalzire auxiliara </option>';
	$incalzire .= '<option value="0"> Nu</option>';
	$incalzire .= '<option value="1"> Da </option>';
	global $inchidere;
	$inchidere = '<option value="9"> Inchidere centralizata </option>';
	$inchidere .= '<option value="0"> Nu</option>';
	$inchidere .= '<option value="1"> Da </option>';
	global $regulatorV;
	$regulatorV = '<option value="9"> Regulator viteza </option>';
	$regulatorV .= '<option value="0"> Nu</option>';
	$regulatorV .= '<option value="1"> Da </option>';
	global $scauneInc;
	$scauneInc = '<option value="9"> Scaune incalzite </option>';
	$scauneInc .= '<option value="0"> Nu</option>';
	$scauneInc .= '<option value="1"> Da </option>';
	global $geamuriEl;
	$geamuriEl = '<option value="9"> Geamuri electrice </option>';
	$geamuriEl .= '<option value="0"> Nu</option>';
	$geamuriEl .= '<option value="1"> Da </option>';
	global $navigatie;
	$navigatie = '<option value="9"> Sistem navigatie </option>';
	$navigatie .= '<option value="0"> Nu</option>';
	$navigatie .= '<option value="1"> Da </option>';
	global $senzori;
	$senzori = '<option value="9"> Senzori de parcare </option>';
	$senzori .= '<option value="0"> Nu</option>';
	$senzori .= '<option value="1"> Da </option>';
	global $servo;
	$servo = '<option value="9"> Servodirectie </option>';
	$servo .= '<option value="0"> Nu</option>';
	$servo .= '<option value="1"> Da </option>';
	global $trapa;
	$trapa = '<option value="9"> Trapa </option>';
	$trapa .= '<option value="0"> Nu</option>';
	$trapa .= '<option value="1"> Da </option>';
	global $jante;
	$jante = '<option value="9"> Jante aliaj </option>';
	$jante .= '<option value="0"> Nu</option>';
	$jante .= '<option value="1"> Da </option>';
	global $ABS;
	$ABS= '<option value="9"> ABS </option>';
	$ABS .= '<option value="0"> Nu</option>';
	$ABS .= '<option value="1"> Da </option>';
	global $carlig;
	$carlig= '<option value="9"> Carlig remorcare </option>';
	$carlig.= '<option value="0"> Nu</option>';
	$carlig.= '<option value="1"> Da </option>';
	global $ESP;
	$ESP= '<option value="9"> ESP </option>';
	$ESP.= '<option value="0"> Nu</option>';
	$ESP.= '<option value="1"> Da </option>';
	global $integrala;
	$integrala= '<option value="9"> Tractiune integrala </option>';
	$integrala.= '<option value="0"> Nu</option>';
	$integrala.= '<option value="1"> Da </option>';
	global $xenon;
	$xenon= '<option value="9"> Faruri xenon </option>';
	$xenon.= '<option value="0"> Nu</option>';
	$xenon.= '<option value="1"> Da </option>';
	
}

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
	global $category;
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
	$_SESSION['category'] =$category;
	
}
 
function get_models($selMaker)
{
	global $conexiune;
	$category=$_SESSION['category'];
	//global $category;
	// Extrage modelele in functie de marca primita ca parametru
	$maker = mysqli_real_escape_string($conexiune,$selMaker);
	$sql = "SELECT `modelid`, `modelname` FROM `modele` WHERE `makeid` = '$maker' and `Type`='$category'";
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

if (!isset($_GET['categorii'])&&!isset($_GET['marci']) && !isset($_GET['modele']))
{
//echo "f1";
	// Prima data cand se intra pe pagina
	get_categories();
	$_SESSION['categories'] = $categories;
	$ok=0;
	if(isset($_SESSION['cauta']))
	 unset($_SESSION['cauta'] );
	// if(isset($_SESSION['div']))
	 //unset($_SESSION['div'] );
}

else if (isset($_GET['categorii'])&&!isset($_GET['marci']) && !isset($_GET['modele']))
{//echo "f2";
	//
	$categories = $_SESSION['categories'];
	$selCategory = $_GET['categorii'];
	$categories= change_selected($categories, $selCategory);
	get_makers($selCategory);
	$_SESSION['categories'] = $categories;
	$_SESSION['makers'] = $makers;
	$selMaker = "0";
	if(isset($_SESSION['cauta']))
	 unset($_SESSION['cauta'] );
	// if(isset($_SESSION['div']))
	// unset($_SESSION['div'] );
	$ok=0;
	//$stareListaModele = "disabled";
}

else if (isset($_GET['categorii'])&&isset($_GET['marci']) && !isset($_GET['modele'])&& $_GET['categorii'] !== $_GET['lastSelCategory']&&$_GET['categorii']!=0)
{//echo "f3";
	//
	$categories = $_SESSION['categories'];
	$selCategory = $_GET['categorii'];
	$categories= change_selected($categories, $selCategory);
	get_makers($selCategory);
	$_SESSION['categories'] = $categories;
	$_SESSION['makers'] = $makers;
	$selMaker=$_GET['marci'];
	if(isset($_SESSION['cauta']))
	 unset($_SESSION['cauta'] );
	// if(isset($_SESSION['div']))
	// unset($_SESSION['div'] );
	$ok=0;
}

else if (isset($_GET['categorii'])&&isset($_GET['marci']) && !isset($_GET['modele'])&& $_GET['marci'] !== $_GET['lastSelMaker'])
{//echo "f4";
	//
	$categories = $_SESSION['categories'];
	$makers = $_SESSION['makers'];
	$selMaker = $_GET['marci'];
	$selCategory = $_GET['categorii'];
	$makers= change_selected($makers, $selMaker);
	get_models($selMaker);
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
	$stareCauta = "submit";
	$_SESSION['cauta']='cauta';
	//if(isset($_SESSION['div']))
	// unset($_SESSION['div'] );
	$ok=0;
	
}

else if (isset($_GET['categorii'])&&isset($_GET['marci']) && isset($_GET['modele'])&& $_GET['categorii'] !== $_GET['lastSelCategory'])
{//echo "f5";
	//
	$categories = $_SESSION['categories'];
	$selCategory = $_GET['categorii'];
	$categories= change_selected($categories, $selCategory);
	get_makers($selCategory);
	$_SESSION['categories'] = $categories;
	$_SESSION['makers'] = $makers;
	$selMaker=$_GET['marci'];
	$ok=0;
	if(isset($_SESSION['cauta']))
	 unset($_SESSION['cauta'] );
	 //if(isset($_SESSION['div']))
	// unset($_SESSION['div'] );
}

else if (isset($_GET['categorii'])&&isset($_GET['marci']) && isset($_GET['modele'])&& $_GET['marci'] !== $_GET['lastSelMaker']&& $_GET['marci'] != 0)
{//echo "f6";
	//
	$categories = $_SESSION['categories'];
	$makers = $_SESSION['makers'];
	$selMaker = $_GET['marci'];
	$selCategory = $_GET['categorii'];
	$makers= change_selected($makers, $selMaker);
	get_models($selMaker);
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
	$stareCauta = "submit";
	$_SESSION['cauta']='cauta';
	//if(isset($_SESSION['div']))
	 //unset($_SESSION['div'] );
	$ok=0;
	
}

else if (isset($_GET['categorii'])&&(isset($_GET['marci'])) && $_GET['categorii'] == 0)
{//echo "f7";
	$categories = $_SESSION['categories'];
	$selCategory = $_GET['categorii'];
	$categories= change_selected($categories, $selCategory);
	$_SESSION['categories'] = $categories;
	$ok=0;
	if(isset($_SESSION['cauta']))
	 unset($_SESSION['cauta'] );
	// if(isset($_SESSION['div']))
	// unset($_SESSION['div'] );
}

else if (isset($_GET['categorii'])&&(isset($_GET['marci']) && isset($_GET['modele'])) && $_GET['marci'] == 0)
{//echo "f8";
	// Daca se alege prima optiune din lista marcilor se dezactiveaza lista de modele. Un fel de buton de restart.
	$categories = $_SESSION['categories'];
	$selCategory = $_GET['categorii'];
	$categories= change_selected($categories, $selCategory);
	get_makers($selCategory);
	$_SESSION['categories'] = $categories;
	$_SESSION['makers'] = $makers;
	$selMaker=$_GET['marci'];
	if(isset($_SESSION['cauta']))
	 unset($_SESSION['cauta'] );
	// if(isset($_SESSION['div']))
	// unset($_SESSION['div'] );
	$ok=0;
}

else if (isset($_GET['categorii'])&&(isset($_GET['marci']) && isset($_GET['modele'])) && $_GET['modele'] == 0)
{//echo "f9";
	// Daca este activa optiunea default din lista de modele.
	$categories = $_SESSION['categories'];
	$makers = $_SESSION['makers'];
	$selMaker = $_GET['marci'];
	$selCategory = $_GET['categorii'];
	$makers= change_selected($makers, $selMaker);
	get_models($selMaker);
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
	$stareCauta = "submit";
	$_SESSION['cauta']='cauta';
	//if(isset($_SESSION['div']))
	// unset($_SESSION['div'] );
	$ok=0;
}

else if($ok==1 && isset($_SESSION['cauta'])){
//echo "f10";
if(isset($_GET['modele'])&& $_GET['modele'] != 0){
set_filtre();
global $div;
$div=$_SESSION['div'];
$_SESSION['xenon']=$xenon;
$_SESSION['integrala']=$integrala;
$_SESSION['ESP']=$ESP;
$_SESSION['carlig']=$carlig;
$_SESSION['ABS']=$ABS;
$_SESSION['jante']=$jante;
$_SESSION['trapa']=$trapa;
$_SESSION['servo']=$servo;
$_SESSION['senzori']=$senzori;
$_SESSION['navigatie']=$navigatie;
$_SESSION['geamuriEl']=$geamuriEl;
$_SESSION['scauneInc']=$scauneInc;
$_SESSION['regulatorV']=$regulatorV;
$_SESSION['inchidere']=$inchidere;
$_SESSION['incalzire']=$incalzire;
$_SESSION['poluare']=$poluare;
$_SESSION['combustibil']=$combustibil;
$_SESSION['culori']=$culori;
$_SESSION['distributie']=$distributie;
$_SESSION['climatizare']=$climatizare;
$categories = $_SESSION['categories'];
$makers = $_SESSION['makers'];
$models = $_SESSION['models'];
$selCategory = $_GET['categorii'];
$selMaker = $_GET['marci'];
$selModel = $_GET['modele'];
$models = change_selected($models, $selModel);
$_SESSION['models'] = $models;

if(isset($_SESSION['cauta']))
	 unset($_SESSION['cauta'] );
}
/*else{
echo '<script language="javascript">';
echo 'alert("Pentru a cauta trebuie sa alegeti un model din lista de modele!")';
echo '</script>';
}
*/
$_SESSION['lastSelModel']=$_GET['modele'];
$stareCauta = "submit";
if(isset($_SESSION['cauta']))
	 unset($_SESSION['cauta'] );

}


else if($ok==1 && !isset($_SESSION['cauta'])&&$_GET['modele']!=$_GET['lastSelModel']){
$selCategory=$_GET['categorii'];
$selMaker=$_GET['marci'];
$selModel=$_GET['modele'];
$categories = $_SESSION['categories'];
$makers = $_SESSION['makers'];
$models = $_SESSION['models'];
$models = change_selected($models, $selModel);
$_SESSION['models']=$models;
$combustibil = $_SESSION['combustibil'];
$culori=$_SESSION['culori'];
$distributie=$_SESSION['distributie'];
$climatizare=$_SESSION['climatizare'];
$poluare=$_SESSION['poluare'];
$incalzire=$_SESSION['incalzire'];
$inchidere=$_SESSION['inchidere'];
$regulatorV=$_SESSION['regulatorV'];
$scauneInc=$_SESSION['scauneInc'];
$geamuriEl=$_SESSION['geamuriEl'];
$navigatie=$_SESSION['navigatie'];
$senzori=$_SESSION['senzori'];
$servo=$_SESSION['servo'];
$trapa=$_SESSION['trapa'];
$jante=$_SESSION['jante'];
$ABS=$_SESSION['ABS'];
$carlig=$_SESSION['carlig'];
$ESP=$_SESSION['ESP'];
$integrala=$_SESSION['integrala'];
$xenon=$_SESSION['xenon'];
//$_SESSION['cauta']='cauta';
$div=$_SESSION['div'];
$stareCauta="submit";
}

else
{//echo "f11";
	// Aici se ajunge cand s-a ales o marca si un model si se poate cauta in tabelul de anunturi.
	// Daca numarul de randuri este 0 inseamna ca nu exista nici un anunt care sa respecte cerintele selectate
	// si se va afisa un mesaj.
	if(isset($_SESSION['cauta']))
	 unset($_SESSION['cauta'] );
	if ((isset($_GET['marci'])))
	$selMaker = $_GET['marci'];
	if ((isset($_GET['modele'])))
	$selModel = $_GET['modele'];
	global $rezultate;
	if ((isset($_GET['categorii'])))
	$selCategory = $_GET['categorii'];
	if ((isset($_SESSION['categories'])))
	$categories = $_SESSION['categories'];
	if ((isset($_SESSION['makers'])))
	$makers = $_SESSION['makers'];
	if ((isset($_SESSION['models'])))
	$models = $_SESSION['models'];
	$categories = change_selected($categories, $selCategory);
	$makers = change_selected($makers, $selMaker);
	$models = change_selected($models, $selModel);
	$_SESSION['categories']=$categories;
	$_SESSION['makers'] = $makers;
	$_SESSION['models'] = $models;
	$culori = $_SESSION['culori'];
	//echo $_GET['culoare'];
	if ((isset($_GET['culoare']))){//&&!(isset($_SESSION['lastSelCuloare']))))//||((isset($_GET['culoare']))&&(isset($_SESSION['lastSelCuloare']))&&$_SESSION['lastSelCuloare']!=0)){
	//echo $_GET['culoare']."    ";
	
	$selCuloare = $_GET['culoare'];
	$culori = change_selected($culori, $selCuloare);
	$_SESSION['culori'] = $culori;
	//$_SESSION['lastSelCuloare']=$selCuloare;
	}
	if ((isset($_GET['combustibil']))){
	$combustibil = $_SESSION['combustibil'];
	$selCombustibil = $_GET['combustibil'];
	$combustibil = change_selected($combustibil, $selCombustibil);
	$_SESSION['combustibil'] = $combustibil;
	}
	
	if ((isset($_GET['distributie']))){
	$distributie = $_SESSION['distributie'];
	$selDistributie = $_GET['distributie'];
	$distributie = change_selected($distributie, $selDistributie);
	$_SESSION['distributie'] = $distributie;
	}
	
	if ((isset($_GET['climatizare']))){
	$climatizare = $_SESSION['climatizare'];
	$selClimatizare = $_GET['climatizare'];
	$climatizare = change_selected($climatizare, $selClimatizare);
	$_SESSION['climatizare'] = $climatizare;
	}
	if ((isset($_GET['poluare']))){
	$poluare = $_SESSION['poluare'];
	$selPoluare = $_GET['poluare'];
	$poluare = change_selected($poluare, $selPoluare);
	$_SESSION['poluare'] = $poluare;
	}
	if ((isset($_GET['incalzire']))){
	$incalzire = $_SESSION['incalzire'];
	$selIncalzire = $_GET['incalzire'];
	$incalzire = change_selected($incalzire, $selIncalzire);
	$_SESSION['incalzire'] = $incalzire;
	}
	if ((isset($_GET['inchidere']))){
	$inchidere = $_SESSION['inchidere'];
	$selInchidere = $_GET['inchidere'];
	$inchidere = change_selected($inchidere, $selInchidere);
	$_SESSION['inchidere'] = $inchidere;
	}
	if ((isset($_GET['regulatorV']))){
	$regulatorV = $_SESSION['regulatorV'];
	$selRegulatorV = $_GET['regulatorV'];
	$regulatorV = change_selected($regulatorV, $selRegulatorV);
	$_SESSION['regulatorV'] = $regulatorV;
	}
	if ((isset($_GET['scauneInc']))){
	$scauneInc = $_SESSION['scauneInc'];
	$selScauneInc = $_GET['scauneInc'];
	$scauneInc = change_selected($scauneInc, $selScauneInc);
	$_SESSION['scauneInc'] = $scauneInc;
	}
	if ((isset($_GET['geamuriEl']))){
	$geamuriEl = $_SESSION['geamuriEl'];
	$selGeamuriEl = $_GET['geamuriEl'];
	$geamuriEl = change_selected($geamuriEl, $selGeamuriEl);
	$_SESSION['geamuriEl'] = $geamuriEl;
	}
	if ((isset($_GET['navigatie']))){
	$navigatie = $_SESSION['navigatie'];
	$selNavigatie = $_GET['navigatie'];
	$navigatie = change_selected($navigatie, $selNavigatie);
	$_SESSION['navigatie'] = $navigatie;
	}
	if ((isset($_GET['senzori']))){
	$senzori = $_SESSION['senzori'];
	$selSenzori = $_GET['senzori'];
	$senzori = change_selected($senzori, $selSenzori);
	$_SESSION['senzori'] = $senzori;
	}
	if ((isset($_GET['servo']))){
	$servo = $_SESSION['servo'];
	$selServo = $_GET['servo'];
	$servo = change_selected($servo, $selServo);
	$_SESSION['servo'] = $servo;
	}
	if ((isset($_GET['trapa']))){
	$trapa = $_SESSION['trapa'];
	$selTrapa = $_GET['trapa'];
	$trapa = change_selected($trapa, $selTrapa);
	$_SESSION['trapa'] = $trapa;
	}
	if ((isset($_GET['jante']))){
	$jante = $_SESSION['jante'];
	$selJante = $_GET['jante'];
	$jante = change_selected($jante, $selJante);
	$_SESSION['jante'] = $jante;
	}
	if ((isset($_GET['ABS']))){
	$ABS= $_SESSION['ABS'];
	$selABS = $_GET['ABS'];
	$ABS = change_selected($ABS, $selABS);
	$_SESSION['ABS'] = $ABS;
	}
	if ((isset($_GET['carlig']))){
	$carlig= $_SESSION['carlig'];
	$selCarlig = $_GET['carlig'];
	$carlig = change_selected($carlig, $selCarlig);
	$_SESSION['carlig'] = $carlig;
	}
	if ((isset($_GET['ESP']))){
	$ESP= $_SESSION['ESP'];
	$selESP = $_GET['ESP'];
	$ESP = change_selected($ESP, $selESP);
	$_SESSION['ESP'] = $ESP;
	}
	if ((isset($_GET['integrala']))){
	$integrala= $_SESSION['integrala'];
	$selIntegrala = $_GET['integrala'];
	$integrala = change_selected($integrala, $selIntegrala);
	$_SESSION['integrala'] = $integrala;
	}
	if ((isset($_GET['xenon']))){
	$xenon= $_SESSION['xenon'];
	$selXenon = $_GET['xenon'];
	$xenon = change_selected($xenon, $selXenon);
	$_SESSION['xenon'] = $xenon;
	}
	
	$xenon= $_SESSION['xenon'];
	$integrala= $_SESSION['integrala'];
	$ESP = $_SESSION['ESP'];
	$carlig = $_SESSION['carlig'];
	$ABS = $_SESSION['ABS'];
	$jante = $_SESSION['jante'];
	$trapa = $_SESSION['trapa'];
	$servo = $_SESSION['servo'];
	$senzori = $_SESSION['senzori'];
	$navigatie = $_SESSION['navigatie'];
	$geamuriEl = $_SESSION['geamuriEl'];
	$scauneInc = $_SESSION['scauneInc'];
	$regulatorV = $_SESSION['regulatorV'];
	$inchidere = $_SESSION['inchidere'];
	$incalzire = $_SESSION['incalzire'];
	$poluare = $_SESSION['poluare'];
	$climatizare = $_SESSION['climatizare'];
	$distributie=$_SESSION['distributie'];
	$combustibil=$_SESSION['combustibil'];
	$culori=$_SESSION['culori'];
	//$_SESSION['combustibil']=$combustibil;
	
	
	$selXenon = mysqli_real_escape_string($conexiune,$selXenon);
	$selIntegrala = mysqli_real_escape_string($conexiune,$selIntegrala);
	$selESP = mysqli_real_escape_string($conexiune,$selESP);
	$selCarlig = mysqli_real_escape_string($conexiune,$selCarlig);
	$selABS = mysqli_real_escape_string($conexiune,$selABS);
	$selJante = mysqli_real_escape_string($conexiune,$selJante);
	$selTrapa = mysqli_real_escape_string($conexiune,$selTrapa);
	$selServo = mysqli_real_escape_string($conexiune,$selServo);
	$selSenzori = mysqli_real_escape_string($conexiune,$selSenzori);
	$selNavigatie = mysqli_real_escape_string($conexiune,$selNavigatie);
	$selGeamuriEl = mysqli_real_escape_string($conexiune,$selGeamuriEl);
	$selScauneInc = mysqli_real_escape_string($conexiune,$selScauneInc);
	$selRegulatorV = mysqli_real_escape_string($conexiune,$selRegulatorV);
	$selInchidere = mysqli_real_escape_string($conexiune,$selInchidere);
	$selIncalzire = mysqli_real_escape_string($conexiune,$selIncalzire);
	$selPoluare = mysqli_real_escape_string($conexiune,$selPoluare);
	$selClimatizare = mysqli_real_escape_string($conexiune,$selClimatizare);
	$selCategory = mysqli_real_escape_string($conexiune,$selCategory);
	$selMaker = mysqli_real_escape_string($conexiune,$selMaker);
	$selModel = mysqli_real_escape_string($conexiune,$selModel);
	$selCombustibil = mysqli_real_escape_string($conexiune,$selCombustibil);
	$selCuloare = mysqli_real_escape_string($conexiune,$selCuloare);
	$selDistributie = mysqli_real_escape_string($conexiune,$selDistributie);
	$_SESSION['selMaker']=$selMaker;
	$_SESSION['selModel']=$selModel;
	
	$sql = "SELECT `emisii`.`EuroName`,`Producator`,`ModelName`,`produse`.`idanunt`, `pozaid`, `kilometraj`, DATE_FORMAT(`datafabricatie`,'%d-%m-%Y' )`datafabricatie`,`pret`, `caiputere`, `capacitate`, `clasaeuro`, `culoare` ,`combustibil`, `distributie`, `climatizare`,`SIA`,`IC`,`RV`,`SIE`,`GE`,`Nav`,`SP`,`Servo`,`TD`,`JA`,`Carlig`,`ABS`,`ESP`,`Integrala`,`Xenon` FROM `emisii`,`pozeanunturi`, `produse`,`modele`,`marci` WHERE `produse`.`ClasaEuro`=`emisii`.`EcoId` and `Categorie`='$selCategory' and`produse`.`ModelId`=`modele`.`ModelId` and `produse`.`MakeId`=`marci`.`MakeId` and `pozeanunturi`.`IdAnunt` = `produse`.`IdAnunt` AND `produse`.`MakeId`='$selMaker'";
	// Daca nu s-a ales optiunea Toate
	if ($selModel != 9999)
		$sql .= " AND `produse`.`ModelId` = '$selModel'";
	if ($selCombustibil != 99)
	$sql .= " AND `produse`.`Combustibil` = '$selCombustibil'";
	if ($selDistributie != 99)
	$sql .= " AND `produse`.`Distributie` = '$selDistributie'";
	if ($selCuloare != 99)
	$sql .= " AND `produse`.`Culoare` = '$selCuloare'";
	//echo $selClimatizare;
	if ($selClimatizare != 99)
	$sql .= " AND `produse`.`Climatizare` = '$selClimatizare'";
	if ($selPoluare != 99)
	$sql .= " AND `produse`.`clasaeuro` = '$selPoluare'";
	if ($selIncalzire != 9)
	$sql .= " AND `produse`.`SIA` = '$selIncalzire'";
	if ($selInchidere != 9)
	$sql .= " AND `produse`.`IC` = '$selInchidere'";
	if ($selRegulatorV != 9)
	$sql .= " AND `produse`.`RV` = '$selRegulatorV'";
	if ($selScauneInc != 9)
	$sql .= " AND `produse`.`SIE` = '$selScauneInc'";
	if ($selGeamuriEl != 9)
	$sql .= " AND `produse`.`GE` = '$selGeamuriEl'";
	if ($selNavigatie != 9)
	$sql .= " AND `produse`.`Nav` = '$selNavigatie'";
	if ($selSenzori != 9)
	$sql .= " AND `produse`.`SP` = '$selSenzori'";
	if ($selServo != 9)
	$sql .= " AND `produse`.`Servo` = '$selServo'";
	if ($selTrapa != 9)
	$sql .= " AND `produse`.`TD` = '$selTrapa'";
	if ($selJante != 9)
	$sql .= " AND `produse`.`JA` = '$selJante'";
	if ($selABS != 9)
	$sql .= " AND `produse`.`ABS` = '$selABS'";
	if ($selCarlig != 9)
	$sql .= " AND `produse`.`Carlig` = '$selCarlig'";
	if ($selESP != 9)
	$sql .= " AND `produse`.`ESP` = '$selESP'";
	if ($selIntegrala != 9)
	$sql .= " AND `produse`.`Integrala` = '$selIntegrala'";
	if ($selXenon != 9)
	$sql .= " AND `produse`.`Xenon` = '$selXenon'";
	/*$mic=$_GET['mic'];
	$mare=$_GET['mare'];
	if($mic!="")
	$sql .=" AND `pret` BETWEEN '$mic.' AND '$mare.'";
	*/
	$sql .=" ORDER by Promovare ASC";
	$result = mysqli_query($conexiune,$sql);
	if (mysqli_num_rows($result) === 0)
		$rezultate = "<tr><td>Ne pare rau, nu a fost gasit niciun anunt dupa criteriile de cautare selectate!</td></tr>";
	else
	{$rezultate .= "<tr><td height='150' colspan='13'></td></tr>";
	if($selCategory==1){
		while ($row = mysqli_fetch_array($result))
		{
			$rezultate .= "<tr align = 'center'><th style = 'width:230' height='40' >". $row['Producator'] ." " . $row['ModelName'] . "</th><th>Culoare</th><td></td><th style>Data fabricației</th><td></td><th>Combustibil</th><td></td><th>Cai Putere</th><td width='1'></td></td><td></td><td><th align = 'center'>Kilometraj</th></tr>";
			$rezultate .= "<tr align = 'center'><td rowspan='3' align='left'><img  src = " . '"getImage.php?id=' . $row['pozaid'] . "\" width = '250' height = '225'></td> <td height = '60' >";
			$sql = "SELECT `culoare` FROM `culori` WHERE `colorid` = '" . $row['culoare'] . "'";
			$col = mysqli_query($conexiune,$sql);
			$col = mysqli_fetch_array($col);
			$rezultate .= "" . $col['culoare'] . "</td><td></td><td>" . $row['datafabricatie'] . "</td><td></td><td>";
			$rezultate .= get_combustibil($row['combustibil']);
			$rezultate .= "<td></td><td>"  . $row['caiputere'] . " </td><td></td></td><td></td><td><td>"  . $row['kilometraj'] . " </td><tr align = 'center'><th align = 'center' height='30'>Aer condiționat</th><td></td><th>Transmisie</th><td></td><th style>Capacitate cilindrică</th><td></td><th>Normă poluare</th><td></td><td></td><td></td><th >Preț(€)</th></tr><tr>";
			$rezultate .= "<td height = '60' align='center'>".get_climatizare($row['climatizare'])."</td><td></td><td td align='center'>";
			$rezultate .= "".get_distributie($row['distributie'])."</td><td></td><td align='center'>" . $row['capacitate'] ." cm³</td><td></td>";
			$rezultate .= "<td align='center'>".$row['EuroName']. "</td><td></td><td>";
			$rezultate .= "<td></td> <td align='center'>" . $row['pret'] . " </td>";
			$rezultate .="<td border = '0'><form action='detalii1.php' method=GET><input type='hidden' name = 'idAnunt' value='" . $row['idanunt'] . "'><input type=submit name='detalii' value='Detalii' /></form></td></tr><tr><td height='20' colspan='13'></td></tr>";
		}
	}
	elseif($selCategory==2){
		while ($row = mysqli_fetch_array($result))
			{
			$rezultate .= "<tr align = 'center'><th style = 'width:230' height='40' >". $row['Producator'] ." " . $row['ModelName'] . "</th><th>Culoare</th><td></td><th style>Data fabricației</th><td></td><th>Combustibil</th><td></td><th>Cai Putere</th><td width='1'></td></td><td></td><td><th align = 'center'>Kilometraj</th></tr>";
			$rezultate .= "<tr align = 'center'><td rowspan='3' align='left'><img  src = " . '"getImage.php?id=' . $row['pozaid'] . "\" width = '250' height = '225'></td> <td height = '60' >";
			$sql = "SELECT `culoare` FROM `culori` WHERE `colorid` = '" . $row['culoare'] . "'";
			$col = mysqli_query($conexiune,$sql);
			$col = mysqli_fetch_array($col);
			$rezultate .= "" . $col['culoare'] . "</td><td></td><td>" . $row['datafabricatie'] . "</td><td></td><td>";
			$rezultate .= get_combustibil($row['combustibil']);
			$rezultate .= "<td></td><td>"  . $row['caiputere'] . " </td><td></td></td><td></td><td><td>"  . $row['kilometraj'] . " </td><tr align = 'center'><th align = 'center' height='30'>Regulator de viteză</th><td></td><th>ABS</th><td></td><th style>Capacitate cilindrică</th><td></td><th>Normă poluare</th><td></td><td></td><td></td><th >Pret(€)</th></tr><tr>";
			$rezultate .= "<td height = '60' align='center'>".get_bit_fields($row['RV'])."</td><td></td><td td align='center'>";
			$rezultate .= "".get_bit_fields($row['ABS'])."</td><td></td><td align='center'>" . $row['capacitate'] ." cm³</td><td></td>";
			$rezultate .= "<td align='center'>".$row['EuroName']. "</td><td></td><td>";
			$rezultate .= "<td></td> <td align='center'>" . $row['pret'] . " </td>";
			$rezultate .="<td border = '0'><form action='detalii2.php' method=GET><input type='hidden' name = 'idAnunt' value='" . $row['idanunt'] . "'><input type=submit name='detalii2' value='Detalii' /></form></td></tr><tr><td height='20' colspan='13'></td></tr>";
			}
	}
	elseif($selCategory==3){
		while ($row = mysqli_fetch_array($result))
			{
			$rezultate .= "<tr align = 'center'><th style = 'width:230' height='40' >". $row['Producator'] ." " . $row['ModelName'] . "</th><th>Culoare</th><td></td><th style>Data fabricației</th><td></td><th>Combustibil</th><td></td><th>Cai Putere</th><td width='1'></td></td><td></td><td><th align = 'center'>Kilometraj</th></tr>";
			$rezultate .= "<tr align = 'center'><td rowspan='3' align='left'><img  src = " . '"getImage.php?id=' . $row['pozaid'] . "\" width = '250' height = '225'></td> <td height = '60' >";
			$sql = "SELECT `culoare` FROM `culori` WHERE `colorid` = '" . $row['culoare'] . "'";
			$col = mysqli_query($conexiune,$sql);
			$col = mysqli_fetch_array($col);
			$rezultate .= "" . $col['culoare'] . "</td><td></td><td>" . $row['datafabricatie'] . "</td><td></td><td>";
			$rezultate .= get_combustibil($row['combustibil']);
			$rezultate .= "<td></td><td>"  . $row['caiputere'] . " </td><td></td></td><td></td><td><td>"  . $row['kilometraj'] . " </td><tr align = 'center'><th align = 'center' height='30'>Cârlig de remorcare</th><td></td><th>Tracțiune integrală</th><td></td><th style>Capacitate cilindrică</th><td></td><th>Normă poluare</th><td></td><td></td><td></td><th >Pret(€)</th></tr><tr>";
			$rezultate .= "<td height = '60' align='center'>".get_bit_fields($row['Carlig'])."</td><td></td><td td align='center'>";
			$rezultate .= "".get_bit_fields($row['Integrala'])."</td><td></td><td align='center'>" . $row['capacitate'] ." cm³</td><td></td>";
			$rezultate .= "<td align='center'>".$row['EuroName']. "</td><td></td><td>";
			$rezultate .= "<td></td> <td align='center'>" . $row['pret'] . " </td>";
			$rezultate .="<td border = '0'><form action='detalii3.php' method=GET><input type='hidden' name = 'idAnunt' value='" . $row['idanunt'] . "'><input type=submit name='detalii3' value='Detalii' /></form></td></tr><tr><td height='20' colspan='13'></td></tr>";
			}
	}
	}
	$stareCauta = "submit";
	$div=$_SESSION['div'];
	
}
?>
<!DOCTYPE html> 
<html>
<head>
<style type="text/css"> 

#categorii
{
	position: relative;
    top: 10px;
	
}

#lista_marci
{
	position: relative;
    top: 90px;
	
}
#lista_modele
{
	position: relative;
    top: 130px;
	
}

#culoare
{
	position: fixed;
    top: 18px;
	left:350px;
}
#combustibil
{
	position: fixed;
    top: 70px;
	left:350px;
}
#distributie
{
	position: fixed;
    top: 122px;
	left:350px;
}
#climatizare
{
	position: fixed;
    top: 174px;
	left:350px;
}
#poluare
{
	position: fixed;
    top: 18px;
	left:520px;
}
#pret
{
	position: fixed;
    top: 51px;
	left:520px;
}
#incalzire
{
	position: fixed;
    top: 70px;
	left:520px;
}
#inchidere
{
	position: fixed;
    top: 122px;
	left:520px;
}
#regulatorV
{
	position: fixed;
    top: 174px;
	left:520px;
}
#scauneInc
{
	position: fixed;
    top: 18px;
	left:690px;
}
#geamuriEl
{
	position: fixed;
    top: 70px;
	left:690px;
}
#navigatie
{
	position: fixed;
    top: 122px;
	left:690px;
}
#senzori
{
	position: fixed;
    top: 174px;
	left:690px;
}
#servo
{
	position: fixed;
    top: 18px;
	left:860px;
}
#trapa
{
	position: fixed;
    top: 70px;
	left:860px;
}
#jante
{
	position: fixed;
    top: 122px;
	left:860px;
}
#ABS
{
	position: fixed;
    top: 174px;
	left:860px;
}
#carlig
{
	position: fixed;
    top: 18px;
	left:1030px;
}
#ESP
{
	position: fixed;
    top: 70px;
	left:1030px;
}
#integrala
{
	position: fixed;
    top: 122px;
	left:1030px;
}
#xenon
{
	position: fixed;
    top: 174px;
	left:1030px;
}


#input1
{
	width:70px;
}
#input2
{
	width:70px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<form name="autoturisme" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get" >
	<div id="categorii">
		<select name="categorii" onchange = "this.form.submit();">
			<?php  echo $categories; ?>
		</select>
	</div>
	<div id="lista_marci">
		<select name="marci" <?php echo $stareListaMarci ?> onchange = "this.form.submit();">
			<?php  echo $makers; ?>
		</select>
	</div>
	<div id = "lista_modele">
		<select name = "modele" <?php echo $stareListaModele ?> onchange = "this.form.submit();">
			<?php echo $models; ?>
		</select>
	</div>
	<div id = "culoare">
		<select name = "culoare" >
			<?php echo $culori; ?>
		</select>
	</div>
	<div id = "combustibil">
		<select name = "combustibil" >
			<?php echo $combustibil; ?>
		</select>
	</div>
	<div id = "distributie">
		<select name = "distributie" >
			<?php echo $distributie; ?>
		</select>
	</div>
	<div id = "climatizare">
		<select name = "climatizare" >
			<?php echo $climatizare; ?>
		</select>
	</div>
	<div id = "poluare">
		<select name = "poluare" >
			<?php echo $poluare; ?>
		</select>
	</div>
	<div id = "incalzire">
		<select name = "incalzire" >
			<?php echo $incalzire; ?>
		</select>
	</div>
	<div id = "inchidere">
		<select name = "inchidere" >
			<?php echo $inchidere; ?>
		</select>
	</div>
	<div id = "regulatorV">
		<select name = "regulatorV" >
			<?php echo $regulatorV; ?>
		</select>
	</div>
	<div id = "scauneInc">
		<select name = "scauneInc" >
			<?php echo $scauneInc; ?>
		</select>
	</div>
	<div id = "geamuriEl">
		<select name = "geamuriEl" >
			<?php echo $geamuriEl; ?>
		</select>
	</div>
	<div id = "navigatie">
		<select name = "navigatie" >
			<?php echo $navigatie; ?>
		</select>
	</div>
	<div id = "senzori">
		<select name = "senzori" >
			<?php echo $senzori; ?>
		</select>
	</div>
	<div id = "servo">
		<select name = "servo" >
			<?php echo $servo; ?>
		</select>
	</div>
	<div id = "trapa">
		<select name = "trapa" >
			<?php echo $trapa; ?>
		</select>
	</div>
	<div id = "jante">
		<select name = "jante" >
			<?php echo $jante; ?>
		</select>
	</div>
	<div id = "ABS">
		<select name = "ABS" >
			<?php echo $ABS; ?>
		</select>
	</div>
	<div id = "carlig">
		<select name = "carlig" >
			<?php echo $carlig; ?>
		</select>
	</div>
	<div id = "ESP">
		<select name = "ESP" >
			<?php echo $ESP; ?>
		</select>
	</div>
	<div id = "integrala">
		<select name = "integrala" >
			<?php echo $integrala; ?>
		</select>
	</div>
	<div id = "xenon">
		<select name = "xenon" >
			<?php echo $xenon; ?>
		</select>
	</div>
	
	
	
	
	<?php //echo $div; ?>
	<!div id="pret">
	<!input type="number" name="mic" id="input1"> <!input type="number" name="mare" id="input1">
	 <!div>
	<!/div>
	<!/div>
	<input type = "hidden" name = "lastSelCategory" value = "<?php echo $selCategory; ?>">
	<input type = "hidden" name = "lastSelMaker" value = "<?php echo $selMaker; ?>">
	<input type = "hidden" name = "lastSelModel" value = "<?php echo $selModel; ?>">
	<input type="<?php echo $stareCauta; ?>" name="cauta" value="Cauta">
</form>
<div id = "rezultate">
	<table style = "width:100%" >
		<?php echo $rezultate ?>
	</table>
</div>

</body>
</html>