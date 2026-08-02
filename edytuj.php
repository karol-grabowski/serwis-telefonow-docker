<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Edytuj przedmiot</title>
<h1> Edytuj informacje o przedmiocie</h1>
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

<?php
session_start();
require_once "connect.php";

if($_SESSION['zalogowany']==false)
		{
			header('Location: index.php');
			exit;
		}

$polaczenie = new mysqli($host, $user, $password, $name);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM naprawy WHERE id = $id";
    $result = $polaczenie->query($query);
    $row = $result->fetch_assoc();
    //formularz z danymi
    echo "<form action='edytuj.php?id=" . $id . "' method='post'>";
    echo "Producent: <input type='text' name='Producent' value='" . $row["Producent"] . "'><br>";
    echo "Model: <input type='text' name='Model' value='" . $row["Model"] . "'><br>";
    echo "Kod producenta: <input type='text' name='Kod_producenta' value='" . $row["Kod producenta"] . "'><br>";
    echo "Data przyjęcia: <input type='date' name='Data_przyjecia' value='" . $row["Data przyjęcia"] . "'><br>";
    echo "Data odbioru: <input type='date' name='Data_odbioru' value='" . $row["Data odbioru"] . "'><br>";
    echo "Opis: <input type='text' name='Opis' value='" . $row["Opis"] . "'><br>";
    echo "Dodany przez: <input type='text' name='Dodany_przez' value='" . $row["Dodany przez"] . "'><br>";
	echo "<a href='naprawy.php' class='button'>Powrót</a>";
	echo "<input type='submit' value='Zapisz'>";
    echo "</form>";
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobierz dane z formularza
    $Producent = $_POST['Producent'];
    $Model = $_POST['Model'];
    $Kod_producenta = $_POST['Kod_producenta'];
    $Data_przyjecia = $_POST['Data_przyjecia'];
    $Data_odbioru = $_POST['Data_odbioru'];
    $Opis = $_POST['Opis'];
    $Dodany_przez = $_POST['Dodany_przez'];

    // Aktualizacja danych
	$updateQuery = "UPDATE naprawy SET `Producent`='$Producent', `Model`='$Model', `Kod producenta`='$Kod_producenta', `Data przyjęcia`='$Data_przyjecia', `Data odbioru`='$Data_odbioru', `Opis`='$Opis', `Dodany przez`='$Dodany_przez' WHERE id='$id'";

    if ($polaczenie->query($updateQuery)) {
		echo "<span style='color: green; 
			background-color: lightyellow; 
			padding: 5px;
			border: 1px solid green;
			border-radius: 5px; 
			text-align: center; 
			margin: 10px 0;'>
			Pomyślnie edytowano informacje o tym przedmiocie</span>";

    } else {
        echo "Błąd: " . $polaczenie->error;
    }
}
?>

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
		margin-top: 20px;
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
		margin-top: 20px;
		}
		</style>