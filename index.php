<?php

session_start();
$_SESSION['zalogowany'] = false;
$_SESSION['usunieto'] = false;
$_SESSION['dodano'] = false;
$_SESSION['usunietozmagazynu'] = false;

if (isset($_POST['login']))
	{
	require_once "connect.php";

	$polaczenie = @new mysqli("db", "serwis_user", "serwis_password", "serwis_db"
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		//$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM konta WHERE login='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu = $rezultat->num_rows;
			if($ilu>0)
			{
				$wiersz = $rezultat->fetch_assoc();
				
				if (password_verify($haslo, $wiersz['haslo']))
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['id'] = $wiersz['id'];
					$_SESSION['login'] = $wiersz['login'];
					$_SESSION['haslo'] = $wiersz['haslo'];
					unset($_SESSION['blad']);
					$rezultat->free_result();
					header('Location: strona.php');
				}
				else 
				{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
				}
			}
			else 
			{
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				$_SESSION['wpisany_login'] = $login; 
				header('Location: index.php');
			}
		$polaczenie->close();
	}
	}
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Projekt</title>
</head>

<body>

		<span style="color: #33ABEB; font-size: 44px;background-color: #D5F0FE; padding: 20px 383px; display: inline-block;">Baza danych serwisu telefonów</span>

		<!--zaloguj -->
		<form action="index.php" method="post">
		Zaloguj się
		
			</br></br>
			Login
			<input type="text" name="login" value="<?php
				if (isset($_SESSION['wpisany_login'])) 
				{
					echo htmlspecialchars($_SESSION['wpisany_login']);
				}
			?>" />
			</br></br>
			Hasło
			<input type="password" name="haslo"  />
		
		</br></br>
		<input type="submit" value="Zaloguj" />
		</form>
		
</body>
</html>



