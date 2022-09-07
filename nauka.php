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
		include("answer.php");

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


		if($zakres_struktury == "podstawowy") {
			get_data_podstawowe($_GET['pytanie']);
		}
		else {
			get_data_specjalistyczne($_GET['pytanie']);
		}
		

		function get_data_podstawowe($pytanieID) {
			global $con, $classNameT, $classNameN, $category;

			//get data from table pytania
			$sql = "SELECT * FROM pytania_podstawowe_$category WHERE Id=$pytanieID";
			$query = mysqli_query($con, $sql);

			$data_array = mysqli_fetch_array($query);
			$next = ($data_array['Id'])+1;
			$previous = ($data_array['Id']) - 1;

			//media
			$media = "data/{$data_array["Media"]}";

			echo
				"	
					<div id='questionAndAnswer'>
						<div id='video'>
							<object id='MediaPlayer' width=320 height=286 classid='CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95' standby='Loading Windows Media Player ...' type='application/x-oleobject' codebase='http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112'> 
							<param name='filename' value='data/$media'>
							<param name='Showcontrols' value='True'>
							<param name='autoStart' value='True'>
							<param name='wmode' value='transparent'>
							<embed type='application/x-mplayer2' src='data/$media' name='MediaPlayer' autoStart='True' wmode='transparent' width='320' height='286' ></embed>
							</object>
						</div>

						<div id='questionHolder'>
							<p id='question'>".$data_array['Pytanie']."</p>
						</div>
						<form id='podstForm' method='POST'>
							<button type='submit' value='T' name='answer' class='$classNameT'>Tak</button>
							<button type='submit' value='N' name='answer' class='$classNameN'>Nie</button>
						</form>
					</div>
				";

			echo "<div id='navigationMenu'>";
			if($data_array['Id'] > 1) {
				echo "<a class='btn btn-danger' href=index.php?strona=nauka&pytanie=$previous&zakres_struktury=podstawowy&kategoria=$category>Poprzednie</a> ";
			}

			echo "<a class='btn btn-success' href=index.php?strona=nauka&pytanie=$next&zakres_struktury=podstawowy&kategoria=$category>Następne</a>";
			echo "</div>";
			
		}

		function get_data_specjalistyczne($pytanieID) {
			global $con, $classNameA, $classNameB, $classNameC, $category;

			//get data from table pytania
			$sql = "SELECT * FROM pytania_specjalistyczne_$category WHERE Id=$pytanieID";
			$query = mysqli_query($con, $sql);

			$data_array = mysqli_fetch_array($query);
			$next = ($data_array['Id'])+1;
			$previous = ($data_array['Id']) - 1;

			//media
			$media = "data/{$data_array["Media"]}";

			echo
			"	
				<div id='questionAndAnswer'>
					<div id='video'>
						<object id='MediaPlayer' width=320 height=286 classid='CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95' standby='Loading Windows Media Player ...' type='application/x-oleobject' codebase='http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112'> 
						<param name='filename' value='data/$media'>
						<param name='Showcontrols' value='True'>
						<param name='autoStart' value='True'>
						<param name='wmode' value='transparent'>
						<embed type='application/x-mplayer2' src='data/$media' name='MediaPlayer' autoStart='True' wmode='transparent' width='320' height='286' ></embed>
						</object>
					</div>

					<div id='questionHolder'>
						<p id='question'>".$data_array['Pytanie']."</p>
					</div>
					<form id='specForm' method='POST'>
						<div id='buttonSpec'>
							<button type='submit' value='A' name='answer' class='$classNameA'>".$data_array['Odpowiedz_A']."</button>
							<button type='submit' value='B' name='answer' class='$classNameB'>".$data_array['Odpowiedz_B']."</button>
							<button type='submit' value='C' name='answer' class='$classNameC'>".$data_array['Odpowiedz_C']."</button>
						</div>
					</form>
				</div>
				";
			echo "<div id='navigationMenu'>";
			if($data_array['Id'] > 1) {
				echo "<a class='btn btn-danger navigation' href=index.php?strona=nauka&pytanie=$previous&zakres_struktury=specjalistyczny&kategoria=$category>Poprzednie</a> ";
			}

			echo "<a class='btn btn-success navigation' href=index.php?strona=nauka&pytanie=$next&zakres_struktury=specjalistyczny&kategoria=$category>Następne</a>";
			echo "</div>";
			
		}

		function zakres_button($zakres, $question, $category) {
			echo "<a id=".strtolower($zakres)." class='btn btn-primary' href='index.php?strona=nauka&pytanie=$question&zakres_struktury=".strtolower($zakres)."&kategoria=".$category."'>$zakres</a>";
		}

		function question_count() {
			global $con;

			$category = strtolower($_GET['kategoria']);

			//query row
			$row;

			//count all quesiton in table
			if($_GET['zakres_struktury'] == "podstawowy") {
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


		function set_answer_level($table) {
			global $con;

			//function to move question to diferents category

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








