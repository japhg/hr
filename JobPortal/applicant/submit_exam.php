<?php
require "../database/connection.php";

   if(isset($_POST['submit'])){
    $exam_id = $_POST['exam_id'];
    $question_id = $_POST['question_id'];
    
    while($question_id){
        echo $question_id;
    }
    // Validate input
    if (!is_array($answers) || count($answers) == 0) {
        // Handle validation error
    }
    // Insert answers into database
    foreach ($answers as $question_id => $answer) {
        $query = "INSERT INTO answer_tbl (exam_id, question_id, answer) VALUES ($exam_id, $question_id, '$answer')";
        $result = mysqli_query($con, $query);

        if ($result) {
            header("location: exam.php");
        }
    }
}
?>

