<?php
  session_start();
  include_once('DB_connect.php');
  include('header.php');
  $sql = "SELECT * FROM review";
  $result = mysqli_query($connection_status, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reviewstyle.css" class="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/1e85c12f47.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Review</title>
</head>
<body>

   <section class="testimonials-container">
        <h2>Furever Reviews</h2>
        <span>See what our users have to say about us!</span>
        <div class="testimonials">
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                ?>
            <div class="testimonial">
               
                <?php $y = '<svg xmlns="http://www.w3.org/2000/svg" height="14" width="15.75" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>' ?>
                <h3><?php echo $row['review_title']; ?></h3>
                <p><?php echo $row['review_story']; ?><br>
                <?php 
                for($x=0;$x<$row['rating'];$x++){
                    echo $y;
                } 
                ?>
                <?php
                      $id = $row['adopteeID'];
                      $sql = "SELECT user_name as 'name' FROM user WHERE userID = $id";
                      $name = mysqli_query($connection_status, $sql);
                      $name = mysqli_fetch_assoc($name);
                ?>
                <span class="testimonal-author"><?php echo $name['name']; ?></span>
                </p>
            </div>
            <?php
             }
            ?>

        </div>


   </section>
   <?php
        if(isset($_POST['submit'])){

            if($_SESSION['userID'] != ""){

                $adopteeID = $_SESSION['userID'];
                $sql = "SELECT COUNT(*) as total FROM review WHERE adopteeID = $adopteeID";
                $data = mysqli_query($connection_status, $sql );
                $row = mysqli_fetch_assoc($data);
                $review_no = $row['total'] + 1;
                $title = $_POST['title'];
                $description = $_POST['story'];
                $rating = $_POST['rating'];
                
                $add_review = $connection_status->prepare("INSERT INTO review(adopteeID, reviewNO, review_title, review_story, rating) VALUES(?, ?, ?, ?, ?)");
                $add_review->execute([$adopteeID, $review_no, $title, $description, $rating]);

                
                header('location: review.php');

            }else{
                echo 'Please login first!';
             }
        }
        
    ?>


    <form class="row gx-3 gy-2 align-items-center" action="review.php" id = "review", method= "POST">
        <h3>Leave a Review!</h3>
        <div class="col-sm-3">
            <label for="specificSizeInputName">Title</label>
            <input name = "title" type="text" class="form-control" id="specificSizeInputName" placeholder="Enter a Title" required>
        </div>
        <div class="col-12">
            <label for="specificSizeInputName">Description</label>
            <input name = "story" type="text" class="form-control" id="specificSizeInputName" placeholder="Write Your Review">

            
        </div>
        <div class="col-sm-3">
            <label for="specificSizeSelect">Rating</label>
            <select name="rating" class="form-select" id="specificSizeSelect">
            <option>Give Us a Rating!</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>

            </select>

         
        </div>

        <div>
            <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
        </div>

      </form>

      

</body>
</html>

