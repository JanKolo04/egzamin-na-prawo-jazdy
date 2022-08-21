<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<?php

		include("connection.php");


		if(isset($_POST['answer'])) {
			check_answer();
		}

		function get_question($table, $question_Id) {
			global $con;

			$sql = "SELECT * FROM $table WHERE Id=$question_Id";
			$query = mysqli_query($con, $sql);

			$row = mysqli_fetch_array($query);

			return $row;
		}

		function get_answer() {
			global $con;

			//question
			$question_Id = $_GET['pytanie'];
			//zakres struktury
			$zakres_struktury = $_GET['zakres_struktury'];

			$correct_answer = "";

			if($zakres_struktury == "podstawowy") {
				//array with data about question
				$podsatwowe = get_question("pytania_podstawowe", $question_Id);
				$correct_answer = $podsatwowe['Poprawna_odp'];

			}
			else {
				//arraa with data about question
				$specjalistyczne = get_question("pytania_specjalistyczne", $question_Id);
				$correct_answer = $specjalistyczne['Poprawna_odp'];
			}

			return $correct_answer;
		}


		function check_answer() {
			global $correct_answer;

			//correct answer
			$correct_answer = get_answer();

			//button background color
			if($correct_answer == $_POST['answer']) {
				echo "Odpowiedź poprawna";
			}
			else {
				echo "Odpowiedź niepoprwna";
			}
		}

	?>



</body>
</html>










