 <!-- Add Exam -->
 <?php
    include '../../JobPortal/database/connection.php';
    include '../../JobPortal/body/function.php';
    session_start();

    if (isset($_POST['add_exam'])) {
        $job_id = mysqli_real_escape_string($con, $_POST['job_id']);
        $exam_title = mysqli_real_escape_string($con, $_POST['exam_title']);

        $exam_duration = mysqli_real_escape_string($con, $_POST['exam_duration']);
        $mark_per_right = mysqli_real_escape_string($con, $_POST['mark_per_right']);
        $mark_per_wrong = mysqli_real_escape_string($con, $_POST['mark_per_wrong']);
        $number_of_items = mysqli_real_escape_string($con, $_POST['number_of_items']);
        $exam_status = mysqli_real_escape_string($con, "Pending");

        if (
            !empty($exam_title) && !empty($exam_duration) &&
            !empty($mark_per_right) && !empty($mark_per_wrong) && !empty($exam_status) && !empty($number_of_items)
        ) {

            $query = "INSERT INTO exam_tbl(job_id, exam_title, exam_duration, mark_per_right_answer, mark_per_wrong_answer, exam_status, number_of_items) 
        VALUES('$job_id', '$exam_title', '$exam_duration', '$mark_per_right', '$mark_per_wrong', '$exam_status', '$number_of_items')";
            $result = mysqli_query($con, $query);

            echo "Yey";
            header("location: learning.php");
        }
    }
    ?>

 <!-- Update Exam -->
 <?php
    if (isset($_POST['update_exam'])) {
        $exam_id = mysqli_real_escape_string($con, $_POST['exam_id']);
        $exam_title = mysqli_real_escape_string($con, $_POST['exam_title']);
        $exam_duration = mysqli_real_escape_string($con, $_POST['exam_duration']);
        $mark_per_right = mysqli_real_escape_string($con, $_POST['mark_per_right']);
        $mark_per_wrong = mysqli_real_escape_string($con, $_POST['mark_per_wrong']);

        if (
            !empty($exam_title) && !empty($exam_duration) &&
            !empty($mark_per_right) && !empty($mark_per_wrong)
        ) {

            $query = "UPDATE exam_tbl SET exam_title = '$exam_title', exam_duration = '$exam_duration', mark_per_right_answer = '$mark_per_right', mark_per_wrong_answer = '$mark_per_wrong' WHERE id = '$exam_id' ";
            $result = mysqli_query($con, $query);

            echo "Yey";
            header("location: learning.php");
        }
    }
    ?>

 <!-- Delete Exam -->
 <?php

    if (isset($_POST['deleteExam_btn_set'])) {
        $id = $_POST['deleteExam_id'];

        $query = "DELETE FROM exam_tbl WHERE id = '$id'";
        $result = mysqli_query($con, $query);

        $_SESSION['success'] = "Job is succesfully deleted!";
        header("location: learning.php");
    }
    ?>


 <!-- Add Questions -->
 <?php
if (isset($_POST['add_questions'])) {
    $exam_id = mysqli_real_escape_string($con, $_POST['examID']);
    $question_title = mysqli_real_escape_string($con, $_POST['questionTitle']);
    $options = $_POST['options'];
    $answer =  $_POST['answer'];
    
    // fetch number_of_items for the current exam
    $query = "SELECT number_of_items FROM exam_tbl WHERE id = '$exam_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $number_of_items = $row['number_of_items'];

    mysqli_autocommit($con, false);

    $query1 = "INSERT INTO question_tbl(exam_id, question_title, answer_option) 
    VALUES('$exam_id', '$question_title', '$answer')";

    if (mysqli_query($con, $query1)) {
        $last_id = mysqli_insert_id($con);

        foreach ($options as $option_number => $option_title) {
            $query2 = "INSERT INTO option_tbl (question_id, option_title, option_number) 
            VALUES ('$last_id', '$option_title', '$option_number')";

            if (mysqli_query($con, $query2)) {

                // check if the number of questions for the current exam has reached the limit
                $query = "SELECT COUNT(*) AS count FROM question_tbl WHERE exam_id = '$exam_id'";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count'];

                if ($count >= $number_of_items) {
                    // set status to "Completed" if the limit has been reached
                    $status = "Completed";
                } else {
                    // set status to "Incomplete" if the limit has not been reached
                    $status = "Incomplete";
                }

                // update exam_status in the exam_tbl table
                $query3 = "UPDATE exam_tbl SET exam_status = '$status' WHERE id = '$exam_id'";
                if (mysqli_query($con, $query3)) {
                    // Commit the transaction
                    mysqli_commit($con);
                    $_SESSION['success'] = "New record created successfully";
                    header("location: learning.php");
                } else {
                    // Rollback the transaction
                    mysqli_rollback($con);
                    echo "Error: " . $query2 . "<br>" . $con->error;
                }
            } else {
                echo "Yay :(";
            }
        }
    }
}
    ?>