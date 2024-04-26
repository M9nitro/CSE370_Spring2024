<?php
session_start();
//Validate if user is logged in
if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("location: destroy_session.php");
    exit();
    
}

if(time() - $_SESSION['timestamp'] > 900) { 
    header("location: destroy_session.php");
    exit();
} else {
    $_SESSION['timestamp'] = time(); //set new timestamp
}


?>