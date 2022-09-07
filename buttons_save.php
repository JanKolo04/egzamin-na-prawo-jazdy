<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<?php


		if(isset($_POST['save'])) {
			save_current_question();
		}
		if(isset($_POST['delete'])) {
			delete_saved_question();
		}

		function save_current_question() {
			global $con;

			//user id
			$Id_user = $_COOKIE['Id_user'];
			//question
			$question = $_GET['pytanie'];
			//category
			$category = $_GET['kategoria'];
			//zakres struktury
			$zakres_struktury = $_GET['zakres_struktury'];

			//check function to choose great way
			$sql_check = "SELECT * FROM additional_data WHERE Id_user=$Id_user AND Category='$category'";
			$query_check = mysqli_query($con, $sql_check);

			//if user have row in table update this row
			//but if haven't row create
			$row = mysqli_fetch_array($query_check);
			if($query_check->num_rows == 0) {
				//save data
				$sql_insert = "INSERT INTO additional_data(Id_user, $zakres_struktury, Category) VALUES($Id_user, $question, '$category')";
				$query_insert = mysqli_query($con, $sql_insert);
			}
			else {
				//update data
				$sql_update = "UPDATE additional_data SET $zakres_struktury=$question WHERE Id_user=$Id_user AND Category='$category'";
				$query_update = mysqli_query($con, $sql_update);	
			}

		}

		function delete_saved_question() {
			global $con;

			//user id
			$Id_user = $_COOKIE['Id_user'];
			//question
			$question = $_GET['pytanie'];
			//category
			$category = $_GET['kategoria'];
			//zakres struktury
			$zakres_struktury = $_GET['zakres_struktury'];

			//update data
			$sql_update = "UPDATE additional_data SET $zakres_struktury=NULL WHERE Id_user=$Id_user AND Category='$category'";
			$query_update = mysqli_query($con, $sql_update);
		}


	?>


</body>
</html>