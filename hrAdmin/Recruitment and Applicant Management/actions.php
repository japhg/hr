<!--SHORTLISTING-->
<?php
session_start();
include '../../JobPortal/database/connection.php';

if (isset($_POST['shortlist_btn_set'])) {

  $id = mysqli_real_escape_string($con, $_POST['shortlist_id']);
  $status = "Shortlisted";

  $query = "UPDATE resume_tbl SET resume_status = '$status' WHERE r_id = '$id'";
  $result = mysqli_query($con, $query);

    $_SESSION['success'] = "Successfully Shortlistedsss!";
    header("location: recruitment.php");
}
?>

<!--SHORTLISTING REJECTION-->
<?php
// if (isset($_POST['shortlist_reject_btn_set'])) {

//   $reject_id = $_POST['shortlist_reject_id'];
//   $status = "Shortlisting Rejected";

//   $query = "UPDATE resume_tbl SET resume_status = '$status' WHERE r_id = '$reject_id'";
//   $result = mysqli_query($con, $query);

//     $_SESSION['success'] = "Successfully Rejected!";
//     header("location: recruitment.php");
// }

if (isset($_POST['shortlist_reject_btn_set'])) {

  // 
  
  $status = "Shortlisting Rejected";

  // get the data of the rejected applicant
  $query = "SELECT applicant.*, resume.* FROM applicant_tbl applicant, resume_tbl resume WHERE applicant.id = resume.a_id";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);

  $reject_id = $_POST['shortlist_reject_id'];
  $fname = $row['firstname'];
  $mname = $row['middlename'];
  $lname = $row['lastname'];
  $email = $row['email_address'];
  $phone = $row['mobile_number'];
  $resume = $row['resume_attachment']; 

  // insert the data of the rejected applicant to the rejected_applicant table
  $insert_query = "INSERT INTO rejected_applicant (resume_id, firstname, middlename, lastname, email, phone, resume_attachment, status)
                  VALUES ('$reject_id', '$fname', '$mname', '$lname', '$email', '$phone', '$resume', '$status')";
  $insert_result = mysqli_query($con, $insert_query);

  // update the status of the applicant in the resume_tbl table
  $update_query = "UPDATE resume_tbl SET resume_status = '$status' WHERE r_id = '$reject_id'";
  $update_result = mysqli_query($con, $update_query);

  // check if the data was successfully inserted and the status was updated
  if ($insert_result && $update_result) {
    $_SESSION['success'] = "Successfully Rejected!";
    header("location: recruitment.php");
  } else {
    $_SESSION['error'] = "Failed to Reject!";
    header("location: recruitment.php");
  }
}

?>

<!-- Appoint screening -->
<?php
if (isset($_POST['appoint_screening'])) {

  $r_id = mysqli_real_escape_string($con, $_POST['resume_id']);
  $date_and_time = mysqli_real_escape_string($con, $_POST['appointmentDateAndTime']);
  $type = "Screening Appointment";
  $status = "Appointed";


if(!empty($date_and_time)){
  $query1 = "INSERT INTO appoint_applicant_tbl(resume_id, appointment_type, appointment_datetime) VALUES('$r_id','$type','$date_and_time')";
  if(mysqli_query($con, $query1)){
    $query2 = "UPDATE resume_tbl SET resume_status = '$status' WHERE r_id = '$r_id'";
    $result = mysqli_query($con, $query2);

    $_SESSION['success'] = "Screening Appointment Successfully Added!";
    header("location: recruitment.php");
  } 
}
}
?>

<!-- Approve Screening -->
<?php
if (isset($_POST['approve_screening_btn_set'])) {

  $id = mysqli_real_escape_string($con, $_POST['approve_screening_id']);
  $status = "Screening Passed";

  $query = "UPDATE resume_tbl SET resume_status = '$status' WHERE r_id = '$id'";
  $result = mysqli_query($con, $query);

    $_SESSION['success'] = "Successfully Approved!";
    header("location: recruitment.php");
}
?>

<!-- Screening Rejection -->
<?php
if (isset($_POST['screening_reject_btn_set'])) {

  // 
  
  $status = "Screening Rejected";

  // get the data of the rejected applicant
  $query = "SELECT applicant.*, resume.* FROM applicant_tbl applicant, resume_tbl resume WHERE applicant.id = resume.a_id";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);

  $reject_id = $_POST['screening_reject_id'];
  $fname = $row['firstname'];
  $mname = $row['middlename'];
  $lname = $row['lastname'];
  $email = $row['email_address'];
  $phone = $row['mobile_number'];
  $resume = $row['resume_attachment']; 

  // insert the data of the rejected applicant to the rejected_applicant table
  $insert_query = "INSERT INTO rejected_applicant (resume_id, firstname, middlename, lastname, email, phone, resume_attachment, status)
                  VALUES ('$reject_id', '$fname', '$mname', '$lname', '$email', '$phone', '$resume', '$status')";
  $insert_result = mysqli_query($con, $insert_query);

  // update the status of the applicant in the resume_tbl table
  $update_query = "UPDATE resume_tbl SET resume_status = '$status' WHERE r_id = '$reject_id'";
  $update_result = mysqli_query($con, $update_query);

  // check if the data was successfully inserted and the status was updated
  if ($insert_result && $update_result) {
    $_SESSION['success'] = "Successfully Rejected!";
    header("location: recruitment.php");
  } else {
    $_SESSION['error'] = "Failed to Reject!";
    header("location: recruitment.php");
  }
}

?>