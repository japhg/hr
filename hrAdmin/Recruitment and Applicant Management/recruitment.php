<?php
session_Start();
include '../../../../ALEGARIO/Hospital-template/database/connection.php';
include '../../JobPortal/database/connection.php';


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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="../../JobPortal/database/connection.php">



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
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shortlisting">Shortlisting</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#screening">Screening of Applicants</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#initial-interview">Initial Interview</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#final-interview">Final Interview</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#send-email">Send Email Message</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#rejected-applicant">Rejected Applicants</button>
            </li>

          </ul>

          <!-- View Posted Jobs -->
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="posted-jobs">
              <table class="table" id="example" style="font-family: 'Roboto', sans-serif !important; text-align: center; width: 100%;">
                <thead class="bg-dark text-white">
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
            <div class="tab-pane" id="shortlisting">
              <!-- Button trigger modal -->

              <label for="filter-select">Filter by:</label>
              <select id="filter-select" class="form-select" style="box-shadow: none;">
                <option value="All">All</option>
                <option value="Short listed">Shortlisted</option>
                <option value="Not-Shortlisted">Not Shortlisted</option>

              </select>
              <table class="table table-sm table-borderless" id="example1" style="font-family: 'Roboto', sans-serif !important; text-align: center;">
                <thead class="bg-dark text-white">
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


                  $query = "SELECT job.*, applicant.*, resume.*, DATE_FORMAT(date_uploaded, '%M %d, %Y')as formatted_date FROM job_tbl job, applicant_tbl applicant, resume_tbl resume WHERE applicant.id = resume.a_id AND job.job_id = resume.j_id";
                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $resume =  $row['resume_attachment'];

                      if ($row['resume_status'] === "Shortlisting Rejected" || $row['resume_status'] !== "Shortlisted" && $row['resume_status'] !== "Not Shortlisted") {
                        continue;
                      }
                  ?>
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['firstname'], ' ', $row['lastname']; ?></td>
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
                        if ($row['resume_status'] === "Shortlisted") {
                        ?>

                          <td><span class="badge bg-success">Short listed</span></td>
                          <td><button type="button" name="shortlist" class="btn btn-primary" disabled>Shortlist</button></td>
                          <td><button type="button" name="reject" class="btn btn-dark" disabled>Reject</button></td>

                        <?php
                        } elseif ($row['resume_status'] === "Not Shortlisted") {
                        ?>
                          <td><span class="badge bg-secondary">Not-Shortlisted</span></td>

                          <td>
                            <input type="hidden" name="view" class="view" id="views" value="<?php echo $row['r_id']; ?>">
                            <a href="javascript:void(0)" class="shortlist_btn_ajax btn btn-primary">Shortlist</a>
                          </td>
                          <td>
                            <input type="hidden" name="rview" class="rview" id="rviews" value="<?php echo $row['r_id']; ?>">
                            <a href="javascript:void(0)" class="shortlist_reject_btn_ajax btn btn-dark">Reject</a>
                          </td>

                        <?php } ?>

                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>




            <!-- Screening -->
            <div class="tab-pane" id="screening">

              <table class="table table-borderless" id="screening_dataTable" style="font-family: 'Roboto', sans-serif !important; text-align: center;">
                <thead class="bg-dark text-white">
                  <tr>
                    <th>ID</th>
                    <th>Candidate Name</th>
                    <th>Email Address</th>
                    <th>Contact Number</th>
                    <th>Resume file</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Action</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php


                  $query = "SELECT job.*, applicant.*, resume.*, DATE_FORMAT(date_uploaded, '%M %d, %Y')as formatted_date FROM job_tbl job, applicant_tbl applicant, resume_tbl resume WHERE applicant.id = resume.a_id AND job.job_id = resume.j_id";
                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $resume =  $row['resume_attachment'];

                      if ($row['resume_status'] === "Screening Rejected" || $row['resume_status'] !== "Shortlisted" && $row['resume_status'] !== "Appointed"&& $row['resume_status'] !== "Screening Passed") {
                        continue;
                      }
                  ?>
                      <tr>
                        <td><?php echo $row['r_id']; ?></td>
                        <td><?php echo $row['firstname'], ' ', $row['lastname']; ?></td>
                        <td><?php echo $row['email_address']; ?></td>
                        <td><?php echo $row['mobile_number']; ?></td>
                        <td>
                          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $row['r_id']; ?>" style="text-decoration: underline; box-shadow: none !important; outline: none !important;">
                            <?php echo $row['resume_attachment']; ?>
                          </button>
                        </td>
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
                        if ($row['resume_status'] === "Screening Passed") {
                        ?>

                          <td><span class="badge bg-success">Screening Passed</span></td>
                          <td><button type="button" name="appoint_passed" class="btn btn-primary" disabled>Appointed</button></td>
                          <td><button type="button" name="appoint_passed" class="btn btn-primary" disabled>Approved</button></td>
                          <td><button type="button" name="reject" class="btn btn-dark" disabled>Reject</button></td>

                        <?php
                        } elseif ($row['resume_status'] === "Shortlisted") {
                        ?>
                         <td><span class="badge bg-warning">Pending</span></td>
                          <td>
                            <button type="button" class="btn btn-primary appoint_screening">Appoint</button>
                          </td>
                          <td>
                           
                          </td>
                          <td>
                            <input type="hidden" name="reject_appoint" class="reject_appoint" id="reject_appoint" value="<?php echo $row['r_id']; ?>">
                            <a href="javascript:void(0)" class="screening_reject_btn_ajax btn btn-dark">Reject</a>
                          </td>
                          <?php
                        } elseif ($row['resume_status'] === "Appointed") {
                        ?>
                         <td><span class="badge bg-secondary">Appointed</span></td>
                          <td>
                            <button type="button" class="btn btn-primary appoint_screening" disabled>Appointed</button>
                          </td>
                          <td>
                          <input type="hidden" name="approve_screening" class="approve_screening" id="approve_screening" value="<?php echo $row['r_id']; ?>">
                            <a href="javascript:void(0)" class="approve_screening_btn_ajax btn btn-success">Approve</a>
                          </td>
                          <td>
                             <a href="javascript:void(0)" class="screening_reject_btn_ajax btn btn-dark" disabled>Reject</a>
                          </td>

                        <?php } ?>
                  <?php }
                  } ?>
                </tbody>
              </table>

                <!-- Appoint Screening Modal Form ################################################################################################################################################# -->
                <div class="modal fade" id="appoint_screening" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Appoint Screening</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php
                        $query = "SELECT * 
                        FROM resume_tbl";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result)) {
                          $row = mysqli_fetch_assoc($result);

                        ?>
                          <form action="actions.php" method="post" class="form-group needs-validation" novalidate>

                            <hr><br>
                          <input type="text" name="resume_id" id="resume_id" value="<?php echo $row['r_id']; ?>">
                          <div class="col-auto">
                          <label for="appointmentDateAndTime" class="form-label" style="color: #000;">Appoint Date and Time</label>
                          <input type="datetime-local" class="form-control" name="appointmentDateAndTime" id="appointmentDateAndTime" style="box-shadow: none;" required>
                          <div class="invalid-feedback">
                                This field is required.
                          </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="appoint_screening" class="btn btn-primary">Appoint</button>
                      </div>
                      </form>
                    <?php } ?>
                    </div>
                  </div>
                </div>

            </div>

            <!-- Initial Interview -->
            <div class="tab-pane" id="initial-interview">



            </div>

            <!-- Final Interview -->
            <div class="tab-pane" id="final-interview">



            </div>


            <!-- Send Email -->
            <div class="tab-pane" id="send-email">



            </div>

            <!-- Send Email -->
            <div class="tab-pane" id="rejected-applicant">
              <table class="table table-borderless" id="example3">
                <thead class="bg-dark text-white">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Resume Attachment</th>
                    <th>Rejection Status</th>
                    <th>Rejection Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT resume.*, reject.*, DATE_FORMAT(rejection_date, '%M %d, %Y')as formatted_date FROM resume_tbl resume, rejected_applicant reject WHERE resume.r_id = reject.resume_id";
                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['resume_attachment']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['formatted_date']; ?></td>
                      </tr>
                  <?php }
                  }
                  ?>
                </tbody>
              </table>

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
          if (selectedOption === 'Short listed') {
            table.search('Short listed', true, false, true).draw();
          } else if (selectedOption === 'Not-Shortlisted') {
            table.search('Not-Shortlisted', true, false, true).draw();
          } else if (selectedOption === 'Rejected') {
            table.search('Rejected', true, false, true).draw();
          } else {
            table.search('').draw();
          }
        });
      });

      // Rejected Applicant Table
      $(document).ready(function() {
        $('#initial').DataTable();
      });

      // Screening Table
      $(document).ready(function() {
        $('#screening_dataTable').DataTable();
      });
    </script>

    <script>
      // For Applicant Shortlist
      $(document).ready(function() {
        $('.shortlist_btn_ajax').click(function(e) {
          e.preventDefault();

          var closeid = $(this).closest("tr").find('.view').val();

          swal({
              title: "Are you sure you want to shortlist this?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

                $.ajax({
                  type: "POST",
                  url: "actions.php",
                  data: {
                    "shortlist_btn_set": 1,
                    "shortlist_id": closeid,
                  },
                  success: function(response) {

                    swal("Successfully shortlisted!", {
                      icon: "success",
                    }).then((result) => {
                      location.reload();
                    });

                  }
                });

              }
            });

        });
      });

      // For Applicant Shortlist Rejection
      $(document).ready(function() {
        $('.shortlist_reject_btn_ajax').click(function(e) {
          e.preventDefault();

          var shortlistRejectid = $(this).closest("tr").find('.rview').val();

          swal({
              title: "Are you sure you want to Reject this?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

                $.ajax({
                  type: "POST",
                  url: "actions.php",
                  data: {
                    "shortlist_reject_btn_set": 1,
                    "shortlist_reject_id": shortlistRejectid,
                  },
                  success: function(response) {

                    swal("Successfully Rejected!", {
                      icon: "success",
                    }).then((result) => {
                      location.reload();
                    });

                  }
                });

              }
            });

        });
      });


      // For Applicant Screening Appoint
      $(document).ready(function() { 
        $('.appoint_screening').on('click', function() {
          $('#appoint_screening').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get();
          console.log(data);
          $('#resume_id').val(data[0]);
        });
      });

       // For Approve Screening
       $(document).ready(function() {
        $('.approve_screening_btn_ajax').click(function(e) {
          e.preventDefault();

          var closeid = $(this).closest("tr").find('.approve_screening').val();

          swal({
              title: "Are you sure you want to Approve this?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

                $.ajax({
                  type: "POST",
                  url: "actions.php",
                  data: {
                    "approve_screening_btn_set": 1,
                    "approve_screening_id": closeid,
                  },
                  success: function(response) {

                    swal("Successfully shortlisted!", {
                      icon: "success",
                    }).then((result) => {
                      location.reload();
                    });

                  }
                });

              }
            });

        });
      });
        

      // For Applicant Screening Rejection
      $(document).ready(function() {
        $('.screening_reject_btn_ajax').click(function(e) {
          e.preventDefault();

          var shortlistRejectid = $(this).closest("tr").find('.reject_appoint').val();

          swal({
              title: "Are you sure you want to Reject this?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

                $.ajax({
                  type: "POST",
                  url: "actions.php",
                  data: {
                    "screening_reject_btn_set": 1,
                    "screening_reject_id": shortlistRejectid,
                  },
                  success: function(response) {

                    swal("Successfully Rejected!", {
                      icon: "success",
                    }).then((result) => {
                      location.reload();
                    });

                  }
                });

              }
            });

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