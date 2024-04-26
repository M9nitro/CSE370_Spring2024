<?php
  require_once('DB_connect.php');
  ?>


  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furever Pet Center</title>
    <link rel = "stylesheet" href = "header.css">
    
    </head>

  <body>
  <!--NavBar -->
  <?php 
    if($_SESSION['userID'] != ""){
  ?>
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

            <li><a href="donation.php">Donate </a></li>
            <li><a href="review.php">Review</a></li>
            <li><a href="#">Approve</a></li>

            
          </ul>
        </div>
      </div>
      <!-- NavBar End -->
      </div>


<?php 
  }else{
?>
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
            <li><a href="donation.php">Donate </a></li>
            <li><a href="review.php">Review</a></li>

            
            
          </ul>
        </div>
      </div>
      <!-- NavBar End -->
      </div>
  <?php
    } ?>


  </body>
