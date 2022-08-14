<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-index.css">
	<title>Egzaminy na prawo jazdy</title>
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

			echo
				"	
					<div id='questionAndAnswer'>				
						<p>".$data_array['Pytanie']."</p></br>
						<button class='answer'>Tak</button>
						<button class='answer'>Nie</button>
					</div>
				";

			if($data_array['Id'] > 1) {
				echo "<a class='btn btn-danger' href=index.php?pytanie=$previous&zakres_struktury=specjalistyczny>Poprzednie</a> ";
			}

			echo "<a class='btn btn-success' href=index.php?pytanie=$next&zakres_struktury=podstawowy>Następne</a>";
			
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

			if($data_array['Id'] > 1) {
				echo "<a class='btn btn-danger' href=index.php?pytanie=$previous&zakres_struktury=specjalistyczny>Poprzednie</a> ";
			}

			echo "<a class='btn btn-success' href=index.php?pytanie=$next&zakres_struktury=specjalistyczny>Następne</a>";
			
		}


	?>

		<div id="holderForA">
			<div id="navigationButtons">
				<a class="btn btn-primary" id="podstawowy" href=index.php?pytanie=1&zakres_struktury=podstawowy>Podstawowy</a>
				<a class="btn btn-primary" id="specjalistyczny" href=index.php?pytanie=1&zakres_struktury=specjalistyczny>Specjalistyczny</a>
			</div>
		</div>
	</div>




	<script type="text/javascript">
		
		function change_button_color() {
			let zakres = <?php echo json_encode($zakres_struktury); ?>;
			console.log(zakres);
			if(zakres == "podstawowy") {
				document.querySelector("#podstawowy").style="background-color: grey !important;";
			}
			else {
				document.querySelector("#specjalistyczny").style="background-color: grey !important;";
			}
		}

		function add_all_a_to_div() {
			let holderForA = document.querySelector("#holderForA");
			let a = document.querySelectorAll("a");

			for(let i=0; i<a.length; i++) {
				holderForA.appendChild(a[i]);
			}
		}

		change_button_color();
		add_all_a_to_div();

	</script>
	

</body>
</html>








