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
	
		include("connection.php");

		$pytanieID = $_GET['pytanie'];
		$zakres_struktury = $_GET['zakres_struktury'];

		if($zakres_struktury == "podstawowy") {
			get_data_podstawowe();
		}
		else {
			get_data_specjalistyczne();
		}

		function get_data_podstawowe() {
			global $con, $pytanieID;

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
						<button class='answer'>Tak</button>
						<button class='answer'>Nie</button>
					</div>
				";

			echo "<div id='navigationMenu'>";
			if($data_array['Id'] > 1) {
				echo "<a class='btn btn-danger' href=nauka.php?pytanie=$previous&zakres_struktury=podstawowy>Poprzednie</a> ";
			}

			echo "<a class='btn btn-success' href=nauka.php?pytanie=$next&zakres_struktury=podstawowy>Następne</a>";
			echo "</div>";
			
		}

		function get_data_specjalistyczne() {
			global $con, $pytanieID;

			//get data from table pytania
			$sql = "SELECT * FROM pytania_specjalistyczne WHERE Id=$pytanieID";
			$query = mysqli_query($con, $sql);

			$data_array = mysqli_fetch_array($query);
			$next = ($data_array['Id'])+1;
			$previous = ($data_array['Id']) - 1;

			echo
				"	
					<div id='questionAndAnswer'>	
						<p>".$data_array['Pytanie']."</p></br>
						<button class='answer'>".$data_array['Odpowiedz_A']."</button>
						<button class='answer'>".$data_array['Odpowiedz_B']."</button>
						<button class='answer'>".$data_array['Odpowiedz_C']."</button>
					</div>
				";
			echo "<div id='navigationMenu'>";
			if($data_array['Id'] > 1) {
				echo "<a class='btn btn-danger navigation' href=nauka.php?pytanie=$previous&zakres_struktury=specjalistyczny>Poprzednie</a> ";
			}

			echo "<a class='btn btn-success navigation' href=nauka.php?pytanie=$next&zakres_struktury=specjalistyczny>Następne</a>";
			echo "</div>";
			
		}


	?>

		<div id="holderForA">
			<div id="categoryButtons">
				<a class="btn btn-primary" id="podstawowy" href=nauka.php?pytanie=1&zakres_struktury=podstawowy>Podstawowy</a>
				<a class="btn btn-primary" id="specjalistyczny" href=nauka.php?pytanie=1&zakres_struktury=specjalistyczny>Specjalistyczny</a>
			</div>
		</div>
	</div>




	<script type="text/javascript">
		
		function change_button_color() {
			let zakres = <?php echo json_encode($zakres_struktury); ?>;

			if(zakres == "podstawowy") {
				document.querySelector("#podstawowy").style="background-color: grey !important;";
			}
			else {
				document.querySelector("#specjalistyczny").style="background-color: grey !important;";
			}
		}
				
		change_button_color();
		
		//add div into another div
		let holderForA = document.querySelector("#holderForA");
		holderForA.appendChild(document.querySelector("#navigationMenu"));
	

	</script>
	

</body>
</html>








