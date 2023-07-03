<?php 
    include "database-connect.php";
    $sql = "SELECT * FROM contact_information WHERE Id = '1' LIMIT 1";
    $contact_info = mysqli_fetch_assoc(mysqli_query($conn, $sql));
?>