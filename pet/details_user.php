<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CR5 Pet Adoption</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-black d-flex">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="index.php"><b>CR5 Pet Adoption</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
          </li>
          <li class="nav-item">

            <a class="nav-link text-white btn3" href="../myadopt.php">My Adoptions</a>
          </li>
          <li></li>
          <li class="dashboard mx-2"><a class="btn3 nav-link text-white" href="../home.php">Home</a></li>

          <li class="nav-item">
            <a class="nav-link text-white btn3" href="../logout.php?logout">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--NAVBAR END-->

  <?php
  require_once "../db_connect.php";
  session_start();

  if (isset($_SESSION["user"])) {
    header("Locations: ../home.php");
  }

  if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("location: ../login.php");
  }


  if (isset($_GET['id'])) {
    $productId = $_GET['id'];



    $sql = "SELECT * FROM `animal` JOIN size ON animal.fk_sizeId = size.sizeId WHERE `id` = '$productId'";
    // TO JOIN THE size AND GIVE OUT THE VALUE: small, medium, large

    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $petname = $row['petname'];
      $productImage = $row['picture'];
      $short_description = $row['short_description'];
      $big_description = $row['big_description'];
      $breed = $row['breed'];
      $locations = $row['locations'];
      $weights = $row['weights'];
      $species = $row['species'];
      $gender = $row['gender'];
      $birth_date = $row['birth_date'];
      $price = $row['price'];
      $statusLabel = ($row["status"] == 0) ? "Not Adopted" : "<span style='color: red;'>Adopted</span>";
      $vacc = ($row["vacc"] == 0) ? "No" : "<span style='color: red;'>Yes</span>";


      echo "   
      <div class='container d-flex justify-content-center'><div class='card my-2 mx-2' style='width: 42rem;'>
      <img src='../pictures/{$row["picture"]}' class='card-img-top cover' style='object-fit: cover; height: 20rem;' alt='img'>
    <div class='card-body'>
      <h5 class='card-title'><b>{$row["petname"]}</b></h5>
      <p class='card-text'>Overview: <b>{$row["short_description"]}</b></p>
    </div>
    <ul class='list-group list-group-flush'>
      <li class='list-group-item'>Age: <b>{$row["age"]}</b></li>
      <li class='list-group-item'>Description: <b>{$row["big_description"]}</b></li>
      <li class='list-group-item'>Breed: <b>{$row["breed"]}</b></li>
      <li class='list-group-item'>Locations: <b>{$row["locations"]}</b> </li>
      
      <li class='list-group-item'>
      Species: <a href='species_user.php?species={$row["species"]}'>{$row["species"]}</a>
      <li class='list-group-item'>Gender: <b>{$row["gender"]}</b></li>
      <li class='list-group-item'>Birth Date: <b>{$row["birth_date"]}</b></li>
      <li class='list-group-item'>Size: <b>{$row["sizes"]}</b></li>
      <li class='list-group-item'>Status: <b>{$statusLabel}</b></li>
      <li class='list-group-item'>Vaccinated: <b>{$vacc}</b></li>
      <li class='list-group-item'>Price: <b>{$price}$</b></li>
<div class='but'>
     
      <a href='index.php' class='button3 my-2' style='border: solid blue 2px;'>Go Back</a><div>
    </ul>
  
  </div>
  </div>";
    } else {
      echo 'Pet not found.';
    }
  } else {
    echo 'Invalid request.';
  };
  ?>
  <!-- FOOTER -->

  <section class="mt-4">
    <!-- Footer -->
    <footer class="text-center text-white" style="background-color: #0a4275;">
      <!-- Grid container -->
      <div class="container p-4 pb-0">
        <!-- Section: CTA -->
        <section class="">
          <p class="d-flex justify-content-center align-items-center">
            <span class="me-3">Register for free</span>
            <button type="button" class="btn btn-outline-light btn-rounded">
              Sign up!
            </button>
          </p>
        </section>
        <!-- Section: CTA -->
      </div>
      <!-- Grid container -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2023 Copyright:
        <a class="text-white" href="index.php">CodeFactory</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>