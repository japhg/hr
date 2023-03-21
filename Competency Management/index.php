<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main Quill library -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <title>Document</title>
 
</head>
<body>

<?php
include '../../database/connection.php';
session_start();

// Retrieve the job qualifications data from the database
$query = "SELECT * FROM hr1_job_qualifications";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$qualifications = $row['description'] ?? 'default value';

// Parse the JSON data and convert it into HTML
$html = '';
if (!empty($qualifications)) {
    $data = json_decode($qualifications, true);
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

<!-- Display the parsed data in HTML format -->
<div>
  <?php echo $html; ?>
</div>

</body>
</html>