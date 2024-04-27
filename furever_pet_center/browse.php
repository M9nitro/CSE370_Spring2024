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
        <th scope ="col">Gift</th>
      </tr>
    </thead>
    <tbody>
    <?php 
        require_once("DB_connect.php");
        $sql = "SELECT petID, pet_name, pet_age, pet_breed, pet_type, Rescue_date FROM pet;";

        $result = mysqli_query($connection_status, $sql);

        if(mysqli_num_rows($result) > 0){
          //here we will print every row that is returned by our query $sql
          while($row = mysqli_fetch_array($result)){
            $row[4] = detype($row[4]);
            $sql_fetch_status = "SeLECT status FROM request_adoptation WHERE petID = '$row[0]';";
            $result_status = mysqli_query($connection_status, $sql_fetch_status);
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
          <input type = "submit" name = "petID_submit" value = "Gift a Paw">
        </form>
      </tr>
        
        <?php 
          }					
        }
        ?>
    </tbody>
  </table>
  </div>

  </body>
