<?php
session_start();

		if($_SESSION['zalogowany']==false)
		{
			header('Location: index.php');
			exit;
		}
		else
		{
		if (isset($_POST['nazwa']))
		{
			$OK=true;
			$nazwa = $_POST['nazwa'];
			$haslo = $_POST['haslo'];
			$haslo2 = $_POST['haslo2'];
			
			//Sprawdzenie długości nazwy
			if ((strlen($nazwa)<3) || (strlen($nazwa)>20))
			{
				$OK=false;
				$blad_nazwa="Nazwa musi posiadać od 3 do 20 znaków!";
			}
			
			if ((strlen($haslo)<8) || (strlen($haslo)>20))
			{
				$OK=false;
				$blad_haslo="Hasło musi posiadać od 8 do 20 znaków!";
			}
		
			if ($haslo!=$haslo2)
			{
				$OK=false;
				$blad_haslo="Podane hasła nie są identyczne!";
			}	

			$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
		

			//polaczenie
			require_once "connect.php";
			mysqli_report(MYSQLI_REPORT_STRICT);
			
			try 
			{
				$polaczenie = new mysqli($host, $user, $password, $name);
				if ($polaczenie->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				if ($OK==true)
				{
					//Dodanie zlecenia
					if ($polaczenie->query("INSERT INTO konta VALUES (NULL, '$nazwa', '$haslo_hash')"))
					{
						$_SESSION['dodano_konto']=true;
						header('Location: strona.php');
						exit();
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
				}
					$polaczenie->close();
			}
			catch(Exception $b)
			{
				echo '<span style="color:red;">Wystąpił błąd serwera!</span>';
				echo '<br />Informacje o błędzie: '.$b;
			}
		}
		}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Dodaj nowego konto</title>
	<h1> Utwórz nowe konto dla nowego użytkownika</h1>
	<style>
        h1 {
		display: inline-block;
		padding: 6px 20px;
		background-color: white;
		color: black;
		text-align: center;
		text-decoration: none;
		border-radius: 6px;
		border: 1px solid black;
		margin-left: 6px;
		margin-right: 6px;
		}

		input[type="submit"] {
		display: inline-block;
		padding: 6px 20px;
		background-color: black;
		color: white;
		text-align: center;
		text-decoration: none;
		border-radius: 6px;
		margin-left: 6px;
		margin-right: 6px;
		}
		
		.button {
		display: inline-block;
		padding: 6px 20px;
		background-color: black;
		color: white;
		text-align: center;
		text-decoration: none;
		border-radius: 6px;
		margin-left: 6px;
		margin-right: 6px;
		}
		
    </style>
	<br /><br />
	
</head>

<body>

	<form action="uzytkownicy.php" method="post">
	Nazwa :
		<input type="text" name="nazwa" value="<?php
		if(isset($nazwa))
		{
			echo $nazwa;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_nazwa))
		{
			echo '<span style="color: red;">' . $blad_nazwa. '</span>';
			unset($blad_nazwa);
		}
		?>
		
		</br>
	Hasło: 
		<input type="password" name="haslo" value="<?php
		if(isset($haslo))
		{
			echo $haslo;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_haslo))
		{
			echo '<span style="color: red;">' . $blad_haslo. '</span>';
			unset($blad_haslo);
		}
		?>
		</br>
	Powtórz hasło: 
		<input type="password" name="haslo2" value="<?php
		if(isset($haslo2))
		{
			echo $haslo2;
		}
		?>"/>
		

		</br></br>
		<a href="strona.php" class="button">Wróć</a>
		<input type="submit" value="Dodaj nowe konto">
	</form>
</body>
</html>