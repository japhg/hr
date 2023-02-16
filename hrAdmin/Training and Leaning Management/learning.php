<?php
session_start();
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

    <title>Learning Management - Alegario Cure Hospital</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/alegario_logo" rel="icon">
    <link rel="shortcut icon" href="../assets/img/alegario_logo" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600&family=Bebas+Neue&family=Catamaran:wght@300&family=Comfortaa:wght@500&family=Fira+Sans:wght@300;400;500;600;700;800&family=Heebo:wght@100;200;300;400;500;600;700;800;900&family=Hind&family=Inter:wght@300;400;600;800&family=Poiret+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:wght@500;600&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Source+Sans+3&display=swap" rel="stylesheet">

    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>





    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

  </head>

  <body>
    <?php include '../body/inside-header.php';
    include '../body/inside-sidebar.php'; ?>
    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Learning Management</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
            <li class="breadcrumb-item active">Learning Management</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->



      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#posted-jobs">Add Exams</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shortlisting">Manage Examinees</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#exam-list">Exam List</button>
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
              <table class="table table-secondary table-striped table-hover" id="example" style="font-family: 'Roboto', sans-serif !important; text-align: center;">
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
                        <td><?php echo $row['formatted_date'];?></td>
                        <td>
                          <button type="button" class="btn btn-primary addExamBtn">Add Exam</button>
                        </td>
                       
                      </tr>
                  <?php }
                  } ?>
                </tbody>
              </table>
              <br><br><br>
              <hr>




              <!-- Table for Questions -->
              <table class="table table-striped table-secondary table-hover" id="example01" style="font-family: 'Roboto', sans-serif !important; text-align: center;">
                <thead>
                  <tr>
                    <th>Job ID</th>
                    <th>Job Title</th>
                    <th>Exam Title</th>
                    <th>Exam Date and Time</th>
                    <th>Exam Duration</th>
                    <th>Mark per right answer</th>
                    <th>Mark per wrong answer</th>
                    <th>Exam Status</th>
                    <th>Actions</th>
                    <th>Actions</th>
                    <th>Actions</th>


                  </tr>
                </thead>
                <tbody>
                  <?php

                  $query = "SELECT job.title, exam.*, DATE_FORMAT(exam_datetime, '%M %d, %Y')as formatted_date FROM job_tbl job, exam_tbl exam WHERE job.job_id = exam.job_id";
                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_assoc($result)) {

                  ?>
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['exam_title']; ?></td>
                        <td><?php echo $row['formatted_date']; ?></td>
                        <?php 
                        if($row['exam_duration'] === "5"){
                          echo "<td>5 Minutes</td>";
                        } elseif($row['exam_duration'] === "10"){
                          echo "<td>10 Minutes</td>";
                        } elseif($row['exam_duration'] === "30"){
                          echo "<td>30 Minutes</td>";
                        } elseif($row['exam_duration'] === "60"){
                          echo "<td>1 Hour</td>";
                        } elseif($row['exam_duration'] === "120"){
                          echo "<td>2 Hours</td>";
                        }
                        ?>
                        
                        <td>+<?php echo $row['mark_per_right_answer'];?> points</td>
                        <td>-<?php echo $row['mark_per_right_answer']; ?> points</td>
                        <?php
                        if($row['exam_status'] === "Pending"){
                          echo '<td><span class="badge bg-warning" style="color: black;">Pending</span></td>';
                          echo '<td><button class="btn btn-primary addQuestionBtn">Add Questions</button></td>';
                        } elseif($row['exam_status'] === "Completed"){
                          echo '<td><span class="badge bg-dark">Completed</span></td>';
                          echo '<td><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">View Questions</button></td>';
                        }
                        ?>
                        
                        <td><button class="btn btn-info updateExamBtn">Update</button></td>
                        <td>
                          <input type="hidden" name="deleteExam" class="deleteExam" id="deleteExam" value="<?php echo $row['id']; ?>">
                          <a href="javascript:void(0)" class="deleteExamBtn btn btn-danger">Delete</a>
                        </td>
                      </tr>
                  <?php }
                  } ?>
                </tbody>

