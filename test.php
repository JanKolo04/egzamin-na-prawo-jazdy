<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Strona</title>
</head>
<body>

	<?php

		include("connection.php");

		function delete() {
			global $con;

			$array = ["a", "b", "c", "d", "t"];

			for($i=0; $i<sizeof($array); $i++) {
				$sql = "DELETE FROM pytania_podstawowe_{$array[$i]}";
				$query = mysqli_query($con, $sql);
			}

			for($i=0; $i<sizeof($array); $i++) {
				$sql = "DELETE FROM pytania_specjalistyczne_{$array[$i]}";
				$query = mysqli_query($con, $sql);
			}

		}

		function podst() {
			global $con;

			$array = ["a", "b", "c", "d", "t"];

			for($i=0; $i<sizeof($array); $i++) {
				$sql = "INSERT INTO pytania_podstawowe_{$array[$i]}(Pytanie, Poprawna_odp, Media, Liczba_punktow)
						SELECT Pytanie, Poprawna_odp, Media, Liczba_punktow
						FROM pytania
						WHERE Kategoria LIKE '%{$array[$i]}%' AND Zakres_struktury='PODSTAWOWY';";
				$query = mysqli_query($con, $sql);
			}

		}

		function spec() {
			global $con;

			$array = ["a", "b", "c", "d", "t"];

			$array2 = ["A", "B", "C", "D", "T"];

			for($i=0; $i<sizeof($array); $i++) {
				$sql = "INSERT INTO pytania_specjalistyczne_{$array[$i]}(Pytanie, Odpowiedz_A, Odpowiedz_B, Odpowiedz_C, Poprawna_odp, Media, Liczba_punktow)
						SELECT Pytanie, Odpowiedz_A, Odpowiedz_B, Odpowiedz_C, Poprawna_odp, Media, Liczba_punktow
						FROM pytania
						WHERE Kategoria LIKE '%{$array2[$i]}%' AND Zakres_struktury='SPECJALISTYCZNY';";
				$query = mysqli_query($con, $sql);

				echo $sql."</br>";
			}

		}

	?>

</body>
</html>