<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style-index.css">

	<!-----PLUGINS----->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

	<header id="baner">
		<a href="index.php" id="logo">Egzaminy na prawo jazdy</a>
	</header>


	<?php

		$page = "login";
		if(isset($_GET['strona'])) {
			$page = $_GET['strona'];
		}

	?>

	<div id="pageHolder">
		<?php

			include($page.".php");

		?>
	</div>


	<footer id="footer">
		<div id="infoDiv">
			<p><strong>Administrator</strong><br>Jan Kołodziej<br>jankolodziej99@gmail.com</p>
		</div>

		<div id="autorDiv">
			<p id="autor"><strong>Autor Jan Kołodziej</strong></p>
		</div>
	</footer>

</body>
</html>