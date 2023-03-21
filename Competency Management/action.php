 <!-- Set Job Qualifications -->
 <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '../../database/connection.php';
    session_start();

    if (isset($_POST['addQualifications'])) {
        $id = $_POST['id'];
        $qualifications = mysqli_real_escape_string($con, $_POST['qualifications']);
        $token = "1";

        if (!empty($qualifications)) {
            $query = "INSERT INTO hr1_job_qualifications(job_request_id, description) 
            VALUES ('$id','$qualifications')";
            $result = mysqli_query($con, $query);

            if ($result) {
                $query2 = "UPDATE hr_job_request SET token = '$token' WHERE id = '$id'";
                $result2 = mysqli_query($con, $query2);
                if ($result2) {
                    $_SESSION['message'] = "Successfully set the qualifications for this job.";
                    header("location: competency.php");
                } else {
                    echo "Error!";
                }
            } else {
                echo "Error!";
            }
        } else {
            echo "Error";
        }
    }
    ?>