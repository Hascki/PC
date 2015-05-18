<?php
	$arrayPagCurenta = array("acasa" => 0, "produse" => 0, "cont" => 0, "inregistrare" => 0, "login" => 0);
	$arrayLeftBtns = array("acasa" => "", "produse" => "", "cont" => "");
	$arrayRightBtns = array("logout" => "<li class = \"rightBtn\"><a href = \"logout.php\">Logout</a></li>", "login" => "", "inregistrare" => "");
	if ($pagCurenta === "index")
	{
		$arrayPagCurenta['acasa'] = 1;
		$arrayLeftBtns['acasa'] = "id = \"curenta\" ";
	}
	else if ($pagCurenta === "produse")
	{
		$arrayPagCurenta['produse'] = 1;
		$arrayLeftBtns['produse'] = "id = \"curenta\" ";
	}
	else if ($pagCurenta === "account" || $pagCurenta === "edit_profile")
	{
		$arrayPagCurenta['cont'] = 1;
		$arrayLeftBtns['cont'] = "id = \"curenta\" ";
	}
	else if ($pagCurenta === "inregistrare")
	{
		$arrayPagCurenta['inregistrare'] = 1;
		$arrayRightBtns['inregistrare'] = "id = \"curenta\" ";
	}
	else if ($pagCurenta === "login")
	{
		$arrayPagCurenta = 1;
		$arrayRightBtns['login'] .= "id = \"curenta\" ";
	}
	$arrayLeftBtns['acasa'] .= "class = \"leftBtn\"><a href = \"index.php\">Acasă</a>";
	$arrayLeftBtns['produse'] .= "class = \"leftBtn\"><a href = \"produse.php\">Produse</a>";
	$arrayLeftBtns['cont'] .= "class = \"leftBtn\"><a href = \"account.php\">Cont</a>";
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
			<li " . $arrayLeftBtns['produse'] . "</li>
			<li " . $arrayLeftBtns['cont'] . "</li>
			<li " . $arrayRightBtns['logout'] . "</li>";
	}
	echo "
		</ul>
	</div>
";
?>