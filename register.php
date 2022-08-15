<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Zareejstruj się - Egzamin na prawo jazdy</title>
</head>
<body>

	<div>
		<form method="POST">
			<input type="text" name="Imie" placeholder="Imie...">
			<input type="text" name="Nazwisko" placeholder="Nazwisko...">
			<input type="email" name="Email" placeholder="Email...">
			<input type="text" name="Login" placeholder="Login...">
			<input type="password" name="Passwd" placeholder="Password...">

			<button type="submit" name="submitRegister">Submit</button>
		</form>
	</div>


	<?php

		include("connection.php");

		if(isset($_POST['submitRegister'])) {
			check_data();
		}


		function get_data() {
			//array with data
			$data = [
				"Name" => $_POST['Imie'],
				"Lastname"=>$_POST['Nazwisko'],
				"Email"=>$_POST['Email'],
				"Login"=>$_POST['Login'],
				"Passwd"=>$_POST['Passwd']
			];

			return $data;
		}

		function check_data() {
			global $con;
			//user data
			$user_data = get_data();

			//if user data exist with email or login return 0 value
			//check
			$sql = "SELECT * FROM users WHERE Email='{$user_data['Email']}' OR Login='{$user_data['Login']}'";
			$query = mysqli_query($con, $sql);

			$query_data = mysqli_fetch_array($query);

			if($query->num_rows == 0) {
				$insert = "INSERT INTO users(Imie, Nazwisko, Email, Login, Password) VALUES('{$user_data['Name']}','{$user_data['Lastname']}','{$user_data['Email']}','{$user_data['Login']}','{$user_data['Passwd']}')";
				$insert_query = mysqli_query($con, $insert);
			}
			else {
				if($query_data['Login'] == $user_data['Login']) {
					echo "Istnieje użytkownik o tym loginie";
				}
				else {
					echo "Isnieje użytkonik o tym emailu";
				}
			}
		}

	?>


</body>
</html>