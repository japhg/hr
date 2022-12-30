<?php
  include 'connection.php';
include 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/hrlogo.png" type="image/x-icon">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,200" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="assets/fontawesome/css/brands.css">
    <link rel="stylesheet" href="assets/fontawesome/css/solid.css">
    <script src="https://kit.fontawesome.com/f63d53b14e.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&family=Inter:wght@300;400;600;800&family=Poiret+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:wght@500;600&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   
    <!-- Vendor CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <!-- JS -->
    <script src="js/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="jquery-2.1.3.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    
    <link rel="stylesheet" href="css/style/search_job.css">
    <link rel="stylesheet" href="css/style/footer.css">
    <link rel="stylesheet" href="css/style/loader.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    

    <title>Search Jobs Results</title>

</head>
<body>
  <?php include 'loader.php';?>
  <header class="top-nav">
    <div>
    <img src="img/hrlogo.png" alt="HR Logo" class="rounded" id="logo">
    <h1 id="logo-title">JOB PORTAL</h1>
    </div>
    <input id="menu-toggle" type="checkbox" />
    <label class='menu-button-container' for="menu-toggle">
    <div class='menu-button'></div>
  </label>
    <ul class="menu position-absolute top-50 start-50 translate-middle">
    <li><a class="active" href="index.php">HOME</a></li>
    <li><a href="#about">ABOUT</a></li>
    <li><a href="#contact">CONTACT</a></li>
    </ul>
  </header>
<br><br><br><br><br><br><br><br>
      <main>
          <div class="container">   
          <h2 style="font-family: 'Inter', san-serif; font-weight: 500;">SEARCH RESULTS</h2>
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php" style="color: #FFF;">Home</a></li>
              <li class="breadcrumb-item"><a href="search_job.php" style="color: #FFF;">Search Jobs</a></li>
              <li class="breadcrumb-item active" aria-current="page">Search Jobs Results</li>
            </ol>
          </nav>
          <br><br>
          <section>
          <div class="row" style="margin: 5rem;">
          <span>JOB OPENINGS</span>
          <p>107 of 507 JOBS</p>
          <hr>
          <?php
          if (isset($_GET['searchbtn'])) {
              $search = clean(mysqli_real_escape_string($con, $_GET['search']));
              $query = "SELECT * FROM job_tbl WHERE title LIKE '%$search%' OR street LIKE '%$search%' OR barangay LIKE '%$search%' OR city LIKE '%$search%' OR state LIKE '%$search%'";
              $result = mysqli_query($con, $query);
              $queryResult = mysqli_num_rows($result);

                if($queryResult > 0){
                  while ($row = mysqli_fetch_assoc($result)) {
                      ?>
            <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card" style="width: 100%;">
            <div class="image">
              <img class="image__img" src="img/mema.jpg" alt="">
              <div class="image__overlay .image__overlay--blur">
              <div class="image__title"><?php echo $row['title']; ?></div>
                <a href="job_details.php" class="image__description">View Full Details</a>
              </div>
            </div>
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['title']; ?></h5>
              <p class="card-text">Company: XYZ Company</p>
              <p class="card-text">Address: <?php echo $row['street'], ", ", $row['barangay'], ", ", $row['city'], ", ", $row['state']; ?></p>
              <p class="card-text">Salary: <?php echo $row['salary']; ?></p>
            </div>
          </div>
          </div>
          <?php
                  }
              }
              else
              {
                  echo "No Result Found";
              }
          }
    ?> 
  
  
        </div>      
      </section>

        </div>
      </main>

      <br><br><br><br><br><br><br><br>
     
      <?php include 'footer.php';?>
</body>
</html>





