<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-main.css">
	<title>Strona główna - Egzaminy na prawo jazdy</title>
</head>
<body>

	<div id="main">
		<div id="allCategoryHolder">

	<?php

		include("print_data_func.php");

		//user id
		$Id_user = $_COOKIE['Id_user'];

		//if id_user cookie is null move into error page
		if($Id_user == null) {
			//set error cookie to show error page
			header("Location: index.php?strona=error-page/oups&previous=login");
		}

		function check_save_question_category() {
			global $con, $Id_user;

			/*
				---check for save question in table---
				if question isn't saved you open page on first question
			*/
			$category_array = ['A','B','C','D','T'];

			for($i=0; $i<5; $i++) {
				echo "<div class='categoryHolder'><h2>{$category_array[$i]}</h2>";
				//check for exist row with save question
				$sql_get_save_question = "SELECT * FROM additional_data WHERE Id_user=$Id_user AND Category='{$category_array[$i]}'";
				$query_get_save_question = mysqli_query($con, $sql_get_save_question);
				
				//if user have save question move to this question but if haven't move to first question
				$row_save = mysqli_fetch_array($query_get_save_question);

				if($query_get_save_question->num_rows != 0) {
					$question = $row_save['Podstawowy'];
					if($question != "") {
						nauka_button('nauka', $question, $category_array[$i], 'Brak');
					}
					else {
						nauka_button('nauka', 1, $category_array[$i], 'Brak');
					}
				}
				else {
					nauka_button('nauka', 1, $category_array[$i], 'Brak');
				}
				echo "</div>";
			}
		}

		check_save_question_category();

	?>

		</div>
	
		<div id="ratedCategoriesHolder">
			<h3>Postępy w nauce</h3>
			<div id="underCategories">
	<?php

		function check_save_rated_question() {
			global $con, $Id_user;

			/*
				check save question which was rateing
			*/

			$category_array = ['A','B','C','D','T'];
			//other category
			$other_category_array = ['A1', 'B1 BE', 'CE C1,', 'C1E', 'D1', 'DE'];
			//rate categories
			$rate_array = ['dobrze_znam'];
			//rate categories names
			$rate_name_array = ['Dobrze znam'];

			//show all categories with under categories
			rate_category();
			echo "</div>";
			for($i=0; $i<sizeof($category_array); $i++) {
				//select rate category buttons

				for($y=0; $y<sizeof($rate_array); $y++) {
					echo "<p>".$rate_name_array[$y]."</p>";

					//check for exist row with save question
					$sql_get_save_question = "SELECT * FROM additional_data WHERE Id_user=$Id_user AND Category='{$category_array[$i]}' AND Poziom='{$rate_array[$y]}'";
					$query_get_save_question = mysqli_query($con, $sql_get_save_question);
				
					//if user have save question move to this question but if haven't move to first question
					$row_save = mysqli_fetch_array($query_get_save_question);

					if($query_get_save_question->num_rows != 0) {
						$question = $row_save['Podstawowy'];
						if($question != "") {
							nauka_button('level-question', $question, $category_array[$i], $rate_array[$y]);
						}
						else {
							nauka_button('level-question', 1, $category_array[$i], $rate_array[$y]);
						}
					}
					else {
						nauka_button('level-question', 1, $category_array[$i], $rate_array[$y]);
					}
				}
			}
			echo "</div>";
		}

		check_save_rated_question();

	?>

		</div>
	</div>


</body>
</html>