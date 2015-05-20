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
	// Cand se schimba categoria
	$("#categorii").on("change", function()
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
			$.getJSON("getStyles.php", {tip:$(this).val()}, function(rez)
			{
				var options = "<option value = 0>Selectati</option>";
				for (var i = 0;i < rez.length;i++)
				{
					options += "<option value = " + rez[i].id + ">" + rez[i].stil + "</option>";
				}
				$("#stil").html(options);
			});
			if ($(this).val() === "1")
			{
				$("#divNrLocuri").css("display", "inline-block");
				$("#divMMA").css("display", "inline-block");
				$("#dotari").css("display", "block");
				var options = "<option value = 0>Selectati</option><option value = 1>Manuala</option><option value = 2>Secventiala</option><option value = 3>Automata</option>";
				$("#distributie").html(options);
				options = "<option value = 0>Selectati</option><option value = 1>Benzina</option><option value = 2>Motorina</option><option value = 3>Electrica</option><option value = 4>Hibrid</option>";
				$("#combustibil").html(options);
			}
			else 
			{
				$("#divNrLocuri").css("display", "none");
				$("#divMMA").css("display", "none");
				$("#dotari").css("display", "none");
				var options = "<option value = 0>Selectati</option><option value = 4>lant</option><option value = 5>cardan</option><option value = 6>curea</option>";
				$("#distributie").html(options);
				options = "<option value = 0>Selectati</option><option value = 1>Benzina</option><option value = 2>Motorina</option><option value = 3>Electrica</option>";
				$("#combustibil").html(options);
			}
			$("#marcaModel").prop("disabled", false);
			$("#dateVehicul").prop("disabled", false);
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
			$("#infoGen").prop("disabled", true);
			$("#dotari").prop("disabled", true);
			$("#descriere").prop("disabled", true);
			$("#poza").prop("disabled", true);
			$("#pret").prop("disabled", true);
			$("#promovare").prop("disabled", true);
			$("#submit").prop("disabled", true);
			$("#marca").html("<option value = 0>Selectati</option>");
			$("#model").html("<option value = 0>Selectati</option>");
			$("#stil").html("<option value = 0>Selectati</option>");
			$("#combustibil").html("<option value = 0>Selectati</option>");
			$("#distributie").html("<option value = 0>Selectati</option>");
		}
	});
	// Cand se schimba modelul
	$("#marca").on("change", function()
	{
		if ($(this).val() !== "0")
		{
			$.getJSON("getModels.php", {marca: $(this).val(), tip:$("#categorii").val()}, function(rez)
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
	// Validare formular
	$("#anunt").validate(
	{
		//Reguli de validare
		rules:
		{
			categorii: {selectNotDefault: "0"},
			marca: {selectNotDefault: "0"},
			model: {selectNotDefault: "0"},
			stil: {selectNotDefault: "0"},
			fabricatie: 
			{
				required: true,
				minlength: 4,
				min: 1900
			},
			combustibil: {selectNotDefault: "0"},
			culoare: {selectNotDefault: "0"},
			rulaj:
			{
				required: true,
				min: 0
			},
			clasaEuro: {selectNotDefault: "0"},
			pret: 
			{
				required: true,
				min: 1
			}
		},
		// Mesaje de eroare
		messages:
		{
			categorii: {selectNotDefault: "Selectati o categorie de autovehicul!"},
			marca: {selectNotDefault: "Selectati o marca!"},
			model: {selectNotDefault: "Selectati un model!"},
			stil: {selectNotDefault: "Selectati stilul autovehiculului!"},
			fabricatie:
			{
				required: "Introduceti anul fabricatiei!",
                minlength: "Anul nu are 4 caractere!",
				min: "An invalid!"
			},
			combustibil: {selectNotDefault: "Selectati tipul de combustibil!"},
			culoare: {selectNotDefault: "Selectati culoare autovehiculului!"},
			rulaj:
			{
				required: "Introduceti kilometrajul!",
				min: "Kilometrajul nu poate fi negativ!"
			},
			clasaEuro: {selectNotDefault: "Selectati clasa euro!"},
			pret:
			{
				required: "Introduceti pretul!",
				min: "Pretul nu poate fi mai mic ca 1"
			}
		},
		// Daca totul e in regula se trimit datele
		submitHandler: function(form)
		{
			var r = confirm("Esti sigur ca vrei sa postezi anuntul?\nOdata postat el nu mai poate fi modificat.");
			if (r === true)
				$("#anunt").submit();
			/*
			var posting = $.post("checkAnunt.php", $form.serialize());
			posting.done(function(data)
			{
				console.log(data);
			});
			*/
			/*
			console.log(form);
			var $form = $(this);
			var serializedData = $form.serialize();
			request = $.ajax(
			{
				url: "checkAnunt.php",
				type: $form.attr("method"),
				data: serializedData
			});
			request.done(function(response, textStatus, jqXHR)
			{
				console.log(textStatus);
				alert(response);
			});
			request.fail(function(jqXHR, textStatus, errorThrown)
			{
				console.error("Eroare: " + textStatus, errorThrown);
			});
			*/
		}
	});
});
</script>
<title>Adauga anunt</title>
</head>

<body>
<div class = "header">
<?php include "meniu.php" ?>
</div>
<div class = "container">
	<div id="content" class = "pane">
		<span>Campurile ingrosate si marcate cu * sunt obligatorii!</span>
		<form id = "anunt" name = "anunt" action = "checkAnunt.php" method = "POST" enctype="multipart/form-data" style = "padding-bottom: 20px">
			<!-- Categorii -->
			<div style = "display: block;padding-top: 10px;padding-bottom: 10px">
				<label for = "categorii"><b>Categoria anuntului*</b></label><br>
				<select id = "categorii" name = "categorii" class = "required">
					<?php echo $categorii ?>
				</select>
			</div>
			<!-- End Categorii -->
			<!-- Marca si model -->
			<fieldset id = "marcaModel" disabled>
				<legend>Marca si modelul</legend>
					<div style = "display: inline-block;padding-right: 20px">
						<label for = "marca"><b>Marca*</b></label><br>
						<select id = "marca"  name = "marca" class = "required" style = "width: 150px">
							<option value = 0>Selectati</option>
						</select>
					</div>
					<div style = "display: inline-block;padding-right: 20px;">
						<label for = "model"><b>Modelul*</b></label><br>
						<select id = "model" name = "model" class = "required" style = "width: 150px">
							<option value = 0>Selectati</option>
						</select>
					</div>
			</fieldset>
			<!-- End Marca si model -->
			<!-- Date vehicul -->
			<fieldset id = "dateVehicul" style = "text-align: center;" disabled>
				<legend>Date vehicul</legend>
				<div style = "display: inline-block;text-align: left;padding-right: 20px;padding-bottom: 5px;">
					<label for = "stil"><b>Stil*</b></label><br>
					<select id = "stil" name = "stil" class = "required" style = "width: 105px">
						<option value = 0>Selectati</option>
					</select>
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<label for = "fabricatie"><b>Anul fabricarii*</b></label><br>
					<input type = "text" maxlength = "4" size = "4" id = "fabricatie" name = "fabricatie" class = "required">
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<label for = "combustibil"><b>Combustibil*</b></label><br>
					<select id = "combustibil" name = "combustibil" class = "required">
						<option value = 0>Selectati</option>
					</select>
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<label for = "culoare"><b>Culoare*</b></label><br>
					<select id = "culoare" name = "culoare" class = "required">
						<?php echo $culori; ?>
					</select>
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<label for = "capacitate">Cap. cilindrica(cm<sup>3</sup>)</label><br>
					<input type = "text" id = "capacitate" name = "capacitate">
				</div>
				<div style = "display: inline-block;text-align: left;padding-right: 20px;padding-bottom: 5px;">
					<label for = "putere">Putere <b><u title = "Valoarea va fi automat recalculata in kW sau CP.">?</u></b></label><br>
					<input type = "text" id = "putere" name = "putere" maxlength = "4" size = "4">
					<input type = "radio" id = "putereKW" name = "tipPutere" value = "kW">kW
					<input type = "radio" id = "putereCP" name = "tipPutere" value = "CP">CP
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
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
					<label for = "rulaj"><b>Rulaj*</b></label><br>
					<input type = "text" id = "rulaj" name = "rulaj" class = "required">
				</div>
				<div style = "display: inline-block;padding-right: 20px;">
					<label for = "clasaEuro"><b>Norma Euro*</b></label><br>
					<select id = "clasaEuro" name = "clasaEuro" class = "required">
						<?php echo $clasaEuro; ?>
					</select>
				</div>
				<div style = "display: inline-block;padding-right: 20px;padding-bottom: 5px;">
					<label for = "emisii">Emisii CO<sub>2</sub>/l</label><br>
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
						<option value = 1>Fara AC</option>
						<option value = 2>AC manual</option>
						<option value = 3>AC automat</option>
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
				<p>Adaugarea unei poze la anunt nu este necesara, dar daca adaugi una vei creste sansele vanzarii autovehiculului.</p>
			</div>
			<!-- End Poza -->
			<!-- Pret -->
			<div style = "display: block;padding-top: 5px;padding-bottom: 10px">
				<label><b>Pret* <u title = "Pretul trebuie sa fie in Euro">?</u></b></label><br>
				<input type = "text" id = "pret" name = "pret" class = "required" disabled>
			</div>
			<!-- End Pret -->
			<!-- Promovare -->
			<div style = "display: block;padding-top: 5px;padding-bottom: 10px">
				<label>Promovare</label><br>
				<select id = "promovare" name = "promovare" disabled>
					<option value = 2>Basic</option>
					<option value = 1>Premium</option>
					<option value = 0>Gold</option>
				</select>
				<p>
					Sunt disponibile 3 pachete de promovare a anunturilor:
					<ol>
						<li>Pachetul <b>Basic</b> nu are beneficii speciale</li>
						<li>Pachetul <b>Premium</b>: Afisarea anuntului la inceputul listei</li>
						<li>Pachetul <b>Gold</b>: Afisarea anuntului la inceputul listei + evidentierea anuntului cu o culoare atractiva</li>
					</ol>
				</p>
				
			</div>
			<!-- End Promovare -->
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