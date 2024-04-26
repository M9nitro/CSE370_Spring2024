<?php
    session_start();
    include_once('DB_connect.php');
    include('header.php');
    $petID = $_SESSION['petID'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="giftstyle.css" class="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/1e85c12f47.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Checkout</title>
</head>
<body>
    <section class="cart">
    <h1 class="heading">shopping cart</h1>

    <table>
    <thead>
      <th>Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Total price</th>
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
                

                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){

                        $result = $connection_status->prepare("INSERT INTO gift_given(giftID, animalID, userID, number_gift) VALUES(?, ?, ?, ?)");
                        $result->execute([$fetch_cart['gift_id'], $petID, $donating_userID, $fetch_cart['quantity']]);
                        

                        $delete = $connection_status->prepare("DELETE FROM cart WHERE gift_id = ?");
                        $delete->execute([$fetch_cart['gift_id']]);
          

                    }
                    header('location:thankyou.php');
                }else{
                $warning_msg[] = 'Empty Cart!';
             }
            }
        }

        
    ?>

    <form class="row gx-3 gy-2 align-items-center" action="checkoutgift.php" id = "checkout", method= "POST">
        <h1>Checkout</h1>
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
