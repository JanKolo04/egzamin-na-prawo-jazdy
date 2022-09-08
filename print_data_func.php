<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Strona</title>
</head>
<body>

	<?php

		function navigation_buttons($class, $question, $zakres, $category, $innerHTML) {
			if(isset($_GET['poziom'])) {
				echo "<a class='$class' href=index.php?strona=level-question&pytanie=$question&zakres_struktury=$zakres&kategoria=$category&poziom={$_GET['poziom']}>$innerHTML</a> ";
			}
			else {
				echo "<a class='$class' href=index.php?strona=nauka&pytanie=$question&zakres_struktury=$zakres&kategoria=$category>$innerHTML</a> ";
			}
		}

		function nauka_button($question, $category) {
			echo "<a class='btn btn-primary' href='index.php?strona=nauka&pytanie=$question&zakres_struktury=podstawowy&kategoria=".$category."'>Nauka</a>";
		}

	?>

</body>
</html>