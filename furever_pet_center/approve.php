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
    <link rel = "stylesheet" href = "approve.css">
    
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

 

  <div class = "approve-portal">
  <img src= "./img/damn.png" height = "80px" width = "120px" >
    <h2>Pet Details</h2>
        <div class = "items">
        <?php 

            if ($_SESSION['user_type'] != 0){
              header("Location: homepage.php");
              exit();
            }

            $fetch_approve = "SELECT * FROM request_adoptation WHERE status = 'pending' limit 1;";
            $fetch_result = mysqli_query($connection_status, $fetch_approve);
            $fetch_count = mysqli_num_rows($fetch_result);
            if ($fetch_count == 0){
              echo "<h3>No pending requests</h3>";
            }
            else {
                $array = mysqli_fetch_assoc($fetch_result);
                $animal_query = "SELECT * FROM pet WHERE petID = '" . $array['petID'] . "';";
                $_SESSION['petID'] = $array['petID'];

                $result = mysqli_query($connection_status, $animal_query);
                $row = mysqli_fetch_assoc($result);
                echo "<p>Pet Name: " . $row['pet_name'] . "</p>";
                echo "<p>Pet Type: " . detype($row['pet_type']) . "</p>";
                echo "<p>Pet Breed: " . $row['pet_Breed'] . "</p>";
                echo "<p>Pet Age: " . $row['pet_age'] . "</p>";
                echo "<p>Rescuer ID: " . $row['rescuerID'] . "</p>";
                echo "<p>Adoptee ID: " . $array['adopteeID'] . "</p>";

            }
            ?> 

                <form action = "approve_process.php" method = "POST">
                <input type = "submit" name = "approve" value = "Approve">
                <input type = "submit" name = "reject" value = "Reject">
        </form>



        </div>
  </div>

  </body>

</head>
