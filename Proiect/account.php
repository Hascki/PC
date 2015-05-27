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
	$query = "SELECT `nume`, `prenume`, `telefon`, `adresaEmail`, `judet`, `localitate`, `strada`, `bloc`, `numar`, `scara`, `etaj`, `apartament`, `sold` FROM `profiles` WHERE `profileid` = " . $_SESSION['userID'];
	$sql = mysqli_query($conexiune, $query);
	if ($sql !== false)
	{
		$rez = mysqli_fetch_assoc($sql);
		$judet = "";
		if ($rez['judet'] !== NULL)
		{
			$query = "SELECT `numeJudet` FROM `judete` WHERE `judetid` = " . $rez['judet'];
			$sql = mysqli_query($conexiune, $query);
			$row = mysqli_fetch_assoc($sql);
			$rez['judet'] = $row['numeJudet'];
		}
		foreach ($rez as $key => $value)
		{
			if ($rez[$key] === NULL)
				$rez[$key] = '-';
		}
	}
	else $mesajEroare = "<span class = \"error\">Au aparut ceva probleme la incarcarea profilului. Va rugam reincarcati pagina. Daca problemele persista va rugam sa semnalati aceasta eroare contactandu-ne folosind datele din pagina About.</span><br>";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" type = "text/css" href = "styles/meniu.css">
<link rel = "stylesheet" type = "text/css" href = "styles/fundal.css">
<title>Cont</title>
</head>

<body>
<div class = "header">
<?php include "meniu.php" ?>
</div>
<div class = "container">
	<div id="content" class = "pane">
		<div id = "profil" style = "border:2px solid black;width: 99.6%;">
			<?php if (isset($mesajEroare)) echo $mesajEroare; ?>
			<div style = "margin: 5px 10px;display: inline-block;vertical-align: top;">
				<img  src =  <?php echo "getProfileImg.php?id=" . $_SESSION['userID'] . "\""?> style = "height: 200px;width: 173px;">
			</div>
			<div style = "margin: 5px 10px;display: inline-block;">
				<p>
					<span><b>Nume: </b><?php if (isset($rez['nume'])) echo $rez['nume']; ?></span><br>
					<span><b>Prenume: </b><?php if (isset($rez['prenume'])) echo $rez['prenume']; ?></span>
				</p>
				<p>
					<span><b>Telefon: </b><?php if (isset($rez['telefon']) && $rez['telefon'] !== '-') echo "0" . $rez['telefon']; else echo $rez['telefon']; ?></span><br>
					<span><b>Adresa email: </b><?php if (isset($rez['adresaEmail'])) echo $rez['adresaEmail']; ?></span>
				</p>
				<p>
					<span><b>Judet: </b><?php if (isset($rez['judet'])) echo $rez['judet']; ?></span>&nbsp;
					<span><b>Localitate: </b><?php if (isset($rez['localitate'])) echo $rez['localitate']; ?></span><br>
					<span><b>Strada: </b><?php if (isset($rez['strada'])) echo $rez['strada']; ?></span>&nbsp;
					<span><b>Nr: </b><?php if (isset($rez['numar'])) echo $rez['numar']; ?></span><br>
					<span><b>Bloc: </b><?php if (isset($rez['bloc'])) echo $rez['bloc']; ?></span>&nbsp;
					<span><b>Scara: </b><?php if (isset($rez['scara'])) echo $rez['scara']; ?></span>&nbsp;
					<span><b>Etaj: </b><?php if (isset($rez['etaj'])) echo $rez['etaj']; ?></span>&nbsp;
					<span><b>Apartament: </b><?php if (isset($rez['apartament'])) echo $rez['apartament']; ?></span>
				</p>
				<p style = "margin-bottom: 0px;">
					<span><b>Sold: </b><?php if (isset($rez['sold'])) echo $rez['sold'] . " Lei"; ?></span>
				</p>
			</div>
			<input type = "button" id = "schProfil" name = "schProfil" value = "Modificare profil" onclick = "window.location.href = 'edit_profile.php'" style = "display: block;margin: 10px;">
		</div>
		<div id = "anunturi" style = "margin: 5px 0px;border:2px solid black;">
			<iframe name="anunturiFrame" id="anunturiFrame" src= "anunturile_mele.php" scrolling="yes" style = "width: 99.6%;height: 1000px;border: 0px;"></iframe>
		</div>
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