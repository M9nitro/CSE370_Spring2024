<?php
require_once('DB_connect.php');
require_once('session.php');






if (isset($_POST['add_adopt'])) {

    $PetID = $_SESSION['PetID'];
    $adopteeID = $_SESSION['adopteeID'];
    $sql_0 = "INSERT INTO Request_adoptation (petID, adminID, adopteeID, status) VALUES ('$PetID', 'admin','$adopteeID', 'pending');";
    
    $result_0 = mysqli_query($conn, $sql_0);

    if (mysqli_affected_rows($conn) > 0) {
        
        header ("Location: adopt.php");
    }
    else {
        header("Location: homepage.php");

    }

    }
?>