<!-- Add Exam Modal Form ###################################################################################################################################################### -->
                <div class="modal fade" id="addExamBtn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Examination</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php
                        $query = "SELECT job.*, emp.*, DATE_FORMAT(date_posted, '%M %d, %Y')as formatted_date FROM job_tbl job, employer_tbl emp WHERE emp.id = job.empr_id";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result)) {
                          $row = mysqli_fetch_assoc($result);
                        ?>
                          <form action="action.php" method="post" class="form-group needs-validation" novalidate>
                            <input type="hidden" name="job_id" id="job_id" value="<?php echo $row['job_id']; ?>">
                            <div class="col-auto">
                              <label for="exam_title" class="form-label" style="color: #000;">Exam Title</label>
                              <input type="text" class="form-control" name="exam_title" id="exam_title" style="box-shadow: none;" required>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto py-3">
                              <label for="exam_date&time" class="form-label" style="color: #000;">Exam Date and Time</label>
                              <input type="datetime-local" class="form-control" name="exam_date&time" id="exam_date&time" style="box-shadow: none;" required>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto py-3">
                              <label for="exam_duration" class="form-label" style="color: #000;">Exam Duration</label>
                              <select class="form-select" name="exam_duration" id="exam_duration" required>
                                <option value="" disabled selected></option>
                                <option value="5">5 Minutes</option>
                                <option value="10">10 Minutes</option>
                                <option value="30">30 minutes</option>
                                <option value="60">1 Hour</option>
                                <option value="120">2 Hours</option>
                              </select>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto py-3">
                              <label for="mark_per_right" class="form-label" style="color: #000;">Mark per right answer</label>
                              <select class="form-select" name="mark_per_right" id="mark_per_right" required> 
                                <option value="" disabled selected></option>
                                <option value="1">+1 point</option>
                                <option value="2">+2 points</option>
                                <option value="3">+3 points</option>
                                <option value="4">+4 points</option>
                                <option value="5">+5 points</option>
                              </select>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto py-3">
                              <label for="mark_per_wrong" class="form-label" style="color: #000;">Mark per wrong answer</label>
                              <select class="form-select" name="mark_per_wrong" id="mark_per_wrong" required>
                                <option value="" disabled selected></option>
                                <option value="1">-1 point</option>
                                <option value="2">-2 points</option>
                                <option value="3">-3 points</option>
                                <option value="4">-4 points</option>
                                <option value="5">-5 points</option>
                              </select>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_exam" class="btn btn-primary" style="box-shadow: none;">Add Exam</button>
                      </div>
                      </form>
                    <?php } ?>
                    </div>
                  </div>
                </div>


<!-- Update Exam Modal Form ###################################################################################################################################################### -->
<div class="modal fade" id="updateExamBtn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Examination</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php
                        $query = "SELECT * FROM exam_tbl";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result)) {
                          $row = mysqli_fetch_assoc($result);
                        ?>
                          <form action="action.php" method="post" class="form-group needs-validation" novalidate>
                            <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $row['id']; ?>">
                            <div class="col-auto">
                              <label for="exam_title" class="form-label" style="color: #000;">Exam Title</label>
                              <input type="text" class="form-control" name="exam_title" id="exam_title" style="box-shadow: none;" required>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto py-3">
                              <label for="exam_date&time" class="form-label" style="color: #000;">Exam Date and Time</label>
                              <input type="datetime-local" class="form-control" name="exam_date&time" id="exam_date&time" style="box-shadow: none;" required>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto py-3">
                              <label for="exam_duration" class="form-label" style="color: #000;">Exam Duration</label>
                              <select class="form-select" name="exam_duration" id="exam_duration" required>
                                <option value="" disabled selected></option>
                                <option value="5">5 Minutes</option>
                                <option value="10">10 Minutes</option>
                                <option value="30">30 minutes</option>
                                <option value="60">1 Hour</option>
                                <option value="120">2 Hours</option>
                              </select>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto py-3">
                              <label for="mark_per_right" class="form-label" style="color: #000;">Mark per right answer</label>
                              <select class="form-select" name="mark_per_right" id="mark_per_right" required>
                                <option value="" disabled selected></option>
                                <option value="1">+1 point</option>
                                <option value="2">+2 points</option>
                                <option value="3">+3 points</option>
                                <option value="4">+4 points</option>
                                <option value="5">+5 points</option>
                              </select>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto py-3">
                              <label for="mark_per_wrong" class="form-label" style="color: #000;">Mark per wrong answer</label>
                              <select class="form-select" name="mark_per_wrong" id="mark_per_wrong" required>
                                <option value="" disabled selected></option>
                                <option value="1">-1 point</option>
                                <option value="2">-2 points</option>
                                <option value="3">-3 points</option>
                                <option value="4">-4 points</option>
                                <option value="5">-5 points</option>
                              </select>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_exam" class="btn btn-primary" style="box-shadow: none;">Update Exam Details</button>
                      </div>
                      </form>
                    <?php } ?>
                    </div>
                  </div>
                </div>



