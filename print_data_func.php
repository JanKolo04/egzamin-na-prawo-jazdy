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

		function nauka_button($page, $question, $category, $level) {
			echo "<a class='btn btn-primary' href='index.php?strona=$page&pytanie=$question&zakres_struktury=podstawowy&kategoria=".$category."&poziom=$level'>Nauka</a>";
		}



		function rate_category() {
			//arrays with categories and undercategories
			$category_array = ['A','B','C','D','T'];
			$other_category_array = [', A1', ', B1 BE', ', CE C1', ', C1E', ', D1', ', DE'];

			//check which indercategory contain category char
			for($i=0; $i<sizeof($category_array); $i++) {
				echo "<a id='rateCategories' href='index.php?strona=main'>Kategorie: $category_array[$i]";
				for($y=0; $y<sizeof($other_category_array); $y++) {
					//if udner category contain char form category print undercategory
					if(str_contains($other_category_array[$y], $category_array[$i])) {
						echo $other_category_array[$y];
					}
				}
				echo "</a>";
			}
		}

	?>

</body>
</html>