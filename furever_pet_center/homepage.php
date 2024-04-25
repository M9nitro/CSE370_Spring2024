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
        <li><a href="rescue.php">Rescue </a></li>
        <li><a href="adopt.php">Adopt </a></li>
        <li><a href="#">Gift a pet </a></li>
        <li><a href="#">Donate </a></li>
        <li><a href="#">Review</a></li>
        <li><a href="#">Approve</a></li>
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

  <div class="pet-query">
    <h4>Look no Further</h4>
    <table>
    <!-- <caption>We are waiting for you</caption> -->
    <thead>
      <tr>
        <th scope="col">PetID</th>
        <th scope="col">Name</th>
        <th scope="col">Age</th>
        <th scope="col">Breed</th>
        <th scope="col">Type</th>
        <th scope ="col">Rescue Date</th>
      </tr>
    </thead>
    <tbody>
    <?php 
        require_once("DB_connect.php");
        $sql = "SELECT petID, pet_name, pet_age, pet_breed, pet_type, Rescue_date FROM pet;";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
          //here we will print every row that is returned by our query $sql
          while($row = mysqli_fetch_array($result)){
            $row[4] = detype($row[4]);
          //here we have to write some HTML code, so we will close php tag
        ?>
        <tr>
        <td scope="row" data-label="Pet ID"><?php echo $row[0]; ?></td>
        <td data-label="Name"><?php echo $row[1]; ?></td>
        <td data-label="Age"><?php echo $row[2]; ?></td>
        <td data-label="Breed"><?php echo $row[3]; ?></td>
        <td data-label="Type"><?php echo $row[4]; ?></td>
        <td data-label="Rescue Date"><?php echo $row[5]; ?></td>
      </tr>
        
        <?php 
          }					
        }
        ?>
    </tbody>
  </table>
  </div>

  </body>

  <script>

const button = document.querySelector(".button");
console.log(button);
const homepageWelcome = document.querySelector(".homepage-welcome");
console.log(homepageWelcome);


const petQuery = document.querySelector(".pet-query");

button.addEventListener('click', () => {
  homepageWelcome.style.display = 'none';
  petQuery.style.display = 'block';
  
})

</script>
