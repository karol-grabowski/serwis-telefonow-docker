<?php
session_start();

		if($_SESSION['zalogowany']==false)
		{
			header('Location: index.php');
			exit;
		}
		else
		{
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
				$wyniki_producent = null;
				$wyniki_model = null;
				$wyniki_kod_producenta = null;
				
				if (isset($_POST['szukaj_producent'])) 
				{
				$producent = $_POST['producent'];
				$query = "SELECT * FROM naprawy WHERE Producent = '$producent'";
				$wyniki_producent = $polaczenie->query($query);
				}

				if (isset($_POST['szukaj_model'])) 
				{
				$model = $_POST['model'];
				$query = "SELECT * FROM naprawy WHERE Model = '$model'";
				$wyniki_model = $polaczenie->query($query);
				}
				
				if (isset($_POST['szukaj_kod_producenta'])) 
				{
				$kod_producenta = $_POST['kod_producenta'];
				$query = "SELECT * FROM naprawy WHERE `Kod producenta` = '$kod_producenta'";
				$wyniki_kod_producenta = $polaczenie->query($query);
				
				}
			}
			catch(Exception $b)
			{
				echo '<span style="color:red;">Wystąpił błąd serwera!</span>';
				echo '<br />Informacje o błędzie: '.$b;
			}
		}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Wyszukaj przedmiot klienta</title>
	<h1>Wyszukaj przedmiot klienta</h1>
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

        .button {
            display: inline-block;
            padding: 6px 20px;
            background-color: black;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
        }

    </style>
	
</head>
<body>

    <form action="wyszukaj.php" method="post">
        Producent:
        <input type="text" name="producent" value="<?php
		if(isset($producent))
		{
			echo $producent;
		}
		?>"/>
        <input type="submit" name="szukaj_producent" value="Szukaj">
    </form>
    
    <form action="wyszukaj.php" method="post">
        Model:
        <input type="text" name="model" value="<?php
		if(isset($model))
		{
			echo $model;
		}
		?>"/>
        <input type="submit" name="szukaj_model" value="Szukaj">
    </form>
	
	<form action="wyszukaj.php" method="post">
        Kod producenta:
        <input type="text" name="kod_producenta" value="<?php
		if(isset($kod_producenta))
		{
			echo $kod_producenta;
		}
		?>"/>
        <input type="submit" name="szukaj_kod_producenta" value="Szukaj">
    </form>
    
	<a href="strona.php" class="button">Wróć</a>
	
    <!-- wyniki -->
		<?php
		if (isset($_POST['szukaj_producent']) && $wyniki_producent && $wyniki_producent->num_rows > 0)
		{
			echo "<table border='1'><tr><th>ID</th><th>Producent</th><th>Model</th><th>Kod producenta</th><th>Data przyjęcia</th><th>Data odbioru</th><th>Opis</th><th>Dodany przez</th></tr>";

			while($row = $wyniki_producent->fetch_assoc())
			{
			echo "<tr><td>" . $row["id"] . "</td><td>" . $row["Producent"] . "</td><td>" . $row["Model"] . "</td><td>" . $row["Kod producenta"] . "</td><td>" . $row["Data przyjęcia"] . "</td><td>" . $row["Data odbioru"] . "</td><td>" . $row["Opis"] . "</td><td>" . $row["Dodany przez"] . "</td></tr>";
			}

			echo "</table>";
		} 
		elseif (isset($_POST['szukaj_producent']) && (!$wyniki_producent || $wyniki_producent->num_rows == 0)) 
		{
			echo "<span style='color: black; 
				background-color: #FEE6E6; 
				padding: 5px;
				border: 1px solid red;
				border-radius: 5px; 
				text-align: center; 
				position: relative; 
                left: 10px; 
                top: 15px;'>
				Nie znaleziono rekordów spełniających kryteria</span>";
		}
		if (isset($_POST['szukaj_model']) && $wyniki_model && $wyniki_model->num_rows > 0)
		{
			echo "<table border='1'><tr><th>ID</th><th>Producent</th><th>Model</th><th>Kod producenta</th><th>Data przyjęcia</th><th>Data odbioru</th><th>Opis</th><th>Dodany przez</th></tr>";

			while($row = $wyniki_model->fetch_assoc())
			{
			echo "<tr><td>" . $row["id"] . "</td><td>" . $row["Producent"] . "</td><td>" . $row["Model"] . "</td><td>" . $row["Kod producenta"] . "</td><td>" . $row["Data przyjęcia"] . "</td><td>" . $row["Data odbioru"] . "</td><td>" . $row["Opis"] . "</td><td>" . $row["Dodany przez"] . "</td></tr>";
			}
			echo "</table>";
		} 
		elseif (isset($_POST['szukaj_model']) && (!$wyniki_model || $wyniki_model->num_rows == 0)) 
		{
			echo "<span style='color: black; 
				background-color: #FEE6E6; 
				padding: 5px;
				border: 1px solid red;
				border-radius: 5px; 
				text-align: center; 
				position: relative; 
                left: 10px; 
                top: 15px;'>
				Nie znaleziono rekordów spełniających kryteria</span>";
		}
		if (isset($_POST['szukaj_kod_producenta']) && $wyniki_kod_producenta && $wyniki_kod_producenta->num_rows > 0)
		{
			echo "<table border='1'><tr><th>ID</th><th>Producent</th><th>Model</th><th>Kod producenta</th><th>Data przyjęcia</th><th>Data odbioru</th><th>Opis</th><th>Dodany przez</th></tr>";

			while($row = $wyniki_kod_producenta->fetch_assoc())
			{
			echo "<tr><td>" . $row["id"] . "</td><td>" . $row["Producent"] . "</td><td>" . $row["Model"] . "</td><td>" . $row["Kod producenta"] . "</td><td>" . $row["Data przyjęcia"] . "</td><td>" . $row["Data odbioru"] . "</td><td>" . $row["Opis"] . "</td><td>" . $row["Dodany przez"] . "</td></tr>";
			}
			echo "</table>";
		} 
		elseif (isset($_POST['szukaj_kod_producenta']) && (!$wyniki_kod_producenta || $wyniki_kod_producenta->num_rows == 0)) 
		{
			echo "<span style='color: black; 
				background-color: #FEE6E6; 
				padding: 5px;
				border: 1px solid red;
				border-radius: 5px; 
				text-align: center; 
				position: relative; 
                left: 10px; 
                top: 15px;'>
				Nie znaleziono rekordów spełniających kryteria</span>";
		}
		?>
    <br /><br /><br />
    
</body>
</html>