<?php
session_Start();
include '../../database/connection.php';


if (isset($_SESSION['username'], $_SESSION['password'])) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="refresh" content="1600; url=../../index.php">

    <title>Recruitment Management - Alegario Cure Hospital</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="../../assets/img/alegario_logo.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600&family=Bebas+Neue&family=Catamaran:wght@300&family=Comfortaa:wght@500&family=Fira+Sans:wght@300;400;500;600;700;800&family=Heebo:wght@100;200;300;400;500;600;700;800;900&family=Hind&family=Inter:wght@300;400;600;800&family=Poiret+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:wght@500;600&family=Poppins:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Source+Sans+3&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">

    <!-- Main Quill library -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
      @font-face {
        font-family: 'Jamesphilip Bold';
        src: url(../assets/fonts/Fonts/sofiapro-light.otf);
      }
    </style>
  </head>

  <body>
    <?php include '../body/inside-header.php';
    include '../body/inside-sidebar.php'; ?>
    <main id="main" class="main">

      <div class="pagetitle">

        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
            <li class="breadcrumb-item active">Recruitment Management</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->



      <div class="card">
        <div class="card-body pt-3">


          <?php
          if (isset($_SESSION['success'])) { ?>
            <script>
              Swal.fire({
                icon: 'success',
                title: "<?php echo $_SESSION['success']; ?>",
              })
            </script>
          <?php unset($_SESSION['success']);
          } ?>


          <?php
          if (isset($_SESSION['error'])) { ?>
            <script>
              Swal.fire({
                icon: 'error',
                title: "<?php echo $_SESSION['error']; ?>",
              })
            </script>
          <?php unset($_SESSION['error']);
          } ?>


          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#posted-jobs">Posted Jobs</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shortlisting">Shortlisting</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#exam">Examinees</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#interview">Interview Schedule</button>
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

            <!-- JOBS ########################################################################################################### -->
            <div class="tab-pane fade show active profile-overview" id="posted-jobs">
              <br><br>
              <div class="table">
                <h3>JOB REQUESTS</h3>
                <table class="table" id="example" style="font-family: 'Jamesphilip Bold', sans-serif !important; text-align: center; width: 100%;">
                  <thead class="bg-light text-center">
                    <tr>
                      <th>#</th>
                      <th>Job Title</th>
                      <th>Job Type</th>
                      <th>Number of applicants</th>
                      <th>Department Name</th>
                      <th>Actions</th>


                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $query = "SELECT job_request.*, department.department_name
                    FROM hr_job_request job_request, hr_department department
                    WHERE job_request.department_id = department.id";

                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result)) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['token'] === "1") {
                    ?>
                          <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['job_title']; ?></td>
                            <td><?php echo $row['job_type']; ?></td>
                            <td><?php echo $row['num_applicants']; ?></td>
                            <td><?php echo $row['department_name'] ?></td>
                            <td>
                              <input type="hidden" name="previewModalId" class="previewModalId" value="<?php echo $row['id']; ?>">
                              <button class="btn btn-info text-white btn-sm previewBtn">Preview</button>
                              <input type="hidden" name="postJobs" class="postJobs" id="postJobs" value="<?php echo $row['id']; ?>">
                              <a href="javascript:void(0)" class="postJobsBtn btn btn-sm" style="background: #57d8cd; color: #fff;">Post</a>
                            </td>
                          </tr>
                    <?php }
                      }
                    } ?>
                  </tbody>
                </table>
              </div>


              <!-- Posted Jobs -->
              <br><br><br>
              <div class="table">
                <h3>POSTED JOBS</h3>
                <table class="table" id="example2" style="font-family: 'Jamesphilip Bold', sans-serif !important; text-align: center; width: 100%;">
                  <thead class="bg-light text-center">
                    <tr>
                      <th>#</th>
                      <th>Job Title</th>
                      <th>Job Type</th>
                      <th>Number of applicants</th>
                      <th>Department Name</th>
                      <th>Actions</th>


                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $query = "SELECT * FROM hr_job_list";

                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result)) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['status'] === "ACTIVE") {
                    ?>
                          <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['job_title']; ?></td>
                            <td><?php echo $row['job_type']; ?></td>
                            <td><?php echo $row['num_applicants']; ?></td>
                            <td><?php echo $row['department_name'] ?></td>
                            <td>
                              <input type="hidden" name="previewModalId" class="previewModalId" value="<?php echo $row['id']; ?>">
                              <button class="btn btn-info btn-sm text-white previewBtn">View</button>
                              <input type="hidden" name="postJobs" class="postJobs" id="postJobs" value="<?php echo $row['id']; ?>">
                              <a href="javascript:void(0)" class="postJobsBtn btn btn-sm" style="background: #57d8cd; color: #fff;">Post</a>
                            </td>
                          </tr>
                    <?php }
                      }
                    } ?>
                  </tbody>
                </table>
              </div>

              <!-- Preview Job before post -->
              <div class="modal fade" id="previewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="previewModalLabel-<?php echo $row['id']; ?>">Preview Job Request</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                  </div>
                </div>
              </div>
              <!-- End of modal -->
            </div>




            <!-- SHORTLISTING ################################################################################################# -->
            <div class="tab-pane" id="shortlisting">
              <br><br>
              <!-- Shortlisting -->
              <div class="table">
                <h3>SHORTLISTING</h3>
                <table class="table" id="example3" style="font-family: 'Jamesphilip Bold', sans-serif !important; text-align: center; width: 100%;">
                  <thead class="bg-light text-center">
                    <tr>
                      <th>#</th>
                      <th>Applicant Name</th>
                      <th>Email Address</th>
                      <th>Address</th>
                      <th>Phone Number</th>
                      <th>Job Applied</th>
                      <th>Date Applied</th>
                      <th>Resume Attached</th>
                      <th>Status</th>
                      <th>Actions</th>



                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $query = "SELECT job.*, applicant.*, resume.*, DATE_FORMAT(date_uploaded, '%M %d, %Y')as formatted_date 
                    FROM hr_job_list job, hr1_applicant applicant, hr1_resume resume 
                    WHERE applicant.id = resume.applicant_id AND job.id = resume.job_list_id";

                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result)) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['resume_status'] === "Shortlisting Rejected" || $row['resume_status'] !== "Shortlisted" && $row['resume_status'] !== "Not Shortlisted") {
                          continue;
                        }

                    ?>
                        <tr>
                          <td><?php echo $row['id']; ?></td>
                          <td><?php echo $row['firstname'], ' ', $row['lastname']; ?></td>
                          <td><?php echo $row['email_address']; ?></td>
                          <td><?php echo $row['street'], " ", $row['barangay'], " ", $row['city'], " ", $row['state'], " ", $row['zip_code']; ?></td>
                          <td><?php echo $row['mobile_number']; ?></td>
                          <td><?php echo $row['job_title']; ?></td>
                          <td><?php echo $row['formatted_date']; ?></td>
                          <td><button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $row['id']; ?>" style="text-decoration: underline; box-shadow: none !important; outline: none !important;"><?php echo $row['resume_attachment']; ?></button></td>

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <td>
                              <button type="button" name="shortlist" class="btn btn-sm" style="background: #57d8cd; color: #fff;" disabled>Shortlist</button>
                              <button type="button" name="reject" class="btn btn-dark btn-sm" disabled>Reject</button>
                            </td>
                          <?php
                          } elseif ($row['resume_status'] === "Not Shortlisted") {
                          ?>
                            <td><span class="badge bg-secondary">Not-Shortlisted</span></td>

                            <td>
                              <input type="hidden" name="view" class="view" id="views" value="<?php echo $row['id']; ?>">
                              <a href="javascript:void(0)" class="shortlist_btn_ajax btn btn-sm" style="background: #57d8cd; color: #fff;">Shortlist</a>

                              <input type="hidden" name="rview" class="rview" id="rviews" value="<?php echo $row['id']; ?>">
                              <a href="javascript:void(0)" class="shortlist_reject_btn_ajax btn btn-dark btn-sm">Reject</a>
                            </td>

                          <?php } ?>

                        </tr>
                    <?php }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <br><br><br>

              <!-- APPOINT SCREENING -->
              <div class="table">
                <h3>APPOINT SCREENING</h3>
                <table class="table table-borderless" id="screening_dataTable" style="font-family: 'Jamesphilip Bold', sans-serif !important; text-align: center;">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Candidate Name</th>
                      <th>Email Address</th>
                      <th>Contact Number</th>
                      <th>Job Title</th>
                      <th>Resume file</th>
                      <th>Status</th>
                      <th>Appoint/Resched</th>
                      <th>Approve/Reject</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php


                    $query = "SELECT job.*, applicant.*, resume.*, DATE_FORMAT(date_uploaded, '%M %d, %Y')as formatted_date 
                  FROM hr_job_list job, hr1_applicant applicant, hr1_resume resume 
                  WHERE applicant.id = resume.applicant_id AND job.id = resume.job_list_id";

                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result)) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        $resume =  $row['resume_attachment'];

                        if ($row['resume_status'] === "Screening Rejected" || $row['resume_status'] !== "Shortlisted" && $row['resume_status'] !== "Appointed"  && $row['resume_status'] !== "Screening Appointed") {
                          continue;
                        }
                    ?>
                        <tr>
                          <td><?php echo $row['id']; ?></td>
                          <td><?php echo $row['firstname'], ' ', $row['lastname']; ?></td>
                          <td><?php echo $row['email_address']; ?></td>
                          <td><?php echo $row['mobile_number']; ?></td>
                          <td><?php echo $row['job_title']; ?></td>
                          <td>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $row['id']; ?>" style="text-decoration: underline; box-shadow: none !important; outline: none !important;">
                              <?php echo $row['resume_attachment']; ?>
                            </button>
                          </td>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <td><button type="button" name="appoint_passed" class="btn btn-sm" style="background: #57d8cd; color: #fff;" disabled>Approved</button></td>
                            <td><button type="button" name="reject" class="btn btn-dark" disabled>Reject</button></td>

                          <?php
                          } elseif ($row['resume_status'] === "Shortlisted") {
                          ?>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                              <button type="button" class="btn btn-sm appoint_screening" style="background: #57d8cd; color: #fff;">Appoint</button>
                              <button type="button" class="btn btn-secondary btn-sm appoint_screening">Resched</button>
                            </td>

                            <td>
                              <input type="hidden" name="passed_screening" class="passed_screening" id="passed_screening" value="<?php echo $row['id']; ?>">
                              <a href="javascript:void(0)" class="btn btn-sm" disabled style="background: #57d8cd; color: #fff;">Approves</a>
                              <input type="hidden" name="reject_appoint" class="reject_appoint" id="reject_appoint" value="<?php echo $row['id']; ?>">
                              <a href="javascript:void(0)" class="screening_reject_btn_ajax btn btn-dark btn-sm">Reject</a>
                            </td>
                          <?php
                          } elseif ($row['resume_status'] === "Screening Appointed") {
                          ?>
                            <td><span class="badge bg-secondary">Appointed</span></td>
                            <td>
                              <button type="button" class="btn btn-sm appoint_screening" style="background: #57d8cd; color: #fff;" disabled>Appointed</button>
                            </td>
                            <td>
                              <input type="hidden" name="approve_screening" class="approve_screening" id="approve_screening" value="<?php echo $row['id']; ?>">
                              <a href="javascript:void(0)" class="approve_screening_btn_ajax btn btn-sm" style="background: #57d8cd; color: #fff;">Approve</a>
                              <input type="hidden" name="reject_appoint" class="reject_appoint" id="reject_appoint" value="<?php echo $row['id']; ?>">
                              <a href="javascript:void(0)" class="screening_reject_btn_ajax btn btn-dark btn-sm">Reject</a>
                            </td>

                          <?php } ?>
                      <?php }
                    } ?>
                  </tbody>
                </table>



                <!-- Appoint Screening Modal Form ################################################################################################################################################# -->
                <div class="modal fade" id="appoint_screening" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="background: #fff;">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Appoint Screening</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php
                        $query = "SELECT job.*, applicant.*, resume.* 
                        FROM hr_job_list job, hr1_applicant applicant, hr1_resume resume
                        WHERE job.id = resume.job_list_id 
                        AND resume.applicant_id = applicant.id";

                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result)) {
                          $row = mysqli_fetch_assoc($result);

                        ?>
                          <form action="actions.php" method="post" class="form-group needs-validation" novalidate>

                            <hr><br>
                            <input type="hidden" name="resume_id" id="resume_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="email" id="email" value="<?php echo $row['email_address']; ?>">
                            <input type="hidden" name="fullname" id="fullname" value="<?php echo $row['firstname'], " ", $row['lastname']; ?>">
                            <input type="hidden" name="job_title" id="job_title" value="<?php echo $row['job_title']; ?>">

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
                        <button type="submit" name="appoint_screening" class="btn" style="background: #57d8cd; color: #fff;">Appoint</button>
                      </div>
                      </form>
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="exam">
              <br><br>

              <!-- Grant Examinees -->
              <div class="table">
                <h3>GRANTING EXAMINEES</h3>
                <table class="table table-borderless" id="example5" style="font-family: 'Jamesphilip Bold', sans-serif !important; text-align: center;">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Candidate Name</th>
                      <th>Email Address</th>
                      <th>Contact Number</th>
                      <th>Job Title</th>
                      <th>Status</th>
                      <th>Grant Examination</th>

                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $query = "SELECT job.*, applicant.*, resume.*, DATE_FORMAT(date_uploaded, '%M %d, %Y')as formatted_date 
                    FROM hr_job_list job, hr1_applicant applicant, hr1_resume resume 
                    WHERE applicant.id = resume.applicant_id AND job.id = resume.job_list_id";

                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result)) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        $resume =  $row['resume_attachment'];

                        if ($row['resume_status'] === "Screening Rejected" && $row['resume_status'] === "Shortlisted" && $row['resume_status'] === "Appointed" && $row['resume_status'] !== "Screening Passed" && $row['resume_status'] === "Screening Appointed" && $row['resume_status'] === "Initial Interview") {
                          continue;
                        } elseif ($row['resume_status'] === "Initial Interview Passed" || $row['resume_status'] === "Examination Granted") {
                    ?>
                          <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['firstname'], ' ', $row['lastname']; ?></td>
                            <td><?php echo $row['email_address']; ?></td>
                            <td><?php echo $row['mobile_number']; ?></td>
                            <td><?php echo $row['job_title']; ?></td>


                            <?php
                            if ($row['resume_status'] === "Initial Interview Passed") {
                            ?>

                              <td><span class="badge bg-warning">Pending</span></td>

                              <td> <input type="hidden" name="grant_exam" class="grant_exam" id="grant_exam" value="<?php echo $row['id']; ?>">
                                <a href="javascript:void(0)" class="btn btn-sm grant_exam_btn_ajax" disabled style="background: #57d8cd; color: #fff;">Grant Exam</a>
                              </td>
                            <?php } elseif ($row['resume_status'] === "Examination Granted") {
                            ?>
                              <td><span class="badge bg-success">Examination Granted</span></td>
                              <td>
                                <button type="button" class="btn btn-sm appoint_initial" style="background: #57d8cd; color: #fff;" disabled>Granted</button>
                              </td>




                            <?php } ?>




                          </tr>
                        <?php } ?>
                    <?php }
                    } ?>

                  </tbody>
                </table>
              </div>

              <br><br>

