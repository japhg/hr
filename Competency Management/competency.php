<?php
session_Start();
include '../../database/connection.php';


if (isset($_SESSION['username'], $_SESSION['password'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Main Quill library -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta http-equiv="refresh" content="1600; url=../../index.php">

        <title>Competency Management - Alegario Cure Hospital</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link rel="shortcut icon" href="../../assets/img/alegario_logo.png" type="image/x-icon">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600&family=Bebas+Neue&family=Catamaran:wght@300&family=Comfortaa:wght@500&family=Fira+Sans:wght@300;400;500;600;700;800&family=Heebo:wght@100;200;300;400;500;600;700;800;900&family=Hind&family=Inter:wght@300;400;600;800&family=Poiret+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:wght@500;600&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Source+Sans+3&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>



        <!-- Template Main CSS File -->
        <link href="../assets/css/style.css" rel="stylesheet">
    </head>

    <body>
        <?php
        include '../body/inside-header.php';
        include '../body/inside-sidebar.php';
        ?>

        <main id="main" class="main">

            <div class="pagetitle">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Competency Management</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->



            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#posted-jobs">Job Request</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#s-jobs">s Request</button>
                        </li>   

                    </ul>
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview" id="posted-jobs">
                            <!-- Display Requested Jobs -->
                            <table class="table" id="example" style="font-family: 'Roboto', sans-serif !important; text-align: center; width: 100%;">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Job Title</th>
                                        <th>Job Type</th>
                                        <th>Number of Applicants</th>
                                        <th>Years of Experience</th>
                                        <th>Salary</th>
                                        <th>Department</th>
                                        <th>Date Posted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $query = "SELECT job_request.*, department.department_name, DATE_FORMAT(date_requested, '%M %d, %Y')as formatted_date 
                                    FROM hr_job_request job_request, hr_department department
                                    WHERE job_request.department_id = department.id";
                                    $result = mysqli_query($con, $query);
                                    if (mysqli_num_rows($result)) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if($row['token'] === "0"){
                                    ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['job_title']; ?></td>
                                                <td><?php echo $row['job_type']; ?></td>
                                                <td><?php echo $row['num_applicants']; ?></td>
                                                <td><?php echo $row['year_experience']; ?> years</td>
                                                <td><?php echo $row['salary']; ?></td>
                                                <td><?php echo $row['department_name']; ?></td>
                                                <td><?php echo $row['formatted_date']; ?></td>
                                                <td><button class="btn addQualification" style="background: #57d8cd; color: #fff;">Set Qualification</button></td>

                                            </tr>
                                    <?php }
                                        }
                                    } ?>
                                </tbody>

                                <!-- Modal for Adding a Qualifications -->
                                <div class="modal fade" id="addQualification" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: 'Roboto', sans-serif !important;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family: 'Roboto', sans-serif !important;">Set Qualifications</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                $query = "SELECT * FROM hr_job_request";
                                                $result = mysqli_query($con, $query);
                                                if (mysqli_num_rows($result)) {
                                                    $row = mysqli_fetch_assoc($result);
                                                ?>

                                                    <form action="action.php" method="post" class="form-group needs-validation" novalidate>
                                                        <input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>">

                                                        <div class="col-auto">
                                                            <div id="editor" required></div>
                                                            <textarea name="qualifications" id="qualifications" style="display:none;" required></textarea>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn" name="addQualifications" style="background: #57d8cd; color: #fff;">Save changes</button>
                                                        </div>
                                                    </form>

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </table>


                        </div>
                        <div class="tab-pane" id="s-jobs">
                        </div>
                    </div>


                </div>
            </div>
            </div>
        </main>

        <!-- Add Qualification -->
        <script>
            $(document).ready(function() {
                $('.addQualification').on('click', function() {
                    $('#addQualification').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#id').val(data[0]);


                });
            });
        </script>

        <!-- For Quill WYSISWYG -->
        <script>
            var quill = new Quill('#editor', {
                placeholder: 'Type here...',
                theme: 'snow'
            });

            $('form').submit(function() {
                $('#qualifications').val(JSON.stringify(quill.getContents()));
                return true;
            });
        </script>

        <!-- DataTable -->
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
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
    </body>

    </html>
<?php
} else {
    header("location: ../../index.php");
    session_destroy();
}
unset($_SESSION['prompt']);
mysqli_close($con);
?>