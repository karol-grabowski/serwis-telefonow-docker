<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Edytuj rozliczenie</title>
	
<h1> Edytuj informacje o rozliczeniu</h1>
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
    $query = "SELECT * FROM rozliczenia WHERE id = $id";
    $result = $polaczenie->query($query);
    $row = $result->fetch_assoc();
    // Tworzenie formularza z danymi
    echo "<form action='edycjarozliczenia.php?id=" . $id . "' method='post'>";
    echo "Cena części zamiennych: <input type='text' name='cena_części_zamiennych' value='" . $row["cena części zamiennych"] . "'><br>";
    echo "Opłata za naprawę: <input type='text' name='opłata_za_naprawę' value='" . $row["opłata za naprawę"] . "'><br>";
    echo "Do zapłaty: <input type='text' name='do_zapłaty' value='" . $row["do zapłaty"] . "'><br>";
	echo "<a href='rozliczenia.php' class='button'>Powrót</a>";
	echo "<input type='submit' value='Zapisz'>";
    echo "</form>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobierz dane z formularza
    $cena_części_zamiennych = $_POST['cena_części_zamiennych'];
    $opłata_za_naprawę = $_POST['opłata_za_naprawę'];
    $do_zapłaty = $_POST['do_zapłaty'];

    // Aktualizacja danych
	$updateQuery = "UPDATE rozliczenia SET `cena części zamiennych`='$cena_części_zamiennych', `opłata za naprawę`='$opłata_za_naprawę', `do zapłaty`='$do_zapłaty' WHERE id='$id'";

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