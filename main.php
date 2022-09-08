<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-main.css">
	<title>Strona główna - Egzaminy na prawo jazdy</title>
</head>
<body>

	<div id="allCategoryHolder">

	<?php

		include("print_data_func.php");

		function check_save_question() {
			global $con;

			//user id
			$Id_user = $_COOKIE['Id_user'];

			//if id_user cookie is null move into error page
			if($Id_user == null) {
				//set error cookie to show error page
				header("Location: index.php?strona=error-page/oups&previous=login");
			}

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
						nauka_button($question,$category_array[$i]);
					}
					else {
						nauka_button(1,$category_array[$i]);
					}
				}
				else {
					nauka_button(1,$category_array[$i]);
				}
				echo "</div>";
			}
		}

		check_save_question();

	?>


	</div>

	<a href='index.php?strona=level-question&pytanie=1&zakres_struktury=podstawowy&kategoria=b&poziom=dobrze_znam'>Dobrze znam</a>



</body>
</html>