<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<?php

		function logout() {
			unset($_COOKIE['login']);
			//remove cookie
			setcookie('login', null, -1, '/');
			header("Location: index.php");
		}

		logout();

	?>

</body>
</html>