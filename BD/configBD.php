<?php
    //$host = "sql313.infinityfree.com";
    //$user = "if0_34354190";
    //$password = "laf1Ajt2D0X";
    //$database = "if0_34354190_code";

    $host = "localhost";
    $user = "root";
    $password = ""; // Deixe em branco se não tiver senha
    $database = "if0_34354190_code";

    $con = new mysqli($host, $user, $password, $database);

    if ($con->connect_errno) {
        echo "Failed to connect to MySQL: " . $con->connect_error;
    }    
?>