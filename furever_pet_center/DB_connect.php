<?php

//Credentials 
$DBserver = "localhost";
$username = "root";
$password = "";
$DBname = "furever_370";

//Creating Connection
$conn = new mysqli($DBserver, $username, $password);

//Check Connection Status
if ($conn->connect_error){
    die("Connection Failed: ". $conn->connect_error);
}
else{
    mysqli_select_db($conn, $DBname);
    echo "Database Can be accessed";
    echo "";
}
?>