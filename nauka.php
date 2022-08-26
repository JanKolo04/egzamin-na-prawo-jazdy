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
		include("connection.php");
		include("save_current_question.php");
		include("answer.php");

		//global varaibles
		$pytanieID = $_GET['pytanie'];
		$zakres_struktury = $_GET['zakres_struktury'];

		if($zakres_struktury == "podstawowy") {
			get_data_podstawowe();
		}
		else {
			get_data_specjalistyczne();
		}

		function get_data_podstawowe() {
			global $con, $pytanieID, $classNameT, $classNameN;

			//get data from table pytania
			$sql = "SELECT * FROM pytania_podstawowe WHERE Id=$pytanieID";
			$query = mysqli_query($con, $sql);

			$data_array = mysqli_fetch_array($query);
			$next = ($data_array['Id'])+1;
			$previous = ($data_array['Id']) - 1;

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
				echo "<a class='btn btn-danger' href=index.php?strona=nauka&pytanie=$previous&zakres_struktury=podstawowy&kategoria=B>Poprzednie</a> ";
			}

			echo "<a class='btn btn-success' href=index.php?strona=nauka&pytanie=$next&zakres_struktury=podstawowy&kategoria=B>Następne</a>";
			echo "</div>";
			
		}

		function get_data_specjalistyczne() {
			global $con, $pytanieID, $classNameA, $classNameB, $classNameC;

			//get data from table pytania
			$sql = "SELECT * FROM pytania_specjalistyczne WHERE Id=$pytanieID";
			$query = mysqli_query($con, $sql);

			$data_array = mysqli_fetch_array($query);
			$next = ($data_array['Id'])+1;
			$previous = ($data_array['Id']) - 1;

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
				echo "<a class='btn btn-danger navigation' href=index.php?strona=nauka&pytanie=$previous&zakres_struktury=specjalistyczny&kategoria=B>Poprzednie</a> ";
			}

			echo "<a class='btn btn-success navigation' href=index.php?strona=nauka&pytanie=$next&zakres_struktury=specjalistyczny&kategoria=B>Następne</a>";
			echo "</div>";
			
		}


	?>

		<div id="buttonsHolder">
			<div id="categoryButtons">
				<a class="btn btn-primary" id="podstawowy" href=index.php?strona=nauka&pytanie=1&zakres_struktury=podstawowy&kategoria=B>Podstawowy</a>
				<a class="btn btn-primary" id="specjalistyczny" href=index.php?strona=nauka&pytanie=1&zakres_struktury=specjalistyczny&kategoria=B>Specjalistyczny</a>
			</div>
			<form method="POST">
				<div>
					<button id="save" class="btn btn-secondary" type="submit" name="save">Zapamiętaj</button>
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








