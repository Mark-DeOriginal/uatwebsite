<?php
    require_once "config.php";

    // Let's provide our connection details
    $host = host;
    $username = username;
    $password = password;
    $dbname = database_name;

    //  Connect to the database with our connection details
    $conn = mysqli_connect($host, $username, $password, $dbname);
?>