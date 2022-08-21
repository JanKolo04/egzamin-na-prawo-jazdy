<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-nauka.css">
	<title>Nauka - Egzaminy na prawo jazdy</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

	<div id="main">
	<?php
	
		//includes
		include("connection.php");
		include("additional_function.php");
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
						<object id='MediaPlayer' width=320 height=286 classid='CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95' standby='Loading Windows Media Player ...' type='application/x-oleobject' codebase='http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112'> 
						<param name='filename' value='data/$media'>
						<param name='Showcontrols' value='True'>
						<param name='autoStart' value='True'>
						<param name='wmode' value='transparent'>
						<embed type='application/x-mplayer2' src='data/$media' name='MediaPlayer' autoStart='True' wmode='transparent' width='320' height='286' ></embed>
						</object>

						<p>".$data_array['Pytanie']."</p></br>
						<form method='POST'>
							<button type='submit' value='T' name='answer' class='$classNameT'>Tak</button>
							<button type='submit' value='N' name='answer' class='$classNameN'>Nie</button>
						</form>
					</div>
				";

			echo "<div id='navigationMenu'>";
			if($data_array['Id'] > 1) {
				echo "<a class='btn btn-danger' href=nauka.php?pytanie=$previous&zakres_struktury=podstawowy&kategoria=B>Poprzednie</a> ";
			}

			echo "<a class='btn btn-success' href=nauka.php?pytanie=$next&zakres_struktury=podstawowy&kategoria=B>Następne</a>";
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
				"	<form method='POST'>
						<div id='questionAndAnswer'>
							<p>".$data_array['Pytanie']."</p>
							<button type='submit' value='A' name='answer' class='$classNameA'>".$data_array['Odpowiedz_A']."</button>
							<button type='submit' value='B' name='answer' class='$classNameB'>".$data_array['Odpowiedz_B']."</button>
							<button type='submit' value='C' name='answer' class='$classNameC'>".$data_array['Odpowiedz_C']."</button>
						</div>
					</form>
				";
			echo "<div id='navigationMenu'>";
			if($data_array['Id'] > 1) {
				echo "<a class='btn btn-danger navigation' href=nauka.php?pytanie=$previous&zakres_struktury=specjalistyczny&kategoria=B>Poprzednie</a> ";
			}

			echo "<a class='btn btn-success navigation' href=nauka.php?pytanie=$next&zakres_struktury=specjalistyczny&kategoria=B>Następne</a>";
			echo "</div>";
			
		}


	?>

		<div id="holderForA">
			<div id="categoryButtons">
				<a class="btn btn-primary" id="podstawowy" href=nauka.php?pytanie=1&zakres_struktury=podstawowy&kategoria=B>Podstawowy</a>
				<a class="btn btn-primary" id="specjalistyczny" href=nauka.php?pytanie=1&zakres_struktury=specjalistyczny&kategoria=B>Specjalistyczny</a>
			</div>
			<form method="POST">
				<div>
					<button class="btn btn-secondary" type="submit" name="save">Zapamiętaj</button>
				</div>
			</form>
		</div>

		<a href="logout.php">Wyloguj się</a>
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
		let holderForA = document.querySelector("#holderForA");
		holderForA.appendChild(document.querySelector("#navigationMenu"));

	

	</script>
	

</body>
</html>








