<?php
session_start();
session_unset();
unset($_SESSION['logged_in']);
session_destroy();
header("location: index.html");
?>