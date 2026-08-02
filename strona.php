<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Strona główna</title>
	<h1>Baza danych serwisu telefonów</h1>
	<style>
        h1 {
		padding: 6px 20px;
		background-color: white;
		color: black;
		text-align: center;
		text-decoration: none;
		border-radius: 6px;
		border: 1px solid black;
		margin: auto;
		font-size: 40px;
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
		margin-left: 6px;
		margin-right: 6px;
		}
		
    </style>
</head>
<body>
</br></br>
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
		
		echo "<span style='
			color: black;
			background-color: white;
			text-align: center; 
			display: block; 
			margin: auto;
			font-size: 25px;'>
			Najważniejsze informacje o zleceniach
			</span>";
		
		echo "<span style='
			color: #f2f2f2; 
			background-color: #4CAF50; 
			padding: 10px;
			border: 1px solid black;
			border-radius: 10px; 
			text-align: center; 
			display: block; 
			margin-left: 1100px;
			'>
			Użytkownik: {$_SESSION['login']}
			</br>
			</span>";
			
			?>
			<a href="klienci.php" class="button">Klienci </a>
			<a href="naprawy.php" class="button">Urządzenia </a>
			<a href="rozliczenia.php" class="button">Rozliczenia</a>
			<a href="magazyn.php" class="button">Części zamienne</a>
			<a href="wyszukaj.php" class="button">Wyszukaj </a>
			<a href="dodaj.php" class="button">Dodaj przedmiot</a>
			<?php
			if($_SESSION['login']=="admin")
			{
				echo "<a href='uzytkownicy.php' class='button'>Dodaj konto</a>";
			}
			?>
			<a href="index.php" class="button">Wyloguj</a>
	    	</br>
			<?php

		require_once "connect.php";

		$polaczenie = new mysqli($host, $user, $password, $name);
		if ($polaczenie->connect_errno) 
		{
			echo "Błąd połączenia z bazą danych: " . $polaczenie->connect_error;
		} 
		else
		{
			$query = "SELECT naprawy.id, naprawy.Producent, naprawy.Model, naprawy.`Data przyjęcia`, klienci.imię, klienci.nazwisko, klienci.email, klienci.`nr telefonu`, rozliczenia.`do zapłaty` FROM naprawy JOIN klienci ON naprawy.id = klienci.id JOIN rozliczenia ON naprawy.id = rozliczenia.id";
			$result = $polaczenie->query($query);

		if ($result && $result->num_rows > 0) 
		{
			echo "</br>";
			echo "<table border='1'><tr><th>id</th><th>Producent</th><th>Model</th><th>Data przyjęcia</th><th>imię</th><th>nazwisko</th><th>email</th><th>nr telefonu</th><th>do zapłaty</th></tr>";

        while($row = $result->fetch_assoc()) 
		{
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["Producent"] . "</td><td>" . $row["Model"] . "</td><td>" . $row["Data przyjęcia"] . "</td><td>" . $row["imię"] . "</td><td>" . $row["nazwisko"] . "</td><td>" . $row["email"] . "</td><td>" . $row["nr telefonu"] . "</td><td>" . $row["do zapłaty"] . "</td></tr>";
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
				position: relative; 
                left: 50px; 
                top: 50px;'>
                Tabela jest pusta</span>";
		}
    $polaczenie->close();
}

?>
</body>
</html>
