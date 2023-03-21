<!--SHORTLISTING-->
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

session_start();
include '../../database/connection.php';

if (isset($_POST['shortlist_btn_set'])) {

  $id = mysqli_real_escape_string($con, $_POST['shortlist_id']);
  $status = "Shortlisted";

  $query = "UPDATE hr1_resume SET resume_status = '$status' WHERE id = '$id'";
  $result = mysqli_query($con, $query);

  $_SESSION['success'] = "Successfully Shortlisted!";
  header("location: recruitment.php");
}
?>

<!--SHORTLISTING REJECTION-->
<?php



if (isset($_POST['shortlist_reject_btn_set'])) {
  $status = "Shortlisting Rejected";
  $reject_id = $_POST['shortlist_reject_id'];
  // get the data of the rejected applicant
  $query = "SELECT applicant.*, resume.* 
  FROM hr1_applicant applicant, hr1_resume resume 
  WHERE applicant.id = resume.applicant_id
  AND resume.id = '$reject_id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);

  $reject_id = $_POST['shortlist_reject_id'];
  $fname = $row['firstname'];
  $mname = $row['middlename'];
  $lname = $row['lastname'];
  $fullName = $fname . " " . $lname;
  $email = $row['email_address'];
  $phone = $row['mobile_number'];
  $resume = $row['resume_attachment'];

  // insert the data of the rejected applicant to the rejected_applicant table
  $insert_query = "INSERT INTO hr1_rejected_applicant (resume_id, firstname, middlename, lastname, email, phone, resume_attachment, status)
                  VALUES ('$reject_id', '$fname', '$mname', '$lname', '$email', '$phone', '$resume', '$status')";
  $insert_result = mysqli_query($con, $insert_query);

  // update the status of the applicant in the resume_tbl table
  $update_query = "UPDATE hr1_resume SET resume_status = '$status' WHERE id = '$reject_id'";
  $update_result = mysqli_query($con, $update_query);

  // check if the data was successfully inserted and the status was updated
  if ($insert_result && $update_result) {
    sendemail_shortlist_reject("$email", "$fullName");
    $_SESSION['success'] = "Successfully Rejected!";
    header("location: recruitment.php");
  } else {
    $_SESSION['error'] = "Failed to Reject!";
    header("location: recruitment.php");
  }
}


function sendemail_shortlist_reject($email, $fullName)
{
  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port       = 465;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = 'jphigomera19@gmail.com';
  $mail->Password   = 'lavhavwsxxlzvhyw';

  $mail->IsHTML(true);
  $mail->AddAddress($email, "");
  $mail->SetFrom("jphigomera19@gmail.com", "Alegario Cure Hospital");
  $mail->Subject = "Rejection Message";
  $email_content = "Dear " . $fullName . ", <br><br>
  Thank you for taking the time to apply to our Company. We appreciate your interest in our organization and your efforts in submitting your application.
  <br><br>
  After careful consideration, we regret to inform you that we have decided not to move forward with your application at this time. Please note that we received a large number of highly qualified applications, and our decision was based on a careful review of your qualifications in relation to the requirements of the position.
  <br>
  We encourage you to continue pursuing your career goals and to apply for other suitable positions in the future. We wish you all the best in your future endeavors.
  <br><br>
  Thank you again for your interest in our company.
  <br><br>
  Sincerely,
  <br>
  James Philip Gomera <br>
  Alegario Cure Hospital";

  $content = $email_content;

  $mail->MsgHTML($content);
  $mail->Send();
}

?>

<!-- Appoint screening -->
<?php

