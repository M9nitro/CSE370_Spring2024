<?php
  session_start();
  include_once('DB_connect.php');
//   include('header.php');

 
  if($_SESSION['user_type'] != 0){
      $animalID = $_SESSION['petID'];
      if($animalID ==""){
         echo '<script language="javascript">';
         echo 'alert("Select an animal first.")';
         echo '</script>';
         header('location:browse.php');
      }
  }

   if($_SESSION['userID'] != ""){

       $userID = $_SESSION['userID'];
       
   }else{
      echo '<script language="javascript">';
      echo 'alert("Please login first!.")';
      echo '</script>';
      header('location:index.html');
    }

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Inventory</title>
</head>
<body>
    <div class="container">
        <h1 class="heading">Welcome Admin!</h1>
        <p>Here's the list of products available.</p>
            <div class="box-container">
                
                         
                    <?php
                        $select_products = mysqli_query($connection_status, "SELECT * FROM gift");
                        if(mysqli_num_rows($select_products) > 0){
                            while($fetch_product = mysqli_fetch_assoc($select_products)){

                    ?>
                  <div class="box">
                    <form action="admin_gift.php" method="post">
                        <img class= "image" src="<?php echo $fetch_product['image']; ?>">
                        <h3><?php echo $fetch_product['giftID'].". ".$fetch_product['gift_type']; ?></h3>
                        <p class="price">BDT<?php echo $fetch_product['gift_price']; ?></p>
                        <input type="hidden" name="id" value="<?php $fetch_product['giftID'];?>">
                        <input name="remove" value="Delete" type="submit" onclick="return confirm('Remove item from inventory?')" class="delete-btn">
                    </form>
                </div>
            </div>
         </div>
                    <?php
            }
                    }else{
                        echo '<script language="javascript">';
                        echo 'alert("No products available.")';
                        echo '</script>';
                    }?>
    </div>
    <div class="gift">
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

        <h2>Insert New Gift Products</h2>
        <form class="gift_add" action="admin_gift.php" method="post">
            <input class = "grid" type="text" placeholder="Type of Animal" name="animaltype" required>
            <input class = "grid" type="text" placeholder="Type of Gift" name="gifttype" required>
            <input class = "grid" type="text" placeholder="Price" name="price" required>
            <input class = "grid" type="text" placeholder="Image Location" name="img" required>
            <br><br>
            <button  name = "submit_gift" class="btn btn-primary">Enter Product</button>
        </form>

        <a class="btn btn-outline" href=<?php header('location: gift.php')?>;>Check Inventory</a>;
    </div>
</body>
</html>
