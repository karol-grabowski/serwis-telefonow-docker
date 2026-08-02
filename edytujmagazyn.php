<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Edytuj części zamienne</title>
	
<h1> Edytuj informacje o części zamiennej</h1>
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
</head>
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
    $query = "SELECT * FROM magazyn WHERE Numer = $id";
    $result = $polaczenie->query($query);
    $row = $result->fetch_assoc();
    // Tworzenie formularza z danymi
    echo "<form action='edytujmagazyn.php?id=" . $id . "' method='post'>";
    echo "Nazwa części <input type='text' name='nazwa_elementu' value='" . $row["nazwa elementu"] . "'><br>";
    echo "Opis elementu: <input type='text' name='opis_elementu' value='" . $row["opis elementu"] . "'><br>";
    echo "Pobrany z: <input type='text' name='Pobrany_z' value='" . $row["Pobrany z"] . "'><br>";
    echo "Ilość elementów: <input type='text' name='ilosc' value='" . $row["ilosc"] . "'><br>";
	echo "<a href='magazyn.php' class='button'>Powrót</a>";
	echo "<input type='submit' value='Zapisz'>";
    echo "</form>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobierz dane z formularza
    $nazwa_elementu = $_POST['nazwa_elementu'];
    $opis_elementu = $_POST['opis_elementu'];
    $Pobrany_z = $_POST['Pobrany_z'];
    $ilosc = $_POST['ilosc'];

    // Aktualizacja danych
	$updateQuery = "UPDATE magazyn SET `nazwa elementu`='$nazwa_elementu', `opis elementu`='$opis_elementu', `Pobrany z`='$Pobrany_z', `ilosc`='$ilosc' WHERE Numer='$id'";

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