<?php
  require_once('session.php');
  require_once('DB_connect.php');

  function detype($pet_type){
    if ($pet_type == 1){
      return "Dog";
    }
    else if ($pet_type == 0){
      return "Cat";
    }
    else {
      return "Rabbit";
    }
  }
  ?>


  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furever Pet Center</title>
    <link rel = "stylesheet" href = "adopt.css">
    
  <body>
  <!--NavBar -->
  <div class="navbar">
    <div class="nav-logo">
      <a href="homepage.php">
        <img class="logo-img" src="./img/logo.png" alt="">
      </a>
      </div>
    <div class="nav-items">
      <ul>
      <li><a href="browse.php">Browse</a></li>
      <?php $type = $_SESSION['user_type'];
        if ($type == 2) {
          echo "<li><a href='adopt.php'>Adopt</a></li>";
        }
        else if ($type == 1) {
          echo "<li><a href='rescue.php'>Rescue</a></li>";
        }

       if ($type != 0) {
       
       echo "<li><a href='donation.php'>Donate</a></li>";
       echo "<li><a href='review.php'>Review</a></li>";

       }
       else{
        echo "<li><a href='rescue.php'>Rescue</a></li>";
        echo "<li><a href='adopt.php'>Adopt</a></li>";
        echo "<li><a href='admin_gift.php'>Inventory</a></li>";
        echo "<li><a href='user.php'>Users</a></li>";
        echo "<li><a href='approve.php'>Approve</a></li>";
       }
       ?>
        
        <li class = "logout" ><a href="destroy_session.php">Log out</a></li>
        
      </ul>
    </div>
  </div>
  <!-- NavBar End -->

 

  <div class = "adopt-portal">
  <img src= "./img/damn.png" height = "80px" width = "120px" >
    <h2>Pet Details</h2>
        <div class = "items">
        <?php 

        if(isset($_POST['PetID'])) {
          $PetID = $_POST['PetID'];
          $sql = "SELECT pet_name, pet_age, pet_type, pet_breed, rescuerID FROM pet WHERE petID = '$PetID';";
          
          $result = mysqli_query($connection_status, $sql);
          
          $resultCheck = mysqli_num_rows($result);
          
          if ($resultCheck > 0) { $petdetails = mysqli_fetch_assoc($result);
            $petdetails['pet_type'] = detype($petdetails['pet_type']);
            $sql = "SELECT user_address FROM user WHERE userID = '$petdetails[rescuerID]';";
            $location = mysqli_fetch_assoc(mysqli_query($connection_status, $sql));

            $sql_found = "SELECT status FROM request_adoptation WHERE petID = '$PetID';";
            $found_result = mysqli_query($connection_status, $sql_found);
            $found = mysqli_num_rows($found_result);
          
            $sql_exist = "SELECT * FROM request_adoptation WHERE adopteeID = '$_SESSION[userID]';";
            $exist_result = mysqli_query($connection_status, $sql_exist);
            $exist = mysqli_num_rows($exist_result);


            $adoptee = $_SESSION['userID'];
            $_SESSION['PetID'] = $PetID;
            $_SESSION['adopteeID'] = $adoptee;

            $add_adopt = "INSERT INTO request_adoptation (petID, adminID, adopteeID, status) VALUES ('$PetID', 'Dummy' ,'$adoptee' , 'pending');";
            
            echo "<p>Pet ID: " . $PetID . "</p>";
            echo "<p>Pet Name: " . $petdetails['pet_name'] . "</p>";
            echo "<p>Pet Age: " . $petdetails['pet_age'] . "</p>";
            echo "<p>Pet Breed: " . $petdetails['pet_breed'] . "</p>";
            echo "<p>Pet Type: " . $petdetails['pet_type'] . "</p>";
            echo "<p>Location: " . $location['user_address'] . "</p>";

            if($_SESSION['user_type'] == 2 and !$found and !$exist ) {

              echo "<form action = 'adopt_added.php' method = 'post'>
              <input type = 'submit' name = 'add_adopt' value = 'Adopt'>
            </form>";
            }
            
            ?> 
           
        <?php }
      else { ?>

        <h4>Pet ID not found</h4>   
        <?php      
            }
            }
        ?>

        
        </div>
  </div>

  </body>

</head>
