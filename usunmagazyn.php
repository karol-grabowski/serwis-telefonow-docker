<?php
session_start();
require_once "connect.php";

$polaczenie = new mysqli($host, $user, $password, $name);

if ($polaczenie->connect_error) {
    die('Błąd połączenia: ' . $polaczenie->connect_error);
}

if (isset($_GET['id'])) {
    $Numer = $_GET['id'];// Pobierz ID rekordu do usunięcia

    // Upewnij się, że ID jest liczbą
    if (is_numeric($Numer)) {
        $query = "DELETE FROM magazyn WHERE Numer = $Numer";

		
        if ($polaczenie->query($query))
		{
            echo "Rekord został usunięty.";
			$_SESSION['usunietozmagazynu']=true;
        } else 
		{
            echo "Błąd podczas usuwania rekordu: " . $polaczenie->error;
        }
    }
    $polaczenie->close();
}

// Przekieruj z powrotem do strony głównej
header("Location: magazyn.php");
exit;
?>
