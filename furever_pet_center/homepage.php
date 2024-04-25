  <?php
  require_once('session.php');
  require_once('DB_connect.php');

  function detype($pet_type){
    if ($pet_type == 1){
      return "Dog";
    }
    else if ($pet_type == 0){
      return "Cat";
    }
    else {
      return "Rabbit";
    }
  }

  ?>


  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furever Pet Center</title>
    <link rel = "stylesheet" href = "homepage.css">
    </head>

  <body>
  <!--NavBar -->
  <div class="navbar">
    <div class="nav-logo">
      <a href="homepage.php">
        <img class="logo-img" src="./img/logo.png" alt="">
      </a>
      </div>
    <div class="nav-items">
      <ul>
      <li><a href="browse.php">Browse</a></li>
        <li><a href="rescue.php">Rescue </a></li>
        <li><a href="adopt.php">Adopt </a></li>
        <li><a href="#">Gift a pet </a></li>
        <li><a href="#">Donate </a></li>
        <li><a href="#">Review</a></li>
        <li><a href="approve.php">Approve</a></li>
        <li class = "logout" ><a href="destroy_session.php">Log out</a></li>
        
      </ul>
    </div>
  </div>
  <!-- NavBar End -->

  <div class ="homepage-welcome">
  <h1 >Welcome</h1>
  <h2>Furry Friends are wating for you</h2>
  <button class = "button">Browse</button>
  </div>


  </body>

  <script>

const button = document.querySelector(".button");

const petQuery = document.querySelector(".pet-query");

button.addEventListener('click', () => {
  window.location.href = "browse.php";
  
})

</script>
