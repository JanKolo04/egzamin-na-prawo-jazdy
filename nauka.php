<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-nauka.css">
	<title>Nauka - Egzaminy na prawo jazdy</title>
</head>
<body>

	<div id="main">
	<?php

		//includes
		include("buttons_save.php");

		//global varaibles
		$pytanieID = $_GET['pytanie'];
		$zakres_struktury = $_GET['zakres_struktury'];
		$category = strtolower($_GET['kategoria']);

		if($pytanieID == null || $zakres_struktury == null) {
			header("Location: index.php?strona=error-page/oups&previous=main");
		}

		if(isset($_POST['level'])) {
			set_answer_level($_POST['level']);
		}

		function question_count() {
			global $con;

			$category = strtolower($_GET['kategoria']);

			//query row
			$row;

			//count all quesiton in table
			if(isset($_GET['poziom'])) {
				$sql_level = "SELECT COUNT(Id) AS 'count' FROM {$_GET['poziom']}";
				$query_level = mysqli_query($con, $sql_level);
				//set row
				$row = mysqli_fetch_array($query_level);
			}
			else if($_GET['zakres_struktury'] == "podstawowy") {
				$sql_podst = "SELECT COUNT(Id) AS 'count' FROM pytania_podstawowe_$category";
				$query_podst = mysqli_query($con, $sql_podst);
				//set row
				$row = mysqli_fetch_array($query_podst);
			}
			else {
				$sql_spec = "SELECT COUNT(Id) AS 'count' FROM pytania_specjalistyczne_$category";
				$query_spec = mysqli_query($con, $sql_spec);
				//set row
				$row = mysqli_fetch_array($query_spec);
			}
			

			//set value for var
			$count_question = $row['count'];
			//return value
			return $count_question;
		
		}

		//include show question
		include("show-question.php");


		function zakres_button($zakres, $question, $category) {
			echo "<a id=".strtolower($zakres)." class='btn btn-primary' href='index.php?strona=nauka&pytanie=$question&zakres_struktury=".strtolower($zakres)."&kategoria=".$category."'>$zakres</a>";
		}

		function zakres_buttons() {
			global $con;

			//user id
			$Id_user = $_COOKIE['Id_user'];
			//category
			$category = $_GET['kategoria'];

			//zakres array
			$zakres_array = ['Podstawowy', 'Specjalistyczny'];
			//check for zakres exist in table
			for($i=0; $i<sizeof($zakres_array); $i++) {
				$sql_get_save_question = "SELECT * FROM additional_data WHERE Id_user=$Id_user AND Category='$category'";
				$query = mysqli_query($con, $sql_get_save_question);

				if($query->num_rows != 0) {
					//row
					$row = mysqli_fetch_array($query);
					//question
					$question = $row["{$zakres_array[$i]}"];
					//if save question dosen't exist create button with saved question
					if($question != NULL) {
						zakres_button($zakres_array[$i], $question, $category);
					}
					//if dosen't exist create button with first question
					else {
						zakres_button($zakres_array[$i], 1, $category);
					}
				}
				else {
					zakres_button($zakres_array[$i], 1, $category);
				}
			}

		}

		//function to move question to diferents category
		function set_answer_level($table) {
			global $con;

			//zakres
			$zakres = $_GET['zakres_struktury'];
			//category
			$category = $_GET['kategoria'];
			//question
			$question = $_GET['pytanie'];

			$sql = "INSERT INTO $table(Id_pytanie, Struktura, Kategoria) VALUES($question, '$zakres', '$category');";
			$query = mysqli_query($con, $sql);

		}

	?>

		<div id="buttonsHolder">
			<div id="question_number">
				<div id="question_number_holder">
					<p>Zakres struktury: <?php echo $_GET['zakres_struktury']; ?></p>
					<p>Pytanie: <?php echo $_GET['pytanie']."/".question_count(); ?></p>
				</div>
			</div>

			<div id="categoryButtons">
				<?php zakres_buttons(); ?>
			</div>
			<form id="form_buttons" method="POST">
				<div id="levelButtons">
					<button name="level" value="dobrze_znam" class="btn btn-success">Dobrze znam</button>
					<button name="level" name="srednio_znam" class="btn btn-warning">Średnio znam</button>
					<button name="level" name="slabo_znam" class="btn btn-danger">Słabo znam</button>
				</div>
			
				<div id="rememberButtons">
					<button id="save" class="btn btn-secondary" type="submit" name="save">Zapamiętaj</button>
					<button id="delete" class="btn btn-danger" type="submit" name="delete">Usuń zapis</button>
				</div>
			</form>
		</div>

	</div>




	<script type="text/javascript">

		
		function change_button_color() {
			let zakres = <?php echo json_encode($zakres_struktury); ?>;

			if(zakres == "podstawowy") {
				document.querySelector("#podstawowy").className = "btn btn-secondary";
			}
			else {
				document.querySelector("#specjalistyczny").className = "btn btn-secondary";
			}
		}
				
		change_button_color();
		
		//add div into another div
		let holderForA = document.querySelector("#buttonsHolder");
		holderForA.appendChild(document.querySelector("#navigationMenu"));

	

	</script>
	

</body>
</html>








