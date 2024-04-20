<?php
// first of all, we need to connect to the database
require_once('DB_connect.php');
require_once('session.php');

// we need to check if the input in the form textfields are not empty
function nullORnot($string){
    if (isset($_POST[$string])) {
        if (empty($_POST[$string])) {
            return NULL;
        } else { 
            return $_POST[$string];
        }
    }
}

// Determine the type of user
function who($string){
    if("Admin" == $_POST[$string]){
        return 0;
    }
    else if ("Rescuer" == $_POST[$string]) {
        return 1;
    }
    else {
        return 2;
    } 
}




// we need to check if the input in the form textfields are not empty
if(isset($_POST['userID']) && isset($_POST['user_name']) && isset($_POST['user_NID']) && isset($_POST['pass']) && isset($_POST['user_type'])){
	// write the query to check if this username and password exists in our database
	$userID       = $_POST['userID'];
	$user_name    = $_POST['user_name'];
	$user_nid     = $_POST['user_NID'];
	$pass         = $_POST['pass'];
    $user_type    = $_POST['user_type'];
    $user_email   = nullORnot('user_email');
    $user_phone   = nullORnot('user_phone');
    $user_address = nullORnot('user_address');
    $user_DOB     = NULL;
	
	$sql = " INSERT INTO user VALUES ( '$userID', '$user_name', '$user_nid', '$pass', '$user_DOB',  '$user_phone', '$user_email', '$user_address', '$user_type' ) ";
	
	//Execute the query 
	$result = mysqli_query($conn, $sql);
	
	//check if this insertion is happening in the database
	if(mysqli_affected_rows($conn)){
	
		//echo "Inserted Successfully";
		header("Location: index.html");
	}
	else{
        echo "<script>alert('User Already Exists')</script>";
		header("Location: index.html");
	}
	
}


?>