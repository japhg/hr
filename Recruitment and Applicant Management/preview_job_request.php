<?php
include '../../database/connection.php';

$examId = $_POST['id'];

// query database for questions

$query = "SELECT job_request.*, department.*, qualifications.*
        FROM hr_job_request job_request, hr_department department, hr1_job_qualifications qualifications
        WHERE job_request.department_id = department.id
        AND qualifications.job_request_id = job_request.id
        AND job_request.id = '$examId'";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$examId = $_POST['id'];
$job_title = $row['job_title'];
$job_type = $row['job_type'];
$job_qualification = $row['description'];
$job_description = $row['job_description'] ?? 'default value';
$skills = $row['skills'];
$number_of_applicants = $row['num_applicants'];
$year_experience = $row['year_experience'];
$salary = $row['salary'];
$department = $row['department_name'];

$html = '';
if (!empty($job_qualification)) {
    $data = json_decode($job_qualification, true);
    if (!empty($data['ops'])) {
        $html = '<ul>';
        foreach ($data['ops'] as $op) {
            if (!empty($op['insert'])) {
                $text = trim($op['insert']);
                $attributes = $op['attributes'] ?? null;
                if (!empty($attributes) && !empty($attributes['list']) && $attributes['list'] == 'bullet' && !empty($text)) {
                    $html .= '<li>' .$text. '</li>';
                } elseif (!empty($text)) {
                    $html .= '<li>' . $text . '</li>';
                }
            }
        }
        $html .= '</ul>';
    }
}

?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <input type="hidden" name="id" value="<?php echo $examId?>" disabled>
        <div class="col-auto py-3">
                <label for="job_title">Job Title</label>
                <input type="text" class="form-control" name="job_title" id="job_title" value="<?php echo $job_title;?>" disabled style="border: none;">
        </div>
        <div class="col-auto py-3">
        <label for="job_title">Job Type</label>
                <input type="text" class="form-control" name="job_type" id="job_title" value="<?php echo $job_type;?>" disabled style="border: none;">
        </div>
        <div class="col-auto py-3">
        <label for="job_title">Job Qualifications</label>
        <?php echo $html;?>
        </div>
        <div class="col-auto py-3">
        <label for="job_title">Job Description</label>
                <input type="text" class="form-control" name="job_title" id="job_title" value="<?php echo $job_description;?>" disabled style="border: none;">
        </div>
        <div class="col-auto py-3">
        <label for="job_title">Skills</label>
                <input type="text" class="form-control" name="job_title" id="job_title" value="<?php echo $skills;?>" disabled style="border: none;">
        </div>
        <div class="col-auto py-3">
        <label for="job_title">Number of Applicants</label>
                <input type="text" class="form-control" name="job_title" id="job_title" value="<?php echo $number_of_applicants;?>" disabled style="border: none;">
        </div>
        <div class="col-auto py-3">
        <label for="job_title">Years of Experience</label>
                <input type="text" class="form-control" name="job_title" id="job_title" value="<?php echo $year_experience;?>" disabled style="border: none;">
        </div>
        <div class="col-auto py-3">
        <label for="job_title">Salary</label>
                <input type="text" class="form-control" name="job_title" id="job_title" value="<?php echo $salary;?>" disabled style="border: none;">
        </div>
        <div class="col-auto py-3">
        <label for="job_title">Department Name</label>
                <input type="text" class="form-control" name="job_title" id="job_title" value="<?php echo $department;?>" disabled style="border: none;">
        </div>
</form>

