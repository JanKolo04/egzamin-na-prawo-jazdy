<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<?php

		include("connection.php");

		//class name for answer button
		$classNameT = "btn btn-primary";
		$classNameN = "btn btn-primary";
		$classNameA = "btn btn-primary";
		$classNameB = "btn btn-primary";
		$classNameC = "btn btn-primary";

		//category
		$category = $_GET['kategoria'];


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
			global $con, $category;

			//question
			$question_Id = $_GET['pytanie'];
			//zakres struktury
			$zakres_struktury = $_GET['zakres_struktury'];

			$correct_answer = "";

			if($zakres_struktury == "podstawowy") {
				//array with data about question
				$podsatwowe = get_question("pytania_podstawowe_$category", $question_Id);
				$correct_answer = $podsatwowe['Poprawna_odp'];

			}
			else {
				//arraa with data about question
				$specjalistyczne = get_question("pytania_specjalistyczne_$category", $question_Id);
				$correct_answer = $specjalistyczne['Poprawna_odp'];
			}

			return $correct_answer;
		}

		function change_color($post, $class) {
			global $classNameT, $classNameN, $classNameA, $classNameB, $classNameC;
			switch ($post) {
				case "T":
					$classNameT = $class;
					break;
				
				case "N":
					$classNameN = $class;
					break;

				case "A":
					$classNameA = $class;
					break;
				
				case "B":
					$classNameB = $class;
					break;

				case "C":
					$classNameC = $class;
					break;
			}	
		}


		function check_answer() {
			global $correct_answer;

			//correct answer
			$correct_answer = get_answer();

			//button background color
			if($correct_answer == $_POST['answer']) {
				change_color($_POST['answer'], "btn btn-success");
			}
			else {
				change_color($_POST['answer'], "btn btn-danger");
			}
		}

	?>



</body>
</html>