function sendemail_appoint($email, $formattedDateAndTime, $fullname, $job_title)
{
  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port       = 465;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = 'jphigomera19@gmail.com';
  $mail->Password   = 'lavhavwsxxlzvhyw';

  $mail->IsHTML(true);
  $mail->AddAddress($email, "");
  $mail->SetFrom("jphigomera19@gmail.com", "Alegario Cure Hospital");
  $mail->Subject = "Appointment Letter";
  $email_content = "
  Dear " . $fullname . ", <br><br>

    Thank you for your interest in Alegario Cure and for submitting your application for the <strong>" . $job_title . "</strong> role. We appreciate your enthusiasm and qualifications for the position.
    <br><br>
    We would like to schedule a phone screening appointment with you to discuss your application further. The purpose of the call is to learn more about your skills and experiences and to determine if your qualifications match the requirements of the position.
    <br><br>
    Your phone screening appointment is scheduled for <strong>" . $formattedDateAndTime . "</strong>. We will be calling you at the phone number you provided in your application form. Please ensure that you are in a quiet and distraction-free environment for the duration of the call.
    <br><br>
    If for any reason you are unable to attend the scheduled phone screening appointment, please let us know as soon as possible so that we can arrange an alternative time.
    <br><br>
    We look forward to speaking with you soon.
    <br><br>
    Best regards,
    <br><br><br>
    James Philip Gomera<br>
    Alegario Cure";

  $content = $email_content;

  $mail->MsgHTML($content);
  $mail->Send();
}

