<?php
session_start();
include 'connection.php';
include 'function.php';


if (isset($_SESSION['email'], $_SESSION['password'])) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="15; url=login_employer.php"> -->
    <link rel="shortcut icon" href="img/hrlogo.png" type="image/x-icon">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/f63d53b14e.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&family=Inter:wght@300;400;600;800&family=Poiret+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:wght@500;600&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="jquery-2.1.3.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>




    <link rel="stylesheet" href="css/style/manage_job.css">
    <link rel="stylesheet" href="css/style/footer.css">
    <link rel="stylesheet" href="css/style/loader.css">
    <link rel="stylesheet" href="css/bootstrap.css">


    <title>Manage Jobs</title>

    <style>
      .table {
        padding: 3px !important;
      }

      th {
        padding: 3px !important;
      }

      td {
        border: none !important;
      }
    </style>
  </head>

  <body>
    <?php include 'loader.php'; ?>


    <header class="top-nav">

      <div>
        <img src="img/hrlogo.png" alt="HR Logo" class="rounded" id="logo">
        <h1 id="logo-title">JOB PORTAL</h1>
      </div>
      <input id="menu-toggle" type="checkbox" />
      <label class='menu-button-container' for="menu-toggle">
        <div class='menu-button'></div>
      </label>
      <ul class="menu position-absolute top-50 start-50 translate-middle">
        <li><a href="dashboard.php">DASHBOARD</a></li>
        <li><a class="active" href="manage_jobs.php">MANAGE JOBS</a></li>
        <li><a href="postJob.php">POST A JOB</a></li>
        <li><a href="employer_profile.php">PROFILE</a></li>
        <li><a href="logout.php">LOGOUT</a></li>
      </ul>

    </header>
    <br><br><br><br><br><br><br><br>
    <main>
      <div class="container">
        <div class="pagetitle">
          <h1 style="color: #6559ca; font-weight: 800;">MANAGE JOBS</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Jobs</li>
            </ol>
          </nav>
        </div>
        <!-- End Page Title -->
        <br><br><br>

        <section>
          <table id="table" class="display table" width="100%">
            <thead style="text-align: center;">
              <tr>
                <th>ID</th>
                <th>JOB TITLE</th>
                <th>STATUS</th>
                <th>DATE POSTED</th>
                <th colspan="3">ACTIONS</th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
              <tr>
                <?php
                $query = "SELECT e.*, j.*, DATE_FORMAT(date_posted, '%M %d, %Y')as formatted_date FROM employer_tbl e, job_tbl j WHERE e.id = j.empr_id AND email_address = '" . $_SESSION['email'] . "'";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result)) {
                  while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <td><?php echo $row['job_id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['status'];?></td>
                    <td><?php echo $row['formatted_date']; ?></td>
                    <td>
                      <form action="update_manage_jobs.php" method="post">
                        <input type="hidden" name="updates" id="updates" value="<?php echo $row['job_id']; ?>">
                        <button type="submit" class="btn btn-outline-default" id="update">Update</button>
                      </form>
                    </td>
                    <td>
                      <input type="hidden" name="deletes" class="deletes" id="delete" value="<?php echo $row['job_id']; ?>">
                      <a href="javascript:void(0)" class="delete_btn_ajax btn btn-outline-default">Delete</a>
                    </td>
                    <td>
                      <?php
                      if ($row['status'] === "ACTIVE") {
                        ?>
                      <input type="hidden" name="view" class="view" id="views" value="<?php echo $row['job_id']; ?>">
                      <a href="javascript:void(0)" class="close_btn_ajax btn btn-outline-default">Close</a>
                      <?php } elseif ($row['status'] === "CLOSED") { ?>
                       <input type="hidden" name="open" class="open" id="opens" value="<?php echo $row['job_id']; ?>">
                      <a href="javascript:void(0)" class="open_btn_ajax btn btn-outline-default">Open</a>
                     <?php }?>
                    </td>
              </tr>
          <?php
               
                  }
                } ?>
            </tbody>
          </table>

        </section>

        <!-- Start of Section Page -->
    </main>













    <script>
      // For Delete
      $(document).ready(function() {
        $('.delete_btn_ajax').click(function(e) {
          e.preventDefault();

          var deleteid = $(this).closest("tr").find('.deletes').val();

          swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this data again!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

                $.ajax({
                  type: "POST",
                  url: "action.php",
                  data: {
                    "delete_btn_set": 1,
                    "delete_id": deleteid,
                  },
                  success: function(response) {

                    swal("Data Deleted Successfully!", {
                      icon: "success",
                    }).then((result) => {
                      location.reload();
                    });

                  }
                });

              }
            });

        });
      });


      // For ACTIONS Closed
      $(document).ready(function() {
        $('.close_btn_ajax').click(function(e) {
          e.preventDefault();

          var closeid = $(this).closest("tr").find('.view').val();

          swal({
              title: "Are you sure you want to close this job?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

                $.ajax({
                  type: "POST",
                  url: "action.php",
                  data: {
                    "close_btn_set": 1,
                    "close_id": closeid,
                  },
                  success: function(response) {

                    swal("Successfully closed this Job!", {
                      icon: "success",
                    }).then((result) => {
                      location.reload();
                    });

                  }
                });

              }
            });

        });
      });



 // For ACTIONS Open
 $(document).ready(function() {
        $('.open_btn_ajax').click(function(e) {
          e.preventDefault();

          var openid = $(this).closest("tr").find('.open').val();

          swal({
              title: "Are you sure you want to open this job?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

                $.ajax({
                  type: "POST",
                  url: "action.php",
                  data: {
                    "open_btn_set": 1,
                    "open_id": openid,
                  },
                  success: function(response) {

                    swal("Successfully Opened this Job!", {
                      icon: "success",
                    }).then((result) => {
                      location.reload();
                    });

                  }
                });

              }
            });

        });
      });




    </script>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <?php include 'footer.php'; ?>
  </body>

  </html>
<?php
} else {
  header("location:index.php");
  session_destroy();
}
unset($_SESSION['prompt']);
mysqli_close($con);
?>