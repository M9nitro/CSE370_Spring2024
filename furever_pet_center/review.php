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
    <link rel="stylesheet" href="reviewstyle.css" class="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Review</title>
</head>
<body>
   <section>
      
   </section>
   <?php
        if(isset($_POST['submit'])){

            if($_SESSION['userID'] != ""){

                $adopteeID = $_SESSION['userID'];
                $sql = "SELECT COUNT(*) as total FROM review WHERE adopteeID = $adopteeID";
                $data = mysqli_query($connection_status, $sql );
                $row = mysqli_fetch_assoc($data);
                $review_no = $row['total'] + 1;
                $review_no = filter_var($review_no, FILTER_SANITIZE_STRING);
                $title = $_POST['title'];
                $title = filter_var($title, FILTER_SANITIZE_STRING);
                $description = $_POST['story'];
                $description = filter_var($description, FILTER_SANITIZE_STRING);
                $rating = $_POST['rating'];
                
                $add_review = $connection_status->prepare("INSERT INTO review(adopteeID, reviewNO, review_title, review_story, rating) VALUES(?, ?, ?, ?, ?)");
                $add_review->execute([$adopteeID, $review_no, $title, $description, $rating]);
                $success_msg[] = 'Review added!';
                
                header('location:view_review.php');

            }else{
                $warning_msg[] = 'Please login first!';
             }
        }
        
    ?>


    <form class="row gx-3 gy-2 align-items-center" action="review.php" id = "review", method= "POST">
        <h3>Leave a Review!</h3>
        <div class="col-sm-3">
            <label for="specificSizeInputName">Title</label>
            <input name = "title" type="text" class="form-control" id="specificSizeInputName" placeholder="Enter a Title">
        </div>
        <div class="col-12">
            <label for="specificSizeInputName">Description</label>
            <input name = "story" type="text" class="form-control" id="specificSizeInputName" placeholder="Write Your Review">

            
        </div>
        <div class="col-sm-3">
            <label for="specificSizeSelect">Rating</label>
            <select name="rating" class="form-select" id="specificSizeSelect">
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

