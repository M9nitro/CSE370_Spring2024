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

  <div class ="adopt-search">
    <img src= "./img/damn.png" height = "80px" width = "120px" >
  <h1 >Adopt Portal</h1>
  <h2>Find this Cuties Home</h2>
  <form action="adopt_process.php" method = "post">
    <input type="text" name = "PetID" placeholder = "Pet ID" required>
    <input type="submit" name = "submit" value = "Submit" class = "search_button">
  </form>
  </div>

  </body>

</script>
</head>
