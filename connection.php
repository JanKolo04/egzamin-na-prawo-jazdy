<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "egzaminy_na_prawo_jazdy";

    //connectiong with database
    $con = mysqli_connect($servername, $username, $password, $database);


    //checking conection
    if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    } 


?>