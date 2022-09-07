<?php
	
		//includes
		include("buttons_save.php");
		include("answer.php");

		if($_GET['znajomosc'] == "dobra") {
			if($zakres_struktury == "podstawowy") {
				get_data_podstawowe($Id_question);
			}
			else {
				get_data_specjalistyczne($Id_question);
			}
		}
		else {
			if($zakres_struktury == "podstawowy") {
				get_data_podstawowe($_GET['pytanie']);
			}
			else {
				get_data_specjalistyczne($_GET['pytanie']);
			}
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

?>