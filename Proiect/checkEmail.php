<?php
	require_once "conexiune.php";
	$query = "SELECT `emailadd` FROM `utilizatori` WHERE `emailadd` = ?";
	$email = mysqli_real_escape_string($conexiune2, $_POST['email']);
	if (empty($email) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
		echo "Emailul introdus nu este valid!";
	else
	{
		if ($stmt = mysqli_prepare($conexiune2, $query))
		{
			$email = mysqli_real_escape_string($conexiune2, $_POST['email']);
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			if (mysqli_stmt_num_rows($stmt) === 1)
				echo "Email folosit deja!";
			else echo "Email valabil.";
		}
		mysqli_stmt_close($stmt);
	}
?>