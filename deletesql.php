<?php

    include 'conn.php';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $id_borrar= $_GET['id'];
    // Query to check if the email already exist
    $registros = "Delete From users Where id=".$id_borrar;

    // Variable $result hold the connection data and the query
    $result = $conn-> query($registros);
    mysqli_close($conn);

   header('Location: edit-profile.php');


?>