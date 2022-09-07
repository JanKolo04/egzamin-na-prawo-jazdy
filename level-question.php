<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Strona</title>
</head>
<body>

	<?php

		include("nauka.php");

		function test() {
			global $con;

			$zakres = $_GET['zakres_struktury'];
			$question = $_GET['pytanie'];
			$category = $_GET['kategoria'];

			$sql_get_data = "SELECT * FROM dobrze_znam WHERE Id=$question AND Kategoria='$category' AND Struktura='$zakres';";
			$query = mysqli_query($con, $sql_get_data);

			$row = mysqli_fetch_array($query);

			if($row['Struktura'] == 'podstawowy') {
				$sql_question = "SELECT * FROM pytania_podstawowe_".strtolower($category)." WHERE Id={$row['Id_pytanie']};";
				$query_question = mysqli_query($con, $sql_question);

				$row = mysqli_fetch_array($query_question);

			}
		}
		
		test();

	?>

</body>
</html>