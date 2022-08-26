<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Strona</title>
</head>
<body>

	<?php

		include("connection.php");

		function main() {
			global $con;

			$sql = "SELECT DISTINCT Media FROM pytania_podstawowe WHERE Media LIKE '%wmv%'";
			$query = mysqli_query($con, $sql);


			$array_podst = [];

			$count = 0;
			while($row = mysqli_fetch_array($query)) {
				$array_podst[$count] = ["Media"=>$row['Media']];
				$count++;
			}



			$fp = fopen('media.txt', 'w');
			for($i=0; $i<sizeof($array_podst); $i++) {
				echo "1";
				fwrite($fp, $array_podst[$i]['Media']."\n");
			}

			fclose($fp);


		}

		main();


		#W15 3.wmv
	?>

</body>
</html>