<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Części zamienne</title>
	
		<a href="strona.php" class="button">Powrót </a>
		<a href="dodajnamagazyn.php" class="button">Dodaj nowy element </a>
		<a href="index.php" class="button1">Wyloguj</a>
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

		.button1 {
		display: inline-block;
		padding: 6px 20px;
		background-color: black;
		color: white;
		text-align: center;
		text-decoration: none;
		border-radius: 6px;
		margin-left: 6px;
		margin-right: 6px;
		float: right;
		}

        table {
            width: 95%; 
            border-collapse: collapse;
			margin-left: auto;
			margin-right: auto;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
		
		</style>
		</br></br></br>
</head>

<?php
session_start();

		if($_SESSION['zalogowany']==false)
		{
			header('Location: index.php');
			exit;
		}
		
		if($_SESSION['dodano']==true)
		{
			echo "<span style='color: green; 
			background-color: lightyellow; 
			padding: 10px;
			border: 1px solid green;
			border-radius: 5px; 
			text-align: center; 
			display: block; 
			margin: 10px 0;'>
			Pomyślnie dodano przedmiot</span>";
			$_SESSION['dodano']=false;
		}
		
		if($_SESSION['usunietozmagazynu']==true)
		{
			echo "<span style='color: 20A6F5; 
			background-color: C1E6FC; 
			padding: 10px;
			border: 1px solid #0695FF;
			border-radius: 5px; 
			text-align: center; 
			display: block; 
			margin: 10px 0;'>
			Pomyślnie usunięto element tabeli</span>";
			$_SESSION['usunietozmagazynu']=false;
		}
		
		echo "<span style='
			color: black;
			padding: 6px 20px;
			background-color: white;
			border: 1px solid black;
			border-radius: 6px;
			text-align: center; 
			display: block; 
			font-size: 25px;'>
			Szczegółowe informacje o częściach zamiennych w magazynie
			</span>";
		echo "</br>";
		
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
				else
				{
				$sql = "SELECT * FROM magazyn"; // Zapytanie SQL
				$result = $polaczenie->query($sql);

				if ($result->num_rows > 0) 
				{
				echo "<table border='1'><tr><th>Numer</th><th>Nazwa elementu</th><th>Opis elementu</th><th>Pobrany z</th><th>ilość</th><th>usuń</th><th>edytuj</th></tr>"; 
				while ($row = $result->fetch_assoc()) 
				{
				echo "<tr><td>" . $row["Numer"] . "</td><td>" . $row["nazwa elementu"] . "</td><td>" . $row["opis elementu"] . "</td><td>" . $row["Pobrany z"] . "</td><td>" . $row["ilosc"] . "</td>
				<td><a href='usunmagazyn.php?id=" . $row["Numer"] . "' style='padding: 1px 10px; background-color: CBCBCB; color: black; text-decoration: none; border: 1px solid black; border-radius: 2px;'>Usuń</a></td>
				<td><a href='edytujmagazyn.php?id=" . $row["Numer"] . "' style='padding: 1px 10px; background-color: CBCBCB; color: black; text-decoration: none; border: 1px solid black; border-radius: 2px;'>Edytuj</a></td>
				";
				}
				echo "</table>";
				} 
				else 
				{
				echo "Magazyn części jest pusty";
				}
				
				$polaczenie->close();
			}
			}
			catch(Exception $b)
			{
				echo '<span style="color:red;">Wystąpił błąd serwera!</span>';
				echo '<br />Informacje o błędzie: '.$b;
			}
?>
