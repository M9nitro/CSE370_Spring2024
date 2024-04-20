<?php
// first of all, we need to connect to the database
require_once('DB_connect.php');


// we need to check if the input in the form textfields are not empty
if(isset($_POST['userID']) && isset($_POST['pass'])){
	// write the query to check if this username and password exists in our database
	$user = $_POST['userID'];
	$pass = $_POST['pass'];
	$sql_query = "SELECT * FROM user WHERE userID = '$user' AND user_password = '$pass'";
	
	//Execute the query 
	$result = mysqli_query($conn, $sql_query);
	
	//check if it returns an empty set
	if(mysqli_num_rows($result) !=0 ){
	
		// echo "LET HIM ENTER";
		header("Location: homepage.html");
	}
	else{
		echo "Username or Password is wrong";
		header("Location: index.php");
	}
	
}


?>
