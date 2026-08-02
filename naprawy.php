<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Urządzenia</title>
		
		<a href="strona.php" class="button">Powrót </a>
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

<?php
session_start();

		if($_SESSION['zalogowany']==false)
		{
			header('Location: index.php');
			exit;
		}
		
		if($_SESSION['usunieto']==true)
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
			$_SESSION['usunieto']=false;
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
			Szczegółowe informacje o urządzeniu
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
				$sql = "SELECT * FROM naprawy"; // Zapytanie SQL
				$result = $polaczenie->query($sql);

				if ($result->num_rows > 0) 
				{
				echo "<table border='1'><tr><th>ID</th><th>Producent</th><th>Model</th><th>Kod producenta</th><th>Data Przyjęcia</th><th>Data odbioru</th><th>Opis</th><th>Dodany przez</th><th> Usuń</th><th> Edytuj</th></tr>"; 
				while ($row = $result->fetch_assoc()) 
				{
				echo "<tr><td>" . $row["id"] . "</td><td>" . $row["Producent"] . "</td><td>" . $row["Model"] . "</td><td>" . $row["Kod producenta"] . "</td><td>" . $row["Data przyjęcia"] . "</td><td>" . $row["Data odbioru"] . "</td><td>" . $row["Opis"] . "</td><td>" . $row["Dodany przez"] . "</td><td><a href='usun.php?id=" . $row["id"] . "&source=naprawy' style='padding: 1px 10px; background-color: CBCBCB; color: black; text-decoration: none; border: 1px solid black; border-radius: 2px;'>Usuń</a></td><td><a href='edytuj.php?id=" . $row["id"] . "' style='padding: 1px 10px; background-color: CBCBCB; color: black; text-decoration: none;border: 1px solid black; border-radius: 2px;'>Edytuj</a></td>";
				}
				echo "</table>";
				} 
				else 
				{
				echo "<span style='color: black; 
				background-color: #FEE6E6; 
				padding: 5px;
				border: 1px solid red;
				border-radius: 5px; 
				text-align: center; 
				margin: 10px 0;'>
				Tabela jest pusta</span>";
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
		