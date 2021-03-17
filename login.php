<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header("Location: index.php");
	}
		
	$host = "mysql.ct8.pl";
	$db_user = "m20451_spacer";
	$db_password = "8GscvBRcTHa8YSq3Jn0w";
	$db_name = "m20451_spacer";
	

	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	if ($polaczenie->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
	else
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM users WHERE email='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				if(password_verify($password, $wiersz['password']))
				{
					//tu sie powinno stać coś jak zadziała logowanie
					$_GLOBALS['logged'] = true;
			
					//unset($_SESSION['e_login']);
					$rezultat->free_result();
				}
				else 
				{
					$_SESSION['e_login'] = "Niepoprawny login lub hasło!";
				}
				
			} else {
				
				$_SESSION['e_login'] = "Niepoprawny login lub hasło!";
			}
			
		}
		else
			echo '<script>alert("Error")</script>'; 
		
		$polaczenie->close();
	}


?>