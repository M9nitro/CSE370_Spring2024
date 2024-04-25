<?php
session_start();
//Validate if user is logged in
if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: index.html");
    exit();
    
}

if(time() - $_SESSION['timestamp'] > 900) { 
    session_destroy();
} else {
    $_SESSION['timestamp'] = time(); //set new timestamp
}


?>