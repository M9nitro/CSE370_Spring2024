<?php
require_once('session.php');
require_once('DB_connect.php');
?>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Furever Pet Center</title>
  <link rel = "stylesheet" href = "rescue.css">
</head>
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
       echo "<li><a href='#'>Gift a pet </a></li>";
       echo "<li><a href='#'>Donate</a></li>";
       echo "<li><a href='#'>Review</a></li>";

       }
       else{
        echo "<li><a href='rescue.php'>Rescue</a></li>";
        echo "<li><a href='adopt.php'>Adopt</a></li>";
        
        echo "<li><a href='user.php'>Users</a></li>";
        echo "<li><a href='approve.php'>Approve</a></li>";
       }
       ?>
       
       <li class = "logout" ><a href="destroy_session.php">Log out</a></li>
       
     </ul>
   </div>
</div>
<!-- NavBar End -->

<div class ="rescue-form">
<img  src="./img/Rescue.png" alt=""><br><br>
<h2>Rescue registration portal</h2>
<form class="rescue" action="rescue_process.php" method="post">
    <input class = "grid" type="text" placeholder="Pet ID" name="petID" required>
    <input class = "grid" type="text" placeholder="Rescuer ID" name="rescuerID" required>
    <input class = "grid" type="text" placeholder="Pet Name" name="pet_name" required>
    <input class = "grid" type="text" placeholder="Pet Type" name="pet_type" required>
    <input class = "grid" type="text" placeholder="Pet Breed" name="pet_breed" required>
    <input class = "grid" type="text" placeholder="Pet Age" name="pet_age" required>
    <input class = "grid" type="text" placeholder="Past Owners (Write them separated by space)" name="past_owners" required>
    <input class = "grid" type="text" placeholder="Vet Report" name="vet_report" required><br><br>
    <input class = 'button' type ="submit" value = "Rescue">
</form>


</div>


</body>

<footer>
</footer>
