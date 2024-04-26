<?php
  
  require_once('DB_connect.php');
  require('session.php');
  require_once('header.php');

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                    <img class= "image" src="<?php echo $fetch_product['image']; ?>">
                        <h3><?php echo $fetch_product['giftID'] . " - " . $fetch_product['gift_type']; ?></h3>
                        <p class="price">BDT<?php echo $fetch_product['gift_price']; ?></p>

                    <form action="admin_gift.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $fetch_product['giftID'];?>">
                        <input name="remove" class = "btn" value="Delete" type="submit" onclick="return confirm('Remove item from inventory?')">
                    </form>
                    </div>
                    <?php
            }
                        }else{
                            echo '<script language="javascript">';
                            echo 'alert("No products available.")';
                            echo '</script>';
   
                        }?>  
            </div>
    </div>
                   

    <?php
            if(isset($_POST['submit_gift'])){

                if($_SESSION['userID'] != "" && $_POST['randcheck']==$_SESSION['rand']){

                    $animal_type = detype($_POST['animaltype']);
                    
                    $add_review = $connection_status->prepare("INSERT INTO gift(animal_type, gift_type, gift_price, image) VALUES(?, ?, ?, ?)");
                    $add_review->execute([$animal_type, $_POST['gifttype'], $_POST['price'], $_POST['img']]);

                }else{
                    echo '<script language="javascript">';
                    echo 'alert("Not Allowed For Access.")';
                    echo '</script>';
                }
            }

            if(isset($_POST['remove'])){
                $remove_id = $_POST['id'];
                mysqli_query($connection_status, "DELETE FROM gift WHERE giftID = '$remove_id'");
            }

            
        ?>

      <div class = "gift_add_container">
        <h2>Insert New Gift Products</h2>
            <form class="gift_add" action="admin_gift.php" method="post" class = "grid">
              <?php
                $rand=rand();
                $_SESSION['rand']= $rand;
              ?>
                <input  type="text" placeholder="Type of Animal" name="animaltype" required>
                <input  type="text" placeholder="Type of Gift" name="gifttype" required>
                <input  type="text" placeholder="Price" name="price" required>
                <input  type="text" placeholder="Image Location" name="img" required>
                <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                <button class="btn btn-primary" type="submit" name = "submit_gift" >Enter</button>
                  
            </form>
      </div>
   

    
</body>


</html>
