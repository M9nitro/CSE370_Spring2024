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

    <div class="container" id= "donation">
        <h1>Thank you for your support!</h1>
        <span class="sub">Our shelter animals will be very grateful.</span><br>
    <div class="d-grid gap-2 d-md-block">
    <button name = "Home" href = "#" class="btn btn-primary" data-bs-toggle="button">Home</button>
    <button name = "donate" href = "donation.php" class="btn btn-primary" data-bs-toggle="button">Donate Again</button>
    </div>
    
    </div>
</body>
</html>