<?php
	require_once "conexiune.php";
	if (!isset($_SESSION))
	{
		session_start();
	}
	if (empty($_SESSION["login"]))
	{
		header("location:index.php");
		exit;
	}
	$pagCurenta = basename(__FILE__, '.php');
	$query = "SELECT * FROM `categorie` order by `type` asc";
	$sql = mysqli_query($conexiune, $query);
	$categorii = '<option value = 0> Selectati </option>';
	while ($row = mysqli_fetch_array($sql))
		$categorii .= '<option value = ' . $row["Type"] . '>' . $row["CatName"] . '</option>';
	$query = "SELECT * FROM `culori`";
	$sql = mysqli_query($conexiune, $query);
	$culori = '<option value = 0> Selectati </option>';
	while ($row = mysqli_fetch_array($sql))
		$culori .= "<option value = " . $row['ColorId'] . ">" . $row['Culoare'] . "</option>";
	$query = "SELECT * FROM `emisii`";
	$sql = mysqli_query($conexiune, $query);
	$clasaEuro = "<option value = 0> Selectati </option>";
	while ($row = mysqli_fetch_array($sql))
		$clasaEuro .= "<option value = " . $row['EcoId'] . ">" . $row['EuroName'] . "</option>";
	$query = "SELECT `sold` FROM `profiles`, `utilizatori` WHERE `profiles`.`profileid` = `utilizatori`.`userid` AND `profileid` = '" . $_SESSION['userID'] ."' AND `username` = '" . $_SESSION['login'] ."'";
	$sql = mysqli_query($conexiune, $query);
	if ($sql !== false && mysqli_num_rows($sql) === 1)
	{
		 $row = mysqli_fetch_array($sql);
		 $sold = $row['sold'];
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" type = "text/css" href = "styles/meniu.css">
<link rel = "stylesheet" type = "text/css" href = "styles/fundal.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script>
$(document).ready(function()
{
	var filesize = 0;
	// Cand se schimba categoria
	$("#categorie").on("change", function()
	{
		if ($(this).val() !== "0")
		{
			$.getJSON("getMakers.php", {tip: $(this).val()}, function(rez)
			{
				var options = "<option value = 0>Selectati</option>\n";
				for (var i = 0;i < rez.length;i++)
				{
					options += "<option value = " + rez[i].id + ">" + rez[i].maker + "</option>\n";
				}
				$("#marca").html(options);
			});
			if ($(this).val() === "1")
			{
				$("#divDistributie").css("display", "inline-block");
				$("#divDistributie").prop("disabled", false);
				$("#divNrLocuri").css("display", "inline-block");
				$("#divMMA").css("display", "inline-block");
				$("#dotari").css("display", "block");
				var options = "<option value = 1>Manuala</option><option value = 2>Secventiala</option><option value = 3>Automata</option>";
				$("#distributie").html(options);
				options = "<option value = 0>Selectati</option><option value = 1>Benzina</option><option value = 2>Motorina</option><option value = 3>Hibrid</option><option value = 4>Electric</option>";
				$("#combustibil").html(options);
			}
			else 
			{
				$("#divDistributie").css("display", "none");
				$("#distributie").prop("disabled", true);
				$("#divNrLocuri").css("display", "none");
				$("#divMMA").css("display", "none");
				$("#dotari").css("display", "none");
				options = "<option value = 0>Selectati</option><option value = 1>Benzina</option><option value = 2>Motorina</option><option value = 4>Electric</option>";
				$("#combustibil").html(options);
			}
			$("#marcaModel").prop("disabled", false);
			$("#dateVehicul").prop("disabled", false);
			$("#VIN").prop("disabled", false);
			$("#infoGen").prop("disabled", false);
			$("#dotari").prop("disabled", false);
			$("#descriere").prop("disabled", false);
			$("#poza").prop("disabled", false);
			$("#pret").prop("disabled", false);
			$("#promovare").prop("disabled", false);
			$("#submit").prop("disabled", false);
		}
		else
		{
			$("#marcaModel").prop("disabled", true);
			$("#dateVehicul").prop("disabled", true);
			$("#VIN").prop("disabled", true);
			$("#infoGen").prop("disabled", true);
			$("#dotari").prop("disabled", true);
			$("#descriere").prop("disabled", true);
			$("#poza").prop("disabled", true);
			$("#pret").prop("disabled", true);
			$("#promovare").prop("disabled", true);
			$("#submit").prop("disabled", true);
			$("#marca").html("<option value = 0>Selectati</option>");
			$("#model").html("<option value = 0>Selectati</option>");
			$("#combustibil").html("<option value = 0>Selectati</option>");
			$("#distributie").html("<option value = 0>Selectati</option>");
		}
	});
	// Cand se schimba modelul
	$("#marca").on("change", function()
	{
		if ($(this).val() !== "0")
		{
			$.getJSON("getModels.php", {marca: $(this).val(), tip:$("#categorie").val()}, function(rez)
			{
				var options = "<option value = 0>Selectati</option>";
				for (var i = 0;i < rez.length;i++)
				{
					options += "<option value = " + rez[i].id + ">" + rez[i].model + "</option>";
				}
				$("#model").html(options);
			});
		}
		else
		{
			$("#model").html("<option value = 0>Selectati</option>");
		}
	});
	// Actualizare caractere ramase din descriere
	$("#descriere").keyup(function()
	{
		$("#charRamase").val(1024 - parseInt($(this).val().length));
	});
	// Adaugare metoda de validare a select-urilor
	$.validator.addMethod("selectNotDefault", function(value, element, arg)
	{
		return arg !== value;
	});
	// Verificare dimensiune poza
	$("#poza").on("change", function()
	{
		$("#resetPoza").prop("disabled", false);
		filesize = this.files[0].size;
		if (filesize > 6291456)
		{
			alert("Imaginea selectata pentru upload este mai mare ca 6MB!. Pana nu veti adauga o poza mai mica nu veti putea posta anuntul!");
			$("#submit").prop("disabled", true);
		}
		else $("#submit").prop("disabled", false);
	});
	// Sterge poza
	$("#resetPoza").click(function()
	{
		$("#poza").wrap("<form>").parent('form').trigger('reset');
		$("#poza").unwrap();
		$("#resetPoza").prop("disabled", true);
		$("#submit").prop("disabled", false);
	});
	// Validare formular
	$("#anunt").validate(
	{
		//Reguli de validare
		rules:
		{
			categorie: {selectNotDefault: "0"},
			marca: {selectNotDefault: "0"},
			model: {selectNotDefault: "0"},
			fabricatie: 
			{
				required: true,
				dateISO: true
			},
			combustibil: {selectNotDefault: "0"},
			culoare: {selectNotDefault: "0"},
			capacitate:
			{
				required: true,
				digits: true
			},
			rulaj:
			{
				required: true,
				digits: true,
				min: 0
			},
			clasaEuro: {selectNotDefault: "0"},
			emisii:
			{
				required: true,
				digits: true
			},
			pret: 
			{
				required: true,
				digits: true,
				min: 1
			}
		},
		//Schimbare clase CSS de evidentiere a casutelor ce sunt gresite/valide
		errorClass: "inputError",
		validClass: "inputValid",// Nu se foloseste
		invalidHandler:function(e, validator)
		{
			//Afiseaza numarul de erori
			var errors = validator.numberOfInvalids();
			if (errors > 0)
				$("#sumarErori").text(errors + " camp(uri) sunt invalide!");
			else $("#sumarErori").text("");
		},
		errorPlacement: function(error, element){},// Supraincarcarea functiei de plasare a mesajelor de eroare pt a nu le afisa
		highlight: function(element, errorClass)// Subliniere casute gresite
		{
			$(element).addClass(errorClass);
		},
		unhighlight: function(element, errorClass)// Revenire la stilul normal daca casuta este valida
		{
			$(element).removeClass(errorClass);
		},
		// Daca totul e in regula se trimit datele
		submitHandler: function(form)
		{
			var r = confirm("Sigur doriti sa postati anuntul?\nDupa ce anuntul va fi postat nu veti mai putea face modificari.");
			if (r === true)
			{
				$("timbruMediu").val();// Adauga taxa de mediu intre parantezele lui val
				request = $.ajax(
				{
					url: "checkAnunt.php",
					type: "POST",
					data: new FormData($("#anunt")[0]),
					processData: false,
					contentType:false
				});
				$("#anunt :input").prop("disabled", true);
				request.done(function(response, textStatus, jqXHR)
				{
					console.log(response);
					if (response.returnType === "succes")
					{
						alert("Anuntul dvs. a fost adaugat cu succes!\nVe-ti fi redirectionat cate pagina principala dupa ce apasati Ok.");
						window.location.replace("index.php");
					}
					else
					{
						var rasp = $.map(response, function(el){return el;});
						var n = response.errNum;
						var errSys = false;
						var alertStr = "Au aparut urmatoarele erori:\n";
						for (var i = 0;i < n;i++)
						{
							if (rasp[2 + i] !== "Eroare la inserarea in tabel!" || rasp[2 + i] !== "Poza aleasa nu a putut fii uploadata!" || rasp[2 + i] !== "Poza default nu a putut fii uploadata!" || rasp[2 + i] !== "Datele nu au fost trimise cum trebuie!")
								alertStr += rasp[2 + i] + "\n";
							else
							{
								console.log(rasp[2 + i]);
								errSys = true;
							}
						}
						if (!errSys)
						{
							alertStr += "\n Va trebui sa remediati problemele daca doriti sa va postati anuntul!";
							alert(alertStr);
						}
						else alert("S-a produs o eroare la salvarea anuntului!\nVa rugam sa asteptati cateva minute iar apoi sa incercati din nou. Daca problemele persista va rugam sa ne contactati folosind datele de contact de pe pagina About.");
					}
				});
				request.fail(function(jqXHR, textStatus, errorThrown)
				{
					console.error("Eroare: " + textStatus, errorThrown);
					alert("S-a produs o eroare!\nVa rugam sa asteptati cateva minute iar apoi sa incercati din nou. Daca problemele persista va rugam sa ne contactati folosind datele de contact de pe pagina About.");
				});
				$("#anunt :input").prop("disabled", false);
			}
		}
	});
});
</script>
<style type = "text/css">
.inputError
{
	border: 3px solid #c24949;
	border-radius: 5px;
	background: #ffbcbc;
}
.required
{
	font-weight: bold;
}
.autoCalc
{
	//text-decoration: underline;
	color: #0033CC;
}
fieldset
{
	border-color: black; 
	border-radius: 5px;
}
</style>
<title>Adauga anunt</title>
</head>

<body>
<div class = "header">
<?php include "meniu.php" ?>
</div>
<div class = "container">
	<div id="content" class = "pane">
		<p>
			Campurile ingrosate si marcate cu * sunt obligatorii!<br>
			Câmpurile de culoare albastra sunt necesare pentru calcularea automată a timbrului de mediu!
		</p>
		<span id = "sumarErori" class = "error"></span>
		<form id = "anunt" name = "anunt" action = "checkAnunt.php" method = "POST" style = "padding-bottom: 20px">
			<!-- Categorii -->
			<div style = "display: block;padding-top: 10px;padding-bottom: 10px">
				<label for = "categorie" class = "required">Categoria anuntului*</label><br>
				<select id = "categorie" name = "categorie" >
					<?php echo $categorii ?>
				</select>
			</div>
			<!-- End Categorii -->
			<!-- Marca si model -->
			<fieldset id = "marcaModel" disabled>
				<legend>Marca si modelul</legend>
					<div style = "display: inline-block;padding-right: 20px">
						<label for = "marca" class = "required">Marca*</label><br>
						<select id = "marca"  name = "marca"  style = "width: 150px">
							<option value = 0>Selectati</option>
						</select>
					</div>
					<div style = "display: inline-block;padding-right: 20px;">
						<label for = "model" class = "required">Modelul*</label><br>
						<select id = "model" name = "model"  style = "width: 150px">
							<option value = 0>Selectati</option>
						</select>
					</div>
			</fieldset>
			<!-- End Marca si model -->
			<!-- Date vehicul -->
			<fieldset id = "dateVehicul" style = "text-align: center;" disabled>
				<legend>Date vehicul</legend>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<label for = "fabricatie" class = "required autoCalc">Anul fabricarii(format AAAA-LL-ZZ)*</label><br>
					<input type = "text" maxlength = "10" size = "10" id = "fabricatie" name = "fabricatie" >
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<label for = "combustibil" class = "required autoCalc">Combustibil*</label><br>
					<select id = "combustibil" name = "combustibil" >
						<option value = 0>Selectati</option>
					</select>
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<label for = "culoare" class = "required">Culoare*</label><br>
					<select id = "culoare" name = "culoare" >
						<?php echo $culori; ?>
					</select>
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<label for = "capacitate" class = "required autoCalc">Cap. cilindrica(cm<sup>3</sup>)*</label><br>
					<input type = "text" id = "capacitate" name = "capacitate">
				</div>
				<div style = "display: inline-block;text-align: left;padding-right: 20px;padding-bottom: 5px;">
					<label for = "putere">Putere <b><u title = "Valoarea va fi automat recalculata in kW sau CP.">?</u></b></label><br>
					<input type = "text" id = "putere" name = "putere" maxlength = "4" size = "4">
					<input type = "radio" id = "putereKW" name = "tipPutere" value = "kW" checked>kW
					<input type = "radio" id = "putereCP" name = "tipPutere" value = "CP">CP
				</div>
				<div id = "divDistributie" style = "display: none;padding-right: 20px;padding-bottom: 5px;">
					<label for = "distributie">Distributie</label><br>
					<select id = "distributie" name = "distributie">
						<option value = 0>Selectati</option>
					</select>
				</div>
				<div id = "divMMA" style = "display: none;padding-right: 20px;">
					<label for = "MMA">Masa maxima admisa(t)</label><br>
					<input type = "text" id = "MMA" name = "MMA" maxlength = "4" size = "4">
				</div>
				<div id = "divNrLocuri" style = "display: none;padding-right: 20px;">
					<label for = "nrLocuri">Numar locuri</label><br>
					<input type = "text" id = "nrLocuri" name = "nrLocuri" maxlength = "1" size = "2">
				</div>
			</fieldset>
			<!-- End Date vehicul -->
			<!-- VIN -->
			<div style = "display: block;padding-top: 10px;padding-bottom: 10px">
				<label for = "VIN">VIN</label><br>
				<input type = "text" id = "VIN" name = "VIN" maxlength = "17" size = "18" disabled>
				<p>Campul VIN/seria de sasiu poate fi gasit in talonul masinii (campul E in talonul nou sau campul 3 in talonul vechi). El este format dintr-un sir de 17 caractere, primele 3 sunt litere iar restul sunt cifre.</p>
				<p>Prin furnizarea codului VIN/seria de sasiu, credibilitatea anuntului va creste si vanzarea autovehiculului se va face mai repede.</p>
			</div>
			<!-- End VIN -->
			<!-- Info Gen -->
			<fieldset id = "infoGen" disabled>
				<legend>Informatii despre starea generala si exploatarea vehiculului</legend>
				<div style = "display: inline-block;padding-right: 20px;">
					<label for = "rulaj" class = "required">Rulaj*</label><br>
					<input type = "text" id = "rulaj" name = "rulaj" >
				</div>
				<div style = "display: inline-block;padding-right: 20px;">
					<label for = "clasaEuro" class = "required autoCalc">Norma Euro*</label><br>
					<select id = "clasaEuro" name = "clasaEuro" >
						<?php echo $clasaEuro; ?>
					</select>
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<label for = "emisii" class = "required autoCalc">Emisii CO<sub>2</sub>/l*</label><br>
					<input type = "text" id = "emisii" name = "emisii">
				</div>
			</fieldset>
			<!-- End Info Gen -->
			<!-- Dotari -->
			<fieldset id = "dotari" disabled style = "display: none;">
				<legend>Dotari</legend>
				<div style = "display: block;padding-right: 20px;padding-bottom: 5px;">
					<label for = "climatizare">Climatizare</label><br>
					<select id = "climatizare" name = "climatizare">
						<option value = 0>Fara AC</option>
						<option value = 1>AC manual</option>
						<option value = 2>AC automat</option>
					</select>
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<input type = "checkbox" id = "sia" name = "sia">Sistem de incalzire auxiliar<br>
					<input type = "checkbox" id = "ic" name = "ic">Inchidere centralizata<br>
					<input type = "checkbox" id = "rv" name = "rv">Regulator de viteza<br>
					<input type = "checkbox" id = "sie" name = "sie">Scaune incalzite electric<br>
					<input type = "checkbox" id = "ge" name = "ge">Geamuri electrice<br>
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<input type = "checkbox" id = "nav" name = "nav">Sistem de navigatie<br>
					<input type = "checkbox" id = "sp" name = "sp">Senzori de parcare<br>
					<input type = "checkbox" id = "servo" name = "servo">Servo directie<br>
					<input type = "checkbox" id = "td" name = "td">Trapa decapotabila<br>
					<input type = "checkbox" id = "ja" name = "ja">Jante de aliaj<br>
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<input type = "checkbox" id = "carlig" name = "carlig">Carlig<br>
					<input type = "checkbox" id = "abs" name = "abs">ABS<br>
					<input type = "checkbox" id = "esp" name = "esp">ESP<br>
					<input type = "checkbox" id = "integrala" name = "integrala">4x4<br>
					<input type = "checkbox" id = "xenon" name = "xenon">Faruri xenon<br>
				</div>
			</fieldset>
			<!-- End Dotari -->
			<!-- Descriere -->
			<div style = "display: block;padding-top: 10px;padding-bottom: 5px">
				<label for = "descriere">Descriere</label><br>
				<textarea id = "descriere" name = "descriere" maxlength = 1024 rows = "15" cols = "60" disabled></textarea><br>
				<label for = "charRamase">Caractere ramase:</label>
				<input type = "text" id = "charRamase" disabled value = "1024" maxlength = "4" size = "4">
			</div>
			<!-- End Descriere -->
			<!-- Poza -->
			<div style = "display: block;padding-top: 10px;padding-bottom: 5px">
				<label>Adauga poza la anunt</label><br>
				<input type = "file" accept = "image/*" id = "poza" name = "poza" disabled><br>
				<input type = "button" id = "resetPoza" name = "resetPoza" value = "Sterge poza" disabled><br>
				<p>Adaugarea unei poze la anunt nu este necesara, dar daca adaugi una vei creste sansele vanzarii autovehiculului.<b> Poza poate avea o dimensiune de maxim 6 MB!</b></p>
			</div>
			<!-- End Poza -->
			<!-- Pret -->
			<div style = "display: block;padding-top: 5px;padding-bottom: 10px">
				<label><b>Pret* <u title = "Pretul trebuie sa fie in Euro">?</u></b></label><br>
				<input type = "text" id = "pret" name = "pret"  disabled>
			</div>
			<!-- End Pret -->
			<!-- Promovare -->
			<div style = "display: block;padding-top: 5px;padding-bottom: 10px">
				<label>Promovare</label><br>
				<select id = "promovare" name = "promovare" disabled>
					<option value = 2>Basic</option>
					<option value = 1<?php if ($sold < 50) echo " disabled" ?>>Premium</option>
					<option value = 0<?php if ($sold < 100) echo " disabled" ?>>Gold</option>
				</select>
				<p>
					Sunt disponibile 3 pachete de promovare a anunturilor:
					<ol>
						<li>Pachetul <b>Basic</b> (gratuit) nu are beneficii speciale</li>
						<li>Pachetul <b>Premium</b> (50 Lei): Afisarea anuntului la inceputul listei</li>
						<li>Pachetul <b>Gold</b> (100 Lei): Afisarea anuntului la inceputul listei + evidentierea anuntului cu o culoare atractiva</li>
					</ol>
					<strong>Daca nu aveti destui bani in sold nu veti putea selecta pachetele Premium sau Gold!</strong>
				</p>
			</div>
			<!-- End Promovare -->
			<input type = "hidden" id = "timbruMediu" name = "timbruMediu">
			<input type = "submit" id = "submit" name = "submit" value = "Adauga anunt" disabled>
		</form>
	</div>
	<div id = "left" class = "pane">
		
	</div>
	<div id = "right" class = "pane">
		
	</div>
</div>
<div class = "footer">
	<a href = "about.php">About</a><br>
</div>
</body>
</html>