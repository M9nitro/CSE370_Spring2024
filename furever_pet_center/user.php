<?php
  require_once('session.php');
  require_once('DB_connect.php');
  function detype($pet_type){
    if ($pet_type == 1){
      return "Rescuer";
    }
    else if ($pet_type == 0){
      return "Admin";
    }
    else {
      return "Adoptee";
    }
  }

  ?>


  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furever Pet Center</title>
    <link rel = "stylesheet" href = "user.css">
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
    <h4>User Details</h4>
    <table class =  "table table-sortable">
    <!-- <caption>We are waiting for you</caption> -->
    <thead>
      <tr>
        <th scope="col">UserID</th>
        <th scope="col">Name</th>
        <th scope="col">NID</th>
        <th scope="col">Type</th>
        <th scope="col">Phone</th>
        <th scope ="col">Address</th>
        <th scope ="col">Email</th>
      </tr>
    </thead>
    <tbody>
    <?php 
        require_once("DB_connect.php");
        $sql = "SELECT userID, user_name, user_NID, user_type, user_phone, user_address, user_email FROM user;";

        $result = mysqli_query($connection_status, $sql);

        if(mysqli_num_rows($result) > 0){
          //here we will print every row that is returned by our query $sql
          while($row = mysqli_fetch_array($result)){
            $row[3] = detype($row[3]);
           
          //here we have to write some HTML code, so we will close php tag
        ?>
        <tr>
        <td scope="row" data-label="UserID"><?php echo $row[0]; ?></td>
        <td data-label="Name"><?php echo $row[1]; ?></td>
        <td data-label="NID"><?php echo $row[2]; ?></td>
        <td data-label="Type"><?php echo $row[3]; ?></td>
        <td data-label="Phone"><?php echo $row[4]; ?></td>
        <td data-label="Address"><?php echo $row[5]; ?></td>
        <td data-label="Email"><?php echo $row[6]; ?></td>
        
      </tr>
        
        <?php 
          }					
        }
        ?>
    </tbody>
  </table>
  </div>

  </body>
