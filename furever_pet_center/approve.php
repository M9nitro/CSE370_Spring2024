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
            $fetch_result = mysqli_query($conn, $fetch_approve);
            $fetch_count = mysqli_num_rows($fetch_result);
            if ($fetch_count == 0){
              echo "<h3>No pending requests</h3>";
            }
            else {
                $array = mysqli_fetch_assoc($fetch_result);
                $animal_query = "SELECT * FROM pet WHERE petID = '" . $array['petID'] . "';";
                $_SESSION['petID'] = $array['petID'];

                $result = mysqli_query($conn, $animal_query);
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
  <div class="gift">
  <?php
        if(isset($_POST['submit_gift'])){

            if($_SESSION['userID'] != ""){

                $animal_type = detype($_POST['animaltype']);
                
                $add_review = $connection_status->prepare("INSERT INTO gift(animal_type, gift_type, gift_price, image) VALUES(?, ?, ?, ?)");
                $add_review->execute([$animal_type, $_POST['gifttype'], $_POST['price'], $_POST['img']]);

                
                header('location: gift.php');

            }else{
                echo 'Please login first!';
             }
        }
        
    ?>

    <h2>Insert New Gift Products</h2>
    <form class="gift_add" action="approve.php" method="post">
    <input class = "grid" type="text" placeholder="Type of Animal" name="animaltype" required>
    <input class = "grid" type="text" placeholder="Type of Gift" name="gifttype" required>
    <input class = "grid" type="text" placeholder="Price" name="price" required>
    <input class = "grid" type="text" placeholder="Image Location" name="img" required><br><br>
    <button  name = "submit_gift" class="btn btn-primary">Enter Product</button>
    </form>
  </div>
  </body>

</head>
