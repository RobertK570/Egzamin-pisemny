<?php
    $link = mysqli_connect("localhost", "root", "", "egzamin");
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
        echo "Bląd połączenia z bazą danych!";
    }
?>