if (isset($_POST['appoint_screening'])) {

  $r_id = mysqli_real_escape_string($con, $_POST['resume_id']);
  $date_and_time = mysqli_real_escape_string($con, $_POST['appointmentDateAndTime']);
  $type = "Screening Appointment";
  $status = "Screening Appointed";
  $email = $_POST['email'];
  $fullname = $_POST['fullname'];
  $job_title = $_POST['job_title'];

  $appointmentDateAndTime = $_POST['appointmentDateAndTime'];
  $timestamp = strtotime($appointmentDateAndTime);
  $formattedDateAndTime = date('Y-m-d H:i', $timestamp);


  if (!empty($date_and_time)) {
    $query1 = "INSERT INTO hr1_appoint_applicant(resume_id, appointment_type, appointment_date) VALUES('$r_id','$type','$date_and_time')";
    if (mysqli_query($con, $query1)) {
      $query2 = "UPDATE hr1_resume SET resume_status = '$status' WHERE id = '$r_id'";
      $result = mysqli_query($con, $query2);


      sendemail_appoint("$email", "$formattedDateAndTime", "$fullname", "$job_title");
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

  $query = "UPDATE hr1_resume SET resume_status = '$status' WHERE id = '$id'";
  $result = mysqli_query($con, $query);

  $_SESSION['success'] = "Successfully Approved!";
  header("location: recruitment.php");
}
?>

<!-- Screening Rejection -->
<?php
if (isset($_POST['screening_reject_btn_set'])) {

  $status = "Screening Rejected";
  $reject_id = $_POST['screening_reject_id'];
  // get the data of the rejected applicant
  $query = "SELECT applicant.*, resume.* 
  FROM hr1_applicant applicant, hr1_resume resume 
  WHERE applicant.id = resume.applicant_id
  AND resume.id = '$reject_id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);


  $fname = $row['firstname'];
  $mname = $row['middlename'];
  $lname = $row['lastname'];
  $fullName = $fname . " " . $lname;
  $email = $row['email_address'];
  $phone = $row['mobile_number'];
  $resume = $row['resume_attachment'];

  // insert the data of the rejected applicant to the rejected_applicant table
  $insert_query = "INSERT INTO hr1_rejected_applicant (resume_id, firstname, middlename, lastname, email, phone, resume_attachment, status)
                  VALUES ('$reject_id', '$fname', '$mname', '$lname', '$email', '$phone', '$resume', '$status')";
  $insert_result = mysqli_query($con, $insert_query);

  // update the status of the applicant in the resume_tbl table
  $update_query = "UPDATE hr1_resume SET resume_status = '$status' WHERE id = '$reject_id'";
  $update_result = mysqli_query($con, $update_query);

  // check if the data was successfully inserted and the status was updated
  if ($insert_result && $update_result) {
    sendemail_screening_reject("$email", "$fullName");
    $_SESSION['success'] = "Successfully Rejected!";
    header("location: recruitment.php");
  } else {
    $_SESSION['error'] = "Failed to Reject!";
    header("location: recruitment.php");
  }
}

function sendemail_screening_reject($email, $fullName)
{
  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port       = 465;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = 'jphigomera19@gmail.com';
  $mail->Password   = 'lavhavwsxxlzvhyw';

  $mail->IsHTML(true);
  $mail->AddAddress($email, "");
  $mail->SetFrom("jphigomera19@gmail.com", "Alegario Cure Hospital");
  $mail->Subject = "Appreciation Letter";
  $email_content = "Dear " . $fullName . ", <br><br>
  Thank you for taking the time to apply to our Company. We appreciate your interest in our organization and your efforts in submitting your application.
  <br><br>
  After careful consideration, we regret to inform you that we have decided not to move forward with your application at this time. Please note that we received a large number of highly qualified applications, and our decision was based on a careful review of your qualifications in relation to the requirements of the position.
  <br>
  We encourage you to continue pursuing your career goals and to apply for other suitable positions in the future. We wish you all the best in your future endeavors.
  <br><br>
  Thank you again for your interest in our company.
  <br><br>
  Sincerely,
  <br>
  James Philip Gomera <br>
  Alegario Cure Hospital";

  $content = $email_content;

  $mail->MsgHTML($content);
  $mail->Send();
}

?>

<!-- Inserting a jobs with qualifications -->
<?php
if (isset($_POST['postJobs_btn_set'])) {
  $id = $_POST['postJobs_id'];

  // query database for questions
  $query = "SELECT job_request.*, department.*, qualifications.*
            FROM hr_job_request job_request, hr_department department, hr1_job_qualifications qualifications
            WHERE job_request.department_id = department.id
            AND qualifications.job_request_id = job_request.id
            AND job_request.id = '$id'";

  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);

  $department_id = $row['id'];
  $job_title = $row['job_title'];
  $job_type = $row['job_type'];
  $randomNumber = mt_rand(1000, 9999);
  $job_code = "JOB" . $randomNumber;
  $job_qualification = $row['description'];
  $job_description = $row['job_description'] ?? 'default value';
  $department_name = $row['department_name'];
  $skills = $row['skills'];
  $benefits = $row['benefits'];
  $number_of_applicants = $row['num_applicants'];
  $year_experience = $row['year_experience'];
  $salary = $row['salary'];
  $semi_monthly_salary = $salary / 2;
  $street = $row['street'];
  $barangay = $row['barangay'];
  $city = $row['city'];
  $state = $row['state'];
  $status = "ACTIVE";
  $token = "2";

  $insert_query = "INSERT INTO hr_job_list(job_request_id, job_code, job_title, job_type, job_description, department_name, num_applicants, years, skills, benefits, semi_montly_salary, monthly_salary, street, barangay, city, state, status)
                VALUES('$id', '$job_code', '$job_title', '$job_type', '$job_description', '$department_name', '$number_of_applicants', '$year_experience', '$skills', '$benefits', '$semi_monthly_salary', '$salary', '$street', '$barangay', '$city', '$state', '$status')";
  $insert_result = mysqli_query($con, $insert_query);

  if ($insert_result) {
    $query2 = "UPDATE hr_job_request SET token = '$token' WHERE id = '$id'";
    $result2 = mysqli_query($con, $query2);
    if ($result2) {
      $_SESSION['success'] = "Successfully Posted!";
      header("location: recruitment.php");
    } else {
      echo "Error";
      exit(0);
    }
  } else {
    echo "Error";
    exit(0);
  }
}
?>


<!-- Appoint initial Interview -->
<?php

function sendemail_initial($email, $formattedDateAndTime, $fullname, $job_title,$type)
{
  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port       = 465;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = 'jphigomera19@gmail.com';
  $mail->Password   = 'lavhavwsxxlzvhyw';

  $mail->IsHTML(true);
  $mail->AddAddress($email, "");
  $mail->SetFrom("jphigomera19@gmail.com", "Alegario Cure Hospital");
  $mail->Subject = "Appointment Letter";
  if($type === "In-Person Interview"){
    $email_content = "
    Dear <strong>" . $fullname . "</strong>, <br><br>

    Thank you for your interest in the <strong>" . $job_title . "</strong> at Alegario Cure. We would like to confirm your appointment for an initial interview(" .$type. ") on <strong>" . $formattedDateAndTime . "</strong>. 
    <br>
  
    <br>
    If you have any questions or concerns regarding the interview, please do not hesitate to contact us. We would be happy to address any questions or concerns you may have.
    <br>
    We look forward to meeting you in person and learning more about your qualifications for this position.
    <br><br>
    Best regards,
    <br>
    James Philip Gomera
    <br>
    Alegcario Cure
  ";
  }
  elseif($type === "Phone Call Interview"){
    $email_content = "
    Dear <strong>".$fullname."</strong>,
      <br><br>
      Thank you for your interest in the <strong>".$job_title."</strong> role at Alegario Cure. We appreciate the time and effort you have invested in applying for this position.
      <br>
      We would like to invite you for an initial phone interview with our team to further discuss your application and qualifications. The purpose of this call is to learn more about your experience, skills, and to determine if there is a good fit between you and our company.
      <br>
      Your initial phone interview is scheduled for <strong>".$formattedDateAndTime."</strong>. We will be calling you at the phone number you provided in your application form. Please ensure that you are in a quiet and distraction-free environment for the duration of the call.
      <br>
      During the phone interview, we will ask you a series of questions related to your work experience, skills, and your interest in the position. We encourage you to prepare for the interview by researching our company and reviewing the job description.
      <br>
      If for any reason you are unable to attend the scheduled phone interview, please let us know as soon as possible so that we can arrange an alternative time.
      <br><br>
      We are excited to speak with you and learn more about your qualifications.
      <br><br><br>
      Best regards,
      <br>
      James Philip Gomera<br>
      Alegario Cure
        ";
  }
  

  $content = $email_content;

  $mail->MsgHTML($content);
  $mail->Send();
}

if (isset($_POST['appoint_initial'])) {

  $r_id = mysqli_real_escape_string($con, $_POST['r_id']);
  $date_and_time = mysqli_real_escape_string($con, $_POST['appointmentDateAndTime']);
  $type = "Initial Interview Appointment";
  $status = "Initial Interview Appointed";
  $email = $_POST['Email'];
  $fullname = $_POST['fullName'];
  $job_title = $_POST['jobTitle'];
  $type = $_POST['type_of_interview'];

  $appointmentDateAndTime = $_POST['appointmentDateAndTime'];
  $timestamp = strtotime($appointmentDateAndTime);
  $formattedDateAndTime = date('Y-m-d H:i', $timestamp);


  if (!empty($date_and_time)) {
    $query1 = "INSERT INTO hr1_appoint_applicant(resume_id, appointment_type, appointment_date, appointment_status) 
    VALUES('$r_id','$type','$date_and_time','$type')";
    if (mysqli_query($con, $query1)) {
      $query2 = "UPDATE hr1_resume SET resume_status = '$status' WHERE id = '$r_id'";
      $result = mysqli_query($con, $query2);


      sendemail_initial("$email", "$formattedDateAndTime", "$fullname", "$job_title","$type");
      $_SESSION['success'] = "Initial Interview Appointment Successfully!";
      header("location: recruitment.php");
    }
  }
}

?>

<!-- Approve Initial Interview -->
<?php
if (isset($_POST['approve_initial_btn_set'])) {

  $id = mysqli_real_escape_string($con, $_POST['approve_initial_id']);
  $status = "Final Interview";

  $query = "UPDATE hr1_resume SET resume_status = '$status' WHERE id = '$id'";
  $result = mysqli_query($con, $query);

  $_SESSION['success'] = "Successfully Approved!";
  header("location: recruitment.php");
}
?>

<!-- Grant Examination -->
<?php
if (isset($_POST['grant_exam_btn_set'])) {

  $id = mysqli_real_escape_string($con, $_POST['grant_exam_id']);
  $status = "Examination Granted";

  $query = "UPDATE hr1_resume SET resume_status = '$status' WHERE id = '$id'";
  $result = mysqli_query($con, $query);

  $_SESSION['success'] = "Successfully Approved!";
  header("location: recruitment.php");
}
?>

<!-- Approve Examination -->
<?php
if (isset($_POST['approve_examination_btn_set'])) {

  $id = mysqli_real_escape_string($con, $_POST['approve_examination_id']);
  $status = "For Final Interview";

  $query = "UPDATE hr1_exam SET resumeStatus = '$status' WHERE id = '$id'";
  $result = mysqli_query($con, $query);

  $_SESSION['success'] = "Successfully Approved!";
  header("location: recruitment.php");
}
?>

<!-- Reject Examination -->
<?php 
function sendemail_examination_reject($email, $fullName)
{
  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port       = 465;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = 'jphigomera19@gmail.com';
  $mail->Password   = 'lavhavwsxxlzvhyw';

  $mail->IsHTML(true);
  $mail->AddAddress($email, "");
  $mail->SetFrom("jphigomera19@gmail.com", "Alegario Cure Hospital");
  $mail->Subject = "Appreciation Letter";
  $email_content = "Dear " . $fullName . ", <br><br>
  Thank you for taking the time to apply to our Company. We appreciate your interest in our organization and your efforts in submitting your application.
  <br><br>
  After careful consideration, we regret to inform you that we have decided not to move forward with your application at this time. Please note that we received a large number of highly qualified applications, and our decision was based on a careful review of your qualifications in relation to the requirements of the position.
  <br>
  We encourage you to continue pursuing your career goals and to apply for other suitable positions in the future. We wish you all the best in your future endeavors.
  <br><br>
  Thank you again for your interest in our company.
  <br><br>
  Sincerely,
  <br>
  James Philip Gomera <br>
  Alegario Cure Hospital";

  $content = $email_content;

  $mail->MsgHTML($content);
  $mail->Send();
}

if (isset($_POST['examination_reject_btn_set'])) {
  $status = "Examination Failed";
  $reject_id = $_POST['examination_reject_id'];

  // get the data of the rejected applicant
  $query = "SELECT job.*, applicant.*, exam.*, resumes.*
      FROM hr_job_list job, hr1_applicant applicant, hr1_resume resumes, hr1_exam exam
      WHERE resumes.job_list_id = job.id
      AND resumes.applicant_id = applicant.id 
      AND exam.job_list_id = job.id
      AND exam.id = '$reject_id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);

  $resume_id = $row['id'];
  $fname = $row['firstname'];
  $mname = $row['middlename'];
  $lname = $row['lastname'];
  $fullName = $fname . " " . $lname;
  $email = $row['email_address'];
  $phone = $row['mobile_number'];
  $resume = $row['resume_attachment'];

  // insert the data of the rejected applicant to the rejected_applicant table
  $insert_query = "INSERT INTO hr1_rejected_applicant (resume_id, firstname, middlename, lastname, email, phone, resume_attachment, status)
                  VALUES ('$resume_id', '$fname', '$mname', '$lname', '$email', '$phone', '$resume', '$status')";
  $insert_result = mysqli_query($con, $insert_query);

  // update the status of the applicant in the resume_tbl table
  $update_query = "UPDATE hr1_exam SET resumeStatus = '$status' WHERE id = '$reject_id'";
  $update_result = mysqli_query($con, $update_query);

  // check if the data was successfully inserted and the status was updated
  if ($insert_result && $update_result) {
    sendemail_screening_reject("$email", "$fullName");
    $_SESSION['success'] = "Successfully Rejected!";
    header("location: recruitment.php");
  } else {
    $_SESSION['error'] = "Failed to Reject!";
    header("location: recruitment.php");
  }
}
?>