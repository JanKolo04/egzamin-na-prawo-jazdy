<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Zaloguj się - egzaminy na prawo jazdy</title>
</head>
<body>


	<div>
		<form method="POST">
			<input type="text" name="login" placeholder="Login...">
			<input type="password" name="passwd" placeholder="Hasło...">
			
			<br><button type="submit" name="loginSubmit">Submit</button>

			<br><label for="cookie">Zapamiętaj mnie</label>
			<input id="cookie" type="checkbox" name="cookie">
		</form>
	</div>


	<?php

		include("connection.php");

		if(isset($_COOKIE['login'])) {
			header("Location: nauka.php?pytanie=1&zakres_struktury=podstawowy");
		}

		if(isset($_POST['loginSubmit'])) {
			check_data();
		}

		if(isset($_POST['cookie'])) {
			//set login cookie
			setcookie("login", "$login", time() + (86400 * 30), "/"); // 86400 = 1 day
		}

		function get_data() {
			global $login;
			//get login
			$login = $_POST['login'];
			//password
			$passwd = $_POST['passwd'];

			$data = [
				"Login"=>$login,
				"Passwd"=>$passwd
			];

			return $data;
		}

		function check_data() {
			global $con;

			$user_data = get_data();


			$sql = "SELECT * FROM users WHERE Login='{$user_data['Login']}'";
			$query = mysqli_query($con, $sql);


			if($query->num_rows != 0) {
				$row = mysqli_fetch_array($query);
				if($user_data['Passwd'] == $row['Password']) {
					header("Location: nauka.php?pytanie=1&zakres_struktury=podstawowy");
				}
				else {
					echo "Hasło niepoprawne!";
				}
			}
			else {
				echo "Login nieprawidłowy!";
			}
		}

	?>

</body>
</html>