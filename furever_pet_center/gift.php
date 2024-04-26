<?php
  require_once('DB_connect.php');
  require('session.php');
  require('header.php');

  if($_SESSION['user_type'] != 0){
      $animalID = $_SESSION['petID'];
      
      if($animalID ==""){
         echo '<script language="javascript">';
         echo 'alert("Select an animal first.")';
         echo '</script>';
         header('location:browse.php');
      }
  }else{
      header('location:admin_gift.php');
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="giftstyle.css" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/1e85c12f47.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Gift A Paw!</title>
</head>
<body>

   <section class = "feature_products"></section>
    <?php
         if(isset($_POST['add_to_cart'])){
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_quantity = $_POST['quantity'];

            $select_cart = mysqli_query($connection_status, "SELECT * FROM cart WHERE gift_id = $product_id");

            if(mysqli_num_rows($select_cart) > 0){
               echo '<script language="javascript">';
               echo 'alert("Added already.")';
               echo '</script>';
               
            }else{
               $sql = ("INSERT INTO cart VALUES('$product_name', $product_price, $product_quantity, $product_id)");
               $insert_product = mysqli_query($connection_status, $sql);
            }
      }
         if(isset($_POST['update_update_btn'])){
            $update_value = $_POST['update_quantity'];
            $gift_id = $_POST['update_quantity_id'];
            $sql = ("UPDATE cart SET quantity = '$update_value' WHERE gift_id = $gift_id");
            $update_quantity_query = mysqli_query($connection_status, $sql);
            if($update_quantity_query){
               header('location:gift.php');
            }
      }
 
         if(isset($_GET['remove'])){
            $remove_id = $_GET['remove'];
            
 
            mysqli_query($connection_status, "DELETE FROM cart WHERE gift_id = '$remove_id'");
            header('location:gift.php');
            }
   
 
      
      ?>
    <?php
         $pet_info = mysqli_query($connection_status, "SELECT * FROM pet WHERE petID = '$animalID'");
         $row = mysqli_fetch_assoc($pet_info);
         ?>
         <h2>What do you wish to buy for <?php echo $row['pet_name'];?>?</h2>
         <div class="container text-centre">
            <div class="box-container">
                 
               <?php
                  $animaltype = $row['pet_type'];
                  $select_products = mysqli_query($connection_status, "SELECT * FROM gift WHERE animal_type = $animaltype");
                  if(mysqli_num_rows($select_products) > 0){
                     while($fetch_product = mysqli_fetch_assoc($select_products)){
               ?>    
                        <div class="col">
                        <form action="gift.php" method="post"> 
                           <img class= "image" src="<?php echo $fetch_product['image']; ?>">
                           <h3><?php echo $fetch_product['gift_type']; ?></h3>
                           <p class="price">BDT<?php echo $fetch_product['gift_price']; ?></p>
                           <input type="hidden" name="product_id"  value="<?php echo $fetch_product['giftID']; ?>" >
                           <input type="hidden" name="product_name" value="<?php echo $fetch_product['gift_type']; ?>" >
                           <input type="hidden" name="product_price" value="<?php echo $fetch_product['gift_price']; ?>">

                           <div id = "quantity" class="col-sm-3">
                              <label for="specificSizeSelect"></label>
                              <select name="quantity" class="form-select" id="specificSizeSelect" required>
                              <option selected>Quantity</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              </select>
                           </div>
                           <div class="action-buttons"><input type="submit" id= "add-to-cart" class="btn btn-outline" value="add to cart" name="add_to_cart"></div>
                     </form>

                  </div>
                  <?php
                     };
                  };?>
         </div>

         
         
   </section>

   <div class="cart">
      <h1 class="heading">Shopping cart</h1>

      <table class="content_table">

         <thead>
            <tr>
               <th>Name</th>
               <th>Price</th>
               <th>Quantity</th>
               <th class="up">Total price</th>
               <th class="up" >Quantity Update</th>
               <th>Delete</th>
               
            </tr>
            
         </thead>

         <tbody>

            <?php 
            
            $select_cart = mysqli_query($connection_status, "SELECT * FROM cart");
            $grand_total = 0;
            if(mysqli_num_rows($select_cart) > 0){
               while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            ?>

            <tr>
               <td><?php echo $fetch_cart['pname']; ?></td>
               <td>BDT<?php echo number_format($fetch_cart['price']); ?></td>
               <td><?php echo $fetch_cart['quantity']; ?></td>
               <td>BDT<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
               <td>
                  <form action="gift.php" method="post">
                     <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['gift_id']; ?>" >
                     <input class = "quantity" type="number" class="btn" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                     <input type="submit" value="update" name="update_update_btn">
                  </form>   
               </td>
               
               <td><a href="gift.php?remove=<?php echo $fetch_cart['gift_id']; ?>" onclick="return confirm('Remove item from cart?')" class="btn delete-btn"> <i class="fas fa-trash"></i>Remove</a></td>
            </tr>
            <?php
            $grand_total += $sub_total;  
               };
            };
            ?>

         </tbody>

      </table>
      <div class="table-bottom">
               <td colspan="3">Grand Total: </td>
               <td>BDT<?php echo $grand_total; ?></td>
               
      </div>

      <div class="checkout-btn">
         <form action="gift.php" method="post">
            <a href="checkoutgift.php" class="btn btn-primary">procced to checkout</a>
         </form>
      </div>


   </div>
   </body>

</html>
