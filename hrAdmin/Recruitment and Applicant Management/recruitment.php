<?php
session_Start();
include '../../../../ALEGARIO/Hospital-template/database/connection.php';


if (isset($_SESSION['username'], $_SESSION['password'])) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="refresh" content="1600; url=../../../../ALEGARIO/Hospital-template/index.php">

    <title>Recruitment Management - Alegario Cure Hospital</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/alegario_logo" rel="icon">
    <link href="../assets/img/alegario_logo" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600&family=Bebas+Neue&family=Catamaran:wght@300&family=Comfortaa:wght@500&family=Fira+Sans:wght@300;400;500;600;700;800&family=Heebo:wght@100;200;300;400;500;600;700;800;900&family=Hind&family=Inter:wght@300;400;600;800&family=Poiret+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:wght@500;600&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Source+Sans+3&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="">


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="">



    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
  </head>

  <body>
    <?php include '../body/inside-header.php';
    include '../body/inside-sidebar.php'; ?>
    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Recruitment Management</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
            <li class="breadcrumb-item active">Recruitment Management</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->



      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#posted-jobs">Posted Jobs</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#applicants">Applicants</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#send-email">Send Email Message</button>
            </li>

          </ul>

          <!-- View Posted Jobs -->
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="posted-jobs">
              <table class="table table-striped table-hover" id="example" style="font-family: 'Roboto', sans-serif !important; text-align: center;">
                <thead>
                  <tr>
                    <th>Job ID</th>
                    <th>Job Title</th>
                    <th>Job Type</th>
                    <th>Job Status</th>
                    <th>Job Employer</th>
                    <th>Company Name</th>
                    <th>Date Posted</th>
                    <th>Actions</th>
                    <th>Actions</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../../JobPortal/database/connection.php';

                  $query = "SELECT job.*, emp.*, DATE_FORMAT(date_posted, '%M %d, %Y')as formatted_date FROM job_tbl job, employer_tbl emp WHERE emp.id = job.empr_id";
                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {

                  ?>
                      <tr>
                        <td><?php echo $row['job_id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['type']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['firstname'], " ", $row['lastname']; ?></td>
                        <td><?php echo $row['companyName']; ?></td>
                        <td><?php echo $row['formatted_date']; ?></td>
                        <td><button class="btn btn-success">Update</button></td>
                        <td><button class="btn btn-danger">Delete</button></td>
                      </tr>
                  <?php }
                  } ?>
                </tbody>
              </table>


            </div>



            <!-- View Applicants -->
            <div class="tab-pane" id="applicants">
              <!-- Button trigger modal -->

              <label for="filter-select">Filter by:</label>
              <select id="filter-select" class="form-select" style="box-shadow: none;">
                <option value="All">All</option>
                <option value="Shortlisted">Shortlisted</option>
                <option value="Not Shortlisted">Not Shortlisted</option>
              </select>
              <table class="table table-borderless" id="example1" style="font-family: 'Roboto', sans-serif !important; text-align: center;">
                <thead>
                  <tr>
                    <th>Applicant ID</th>
                    <th>Applicant Name</th>
                    <th>Email Address</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Job Applied</th>
                    <th>Date Applied</th>
                    <th>Resume Attached</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>Actions</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../../JobPortal/database/connection.php';

                  $query = "SELECT job.*, applicant.*, resume.*, DATE_FORMAT(date_uploaded, '%M %d, %Y')as formatted_date FROM job_tbl job, applicant_tbl applicant, resume_tbl resume WHERE applicant.id = resume.a_id AND job.job_id = resume.j_id";
                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $resume =  $row['resume_attachment'];
                  ?>
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['email_address']; ?></td>
                        <td><?php echo $row['street'], " ", $row['barangay'], " ", $row['city'], " ", $row['states'], " ", $row['zip']; ?></td>
                        <td><?php echo $row['mobile_number']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['formatted_date']; ?></td>
                        <td><button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $row['r_id']; ?>" style="text-decoration: underline; box-shadow: none !important; outline: none !important;"><?php echo $row['resume_attachment']; ?></button></td>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-<?php echo $row['r_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">RESUME ATTACHED</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <iframe <?php echo 'src="../../JobPortal/employer/resumeStorage/' . $row['resume_attachment'] . '"'; ?> height="1000" width="100%"></iframe>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        if($row['resume_status'] === "SHORTLISTED"){
                        ?>

                        <td><span class="badge bg-success">Shortlisted</span></td>

                        <?php 
                        }
                        elseif($row['resume_status'] === "NOT SHORTLISTED"){
                        ?>
                        <td><span class="badge bg-danger">Not Shortlisted</span></td>
                        <?php }?>
                        <td><button type="button" name="shortlist" class="btn btn-primary">Shortlist</button></td>
                        <td>Reject</td>
                      </tr>
                  <?php }
                  } ?>
                </tbody>
              </table>
            </div>


            <!-- Send Email -->
            <div class="tab-pane" id="send-email">



            </div>
          </div>




        </div>
      </div>





    </main>


















    <script>
      // Posted job table
      $(document).ready(function() {
        $('#example').DataTable();
      });


      // Applicant table
      $(document).ready(function() {
        var table = $('#example1').DataTable();

        $('#filter-select').on('change', function() {
          var selectedOption = $(this).val();
          if (selectedOption === 'Shortlisted') {
            table.search('Shortlisted').draw();
          } else if (selectedOption === 'Not Shortlisted') {
            table.search('Not Shortlisted').draw();
          } else {
            table.search('').draw();
          }
        });
      });
    </script>















    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.min.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
  </body>

  </html>
<?php
} else {
  header("location: ../../../../ALEGARIO/Hospital-template/index.php");
  session_destroy();
}
unset($_SESSION['prompt']);
mysqli_close($con1);
?>