<!-- Grant Examinees -->
<div class="table">
  <h3>MANAGE EXAMINEES</h3>
  <table class="table table-borderless" id="example7" style="font-family: 'Jamesphilip Bold', sans-serif !important; text-align: center;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Candidate Name</th>
        <th>Exam Title</th>
        <th>Exam Duration</th>
        <th>Number of items</th>
        <th>Exam Status</th>
        <th>Score</th>
        <th>Score Percentage</th>
        <th>Approve/Reject</th>

      </tr>
    </thead>
    
    <tbody>
      <?php
      $query = "SELECT job.*, applicant.firstname, applicant.lastname, resumes.*, exam.*, score.score, score.score_percentage
      FROM hr_job_list job, hr1_applicant applicant, hr1_resume resumes, hr1_exam exam, hr1_score score
      WHERE resumes.job_list_id = job.id
      AND resumes.applicant_id = applicant.id 
      AND exam.job_list_id = job.id
      AND score.exam_id = exam.id";

      $result = mysqli_query($con, $query);
      if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
          $resume =  $row['resume_attachment'];

          if ($row['resume_status'] === "Screening Rejected" && $row['resume_status'] === "Shortlisted" && $row['resume_status'] === "Appointed" && $row['resume_status'] !== "Screening Passed" && $row['resume_status'] === "Screening Appointed" && $row['resume_status'] === "Initial Interview" && $row['resumeStatus'] === "Examination Failed") {
            continue;
          } elseif ($row['examination_status_result'] === "Examination Passed" || $row['examination_status_result'] === "Examination Failed") {
      ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['firstname'], ' ', $row['lastname']; ?></td>
              <td><?php echo $row['exam_title']; ?></td>

              <?php if($row['exam_duration'] === "5"){?>
                <td>5 minutes</td>
              <?php }elseif($row['exam_duration'] === "10"){?>
                <td>10 minutes</td>
              <?php }elseif($row['exam_duration'] === "30"){?>
                <td>30 minutes</td>
              <?php }elseif($row['exam_duration'] === "60"){?>
                <td>1 hour</td>
              <?php }elseif($row['exam_duration'] === "120"){?>
                <td>2 hours</td>
              <?php }?>

              <td><?php echo $row['num_items']; ?></td>

              <?php if($row['examination_status_result'] === "Examination Passed"){?>
                <td class="badge bg-success">Examination Passed</td>
              <?php } elseif($row['examination_status_result'] === "Examination Failed"){?>
                <td class="badge bg-danger">Examination Failed</td>
              <?php }?>

              <td><?php echo $row['score']; ?></td>
              <td><?php echo $row['score_percentage']; ?>%</td>

              <?php if($row['resumeStatus'] === "default"){?>
                <td>
                  <input type="hidden" name="approve_examinationID" class="approve_examinationID" id="approve_examinationID" value="<?php echo $row['id']; ?>">
                  <a href="javascript:void(0)" class="approve_examination_btn_ajax btn btn-sm" style="background: #57d8cd; color: #fff;">Approve</a>
                  
                  <input type="hidden" name="reject_exam" class="reject_exam" id="reject_exam" value="<?php echo $row['id']; ?>">
                  <a href="javascript:void(0)" class="examination_reject_btn_ajax btn btn-dark btn-sm">Reject</a>
                </td>

              <?php }elseif($row['resumeStatus'] === "For Final Interview"){ ?>
                <td>
                  <a href="javascript:void(0)" class="btn btn-sm" disabled style="background: #57d8cd; color: #fff;">Approved</a>
                  <a href="javascript:void(0)" class="btn btn-dark btn-sm" disabled>Reject</a>
                </td>
              <?php }?>

            </tr>
          <?php } ?>
      <?php }
      } ?>

    </tbody>
  </table>
