<?php
  require_once('DB_connect.php');
  require('session.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="donation.css" class="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Donation</title>
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



    <?php
        if(isset($_POST['submit'])){

            if($_SESSION['userID'] != ""){

                $donating_userID = $_SESSION['userID'];
                $donation_amount = $_POST['amount'];
                $donation_method = $_POST['method'];
                $date = date("Y-m-d");
            
               
                $sql = "INSERT INTO donation (userID, donation_amount, donation_method, donation_date) VALUES ('$donating_userID', '$donation_amount', '$donation_method', '$date')";

                $result = mysqli_query($connection_status, $sql);
            
                header('location: thankyou.php');

             }else{
                $warning_msg[] = 'Please login first!';
             }
        }
        
    ?>

    <form class="row gx-3 gy-2 align-items-center" action="donation.php" id = "donation", method= "POST">
        <h1>Donation for our Shelter Animals</h1>
        <div class="col-sm-3">
            <label for="specificSizeInputName">Donation Amount</label>
            <input name = "amount" type="text" class="form-control" id="specificSizeInputName" placeholder="500 BDT">
        </div>
    
        <div class="col-sm-3">
            <label for="specificSizeSelect">Transaction Method</label>
            <select name="method" onchange="enableMethod(this)" class="form-select" id="specificSizeSelect">
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
            <button type="submit" name = "submit" class="btn btn-primary">Confirm</button>
        </div>
    </form>


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
