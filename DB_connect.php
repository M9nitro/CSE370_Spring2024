<?php

//Credentials 
$DBserver = "localhost";
$username = "root";
$password = "";
$DBname = "furever_370";

//Creating Connection
$connection_status = new mysqli($DBserver, $username, $password);

//Check Connection Status
if ($connection_status->connect_error){
    die("Connection Failed: ". $connection_statuss->connect_error);
}
else{
    mysqli_select_db($connection_status, $DBname);
    echo "Horayy!";
}


?>