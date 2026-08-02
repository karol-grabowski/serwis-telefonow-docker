<?php
session_start();
require_once "connect.php";

if($_SESSION['zalogowany']==false)
		{
			header('Location: index.php');
			exit;
		}

$polaczenie = new mysqli($host, $user, $password, $name);

if ($polaczenie->connect_error) {
    die('Błąd połączenia: ' . $polaczenie->connect_error);
}

$strona_zrodlowa = 'strona.php';

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Pobierz ID rekordu do usunięcia
	if (isset($_GET['source'])) {
        $strona_zrodlowa = $_GET['source'] . '.php'; // Ustaw stronę źródłową 
    }

    // Upewnij się, że ID jest liczbą
    if (is_numeric($id)) {
        $query = "DELETE FROM naprawy WHERE id = $id";
		$query2 = "DELETE FROM klienci WHERE id = $id";
		$query3 = "DELETE FROM rozliczenia WHERE id = $id";

		
        if ($polaczenie->query($query))
		{
            echo "Rekord został usunięty.";
			$_SESSION['usunieto']=true;
        } else 
		{
            echo "Błąd podczas usuwania rekordu: " . $polaczenie->error;
        }
		if ($polaczenie->query($query2))
		{
            echo "Rekord został usunięty.";
			$_SESSION['usunieto']=true;
        } else 
		{
            echo "Błąd podczas usuwania rekordu: " . $polaczenie->error;
        }
		if ($polaczenie->query($query3))
		{
            echo "Rekord został usunięty.";
			$_SESSION['usunieto']=true;
        } else 
		{
            echo "Błąd podczas usuwania rekordu: " . $polaczenie->error;
        }
    }
    $polaczenie->close();
}

// Przekieruj z powrotem do strony głównej
header("Location: $strona_zrodlowa");
exit;
?>
