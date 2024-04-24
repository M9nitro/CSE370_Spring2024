<?php
  session_start();
  include_once('DB_connect.php');
  include('header.php');

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
    <?php
        if(isset($_POST['submit'])){
            echo $_SESSION['userID'];
            if($_SESSION['userID'] != ""){

                $donating_userID = $_SESSION['userID'];;
                $donation_amount = $_POST['amount'];
                $donation_method = $_POST['method'];
                echo $donating_userID."\n".$donation_amount."\n".$donation_method;
                $sql = ("INSERT INTO donation(donating_userID, donation_amount, donation_method, donation_date) VALUES($donating_userID, $donation_amount, $donation_method, CURDATE())");
                $result = mysqli_query($connection_status, $sql);
            
                header('location:thankyou.php');

             }else{
                $warning_msg[] = 'Please login first!';
             }
        }
        
    ?>

    <form class="row gx-3 gy-2 align-items-center" action="donation.php" id = "donation", method= "POST">
        <h1>Donation for our Shelter Animals</h1>
        <!-- <div class="col-sm-3">
            <label for="specificSizeInputName">User ID</label>
            <input name = "donatingID" type="text" class="form-control" id="specificSizeInputName" placeholder="User ID">
        </div> -->
        <div class="col-sm-3">
            <label for="specificSizeInputName">Donation Amount</label>
            <input name = "amount" type="text" class="form-control" id="specificSizeInputName" placeholder="500 BDT">
        </div>
    
        <div class="col-sm-3">
            <label for="specificSizeSelect">Transaction Method</label>
            <select name="method" class="form-select" id="specificSizeSelect">
            <option selected>Preferred Method</option>
            <option value="1">Bank Transfer</option>
            <option value="2">Mobile Banking</option>
            </select>
        </div>

        <div>
            <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</body>
</html>