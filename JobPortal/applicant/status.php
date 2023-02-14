<?php
include "../database/connection.php";
include "../body/function.php";
session_start();

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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- JS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    <link rel="stylesheet" href="../css/style/search_results.css">
    <link rel="stylesheet" href="../css/style/status.css">
    <link rel="stylesheet" href="../css/style/header.css">
    <link rel="stylesheet" href="../css/bootstrap.css">



    <title>My Status</title>

  </head>

  <body>
    <?php include '../body/loader.php';
    include 'page/header.php';
    ?>

    <br><br><br><br><br><br><br><br>

    <div class="header">
      <div class="container">
        <h1 style="font-family: 'Roboto', sans-serif; color: #6559ca; font-weight: 800;">MY STATUS</h1>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../applicant/searchjob.php" style="color: #000;">Search Jobs</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Status</li>
          </ol>
        </nav>
        <br><br>
      </div>
    </div>


    <div class="main">
    <?php
      $query = "SELECT job.*, applicant.*, resume.*, DATE_FORMAT(date_uploaded, '%M %d, %Y')as formatted_date FROM job_tbl job, applicant_tbl applicant, resume_tbl resume WHERE applicant.id = resume.a_id AND job.job_id = resume.j_id AND email_address = '" . $_SESSION['email'] . "'";
      $result = mysqli_query($con, $query);
      if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
          $status = $row['resume_status'];
          $status1 = "Interview";

      ?>
          <div class="title"><?php echo $row['title']; ?></div>
          <ul id="ul">


            <li>
            <span class="material-symbols-sharp">description</span>
              <div class="progres one <?php if ($status === "Shortlisted" || $status === "Screening" || $status === "Initial Interview" || $status === "Examination" || $status === "Final Interview" || $status === "Screening Rejected" || $status === "Initial Interview Rejected" || $status === "Examination Failed" || $status === "Final Interview Rejected") echo "active";
                                      else if ($status === "Shortlisting Rejected") echo "rejected"; ?>">
                <p>1</p>
                <?php if ($status === "Shortlisted" || $status === "Screening" || $status === "Initial Interview" || $status === "Examination" || $status === "Final Interview" || $status === "Screening Rejected" || $status === "Initial Interview Rejected" || $status === "Examination Failed" || $status === "Final Interview Rejected") { ?>
                  <i class="uil uil-check"></i>
                <?php } else if ($status === "Shortlisting Rejected") { ?>
                  <i class="uil uil-times"></i>
                <?php } ?>
              </div>
              <p class="text">Shortlisting</p>
              <?php if ($status === "Not Shortlisted") { ?>
                  <p class='step-message'>Pending...</p>
                <?php } else if ($status === "Shortlisting Rejected"){?>
                <p class='step-message'>Rejected</p>
                <?php }?>
            </li>


            <li>
            <span class="material-symbols-sharp">work_history</span>
              <div class="progres two <?php if ($status === "Screening" || $status === "Initial Interview" || $status === "Examination" || $status === "Final Interview" || $status === "Initial Interview Rejected" || $status === "Examination Failed" || $status === "Final Interview Rejected") echo "active"; else if ($status === "Screening Rejected" ) echo "rejected"; ?>">
                <p>2</p>
                <?php if ($status === "Screening" || $status === "Initial Interview" || $status === "Examination" || $status === "Final Interview" || $status === "Initial Interview Rejected" || $status === "Examination Failed" || $status === "Final Interview Rejected") { ?>
                  <i class="uil uil-check"></i>
                <?php } else if ($status === "Screening Rejected") { ?>
                  <i class="uil uil-times"></i>
                <?php } ?>
              </div>
              <p class="text">Screening</p>
              <?php if ($status === "Screening Rejected"){?>
                <p class='step-message'>Rejected</p>
                <?php }?>
            </li>


            <li>
            <span class="material-symbols-sharp">person_pin</span>
              <div class="progres three <?php if ($status === "Initial Interview" || $status === "Examination" || $status === "Final Interview" || $status === "Examination Failed" || $status === "Final Interview Rejected") echo "active"; else if ($status === "Initial Interview Rejected") echo "rejected"; ?>">
                <p>3</p>
                <?php if ($status === "Initial Interview" || $status === "Examination" || $status === "Final Interview" || $status === "Examination Failed" || $status === "Final Interview Rejected") { ?>
                  <i class="uil uil-check"></i>
                <?php } else if ($status === "Initial Interview Rejected") { ?>
                  <i class="uil uil-times"></i>
                <?php } ?>
              </div>
              <p class="text">Initial Interview</p>
              <?php if ($status === "Initial Interview Rejected"){?>
                <p class='step-message'>Rejected</p>
                <?php }?>
            </li>


            <li>
            <span class="material-symbols-sharp">edit_document</span>
              <div class="progres four <?php if ($status === "Examination" || $status === "Final Interview" || $status === "Final Interview Rejected") echo "active"; else if ($status === "Examination Failed") echo "rejected";?>">
                <p>4</p>
                <?php if ($status === "Examination" || $status === "Final Interview" || $status === "Final Interview Rejected") { ?>
                  <i class="uil uil-check"></i>
                <?php } else if ($status === "Examination Failed") { ?>
                  <i class="uil uil-times"></i>
                <?php } ?>
              </div>
              <p class="text">Examination</p>
              <?php if ($status === "Examination Failed"){?>
                <p class='step-message'>Failed</p>
                <?php }?>
            </li>
            <li>
              <span class="material-symbols-sharp">supervisor_account</span>
              <div class="progres five <?php if ($status === "Final Interview") echo "active"; else if ($status === "Final Interview Rejected") echo "rejected";?>">
                <p>5</p>
                <?php if ($status === "Final Interview") { ?>
                  <i class="uil uil-check"></i>
                <?php } else if ($status === "Final Interview Rejected") { ?>
                  <i class="uil uil-times"></i>
                <?php } ?>
              </div>
              <p class="text">Final Interview</p>
              <?php if ($status === "Final Interview Rejected"){?>
                <p class='step-message'>Rejected</p>
                <?php }?>
            </li>
          </ul>

      <?php }
      } ?>
    </div>



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