 <!-- Add Exam -->
 <?php
 include '../../JobPortal/database/connection.php';
 include '../../JobPortal/body/function.php';
 session_start();

 if(isset($_POST['add_exam'])){
    $job_id = mysqli_real_escape_string($con, $_POST['job_id']);
    $exam_title = mysqli_real_escape_string($con, $_POST['exam_title']);
    $exam_dateTime = mysqli_real_escape_string($con, $_POST['exam_date&time']);
    $exam_duration = mysqli_real_escape_string($con, $_POST['exam_duration']);
    $mark_per_right = mysqli_real_escape_string($con, $_POST['mark_per_right']);
    $mark_per_wrong = mysqli_real_escape_string($con, $_POST['mark_per_wrong']);
    $exam_status = mysqli_real_escape_string($con, "Pending");

    if(!empty($exam_title) && !empty($exam_dateTime) && !empty($exam_duration) &&
    !empty($mark_per_right) && !empty($mark_per_wrong) && !empty($exam_status)){

        $query = "INSERT INTO exam_tbl(job_id, exam_title, exam_datetime, exam_duration, mark_per_right_answer, mark_per_wrong_answer, exam_status) 
        VALUES('$job_id', '$exam_title', '$exam_dateTime', '$exam_duration', '$mark_per_right', '$mark_per_wrong', '$exam_status')";
        $result = mysqli_query($con, $query);

        echo "Yey";
        header("location: learning.php");
    }
 }
 ?>

<!-- Update Exam -->
 <?php
 if(isset($_POST['update_exam'])){
    $exam_id = mysqli_real_escape_string($con, $_POST['exam_id']);
    $exam_title = mysqli_real_escape_string($con, $_POST['exam_title']);
    $exam_dateTime = mysqli_real_escape_string($con, $_POST['exam_date&time']);
    $exam_duration = mysqli_real_escape_string($con, $_POST['exam_duration']);
    $mark_per_right = mysqli_real_escape_string($con, $_POST['mark_per_right']);
    $mark_per_wrong = mysqli_real_escape_string($con, $_POST['mark_per_wrong']);

    if(!empty($exam_title) && !empty($exam_dateTime) && !empty($exam_duration) &&
    !empty($mark_per_right) && !empty($mark_per_wrong)){

        $query = "UPDATE exam_tbl SET exam_title = '$exam_title', exam_datetime = '$exam_dateTime', exam_duration = '$exam_duration', mark_per_right_answer = '$mark_per_right', mark_per_wrong_answer = '$mark_per_wrong' WHERE id = '$exam_id' ";
        $result = mysqli_query($con, $query);

        echo "Yey";
        header("location: learning.php");
    }
 }
 ?>

 <!-- Delete Exam -->
<?php

 if(isset($_POST['deleteExam_btn_set'])){
    $id = $_POST['deleteExam_id'];
    
    $query = "DELETE FROM exam_tbl WHERE id = '$id'";
    $result = mysqli_query($con, $query);
    
    $_SESSION['success'] = "Job is succesfully deleted!";
    header("location: learning.php");
    }
?>
 
<!-- Add Questions -->
<?php

if(isset($_POST['add_questions'])){
    $exam_id = mysqli_real_escape_string($con, $_POST['examID']);
    $question_title = mysqli_real_escape_string($con, $_POST['questionTitle']);
    $options = $_POST['options'];
    $answer = mysqli_real_escape_string($con, $_POST['answer']);
    $status = mysqli_real_escape_string($con, "Completed");

    mysqli_autocommit($con, false);

        $query1 = "INSERT INTO question_tbl(exam_id, question_title, answer_option) 
        VALUES('$exam_id', '$question_title', '$answer')";

        if (mysqli_query($con, $query1)) {
            $last_id = mysqli_insert_id($con);
    
            foreach ($options as $option_number => $option_title){
                $query2 = "INSERT INTO option_tbl (question_id, option_title, option_number) 
                VALUES ('$last_id', '$option_title', '$option_number')";
                if (mysqli_query($con, $query2)) {
                    
                    // Commit the transaction
                    mysqli_commit($con);
                    echo "New record created successfully";
                    echo "Yey";
                    header("location: learning.php");
                } else {
                    // Rollback the transaction
                    mysqli_rollback($con);
                    echo "Error: " . $query2 . "<br>" . $con->error;
                }
            }
            
        }

        
    
 }
 ?>
