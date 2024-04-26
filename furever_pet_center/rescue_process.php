<?php
require_once('DB_connect.php');

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
    if("Cat" == $_POST[$string]){
        return 0;
    }
    else if ("Dog" == $_POST[$string]) {
        return 1;
    }
    else {
        return 2;
    } 
}


if (isset($_POST['petID']) && isset($_POST['pet_type']) && isset($_POST['rescuerID']) && isset($_POST['pet_name']) && isset($_POST['vet_report']) && isset($_POST['pet_age']) && isset($_POST['pet_breed']) && isset($_POST['past_owners'])) {
echo "hello";
$petID = $_POST['petID'];
$pet_type = who('pet_type');
$rescuerID = $_POST['rescuerID'];
$pet_name = $_POST['pet_name'];
$vet_report = nullORnot('vet_report');
$pet_age = $_POST['pet_age'];
$pet_breed = $_POST['pet_breed'];
$rescue_date = date("Y-m-d");
$pet_owners = explode(" ", $_POST['past_owners']);


$sql_rescuer_check = "SELECT * FROM user WHERE userID = '$rescuerID'";
$verify = mysqli_num_rows(mysqli_query($connection_status, $sql_rescuer_check));

$sql_check = "SELECT * FROM pet WHERE petID = '$petID'";
$count = mysqli_num_rows(mysqli_query($connection_status, $sql_check));

if ($count > 0 || $verify == 0) {

    echo "<script>
       alert('Set New user name or No such rescuer Found');
       console.log('Set New user name or No such rescuer Found');
    </script>";
    
    header("Location: rescue.php");
     exit();
}


$sql = " INSERT INTO pet VALUES ( '$petID',  '$rescuerID',  '$pet_name', '$pet_age', '$pet_breed', '$pet_type', '$vet_report', '$rescue_date') ";

//Execute the query 
$result = mysqli_query($connection_status, $sql);

for($x = 0; $x < sizeof($pet_owners); $x++){
    $sql = "INSERT INTO past_petowner VALUES('$petID', '$pet_owners[$x]');";
    $result = mysqli_query($connection_status, $sql);
}
//check if this insertion is happening in the database
if(mysqli_affected_rows($connection_status)){
	
    echo "<script>alert('Inserted Successfully')</script>";
    header("Location: rescue.php");
}
else{
    echo '<script>alert("Pet Already exits! or invalid input")</script>'; 
    header("Location: rescue.php");
}

}

?>






