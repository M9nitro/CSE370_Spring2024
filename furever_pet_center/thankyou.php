<?php
  session_start();
  include_once('DB_connect.php');
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="donation.css" class="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Donation</title>
</head>
<body>
<!--NavBar Start -->
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
<!-- Nav Bar ENd -->



    <?php
        if(isset($_POST['Homepage'])){
            header('location:homepage.php');    
        }
        
        if(isset($_POST['donate_again'])){
            header('location:donation.php');    
        }
    ?>

    <div class="container" id= "donation">
        <h1>Thank you for your support!</h1>
        <span class="sub">Our shelter animals will be very grateful.</span><br>
    <div class="d-grid gap-2 d-md-block ">
        <form action="thankyou.php" method="post">
            <div class="col">
            <button name = "Homepage" class= "btn btn-primary" type="submit">Home</button>
            </div>
        </form>
        <form action="thankyou.php" method="post">
            <div class="col">
            <button name = "donate_again" class= "btn btn-primary" type="submit">Donate Again</button>
            </div>
        </form>
    </div>
    
    </div>
</body>
</html>
