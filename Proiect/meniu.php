<?php
	if (!isset($_SESSION))
		session_start;
	$arrayLeftBtns = array("acasa" => "", "produse" => "", "promotii" => "", "addAnunt" => "", "cont" => "", "admin" => "");
	$arrayRightBtns = array("logout" => "class = \"rightBtn\"><a href = \"logout.php\">Logout</a>", "login" => "", "inregistrare" => "");
	if ($pagCurenta === "index")
		$arrayLeftBtns['acasa'] = "id = \"curenta\" ";
	else if ($pagCurenta === "produse")
		$arrayLeftBtns['produse'] = "id = \"curenta\" ";
	else if ($pagCurenta === "promotii")
		$arrayLeftBtns['promotii'] = "id = \"curenta\" ";
	else if ($pagCurenta === "adauga_anunt")
		$arrayLeftBtns['addAnunt'] = "id = \"curenta\" ";
	else if ($pagCurenta === "account" || $pagCurenta === "edit_profile")
		$arrayLeftBtns['cont'] = "id = \"curenta\" ";
	else if ($pagCurenta === "administrare")
		$arrayLeftBtns['admin'] = "id = \"curenta\" ";
	else if ($pagCurenta === "inregistrare")
		$arrayRightBtns['inregistrare'] = "id = \"curenta\" ";
	else if ($pagCurenta === "login")
		$arrayRightBtns['login'] .= "id = \"curenta\" ";
	$arrayLeftBtns['acasa'] .= "class = \"leftBtn\"><a href = \"index.php\">Acasă</a>";
	$arrayLeftBtns['produse'] .= "class = \"leftBtn\"><a href = \"produse.php\">Produse</a>";
	$arrayLeftBtns['promotii'] .= "class = \"leftBtn\"><a href = \"promotii.php\">Promotii</a>";
	$arrayLeftBtns['addAnunt'] .= "class = \"leftBtn\"><a href = \"adauga_anunt.php\">Adauga anunt</a>";
	$arrayLeftBtns['cont'] .= "class = \"leftBtn\"><a href = \"account.php\">Cont</a>";
	$arrayLeftBtns['admin'] .= "class = \"leftBtn\"><a href = \"administrare.php\">Administrare</a>";
	$arrayRightBtns['login'] .= "class = \"rightBtn\"><a href = \"login.php\">Login</a>";
	$arrayRightBtns['inregistrare'] .= "class = \"rightBtn\"><a href = \"inregistrare.php\">Înregistrare</a>";
	echo
"	<div class = \"meniu\">
		<ul>";
	if ((isset($_SESSION['login']) && empty($_SESSION['login'])) || !isset($_SESSION['login']))
	{
		echo "
			<li " . $arrayLeftBtns['acasa'] . "</li>
			<li " . $arrayLeftBtns['produse'] . "</li>
			<li " . $arrayRightBtns['login'] . "</li>
			<li " . $arrayRightBtns['inregistrare'] . "</li>";
	}
	else if (isset($_SESSION['login']) && !empty($_SESSION['login']))
	{
		echo "
			<li " . $arrayLeftBtns['acasa'] . "</li>
			<li " . $arrayLeftBtns['produse'] . "</li>";
		if (isset($_SESSION['userType']) && $_SESSION['userType'] !== "3")
			echo "
			<li " . $arrayLeftBtns['promotii'] . "</li>
			";
		if (isset($_SESSION['userType']) && $_SESSION['userType'] !== "3")
			echo "
			<li " . $arrayLeftBtns['addAnunt'] . "</li>";
		echo "
			<li " . $arrayLeftBtns['cont'] . "</li>";
		if (isset($_SESSION['userType']) && $_SESSION['userType'] === "1")
			echo "
			<li " . $arrayLeftBtns['admin'] . "</li>";
		echo
			"<li " . $arrayRightBtns['logout'] . "</li>";
	}
	echo "
		</ul>
	</div>
";
?>