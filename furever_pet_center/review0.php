<?php

    session_start();
    require_once("DB_connect.php");

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
        <title>All Reviews</title>

        <!-- custom css file link  -->
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
   
    


        <section class="all-posts">

        <div class="heading"><h1>All Reviews</h1></div>

        <div class="box-container">

        <?php
            $adopteeID = $_SESSION['userID'];
            $select_posts = $conn->prepare("SELECT * FROM reviews");
            $select_posts->execute();
            if($select_posts->rowCount() > 0){
                while($fetch_post = $select_posts->fetch(PDO::FETCH_ASSOC)){

                    $post_id = $fetch_post['reviewNO'];

                    $count_reviews = $conn->prepare("SELECT * FROM reviews WHERE reviewNO = ?");
                    $count_reviews->execute([$post_id]);
                    $rating = query("SELECT rating from reviews WHERE reviewNO = ?")

        ?>
                <div class="box">
                    <!-- <img src="uploaded_files/<?= $fetch_post['image']; ?>" alt="" class="image"> -->
                    <h2 class="title"><?= $fetch_post['title']; ?></h2>
                    <p class="rating"><i class="fas fa-star"></i> <span><?= $rating; ?></span></p>
                    <p class="desc"><?= $fetch_post['description'];?></p>
                </div>
        <?php
                }
        }else{
                echo "No reviews added yet.";
            }
        

   </div>

</section>

<!-- view all posts section ends -->

















        <?php include 'components/alers.php'; ?>

    </body>
</html>