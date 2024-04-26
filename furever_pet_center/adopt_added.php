<?php
require_once('DB_connect.php');
require_once('session.php');






if (isset($_POST['add_adopt'])) {

    $PetID = $_SESSION['PetID'];
    $adopteeID = $_SESSION['adopteeID'];
    $sql_0 = "INSERT INTO Request_adoptation (petID, adminID, adopteeID, status) VALUES ('$PetID', 'U006','$adopteeID', 'pending');";
    
    $result_0 = mysqli_query($connection_status, $sql_0);

    if (mysqli_affected_rows($connection_status) > 0) {
        
        header ("Location: adopt.php");
    }
    else {
        header("Location: homepage.php");

    }

    }
?>