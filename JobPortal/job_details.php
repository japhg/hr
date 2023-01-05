<?php
include "connection.php";
include "function.php";
session_start();
$errors = array();

if(isset($_POST['login'])){
  $email = clean(mysqli_real_escape_string($con, $_POST['email']));
  $password = clean(mysqli_real_escape_string($con, $_POST['password']));

  $query = "SELECT * FROM applicant_tbl WHERE email_address = '$email'";
    $result = mysqli_query($con, $query);
  if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $row['email_address'];
    $_SESSION['password'] = $row['password'];
    $hashedPassword = $row['password'];

    if (password_verify($password, $hashedPassword)) 
    {

      header("location: special_features.php");
      exit(0);

    }
    else
    {
      $errors['errorMessage'] = "Invalid Username or Password";
    }
  }

  else
  {
      $errors['errorMessage'] = "Invalid Username or Password";
  }

}
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
    

    <title>Job Details</title>

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
          <h2 style="font-family: 'Inter', san-serif; font-weight: 500;">JOB DETAILS</h2>
          <nav style="--bs-breadcrumb-divider:'>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php" style="color: #FFF;">Home</a></li>
              <li class="breadcrumb-item"><a href="search_job.php" style="color: #FFF;">Search Jobs</a></li>
              <li class="breadcrumb-item active" aria-current="page">Job Details</li>
            </ol>
          </nav>
          <br><br><br><br>
        <section>
        <button class="btn btn-primary justify-content-right" style="float: right;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Apply Now</button>
          <div class="container">
            <?php
            if (isset($_GET['view'])) {
              $id = $_GET['job_id'];
              $query = "SELECT *, DATE_FORMAT(date_posted, '%M %d, %Y')as formatted_date FROM job_tbl WHERE job_id = '$id'";
              if ($result = mysqli_query($con, $query)) {

                $row = mysqli_fetch_assoc($result);

                ?>
            <img src="img/mema.jpg" alt="" class="img-responsive" width="200px" height="200px">
            <br><br>
            <h1><?php echo $row['title']; ?></h1>
            <h5>XYZ Company</h5>
            <h6>ADDRESS: <?php echo $row['street'], ", ", $row['barangay'], ", ", $row['city'], ", ", $row['state']; ?></h6>
            <h6>DATE POSTED: <?php echo $row['formatted_date']; ?></h6>
            <br>
            <hr>
            <h5 style="font-weight: bold;">JOB DESCRIPTION</h5>
            <p style="text-indent: 2rem; text-align: justify;  color: #ffffffbc;"><?php echo $row['description']; ?></p>
            <br><br>
            <h5 style="font-weight: bold;">JOB QUALIFICATIONS</h5>
            <ul>
              <li style="color: #ffffffbc;">
                Candidate must possess at least a Bachelor's/College Degree , any field.
              </li>
              <li style="color: #ffffffbc;">
                At least 3 year(s) of working experience in the related field is required for this position.
              </li>
              <li style="color: #ffffffbc;">
                Preferably 1-4 Yrs Experienced Employees specializing in IT/Computer - Software or equivalent
              </li>
              <li style="color: #ffffffbc;">
               Applicants must be willing to work in Tarlac area
              </li>
            </ul>
            <br><br>                                                                
            <h5 style="font-weight: bold;">SKILLS</h5>
            <ul>
              <li style="color: #ffffffbc;"><?php echo $row['skills'];?></li>
            </ul>
            <br><br>
            <h5 style="font-weight: bold;">YEARS OF EXPERIENCE</h5>
            <p style="color: #ffffffbc;"> - <?php echo $row['years'];?></p>
            <br>  
            <h5 style="font-weight: bold;">SALARY</h5>
            <p style="color: #ffffffbc;"> - <?php echo $row['salary'];?></p>
            <br>
            <h5 style="font-weight: bold;">BENEFITS</h5>
            <ul>
              <li style="color: #ffffffbc;"><?php echo $row['benefits'];?></li>
            </ul>
            <br>
            <h5 style="font-weight: bold;">JOB TYPE</h5>
            <p style="color: #ffffffbc;"><?php echo $row['type'];?></p>
            <br>
            <hr>
            <h4 style="font-weight: bold;">COMPANY INFORMATION</h4>
            <br>
            <h5 style="font-weight: bold;">COMPANY NAME</h5>
            <p style="color: #ffffffbc;">XYZ Company</p>
            <br><br>
            <h5 style="font-weight: bold;">COMPANY ADDRESS</h5>
            <p style="color: #ffffffbc;">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
            <br><br>            
            <h5 style="font-weight: bold;">COMPANY DESCRIPTION</h5>
            <p style="text-indent: 2rem; color: #ffffffbc;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde molestiae exercitationem totam iusto saepe! Incidunt pariatur excepturi dolores quae debitis illo. Recusandae dolorum, possimus eaque quos mollitia iste sit praesentium?</p>

            <br><br>
            <button class="btn btn-primary" id="apply-button"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Apply Now</button>
            
         <?php }
            }
         
         ?>
          </div>
        </section>
        </div>
      </main>
      <!-- Modal for login -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background: #2d2d52;">
    <?php
    if(count($errors) > 0){ ?>
  <!--<div class="alert alert-danger alert-dismissile fade show text-center" id="danger-alert">-->
  <div class="container">
  <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" id="myAlert">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>
        <script>
          $(document).ready(function () {
            window.setTimeout(function() {
              $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                  $(this).remove(); 
              });
          }, 3000);
          
          });
            </script>
            <?php
              foreach($errors as $showerror)
              {
                echo $showerror;
              }
          ?>
            </div>
              </div>
            <?php
              }
            ?>    
      <div class="modal-header" >
        <br>
      <h5 style="color: #fff; font-family: 'Roboto', sans-serif; font-weight: 800; text-align: center;">YOU NEED TO LOGIN FIRST BEFORE YOU APPLY FOR THIS JOB</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body " >
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" class="form-group needs-validation" novalidate autocomplete="off">
        <div class="col-auto">
          <label for="email" class="form-label" style="color: #fff;">Email</label>
          <input type="email" class="form-control" name="email" id="email2" style="color: white; border-top: none; border-right: none; border-left: none; border-bottom: 1px solid white; box-shadow: none; background: #2d2d52; border-color: #6559ca;" required>
          <div class="invalid-feedback">
            Please enter a valid email address.
          </div>
        </div>
        <div class="col-auto">
          <label for="password" style="color: #fff;">Password</label>
          <input type="password" class="form-control" name="password" id="password2" style="color: white; border-top: none; border-right: none; border-left: none; border-bottom: 1px solid white; box-shadow: none; background: #2d2d52; border-color: #6559ca;" required>
          <div class="invalid-feedback">
            Please enter a valid password.
          </div>
        </div>
        <br><br>
        <div class="col-auto">
          <h6>Don't have an account yet? <a href="register_applicant.php" style="color: #fff;">Click here</a> to sign up.</h6>
          <button type="submit" name="login" class="btn mb-3" style="background: #6559ca; color: white;">Login</button>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
      <br><br><br><br><br><br><br><br>
     
      <?php include 'footer.php';?>
</body>
</html>

























