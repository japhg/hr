<?php
// connect to database
include '../../JobPortal/database/connection.php';

// get exam ID from POST data
$examId = $_POST['exam_id'];

// query database for questions
$query = "SELECT exam.*, question.*, options.* 
FROM hr1_exam exam, hr1_question question, hr1_option options
WHERE exam.id = question.exam_id
AND question.id = options.question_id 
AND exam_id = $examId              
ORDER BY question.id, options.id";
$result = mysqli_query($con, $query);

$current_question_id = null;
$correct_answer_option_number = null;

while ($row = mysqli_fetch_assoc($result)) {
    $examID = $row['exam_id'];
    // If the current question ID is different from the previous one,
    // we need to display the new question and options
    if ($row['question_id'] !== $current_question_id) {
        // If this is not the first question, display the correct answer for the previous question
        if ($current_question_id !== null) {
            $correct_answer_query = "SELECT option_title FROM hr1_option WHERE question_id = $current_question_id AND option_number = $correct_answer_option_number ";
            $correct_answer_result = mysqli_query($con, $correct_answer_query);
            $correct_answer_row = mysqli_fetch_assoc($correct_answer_result);
?>
            <h5>Correct Answer: <?php echo $correct_answer_row['option_title']; ?></h5> <br><br>
        <?php
        }
        $current_question_id = $row['question_id'];
        $correct_answer_option_number = $row['correct_answer_option'];
        ?>

        <h3><?php echo $row['question_title']; ?></h3>
    <?php
    }
    ?>
    <p><?php echo $row['option_title']; ?></p>
<?php
}

// Display the correct answer for the last question
$correct_answer_query = "SELECT option_title FROM hr1_option WHERE question_id = $current_question_id AND option_number = $correct_answer_option_number";
$correct_answer_result = mysqli_query($con, $correct_answer_query);
$correct_answer_row = mysqli_fetch_assoc($correct_answer_result);
?>
<h5>Correct Answer: <?php echo $correct_answer_row['option_title']; ?></h5>