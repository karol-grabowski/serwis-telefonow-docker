<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Edytuj klienta</title>
<h1> Edytuj informacje o kliencie</h1>
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
    $query = "SELECT * FROM klienci WHERE id = $id";
    $result = $polaczenie->query($query);
    $row = $result->fetch_assoc();
    // Tworzenie formularza z danymi
    echo "<form action='edycjaklient.php?id=" . $id . "' method='post'>";
    echo "Imię: <input type='text' name='imię' value='" . $row["imię"] . "'><br>";
    echo "Nazwisko: <input type='text' name='nazwisko' value='" . $row["nazwisko"] . "'><br>";
    echo "e-mail: <input type='text' name='email' value='" . $row["email"] . "'><br>";
    echo "Nr telefonu: <input type='number' name='nr_telefonu' value='" . $row["nr telefonu"] . "'><br>";
    echo "Kraj: <input type='text' name='kraj' value='" . $row["kraj"] . "'><br>";
    echo "Miasto: <input type='text' name='miasto' value='" . $row["miasto"] . "'><br>";
    echo "Kod pocztowy: <input type='text' name='kod_pocztowy' value='" . $row["kod pocztowy"] . "'><br>";
    echo "Ulica: <input type='text' name='ulica' value='" . $row["ulica"] . "'><br>";
    echo "Nr domu/mieszkania: <input type='text' name='nr_domu/mieszkania' value='" . $row["nr domu/mieszkania"] . "'><br>";
	echo "<a href='klienci.php' class='button'>Powrót</a>";
	echo "<input type='submit' value='Zapisz'>";
    echo "</form>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobierz dane z formularza
    $imię = $_POST['imię'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $nr_telefonu = $_POST['nr_telefonu'];
    $kraj = $_POST['kraj'];
    $miasto = $_POST['miasto'];
    $kod_pocztowy = $_POST['kod_pocztowy'];
    $ulica = $_POST['ulica'];
    $nr_domu_mieszkania = $_POST['nr_domu/mieszkania'];

    // Aktualizacja danych
	$updateQuery = "UPDATE klienci SET `imię`='$imię', `nazwisko`='$nazwisko', `email`='$email', `nr telefonu`='$nr_telefonu', `kraj`='$kraj', `miasto`='$miasto', `kod pocztowy`='$kod_pocztowy', `ulica`='$ulica' , `nr domu/mieszkania`='$nr_domu_mieszkania'WHERE id='$id'";

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