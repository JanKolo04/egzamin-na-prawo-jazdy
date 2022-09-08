<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Strona</title>
</head>
<body>

	<?php

		//function searching question in other table
		function find_question() {
			global $con;

			//variables from link
			$zakres = $_GET['zakres_struktury'];
			$question = $_GET['pytanie'];
			$category = $_GET['kategoria'];
			$level = $_GET['poziom'];

			$sql_get_data = "SELECT * FROM $level WHERE Id=$question AND Kategoria='$category' AND Struktura='$zakres';";
			$query = mysqli_query($con, $sql_get_data);

			$row = mysqli_fetch_array($query);

			//check from which table you need get question
			if($row['Struktura'] == 'podstawowy') {
				$sql_question = "SELECT * FROM pytania_podstawowe_".strtolower($category)." WHERE Id={$row['Id_pytanie']};";
				$query_question = mysqli_query($con, $sql_question);

				$row = mysqli_fetch_array($query_question);

				$_SESSION['question'] = $row['Id'];

			}
		}
		
		find_question();

		include("nauka.php");

	?>

</body>
</html>