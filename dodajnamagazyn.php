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
			$opis = $_POST['opis'];
			$pobranie = $_POST['pobranie'];
			$ilosc = $_POST['ilosc'];
			
			//Sprawdzenie nazwa	
			if (empty($nazwa)) 
			{
				$OK=false;
				$blad_nazwa="Uzupełnij to pole";
			}
			
			//Sprawdzenie ilosc	
		if (empty($ilosc) || !ctype_digit($ilosc) || $ilosc<0) 
			{
				$OK=false;
				$blad_ilosc="Uzupełnij to pole liczbą elementów";
			}

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
					if ($polaczenie->query("INSERT INTO magazyn VALUES (NULL, '$nazwa', '$opis', '$pobranie', '$ilosc')"))
					{
						$_SESSION['zamówiono']=true;
						header('Location: magazyn.php');
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
	<title>Dodaj nowy element</title>
	<h1> Magazyn części zapasowych</br>Dodaj nowy element</h1>
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

	<form action="dodajnamagazyn.php" method="post">
	Nazwa elementu:
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
	Opis elementu: 
		<input type="text" name="opis" value="<?php
		if(isset($opis))
		{
			echo $opis;
		}
		?>"/>
		
		</br>
	Element pobrany z: 
		<input type="text" name="pobranie" value="<?php
		if(isset($pobranie))
		{
			echo $pobranie;
		}
		?>"/>
		
		</br>
	Ilość elementów: 
		<input type="text" name="ilosc" value="<?php
		if(isset($ilosc))
		{
			echo $ilosc;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_ilosc))
		{
			echo '<span style="color: red;">' . $blad_ilosc. '</span>';
			unset($blad_ilosc);
		}
		?>
		</br></br>
		<a href="magazyn.php" class="button">Wróć</a>
		<input type="submit" value="Dodaj">
	</form>
</body>
</html>