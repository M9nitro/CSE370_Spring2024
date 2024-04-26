<?php
  
  require_once('DB_connect.php');
  require('session.php');
    echo "Hello";
  if($_SESSION['user_type'] != 0){
      $animalID = $_SESSION['petID'];
      if($animalID ==""){
         echo "<script>alert('Select an animal first.');</script>";
         header('location: browse.php');
      }
  }   

  function detype($pet_type){
    if ($pet_type == "Dog"){
      return 1;
    }
    else if ($pet_type == "Cat"){
      return 0;
    }
    else {
      return 2;
    }
  }



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admingift.css">
    <title>Gift Inventory</title>
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


    <div class="container">
        <h1 class="heading">Welcome Admin!</h1>
        <p>Here's the list of products available.</p>
            <div class="box-container">
                <div class="box">
                         
                    <?php
                        $select_products = mysqli_query($connection_status, "SELECT * FROM gift");
                        if(mysqli_num_rows($select_products) > 0){
                            while($fetch_product = mysqli_fetch_assoc($select_products)){
                    ?>

                    <img class= "image" src="<?php echo $fetch_product['image']; ?>">
                        <h3><?php echo $fetch_product['giftID'] . " - " . $fetch_product['gift_type']; ?></h3>
                        <p class="price">BDT<?php echo $fetch_product['gift_price']; ?></p>

                    <form action="admin_gift.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $fetch_product['giftID'];?>">
                        <input name="remove" value="Delete" type="submit" onclick="return confirm('Remove item from inventory?')">
                    </form>
                    <?php
            }
                    }else{
                        echo '<script language="javascript">';
                        echo 'alert("No products available.")';
                        echo '</script>';
                    }?>
                    
                </div>
            </div>
    </div>
                   

    <?php
            if(isset($_POST['submit_gift'])){

                if($_SESSION['userID'] != "" or $_SESSION['user_type'] != 0){

                    $animal_type = detype($_POST['animaltype']);
                    
                    $add_review = $connection_status->prepare("INSERT INTO gift(animal_type, gift_type, gift_price, image) VALUES(?, ?, ?, ?)");
                    $add_review->execute([$animal_type, $_POST['gifttype'], $_POST['price'], $_POST['img']]);

                }else{
                    echo '<script language="javascript">';
                    echo 'alert("Not Allowed For Access.")';
                    echo '</script>';
                    header('location:index.html');
                }
            }

            if(isset($_POST['remove'])){
                $remove_id = $_POST['id'];
                echo $remove_id;
                mysqli_query($connection_status, "DELETE FROM gift WHERE giftID = '$remove_id'");
                header('location:admin_gift.php');
            }

            
        ?>

        <div class = "gift_add_container">
        <h2>Insert New Gift Products</h2>
        <form class="gift_add" action="admin_gift.php" method="post" class = "grid">
            <input  type="text" placeholder="Type of Animal" name="animaltype" required>
            <input  type="text" placeholder="Type of Gift" name="gifttype" required>
            <input  type="text" placeholder="Price" name="price" required>
            <input  type="text" placeholder="Image Location" name="img" required>
            <input  type="submit" name = "submit_gift" value="Enter product">
            
        </form>
        </div>
   

    
</body>


</html>