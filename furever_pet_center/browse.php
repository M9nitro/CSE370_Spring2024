<?php
  require_once('session.php');
  require_once('DB_connect.php');
  if(isset($_POST['petID_submit'])){
    $_SESSION['petID'] = $_POST['petID'];
    header('location:gift.php');
  }
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
    <link rel = "stylesheet" href = "homepage.css">
    </head>

  <body>
    <script src = "browse.js"></script>
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
        <li><a href="donation.php">Donate </a></li>
        <li><a href="review.php">Review</a></li>
        <li><a href="approve.php">Approve</a></li>
        <li class = "logout" ><a href="destroy_session.php">Log out</a></li>
        
      </ul>
    </div>
  </div>
  <!-- NavBar End -->

  <div class="pet-query">
    <h4>Look no Further</h4>
    <table class =  "table table-sortable">
    <!-- <caption>We are waiting for you</caption> -->
    <thead>
      <tr>
        <th scope="col">PetID</th>
        <th scope="col">Name</th>
        <th scope="col">Age</th>
        <th scope="col">Breed</th>
        <th scope="col">Type</th>
        <th scope ="col">Rescue Date</th>
        <th scope ="col">Status</th>
      </tr>
    </thead>
    <tbody>
    <?php 
        require_once("DB_connect.php");
        $sql = "SELECT petID, pet_name, pet_age, pet_breed, pet_type, Rescue_date FROM pet;";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
          //here we will print every row that is returned by our query $sql
          while($row = mysqli_fetch_array($result)){
            $row[4] = detype($row[4]);
            $sql_fetch_status = "SeLECT status FROM request_adoptation WHERE petID = '$row[0]';";
            $result_status = mysqli_query($conn, $sql_fetch_status);
            $status = mysqli_num_rows($result_status);
            if ($status > 0){
              $status = "Pending";
            }
            else{
              $status = "Adopt ME";
            }

          //here we have to write some HTML code, so we will close php tag
        ?>
        <tr>
        <td scope="row" data-label="Pet ID"><?php echo $row[0]; ?></td>
        <td data-label="Name"><?php echo $row[1]; ?></td>
        <td data-label="Age"><?php echo $row[2]; ?></td>
        <td data-label="Breed"><?php echo $row[3]; ?></td>
        <td data-label="Type"><?php echo $row[4]; ?></td>
        <td data-label="Rescue Date"><?php echo $row[5]; ?></td>
        <td data-label="Status"><?php echo $status; ?></td>
        <td data-label="Gift"><?php $pet_id = $row[0]; ?>
        <form action="browse.php" method="post">
          <input type="hidden" name = "petID" value="<?php echo $row[0];?>">
          <button name = "petID_submit" class= "btn btn-primary" type="submit">Gift a Paw</button>
        </form></td>
      </tr>
        
        <?php 
          }					
        }
        ?>
    </tbody>
  </table>
  <form action="browse.php" method="post">
    <input type="submit" name="submit" value="Back">
  </form>
  </div>

  </body>
