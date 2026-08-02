<?php
session_start();

		if($_SESSION['zalogowany']==false)
		{
			header('Location: index.php');
			exit;
		}
		else
		{
		if (isset($_POST['producent']))
		{
			$OK=true;
			$producent = $_POST['producent'];
			$model = $_POST['model'];
			$kod_producenta = $_POST['kod_producenta'];
			$data_przyjęcia = $_POST['data_przyjęcia'];
			$data_odbioru = $_POST['data_odbioru'];
			$opis = $_POST['opis'];
			$cena_części_zamiennych = $_POST['cena_części_zamiennych'];
			$opłata_za_naprawę = $_POST['opłata_za_naprawę'];
			$dodany_przez = $_SESSION['login'];
			if (!empty($_POST['cena_części_zamiennych']) && !empty($_POST['opłata_za_naprawę']))
			{
			$do_zapłaty = $cena_części_zamiennych + $opłata_za_naprawę;
			}
				
			if ((strlen($producent)<3) || (strlen($producent)>15))
			{
				$OK=false;
				$blad_producent="Producent musi posiadać od 3 do 15 znaków!";
			}
			if ((strlen($model)<2) || (strlen($model)>15))
			{
				$OK=false;
				$blad_model="Model musi posiadać od 2 do 15 znaków!";
			}
			if (empty($data_przyjęcia))
			{
				$OK=false;
				$blad_data_przyjęcia="Podaj datę przyjęcia!";
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
					if ($polaczenie->query("INSERT INTO naprawy VALUES (NULL, '$producent', '$model', '$kod_producenta', '$data_przyjęcia', '$data_odbioru','$opis', '$dodany_przez')"))
					{
						$_SESSION['dodano']=true;	
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
			
			
			$imie = $_POST['imie'];
			$nazwisko = $_POST['nazwisko'];
			$email = $_POST['email'];
			$nrtel = $_POST['nrtel'];
			$kraj = $_POST['kraj'];
			$miasto = $_POST['miasto'];
			$kod = $_POST['kod'];
			$ulica = $_POST['ulica'];
			$nr = $_POST['nr'];

			//Sprawdzenie znaków czy są to litery (polskie znaki też)
			function polskie_znaki($tekst) 
			{
			return preg_match('/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$/', $tekst);
			}

			//Sprawdzenie znaków imienia	
			if (polskie_znaki($imie) == false) 
			{
				$OK=false;
				$blad_imie="Imie może składać się tylko z liter (dopuszczane są polskie znaki diakrytyczne)";
			}

			if ((strlen($imie)<3) || (strlen($imie)>15))
			{
				$OK=false;
				$blad_imie="Imię musi posiadać od 3 do 15 znaków!";
			}
		
			//Sprawdzenie znaków nazwiska	
			if (polskie_znaki($nazwisko) == false) 
			{
				$OK=false;
				$blad_nazwisko="Nazwisko może składać się tylko z liter (dopuszczane są polskie znaki diakrytyczne)";
			}
			
			//Sprawdzenie długości nazwiska
			if ((strlen($nazwisko)<3) || (strlen($nazwisko)>20))
			{
				$OK=false;
				$blad_nazwisko="Nazwisko musi posiadać od 3 do 20 znaków!";
			}
		
			//Poprawność adresu email
			$email_sprawdzony = filter_var($email, FILTER_SANITIZE_EMAIL);
			
			//Sprawdzenie poprawnosci email
			if ((filter_var($email_sprawdzony, FILTER_VALIDATE_EMAIL)==false) || ($email_sprawdzony!=$email)) 
			{
				$OK=false;
				$blad_email="Podaj poprawny adres e-mail!";
			}
			
			//sprawdzenie nrtel
			if (ctype_digit($nrtel)==false)
			{
				$OK=false;
				$blad_nrtel="Numer może składać się tylko z cyfr";
			}
			
			//Sprawdzenie długości nrtel
			if ((strlen($nrtel)<9) || (strlen($nrtel)>9))
			{
				$OK=false;
				$blad_nrtel="Numer telefonu musi posiadać 9 cyfr!";
			}
		
			//sprawdzenie kraj
			if (polskie_znaki($kraj) == false) 
			{
				$OK=false;
				$blad_kraj="Kraj może składać się tylko z liter (wraz z polskimi znakami) ";
			}
			
			//sprawdzenie miasto
			if (polskie_znaki($miasto) == false) 
			{
				$OK=false;
				$blad_miasto="Miasto może składać się tylko z liter (wraz z polskimi znakami) ";
			}
			
			//Sprawdzenie kodu
			function kod($tekst) 
			{
			return preg_match('/^[0-9-]+$/', $tekst);
			}
			
			//sprawdzenie kodu
			if (kod($kod) == false) 
			{
				$OK=false;
				$blad_kod="Kod pocztowy powinien wyglądać tak: XX-XXX  ,    X=cyfra ";
			}
			
			//Sprawdzenie długości kodu
			if ((strlen($kod)<6) || (strlen($kod)>6))
			{
				$OK=false;
				$blad_kod="Kod musi posiadać 6 znaków!";
			}
			
			//sprawdzenie ulicy
			function LiteryCyfryPlz($tekst) {
			return preg_match('/^[a-zA-Z0-9ąęłńóśźżĄĘŁŃÓŚŹŻ]+$/', $tekst);
			}
			
			//sprawdzenie ulica
			if (LiteryCyfryPlz($ulica) == false) 
			{
				$OK=false;
				$blad_ulica="Ulica nie może posiadać znaków specjalnych";
			}
			
			//sprawdzenie nr
			if (ctype_alnum($nr)==false)
			{
				$OK=false;
				$blad_nr="Numer może składać się tylko z liter i cyfr (bez polskich znaków)";
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
					if ($polaczenie->query("INSERT INTO klienci VALUES (NULL, '$imie', '$nazwisko', '$email', '$nrtel', '$kraj', '$miasto', '$kod', '$ulica', '$nr')"))
					{
						$_SESSION['zamówiono']=true;
						header('Location: strona.php');
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
					if ($polaczenie->query("INSERT INTO rozliczenia VALUES (NULL, '$cena_części_zamiennych', '$opłata_za_naprawę', '$do_zapłaty')"))
					{
						$_SESSION['zamówiono']=true;
						header('Location: strona.php');
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
	<title>Dodaj nowy przedmiot</title>
	
	<h1> Dodaj nowy przedmiot</h1>
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
    </style>
	<br />
	
</head>

<body>

	<h2> Informacje o przedmiocie:</h2>
		<style>
			h2 {
			color: black;
			font-size: 17px;
			}
		</style>

	<form action="dodaj.php" method="post">
	Producent: 
		<input type="text" name="producent" value="<?php
		if(isset($producent))
		{
			echo $producent;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_producent))
		{
			echo '<span style="color: red;">' . $blad_producent. '</span>';
			unset($blad_producent);
		}
		?>
		
		</br>
	Model: 
		<input type="text" name="model" value="<?php
		if(isset($model))
		{
			echo $model;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_model))
		{
			echo '<span style="color: red;">' . $blad_model. '</span>';
			unset($blad_model);
		}
		?>
		</br>
	Kod producenta: 
		<input type="text" name="kod_producenta" value="<?php
		if(isset($kod_producenta))
		{
			echo $kod_producenta;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_kod_producenta))
		{
			echo '<span style="color: red;">' . $blad_kod_producenta. '</span>';
			unset($blad_kod_producenta);
		}
		?>
		
		</br>
	Data przyjęcia: 
		<input type="date" name="data_przyjęcia" value="<?php
		if(isset($data_przyjęcia))
		{
			echo $data_przyjęcia;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_data_przyjęcia))
		{
			echo '<span style="color: red;">' . $blad_data_przyjęcia. '</span>';
			unset($blad_data_przyjęcia);
		}
		?>
		
		</br>
	Data odbioru: 
		<input type="date" name="data_odbioru" value="<?php
		if(isset($data_odbioru))
		{
			echo $data_odbioru;
		}
		?>"/>
		
		</br>
	Opis: 
		<input type="text" name="opis" value="<?php
		if(isset($opis))
		{
			echo $opis;
		}
		?>"/>
		
		<h3> Koszty: </h3>
		<style>
			h3 {
			color: black;
			font-size: 17px;
			}
		</style>

	Koszt części zamiennych: 
		<input type="number" name="cena_części_zamiennych" value="<?php
		if(isset($cena_części_zamiennych))
		{
			echo $cena_części_zamiennych;
		}
		?>"/>
		
		</br>
	Opłata za naprawę:
		<input type="number" name="opłata_za_naprawę" value="<?php
		if(isset($opłata_za_naprawę))
		{
			echo $opłata_za_naprawę;
		}
		?>"/>
		
		<h4> Dane klienta: </h4>
		<style>
			h4 {
			color: black;
			font-size: 17px;
			}
		</style>
		
	Imię: 
		<input type="text" name="imie" value="<?php
		if(isset($imie))
		{
			echo $imie;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_imie))
		{
			echo '<span style="color: red;">' . $blad_imie . '</span>';
			unset($blad_imie);
		}
		?>
		
		</br>
	Nazwisko: 
		<input type="text" name="nazwisko" value="<?php
		if(isset($nazwisko))
		{
			echo $nazwisko;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_nazwisko))
		{
			echo '<span style="color: red;">' . $blad_nazwisko . '</span>';
			unset($blad_nazwisko);
		}
		?>
		
		</br>
	e-mail: 
		<input type="text" name="email" value="<?php
		if(isset($email))
		{
			echo $email;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_email))
		{
			echo '<span style="color: red;">' . $blad_email. '</span>';
			unset($blad_email);
		}
		?>
		
		</br>
	Numer telefonu: 
		<input type="text" name="nrtel" value="<?php
		if(isset($nrtel))
		{
			echo $nrtel;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_nrtel))
		{
			echo '<span style="color: red;">' . $blad_nrtel. '</span>';
			unset($blad_nrtel);
		}
		?>
		
		</br>
		adres:
		</br>
	Kraj: 
		<input type="text" name="kraj" value="<?php
		if(isset($kraj))
		{
			echo $kraj;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_kraj))
		{
			echo '<span style="color: red;">' . $blad_kraj. '</span>';
			unset($blad_kraj);
		}
		?>
		
		</br>
	Miasto: 
		<input type="text" name="miasto" value="<?php
		if(isset($miasto))
		{
			echo $miasto;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_miasto))
		{
			echo '<span style="color: red;">' . $blad_miasto. '</span>';
			unset($blad_miasto);
		}
		?>
		
		</br>
	Kod pocztowy: 
		<input type="text" name="kod" value="<?php
		if(isset($kod))
		{
			echo $kod;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_kod))
		{
			echo '<span style="color: red;">' . $blad_kod. '</span>';
			unset($blad_kod);
		}
		?>
		
		</br>
	Ulica: 
		<input type="text" name="ulica" value="<?php
		if(isset($ulica))
		{
			echo $ulica;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_ulica))
		{
			echo '<span style="color: red;">' . $blad_ulica. '</span>';
			unset($blad_ulica);
		}
		?>
		
		</br>
	nr domu/mieszkania: 
		<input type="text" name="nr" value="<?php
		if(isset($nr))
		{
			echo $nr;
		}
		?>"/>
		
		<!-- wypisanie błędu-->
		<?php
		if (isset($blad_nr))
		{
			echo '<span style="color: red;">' . $blad_nr. '</span>';
			unset($blad_nr);
		}
		?>
		</br></br>
		<a href="strona.php" class="button">Wróć</a>
		<style>
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
		
		<style>
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
		</style>
		
		<input type="submit" value="Dodaj">
	</form>

</body>
</html>