<!-- Add Questions Modal Form ################################################################################################################################################# -->
                <div class="modal fade" id="addQuestionBtn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Questions</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      <?php
                        $query = "SELECT * FROM exam_tbl";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result)) {
                          $row = mysqli_fetch_assoc($result);
                        ?>
                      <form action="action.php" method="post" class="form-group needs-validation" novalidate>
                        <input type="hidden" name="examID" id="examID" value="<?php echo $row['id'];?>">
                            <div class="col-auto">
                              <label for="questionTitle" class="form-label" style="color: #000;">Question Title</label>
                              <input type="text" class="form-control" name="questionTitle" id="questionTitle" style="box-shadow: none;" required>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto">
                              <label for="options1" class="form-label" style="color: #000;">Option 1</label>
                              <input type="text" class="form-control" name="options[]" id="options1" style="box-shadow: none;" required>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto">
                              <label for="options2" class="form-label" style="color: #000;">Option 2</label>
                              <input type="text" class="form-control" name="options[]" id="options2" style="box-shadow: none;" required>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto">
                              <label for="options3" class="form-label" style="color: #000;">Option 3</label>
                              <input type="text" class="form-control" name="options[]" id="options3" style="box-shadow: none;" required>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto">
                              <label for="options4" class="form-label" style="color: #000;">Option 4</label>
                              <input type="text" class="form-control" name="options[]" id="options4" style="box-shadow: none;" required>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                            <div class="col-auto">
                              <label for="answer" class="form-label" style="color: #000;">Correct Answer</label>
                              <select name="answer" id="answer" class="form-select" required>
                                <option value="" disabled selected>Select Answer</option>
                              <option value="0">Option 1</option>
                              <option value="1">Option 2</option>
                              <option value="2">Option 3</option>
                              <option value="3">Option 4</option>
                              </select>
                              <div class="invalid-feedback">
                                This field is required.
                              </div>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_questions" class="btn btn-primary">Add Questions</button>
                      </div>
                      </form>
                      <?php }?>
                    </div>
                  </div>
                </div>

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
              <table class="table table-borderless table-striped table-hover" id="example1" style="font-family: 'Roboto', sans-serif !important; text-align: center;">
                <thead>
                  <tr>
                    <th>Applicant ID</th>
                    <th>Applicant Name</th>
                    <th>Email Address</th>
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

                      if ($row['resume_status'] === "Shortlisting Rejected" || $row['resume_status'] != "Examination") {
                        continue;
                      }
                  ?>
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['email_address']; ?></td>
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
                        if ($row['resume_status'] === "Examination Passed") {
                        ?>

                          <td><span class="badge bg-success">Passed</span></td>
                          <td><button type="button" name="shortlist" class="btn btn-primary" disabled>Shortlist</button></td>
                          <td><button type="button" name="reject" class="btn btn-dark" disabled>Reject</button></td>

                        <?php
                        } elseif ($row['resume_status'] === "Examination") {
                        ?>
                          <td><span class="badge bg-secondary">Examination</span></td>

                          <td>
                            <input type="hidden" name="view" class="view" id="views" value="<?php echo $row['r_id']; ?>">
                            <a href="javascript:void(0)" class="shortlist_btn_ajax btn btn-primary">Appoint</a>
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
            <div class="tab-pane" id="exam-list">
              <table class="table table-borderless table-striped table-hover" id="example2" style="font-family: 'Roboto', sans-serif !important; text-align: center;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Exam Title</th>
                    <th>Date and Time</th>
                    <th>Duration</th>
                    <th>Total Question</th>
                    <th>Right Answer Mark</th>
                    <th>Wrong Answer Mark</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>

            </div>


            <!-- Send Email -->
            <div class="tab-pane" id="send-email">



            </div>




          </div>
        </div>
      </div>





    </main>
<!-- // DataTable Script -->
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

      //example 01
      $(document).ready(function() {
        $('#example01').DataTable();
      });



      // Rejected Applicant Table
      $(document).ready(function() {
        $('#example2').DataTable();
      });

      // Rejected Applicant Table
      $(document).ready(function() {
        $('#example3').DataTable();
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
    </script>

    <!-- // Add Exams -->
    <script>
      $(document).ready(function() {
        $('.addExamBtn').on('click', function() {
          $('#addExamBtn').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data);

          $('#job_id').val(data[0]);
          

        });
      });
    </script>

    <!-- // Update Exams -->
    <script>

      $(document).ready(function() {
        $('.updateExamBtn').on('click', function() {
          $('#updateExamBtn').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data);

          $('#exam_id').val(data[0]);
        });
      });
    </script>
  
    <!-- // Delete Exams -->
    <script>
      $(document).ready(function() {
        $('.deleteExamBtn').click(function(e) {
          e.preventDefault();

          var closeid = $(this).closest("tr").find('.deleteExam').val();

          swal({
              title: "Are you sure you want to delete this exam?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

                $.ajax({
                  type: "POST",
                  url: "action.php",
                  data: {
                    "deleteExam_btn_set": 1,
                    "deleteExam_id": closeid,
                  },
                  success: function(response) {

                    swal("Successfully Deleted!", {
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

<!-- // Add Questions -->
<script>
      $(document).ready(function() {
        $('.addQuestionBtn').on('click', function() {
          $('#addQuestionBtn').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data);

          $('#examID').val(data[0]);
          

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
    <?php include '../body/footer.php';?>
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