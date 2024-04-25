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
       <li><a href="rescue.php">Rescue </a></li>
       <li><a href="adopt.php">Adopt </a></li>
       <li><a href="#">Gift a pet </a></li>
       <li><a href="#">Donate </a></li>
       <li><a href="#">Review</a></li>
       <li><a href="#">Approve</a></li>
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
    <input class = "grid" type="date" placeholder="Rescue Date" name="rescue_date" required>
    <input class = "grid" type="text" placeholder="Vet Report" name="vet_report" required><br><br>
    <input class = 'button' type ="submit" value = "Rescue">
</form>


</div>


</body>

<footer>
</footer>
