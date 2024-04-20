<?php

session_start();
require_once("DB_connect.php");

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:index.php');
}

if(isset($_POST['submit'])){

    if($adopteeID != ''){

        $adopteeID = $_SESSION['userID'];
        $reviewNO = query("SELECT COUNT(*) FROM reviews");
        $reviewNO = $reviewNO+1;
        $title = $_POST['title'];
        $description = $_POST['description'];
        $rating = $_POST['rating'];
  
  
        $verify_review = $conn->prepare("SELECT * FROM `reviews` WHERE reviewNO = ? AND adopteeID = ?");
        $verify_review->execute([$get_id, $adopteeID]);
  
        if($verify_review->rowCount() > 0){
           $warning_msg[] = 'You have already reviewed this.';
        }else{
           $add_review = $conn->prepare("INSERT INTO `review`(adopteeID, reviewNO, title, rating, review_date, description) VALUES(?,?,?,?,?,?,?)");
           $add_review->execute([$adopteeID, $reviewNO, $title, $rating, date("Y-m-d H:i:s"), $description]);
           $success_msg[] = 'Review added succesfully.';
           header('location:review0.php');
        }
  
     }else{
        $warning_msg[] = 'Please login first!';
     }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="review.css" class="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Leave a Review</title>
</head>
<body>
    <?php include 'DB_connect.php'; ?>
    <h1 style = "text-align: center;">Leave a Review!</h1>

    <form action="" method="post">
      <h3>Leave your review</h3>
      <p>Title <span>*</span></p>
      <input type="text" name="title" required maxlength="30" placeholder="enter review title" class="box">
      <p>Description</p>
      <textarea name="description" class="box" placeholder="enter review description" maxlength="1000" cols="30" rows="10"></textarea>
      <p>review rating <span>*</span></p>
      <select name="rating" class="box" required>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
      </select>
      <input type="submit" value="submit review" name="submit" class="btn">
      <a href="view_post.php?get_id=<?= $get_id; ?>" class="option-btn">go back</a>
   </form>
    </div>
</body>
</html>

