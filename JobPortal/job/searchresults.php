<?php
include '../database/connection.php';
include '../body/function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../img/hrlogo.png" type="image/x-icon">

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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <link rel="stylesheet" href="../css/style/search_results.css">
  <link rel="stylesheet" href="../css/style/header.css">
  <link rel="stylesheet" href="../css/bootstrap.css">


  <title>Search Jobs Results</title>

</head>

<body>
  <?php include '../body/loader.php';
  include '../body/header.php'; ?>

  <br><br><br><br><br><br><br><br>

  <div class="head">
    <div class="container">
      <h1 style="font-family: 'Roboto', sans-serif; color: #6559ca; font-weight: 800;">SEARCH RESULTS</h1>
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php" style="color: #000;">Home</a></li>
          <li class="breadcrumb-item"><a href="search_job.php" style="color: #000;">Search Jobs</a></li>
          <li class="breadcrumb-item active" aria-current="page">Search Jobs Results</li>
        </ol>
      </nav>
      <br><br>
    </div>
  </div>

  <div class="body">
    <div class="container">
      <button type="button" class="btn" onclick="location.href = 'search_job.php';" style="background: #6559ca; color: #fff; border: none; box-shadow: none;">Search Again</button>
      <div class="row" style="margin: 5rem;">
        <span>JOB OPENINGS</span>
        <hr>
        <?php
        if (isset($_GET['searchbtn'])) {
          $search = clean(mysqli_real_escape_string($con, $_GET['search']));
          $query = "SELECT e.*, j.*, DATE_FORMAT(date_posted, '%M %d, %Y')as formatted_date FROM employer_tbl e, job_tbl j WHERE e.id = j.empr_id AND title LIKE '%$search%' OR (e.id = j.empr_id AND street LIKE '%$search%') OR (e.id = j.empr_id AND barangay LIKE '%$search%') OR (e.id = j.empr_id AND city LIKE '%$search%') OR (e.id = j.empr_id AND state LIKE '%$search%') OR (e.id = j.empr_id AND companyName LIKE '%$search%')";
          $result = mysqli_query($con, $query);
          $queryResult = mysqli_num_rows($result);
        ?>
          <span style="text-transform: uppercase;">Search Result for "<?php echo $search; ?>"</span>
          <p style="color: #000;"><?php echo $queryResult ?> result/s found</p>
          <?php
          if ($queryResult > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $image = $row['companyLogo'];
          ?>
              <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card" style="width: 100%; height: 400px;">
                  <a href="job_details.php?jobid=<?php echo $row['job_id']; ?>" style="text-decoration: none;">
                    <div class="card-body" style="background: none !important;">
                      <img width="30%" alt="Company Logo" style="box-sizing: border-box;" <?php echo '<img src="../imageStorage/' . $image . '" />'; ?> <br><br>
                      <p class="card-title" style="text-align: left !important;"><?php echo $row['title']; ?></p>
                      <p> <?php echo $row['companyName']; ?> <br> <strong><?php echo $row['city'], ", ", $row['state']; ?></strong></p>
                      <p><strong><?php echo $row['salary']; ?></strong></p>
                      <p>Posted on <?php echo $row['formatted_date']; ?></p>
                    </div>
                  </a>
                </div>
                </form>
              </div>
        <?php
            }
          } else {
            echo "No Result Found";
          }
        }
        ?>



      </div>
    </div>
  </div>


  <?php include '../body/footer.php'; ?>
</body>

</html>