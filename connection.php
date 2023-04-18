<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "foodgorilla_db";

    if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
        die("Failed to connect!!!!");                           //error dite pare tai if er vitor rakhlam
    }
?>