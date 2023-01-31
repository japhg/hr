 <?php
  include "../database/connection.php";
  include "../body/function.php";
  session_start();
  $errors = array();

 if (isset($_POST['apply'])) {
   $job_id = $_POST['job_id'];
   $applicant_id = $_POST['applicant_id'];

   $file = $_FILES['file'];
   $filename = $_FILES["file"]["name"];
   $tempname = $_FILES["file"]["tmp_name"];
   $folder = "../employer/resumeStorage/" . $filename;

   $folderDestination = $folder;



   // Check if the applicant has already applied to 3 different jobs
   $query = "SELECT COUNT(DISTINCT j_id) as job_count FROM resume_tbl WHERE a_id = $applicant_id";
   $result = mysqli_query($con, $query);
   if (mysqli_num_rows($result) > 0) {
     $row = mysqli_fetch_assoc($result);
     if ($row['job_count'] >= 3) {

       // Show the error message
       $_SESSION['errorMessage'] = "You already applied to 3 different jobs.";
       header("location: searchjob.php");
       mysqli_close($con);
       exit;
     } 
     else {


       // Resume checking
       $resume_check = "SELECT * FROM resume_tbl WHERE a_id = '$applicant_id' AND j_id = '$job_id'";
       $res = mysqli_query($con, $resume_check);
       if (mysqli_num_rows($res) > 0) {
         $_SESSION['errorMessage'] = "You are already applied to this Job!";
         header("location: searchjob.php");
       } 
       else if (!empty($filename)) {
         move_uploaded_file($tempname, $folderDestination);
         $sql = "INSERT INTO resume_tbl(a_id,j_id,resume_attachment) VALUES('$applicant_id','$job_id','$filename')";
         $result = mysqli_query($con, $sql);


         $_SESSION['message'] = "File uploaded successfully";
         header("location: searchjob.php");
       } else {

         $_SESSION['errorMessage'] = "Failed to upload file";
       }
     }
   }
 }


  if (isset($_SESSION['email'], $_SESSION['password'])) {
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
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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



     <title>Job Details</title>

   </head>

   <body>
     <?php include '../body/loader.php';
      include 'page/header.php';
      ?>

     <br><br><br><br><br><br><br><br>

     <div class="head">
       <div class="container">
         <h1 style="font-family: 'Roboto', sans-serif; color: #6559ca; font-weight: 800;">JOB DETAILS</h1>
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
           <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="../applicant/searchjob.php" style="color: #000;">Search Jobs</a></li>
             <li class="breadcrumb-item active" aria-current="page">Job Details</li>
           </ol>
         </nav>
         <br><br>
       </div>
     </div>


     <div class="body">
       <div class="container">
         <?php


          $id = $_GET['jobid'];
          $query = "SELECT e.*, j.*, DATE_FORMAT(date_posted, '%M %d, %Y')as formatted_date FROM employer_tbl e, job_tbl j WHERE e.id = j.empr_id AND job_id = '$id'";
          if ($result = mysqli_query($con, $query)) {

            $row = mysqli_fetch_assoc($result);
            $_SESSION['job_details'] = $row;
            $image = $row['companyLogo'];

          ?>
           <img alt="" class="img-thumbnail" width="100vw" <?php echo '<img src="../imageStorage/' . $image . '" />'; ?> <br><br>
           <h1 class="small mb-0" style="text-transform: uppercase;"><?php echo $row['title']; ?></h1>
           <h5 class="small mb-0"><span class="material-symbols-sharp" style="color: #6559ca;">apartment</span> <?php echo $row['companyName']; ?></h5>
           <h6 class="small mb-0"><span class="material-symbols-sharp" style="color: #6559ca;">location_on</span> <?php echo $row['street'], ", ", $row['barangay'], ", ", $row['city'], ", ", $row['state']; ?></h6>
           <h6 class="small mb-0"><span class="material-symbols-sharp" style="color: #6559ca;">calendar_month</span> <?php echo $row['formatted_date']; ?></h6>
           <h6 class="small mb-0"><span><br>Posted by: <a href="#"><?php echo $row['firstname'], " ", $row['lastname']; ?></a></span></h6>
           <br>
           <hr>
           <h5 class="small mb-0" style="font-weight: bold;">JOB DESCRIPTION</h5>
           <p class="small mb-0" style="text-indent: 2rem; color: #000; text-align: justify;"><?php echo $row['jobDescription']; ?></p>
           <br><br>
           <h5 class="small mb-0" style="font-weight: bold;">JOB QUALIFICATIONS</h5>
           <ul class="small mb-0">
             <li style="color: #000;">
               Candidate must possess at least a Bachelor's/College Degree , any field.
             </li>
             <li style="color: #000;">
               At least 3 year(s) of working experience in the related field is required for this position.
             </li>
             <li style="color: #000;">
               Preferably 1-4 Yrs Experienced Employees specializing in IT/Computer - Software or equivalent
             </li>
             <li style="color: #000;">
               Applicants must be willing to work in Tarlac area
             </li>
           </ul>
           <br><br>
           <div class="block small mb-0">
             <h5 class="small mb-0" style="font-weight: bold;">SKILLS</h5>
             <p style="color: #000;"><?php echo $row['skills']; ?></p>
             <br><br>
             <h5 class="small mb-0" style="font-weight: bold;">YEARS OF EXPERIENCE</h5>
             <p style="color: #000;"> - <?php echo $row['years']; ?></p>
             <br>
             <h5 class="small mb-0" style="font-weight: bold;">SALARY</h5>
             <p style="color: #000;"> - <?php echo $row['salary']; ?></p>
             <br>
             <h5 class="small mb-0" style="font-weight: bold;">JOB TYPE</h5>
             <p style="color: #000;"><?php echo $row['type']; ?></p>
           </div>
           <br>
           <h5 class="small mb-0" style="font-weight: bold;">BENEFITS</h5>
           <ul class="small mb-0">
             <li style="color: #000;"><?php echo $row['benefits']; ?></li>
           </ul>
           <br>
           <hr>
           <h4 class="small mb-0" style="font-weight: bold;">COMPANY INFORMATION</h4>
           <br>
           <h5 class="small mb-0" style="font-weight: bold;">COMPANY NAME</h5>
           <p class="small mb-0" style="color: #000;"><?php echo $row['companyName']; ?></p>
           <br><br>
           <h5 class="small mb-0" style="font-weight: bold;">COMPANY ADDRESS</h5>
           <p class="small mb-0" style="color: #000;"><?php echo $row['street'], ', ', $row['barangay'], ', ', $row['city'], ', ', $row['state']; ?></p>
           <br><br>
           <h5 class="small mb-0" style="font-weight: bold;">COMPANY DESCRIPTION</h5>
           <p class="small mb-0" style="text-indent: 2rem; color: #000; text-align: justify;"><?php echo $row['description']; ?></p>

           <br><br>


           <button type="button" name="apply" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background: #6559ca; color: #fff; border: none; box-shadow: none;">Apply Now</button>
         <?php }

          ?>


         <!--Modal-->
         <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
               <div class="modal-header">
                 <br>
                 <h5 style="color: #000; font-family: 'Roboto', sans-serif; font-weight: 800; text-align: center;">UPLOAD YOUR RESUME PICTURE</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: none !important;"></button>
               </div>
               <div class="modal-body">
                 <!-- Form -->

                 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-group needs-validation" novalidate enctype="multipart/form-data">
                   <?php
                    $query = "SELECT * FROM applicant_tbl WHERE email_address = '" . $_SESSION['email'] . "'";
                    $result = mysqli_query($con, $query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                   <div class="col-auto">
                     <input type="hidden" name="job_id" value="<?php echo $id; ?>">
                     <input type="hidden" name="applicant_id" value="<?php echo $row['id']; ?>">
                     <label for="email" class="form-label" style="color: #000;">Please Upload your Resume</label>
                     <input type="file" class="form-control" name="file" id="file" style="color: #000; box-shadow: none; border-color: #6559ca;" required>
                     <div class="invalid-feedback">
                       Please insert your Resume/CV.
                     </div>
                   </div>
                   <br>
                   <button type="submit" name="apply" class="btn" style="background: #6559ca; color: #fff; border: none;">Upload</button>
                   <?php
                    ?>
                 </form>

               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #121212 !important;">Close</button>
               </div>
             </div>
           </div>
         </div>




       </div>
     </div>
     </div>


     </main>
     <br><br><br><br><br><br><br><br>
     <?php include '../body/footer.php'; ?>







     <!-- Vendor JS Files -->
     <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
     <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="../assets/vendor/chart.js/chart.min.js"></script>
     <script src="../assets/vendor/echarts/echarts.min.js"></script>
     <script src="../assets/vendor/quill/quill.min.js"></script>
     <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
     <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
     <script src="../ssets/vendor/php-email-form/validate.js"></script>

     <!-- Template Main JS File -->
     <script src="../assets/js/main.js"></script>



   </body>

   </html>
 <?php
  } else {
    header("location:../applicant/login_applicant.php");
    session_destroy();
  }
  unset($_SESSION['prompt']);
  mysqli_close($con);
  ?>