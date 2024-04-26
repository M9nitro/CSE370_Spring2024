<?php
    require_once('session.php');
    require_once('DB_connect.php');

    if(isset($_POST['approve'])) {
        $approve_sql = "DELETE FROM pet WHERE petID = '{$_SESSION['petID']}';";
        $approve_query = mysqli_query($connection_status, $approve_sql);
        unset($_SESSION['petID']);
        header("Location: congrates.php");
        exit(); // Add exit() to prevent further execution
    }

    if(isset($_POST['reject'])) {
        $reject_sql = "DELETE FROM request_adoptation WHERE petID = '{$_SESSION['petID']}';";
        $reject_query = mysqli_query($connection_status, $reject_sql);
        unset($_SESSION['petID']);
        header("Location: approve.php");
        exit(); // Add exit() to prevent further execution
    }
?>