</div>

            </div>


            <div class="tab-pane" id="interview">
              <br><br>
              <!-- Scheduling For Initial Interview -->
              <div class="table">
                <h3>SCHEDULE FOR INITIAL INTERVIEW</h3>
                <table class="table table-borderless" id="example4" style="font-family: 'Jamesphilip Bold', sans-serif !important; text-align: center;">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Candidate Name</th>
                      <th>Email Address</th>
                      <th>Contact Number</th>
                      <th>Job Title</th>
                      <th>Resume file</th>
                      <th>Status</th>
                      <th>Appoint</th>
                      <th>Approve/Reject</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php


                    $query = "SELECT job.*, applicant.*, resume.*, DATE_FORMAT(date_uploaded, '%M %d, %Y')as formatted_date 
                  FROM hr_job_list job, hr1_applicant applicant, hr1_resume resume 
                  WHERE applicant.id = resume.applicant_id AND job.id = resume.job_list_id";

                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result)) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        $resume =  $row['resume_attachment'];

                        if ($row['resume_status'] === "Screening Rejected" && $row['resume_status'] === "Shortlisted" && $row['resume_status'] === "Appointed" && $row['resume_status'] !== "Screening Passed" && $row['resume_status'] === "Screening Appointed" && $row['resume_status'] === "Initial Interview") {
                          continue;
                        } elseif ($row['resume_status'] === "Screening Passed" || $row['resume_status'] === "Initial Interview Appointed") {
                    ?>
                          <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['firstname'], ' ', $row['lastname']; ?></td>
                            <td><?php echo $row['email_address']; ?></td>
                            <td><?php echo $row['mobile_number']; ?></td>
                            <td><?php echo $row['job_title']; ?></td>
                            <td>
                              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $row['id']; ?>" style="text-decoration: underline; box-shadow: none !important; outline: none !important;">
                                <?php echo $row['resume_attachment']; ?>
                              </button>
                            </td>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            if ($row['resume_status'] === "Initial Interview Passed") {
                            ?>

                              <td><span class="badge bg-success">Initial Interview Passed</span></td>
                              <td><button type="button" name="appoint_passed" class="btn btn-sm" style="background: #57d8cd; color: #fff;" disabled>Approved</button></td>
                              <td><button type="button" name="reject" class="btn btn-dark" disabled>Reject</button></td>

                            <?php } elseif ($row['resume_status'] === "Screening Passed") {
                            ?>
                              <td><span class="badge bg-warning">Pending</span></td>
                              <td>
                                <button type="button" class="btn btn-sm appoint_initial" style="background: #57d8cd; color: #fff;">Appoint</button>
                                <button type="button" class="btn btn-secondaty btn-sm appoint_initial">Resched</button>
                              </td>

                              <td>
                                <input type="hidden" name="passed_initial" class="passed_initial" id="passed_initial" value="<?php echo $row['id']; ?>">
                                <a href="javascript:void(0)" class="btn btn-sm" disabled style="background: #57d8cd; color: #fff;">Approve</a>
                                <input type="hidden" name="reject_appoint_initial" class="reject_appoint_initial" id="reject_appoint_initial" value="<?php echo $row['id']; ?>">
                                <a href="javascript:void(0)" class="initial_reject_btn_ajax btn btn-dark btn-sm">Reject</a>
                              </td>

                            <?php } elseif ($row['resume_status'] === "Initial Interview Appointed") { ?>
                              <td><span class="badge bg-success">Appointed</span></td>
                              <td>
                                <button type="button" class="btn btn-sm appoint_initial" style="background: #57d8cd; color: #fff;" disabled>Appointed</button>
                              </td>
                              <td>
                                <input type="hidden" name="approves_initial" class="approves_initial" id="approves_initial" value="<?php echo $row['id']; ?>">
                                <a href="javascript:void(0)" class="approves_initial_btn_ajax btn btn-sm" style="background: #57d8cd; color: #fff;">Approve</a>
                                <input type="hidden" name="reject_appoint" class="reject_appoint" id="reject_appoint" value="<?php echo $row['id']; ?>">
                                <a href="javascript:void(0)" class="screening_reject_btn_ajax btn btn-dark btn-sm" disabled>Reject</a>
                              </td>

                            <?php } ?>




                          </tr>
                        <?php } ?>
                    <?php }
                    } ?>

                  </tbody>
                </table>



                <!-- Appoint Initial Interview Modal Form ################################################################################################################################################# -->
                <div class="modal fade" id="appoint_initial" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="background: #fff;">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Appoint Initial Interview</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php
                        $query = "SELECT job.*, applicant.*, resume.* 
                        FROM hr_job_list job, hr1_applicant applicant, hr1_resume resume
                        WHERE job.id = resume.job_list_id 
                        AND resume.applicant_id = applicant.id";

                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result)) {
                          $row = mysqli_fetch_assoc($result);

                        ?>
                          <form action="actions.php" method="post" class="form-group needs-validation" novalidate>

                            <hr><br>
                            <input type="hidden" name="r_id" id="r_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="Email" id="Email" value="<?php echo $row['email_address']; ?>">
                            <input type="hidden" name="fullName" id="fullName" value="<?php echo $row['firstname'], " ", $row['lastname']; ?>">
                            <input type="hidden" name="jobTitle" id="jobTitle" value="<?php echo $row['job_title']; ?>">

                            <div class="col-auto">
                              <label for="appointmentDateAndTime" class="form-label" style="color: #000;">Appoint Date and Time</label>
                              <input type="datetime-local" class="form-control" name="appointmentDateAndTime" id="appointmentDateAndTime" style="box-shadow: none;" required>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <br><br><br>
                            <fieldset>
                              <legend class="col-form-label col-lg-12 col-md-12 col-sm-2 pt-0">Type of Interview</legend>
                              <div class="col-sm-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="type_of_interview" id="type_of_interview" value="In-Person Interview" required checked>
                                  <label class="form-check-label" for="type_of_interview">In-Person Interview</label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="type_of_interview" id="type_of_interview" value="Phone Call Interview" required>
                                  <label class="form-check-label" for="type_of_interview">Phone Call Interview</label>
                                </div>
                              </div>
                            </fieldset>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="appoint_initial" class="btn" style="background: #57d8cd; color: #fff;">Appoint</button>
                      </div>
                      </form>
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>

              <br><br><br>
              <div class="table">
                <h3>SCHEDULE FOR FINAL INTERVIEW</h3>
                <table class="table table-borderless" id="example6" style="font-family: 'Jamesphilip Bold', sans-serif !important; text-align: center;">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Candidate Name</th>
                      <th>Email Address</th>
                      <th>Contact Number</th>
                      <th>Resume file</th>
                      <th>Status</th>
                      <th>Appoint/Resched</th>
                      <th>Approve/Reject</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php


                    $query = "SELECT job.*, applicant.*, resume.*, DATE_FORMAT(date_uploaded, '%M %d, %Y')as formatted_date 
                  FROM hr_job_list job, hr1_applicant applicant, hr1_resume resume 
                  WHERE applicant.id = resume.applicant_id AND job.id = resume.job_list_id";

                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result)) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        $resume =  $row['resume_attachment'];

                        if ($row['resume_status'] === "Screening Rejected" || $row['resume_status'] !== "Shortlisted" && $row['resume_status'] !== "Appointed" && $row['resume_status'] !== "Screening Passed" && $row['resume_status'] !== "Screening Appointed") {
                          continue;
                        }
                    ?>
                        <tr>
                          <td><?php echo $row['id']; ?></td>
                          <td><?php echo $row['firstname'], ' ', $row['lastname']; ?></td>
                          <td><?php echo $row['email_address']; ?></td>
                          <td><?php echo $row['mobile_number']; ?></td>
                          <td>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $row['id']; ?>" style="text-decoration: underline; box-shadow: none !important; outline: none !important;">
                              <?php echo $row['resume_attachment']; ?>
                            </button>
                          </td>
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <td><button type="button" name="appoint_passed" class="btn btn-sm" style="background: #57d8cd; color: #fff;" disabled>Approved</button></td>
                            <td><button type="button" name="reject" class="btn btn-dark" disabled>Reject</button></td>

                          <?php
                          } elseif ($row['resume_status'] === "Shortlisted") {
                          ?>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                              <button type="button" class="btn btn-sm appoint_screening" style="background: #57d8cd; color: #fff;">Appoint</button>
                              <button type="button" class="btn btn-secondary btn-sm appoint_screening">Resched</button>
                            </td>

                            <td>
                              <input type="hidden" name="passed_screening" class="passed_screening" id="passed_screening" value="<?php echo $row['id']; ?>">
                              <a href="javascript:void(0)" class="btn btn-sm" disabled style="background: #57d8cd; color: #fff;">Approves</a>
                              <input type="hidden" name="reject_appoint" class="reject_appoint" id="reject_appoint" value="<?php echo $row['id']; ?>">
                              <a href="javascript:void(0)" class="screening_reject_btn_ajax btn btn-dark btn-sm">Reject</a>
                            </td>
                          <?php
                          } elseif ($row['resume_status'] === "Screening Appointed") {
                          ?>
                            <td><span class="badge bg-secondary">Appointed</span></td>
                            <td>
                              <button type="button" class="btn btn-sm appoint_screening" style="background: #57d8cd; color: #fff;" disabled>Appointed</button>
                              <button type="button" class="btn btn-secondary btn-sm appoint_screening">Resched</button>
                            </td>
                            <td>
                              <input type="hidden" name="approve_screening" class="approve_screening" id="approve_screening" value="<?php echo $row['id']; ?>">
                              <a href="javascript:void(0)" class="approve_screening_btn_ajax btn btn-sm" style="background: #57d8cd; color: #fff;">Approve</a>
                              <input type="hidden" name="reject_appoint" class="reject_appoint" id="reject_appoint" value="<?php echo $row['id']; ?>">
                              <a href="javascript:void(0)" class="screening_reject_btn_ajax btn btn-dark btn-sm" disabled>Reject</a>
                            </td>

                          <?php } ?>
                      <?php }
                    } ?>
                  </tbody>
                </table>



                <!-- Appoint Screening Modal Form ################################################################################################################################################# -->
                <div class="modal fade" id="appoint_screening" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="background: #fff;">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Appoint Screening</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php
                        $query = "SELECT applicant.*, resume.* 
                        FROM hr1_applicant applicant, hr1_resume resume
                        WHERE resume.applicant_id = applicant.id";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result)) {
                          $row = mysqli_fetch_assoc($result);

                        ?>
                          <form action="actions.php" method="post" class="form-group needs-validation" novalidate>

                            <hr><br>
                            <input type="hidden" name="resume_id" id="resume_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="email" id="email" value="<?php echo $row['email_address']; ?>">
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
                        <button type="submit" name="appoint_screening" class="btn" style="background: #57d8cd; color: #fff;">Appoint</button>
                      </div>
                      </form>
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>

            </div>


          </div>
        </div>





    </main>










    <!-- JAVASCRIPT ########################################################################################## -->
    <!-- Preview Job before posting it -->
    <script>
      $(document).ready(function() {
        $('tbody').on('click', '.previewBtn', function() {
          var Id = $(this).prev('.previewModalId').val();
          $('#previewModal').modal('show');

          // load the corresponding question(s) for the clicked row
          $.ajax({
            url: 'preview_job_request.php',
            type: 'post',
            data: {
              id: Id
            },
            success: function(response) {
              $('#previewModal .modal-body').html(response);
            },
            error: function() {
              alert('Error loading questions.');
            }
          });
        });
      });
    </script>

    <!-- Posting a jobs with qualifications-->
    <script>
      $(document).ready(function() {
        $('.postJobsBtn').click(function(e) {
          e.preventDefault();

          var closeid = $(this).closest("tr").find('.postJobs').val();

          swal({
              title: "Are you sure you want to post this jobs?",
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
                    "postJobs_btn_set": 1,
                    "postJobs_id": closeid,
                  },
                  success: function(response) {

                    swal("Successfully Posted!", {
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

    <!-- Shortlisting of Applicant -->
    <script>
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
    </script>




    <!-- DATA TABLES -->
    <script>
      // Posted job table
      $(document).ready(function() {
        $('#example').DataTable();
      });
      $(document).ready(function() {
        $('#example2').DataTable();
      });
      $(document).ready(function() {
        $('#example3').DataTable();
      });
      $(document).ready(function() {
        $('#example4').DataTable();
      });
      $(document).ready(function() {
        $('#example5').DataTable();
      });
      $(document).ready(function() {
        $('#example6').DataTable();
      });
      $(document).ready(function() {
        $('#example7').DataTable();
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
          $('#fullname').val(data[1]);
          $('#email').val(data[2]);
          $('#job_title').val(data[4]);
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

                    swal("Successfully Approved!", {
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



      // For Applicant Initial Interview Appoint
      $(document).ready(function() {
        $('.appoint_initial').on('click', function() {
          $('#appoint_initial').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get();
          console.log(data);
          $('#r_id').val(data[0]);
          $('#fullName').val(data[1]);
          $('#Email').val(data[2]);
          $('#jobTitle').val(data[4]);
        });
      });
    </script>
    <script>
      // For Approve Initial Interview
      $(document).ready(function() {
        $('.approves_initial_btn_ajax').click(function(e) {
          e.preventDefault();

          var closeid = $(this).closest("tr").find('.approves_initial').val();

          swal({
              title: "Are you sure you want to approve this?",
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
                    "approve_initial_btn_set": 1,
                    "approve_initial_id": closeid,
                  },
                  success: function(response) {

                    swal("Successfully Approved!", {
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

    <script>
      // For Granting Examination
      $(document).ready(function() {
        $('.grant_exam_btn_ajax').click(function(e) {
          e.preventDefault();

          var closeid = $(this).closest("tr").find('.grant_exam').val();

          swal({
              title: "Are you sure you want to grant this?",
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
                    "grant_exam_btn_set": 1,
                    "grant_exam_id": closeid,
                  },
                  success: function(response) {

                    swal("Successfully Approved!", {
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

    <script>
      // For Approve Examination
      $(document).ready(function() {
        $('.approve_examination_btn_ajax').click(function(e) {
          e.preventDefault();

          var closeid = $(this).closest("tr").find('.approve_examinationID').val();

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
                    "approve_examination_btn_set": 1,
                    "approve_examination_id": closeid,
                  },
                  success: function(response) {

                    swal("Successfully Approved!", {
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
    <!-- Examination Rejection -->
    <script>
      $(document).ready(function() {
            $('.examination_reject_btn_ajax').click(function(e) {
              e.preventDefault();

              var shortlistRejectid = $(this).closest("tr").find('.reject_exam').val();

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
                        "examination_reject_btn_set": 1,
                        "examination_reject_id": shortlistRejectid,
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

    // <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
  </body>

  </html>
<?php
} else {
  header("location: ../../index.php");
  session_destroy();
}
unset($_SESSION['prompt']);
mysqli_close($con);
?>