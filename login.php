<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-login.css">
	<title>Zaloguj się - Egzaminy na prawo jazdy</title>
</head>
<body>


	<div id="holder">
		<div id="textHolder">
			<h1>Login</h1>
		</div>
		<form method='POST'>
			<div id="inputsHolder">
				<div>
					<input type='text' name='login' id='login' placeholder='Login...'>
				</div>

				<div id="passwordHolder">
					<input type='password' name='passwd' id='passsword' placeholder='Hasło...'>
					<i class='bi bi-eye-slash' id='togglePassword'></i>
				</div>
			</div>

			<div id="CookieButtonHolder">
				<div id="cookieHolder">
					<label for="cookie">Zapamiętaj mnie</label>
					<input id="cookie" type="checkbox" name="cookie">
				</div>

				<div id="buttonHolder">
					<button type='submit' name='loginSubmit' id="button">Zaloguj</button>
				</div>
			</div>
		</form>
	</div>


	<?php


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
					//set cookie with user id
					setcookie("Id_user", $row['Id'], time() + (86400 * 30), "/");
					//move into main page
					header("Location: index.php?strona=main");
					
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

	<script>
		let button = document.getElementById('togglePassword');
		let input = document.getElementById('passsword');

		button.onclick = function() {
			if(input.type == 'password') {
				input.setAttribute('type', 'text');
				button.className = 'bi bi-eye';
			}
			else {
				input.setAttribute('type', 'password');
				button.className = 'bi bi-eye-slash';
			}
		}
	</script>

</body>
</html>