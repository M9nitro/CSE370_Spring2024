<?php
    
    require_once('DB_connect.php');
    require('session.php');
    $petID = $_SESSION['petID'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="checkout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/1e85c12f47.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Checkout</title>
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
<!-- Nav Bar ENd -->

    <section class="cart">
    <h1 class="heading">Shopping Cart</h1>

    <table class="content_table">
        <thead>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
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
         
      </tr>
      <?php
      $grand_total += $sub_total;  
         };
      };
      ?>
      <tr class="table-bottom">
         <td colspan="3">Grand Total: <?php echo $grand_total; ?></td>
      </tr>

    </tbody>

    </table>

    </section>


    <section class = "checkout">
    <?php
        if(isset($_POST['submit'])){

            if($_SESSION['userID'] != ""){

                $donating_userID = $_SESSION['userID'];
                $sql = "SELECT * FROM cart";
                $select_cart = mysqli_query($connection_status, $sql);
                

                if(mysqli_num_rows($select_cart)){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){

                        $result = $connection_status->prepare("INSERT INTO gift_given(giftID, animalID, userID, number_gift) VALUES(?, ?, ?, ?)");
                        $result->execute([$fetch_cart['gift_id'], $petID, $donating_userID, $fetch_cart['quantity']]);
                        

                        $delete = $connection_status->prepare("DELETE FROM cart WHERE gift_id = ?");
                        $delete->execute([$fetch_cart['gift_id']]);
          

                    }
                    header('location:thankyou.php');
                }else{
                    echo '<script>alert("Empty Cart. Please add something to the cart first.")</script?';
             }
            }
        }

        
    ?>
    <div class= "bill">

    <form class="row gx-3 gy-2 align-items-center" action="checkoutgift.php" id = "checkout", method= "POST">
        <h1>Billing Summary</h1>
        <div class="col-sm-3">
            <label for="specificSizeInputName">Name</label>
            <input name = "name" type="text" class="form-control" id="specificSizeInputName" placeholder="Name" required>
        </div>
    
        <div class="col-sm-3">
            <label for="specificSizeSelect">Transaction Method</label>
            <select name="method" onchange="enableMethod(this)" class="form-select" id="specificSizeSelect" required>
            <option selected>Preferred Method</option>
            <option value="1">Bank Transfer</option>
            <option value="2">Mobile Banking</option>
            </select>

        </div>
        <div class="bank" id="bank">
                <div class="col-md-6">
                <label for="specificSizeInputName">Bank Information</label>
                <input name = "bank" type="text" class="form-control" id="specificSizeInputName" placeholder="Bank A/C">
                </div>
                <div class="col-md-6">
                <label for="specificSizeInputName">Bank Name</label>
                <input name = "bank" type="text" class="form-control" id="specificSizeInputName" placeholder="Bank Name">
                </div>
                <div class="col-md-6">
                <label for="specificSizeInputName">A/C Type</label>
                <input name = "bank" type="text" class="form-control" id="specificSizeInputName" placeholder="Savings Or Current">
                </div>
        </div>


        <div class="bkash" id="bkash">
                <div class="col-md-6">
                <label for="specificSizeInputName">Bkash Number</label>
                <input name = "bkash" type="text" class="form-control" id="specificSizeInputName" placeholder="Phone No.">
                </div>
                <div class="col-md-6">
                <label for="specificSizeInputName">Phone Operator</label>
                <input name = "bkash" type="text" class="form-control" id="specificSizeInputName" placeholder="Airtel Or Teletalk">
                </div>
        </div>
        

        <div>
            <button type="submit" name = "submit" class="btn btn-primary">Confirm Checkout</button>
        </div>
    </form>
    </div>
   </section>


   <script type="text/javascript">  
        function enableMethod(answer){
            console.log(answer.value);
            if(answer.value == 1){
                document.getElementById('bank').classList.remove('bank');
            }else if(answer.value == 2){
                document.getElementById('bkash').classList.remove('bkash');
                document.getElementById('bank').classList.add('bank');
            }else{
                document.getElementById('bank').classList.add('bank');
                document.getElementById('bkash').classList.add('bkash');
            }
        }
    </script>
</body>
</html>
