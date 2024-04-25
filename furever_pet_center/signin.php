<?php
// first of all, we need to connect to the database
require_once('DB_connect.php');
session_start();


// we need to check if the input in the form textfields are not empty
if(isset($_POST['userID']) && isset($_POST['pass'])){
	// write the query to check if this username and password exists in our database
	$user = $_POST['userID'];
	$pass = $_POST['pass'];
	$sql_query = "SELECT * FROM user WHERE userID = '$user' AND user_password = '$pass'";
	
	//Execute the query 
	$result = mysqli_query($conn, $sql_query);
	
	echo mysqli_num_rows($result);
	

	//check if it returns an empty set
	if(mysqli_num_rows($result) !=0 ){

		echo mysqli_num_rows($result);
		$array = mysqli_fetch_assoc($result);
		
		// echo "LET HIM ENTER";
		$_SESSION['userID'] = $user;
		$_SESSION['pass'] = $pass;
		$_SESSION['user_type'] = $array['user_type'];
		$_SESSION['logged_in'] = true;
		$_SESSION['timestamp'] = time();
		

		header("Location: homepage.php");
	}
	else{
		echo "Username or Password is wrong";
		header("Location: index.html");
	}
	
}


?>
