<?php
session_Start();
require '../../../../ALEGARIO/Hospital-template/database/connection.php';

if (isset($_POST['save'])) {
  $user_id = $_POST['user_id'];
  $firstname = mysqli_real_escape_string($con1, $_POST['firstName']);
  $middlename = mysqli_real_escape_string($con1, $_POST['middleName']);
  $lastname = mysqli_real_escape_string($con1, $_POST['lastName']);
  $about = mysqli_real_escape_string($con1, $_POST['about']);
  $country = mysqli_real_escape_string($con1, $_POST['country']);
  $street = mysqli_real_escape_string($con1, $_POST['street']);
  $barangay = mysqli_real_escape_string($con1, $_POST['barangay']);
  $city = mysqli_real_escape_string($con1, $_POST['city']);
  $state = mysqli_real_escape_string($con1, $_POST['state']);
  $zip = mysqli_real_escape_string($con1, $_POST['zip']);
  $phone = mysqli_real_escape_string($con1, $_POST['phone']);
  $email = mysqli_real_escape_string($con1, $_POST['email']);
  $twitter = mysqli_real_escape_string($con1, $_POST['twitter']);
  $facebook = mysqli_real_escape_string($con1, $_POST['facebook']);
  $instagram = mysqli_real_escape_string($con1, $_POST['instagram']);
  $linkedin = mysqli_real_escape_string($con1, $_POST['linkedin']);

    if (
      !empty($firstname) && !empty($middlename) && !empty($lastname) && !empty($about)
      && !empty($country) && !empty($street) && !empty($barangay) && !empty($city)
      && !empty($state) && !empty($zip) && !empty($phone) && !empty($email) && !empty($twitter)
      && !empty($facebook) && !empty($instagram) && !empty($linkedin)
    ) {

      $query = "UPDATE admins SET firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', about = '$about',
      country = '$country', street = '$street', barangay = '$barangay', city = '$city', state = '$state', zipcode = '$zip',
      phoneNumber = '$phone', email = '$email', twitter = '$twitter', facebook = '$facebook', instagram = '$instagram', linkedin = '$linkedin' 
      WHERE user_id = '$user_id'";

      if ($results = mysqli_query($con1, $query)) {
        header("location: profile.php");
      }
      else {
        $errors['error'] = "Update Unsuccessful!";
      }
    } 
    else {
      $errors['error'] = "Please insert the data to update!";
    }
  }



// Update profile picture
if (isset($_POST['update'])) {
  $user_id = $_POST['user_id'];
  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];
  $fileTempName = $_FILES["file"]["tmp_name"];
  $fileSize = $_FILES["file"]["size"];
  $fileError = $_FILES["file"]["error"];
  $fileType = $_FILES["file"]["type"];
  $folder = "../imageStorage/" . $fileName;

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 5000000) {
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = $folder;
        move_uploaded_file($fileTempName, $fileDestination);

        if (!empty($file)) {
          $query = "UPDATE admins SET image = '$fileName'
          WHERE user_id = '$user_id'";

          $result = mysqli_query($con1, $query);

          header("location: profile.php");
        } else {
          $_SESSION['errorMessage'] = "Failed to update profile picture";
        }
      } else {
        $_SESSION['errorMessage'] = "You image is too big!";
      }
    } else {
      $_SESSION['errorMessage'] = " There was an error uplading your file!";
    }
  } else {
    $_SESSION['errorMessage'] = "You cannot upload this type of Image";
  }
}



if (isset($_SESSION['username'], $_SESSION['password'])) {
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Profile - Alegario Cure Hospital</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/alegario_logo" rel="icon">
    <link href="../assets/img/alegario_logo" rel="apple-touch-icon">

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

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
  </head>

  <body>
    <?php include '../body/inside-header.php';
    include '../body/inside-sidebar.php'; ?>

    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section profile">
        <div class="row">
          <div class="col-xl-4">
          <?php
                   $query = "SELECT user.*, admin.*, SUBSTRING(firstname, 1, 1) as first_letter FROM user_table user, admins admin WHERE admin.user_id = user.u_id AND username = '" . $_SESSION['username'] . "'";
                    $result = mysqli_query($con1, $query);
                    if (mysqli_num_rows($result)) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        $image = $row['image'];
                    ?>
            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

               <img alt="Profile Picture" class="img-circle" <?php echo '<img src="../imageStorage/' . $image . '" />'; ?>
                <h2><?php echo $row['firstname'], " ",$row['lastname'];?></h2>
                <h3><?php echo $row['role'];?></h3>
                <div class="social-links mt-2">
                  <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                  <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                  <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                  <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>

          </div>

          <div class="col-xl-8">

            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                  </li>

                </ul>
                <div class="tab-content pt-2">

                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                    <h5 class="card-title">About</h5>
                    <p class="small fst-italic"><?php echo $row['about'];?></p>

                    <h5 class="card-title">Profile Details</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Full Name</div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['firstname'], " ",$row['lastname'];?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Job</div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['role'];?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Country</div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['country'];?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Address</div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['street'],", ", $row['barangay'],", ", $row['city'],", ",$row['state'],", ", $row['zipcode'];?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Phone</div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['phoneNumber'];?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Email</div>
                      <div class="col-lg-9 col-md-8"><?php echo $row['email'];?></div>
                    </div>
<?php }}?>
                  </div>


                  <!--Modal-->
                  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <br>
                          <h5 style="color: #000; font-family: 'Roboto', sans-serif; font-weight: 800; text-align: center;">UPDATE YOUR PROFILE PICTURE</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: none !important;"></button>
                        </div>
                        <div class="modal-body">
                          <!-- Form -->
                          <?php
                    $query = "SELECT user.*, admin.*, SUBSTRING(firstname, 1, 1) as first_letter FROM user_table user, admins admin WHERE admin.user_id = user.u_id AND username = '" . $_SESSION['username'] . "'";
                    $result = mysqli_query($con1, $query);
                          if (mysqli_num_rows($result)) {
                            while ($row = mysqli_fetch_assoc($result)) {
                              $image = $row['image'];
                              ?>
                          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-group needs-validation" novalidate enctype="multipart/form-data" accept="image/png, image/jpeg, image/jpg">
                          <input type="hidden" value="<?php echo $row['u_id']; ?>" name="user_id">
                          <div class="col-auto">
                              <label for="email" class="form-label" style="color: #000;">Please select image</label>
                              <input type="file" class="form-control" name="file" id="file" style="color: #000; box-shadow: none; border-color: #06bbac;" required>
                              <div class="invalid-feedback">
                                Please insert an image.
                              </div>
                            </div>
                            <br>
                            <button type="submit" name="update" class="btn" style="background: #06bbac; color: #fff; border: none;">Update</button>
                          </form>
                          <?php }
                          }?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #121212 !important;">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                    <!-- Profile Edit Form -->

                    <?php
                    $query = "SELECT user.*, admin.*, SUBSTRING(firstname, 1, 1) as first_letter FROM user_table user, admins admin WHERE admin.user_id = user.u_id AND username = '" . $_SESSION['username'] . "'";
                    $result = mysqli_query($con1, $query);
                    if (mysqli_num_rows($result)) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        $image = $row['image'];
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="needs-validation" novalidate enctype="multipart/form-data" accept="image/png, image/jpeg, image/jpg">
                    <input type="hidden" value="<?php echo $row['u_id']; ?>" name="user_id">
                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                        <div class="col-md-8 col-lg-9">
                        <img alt="Profile Picture" class="img-circle" <?php echo '<img src="../imageStorage/' . $image . '" />'; ?>
                          <div class="pt-2">
                            <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-upload"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="firstName" type="text" class="form-control" id="fullName" value="<?php echo $row['firstname'];?>" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="middleName" type="text" class="form-control" id="fullName" value="<?php echo $row['middlename'];?>" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="lastName" type="text" class="form-control" id="fullName" value="<?php echo $row['lastname'];?>" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                        <div class="col-md-8 col-lg-9">
                          <textarea name="about" class="form-control" id="about" style="height: 100px" required><?php echo $row['about'];?></textarea>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="job" type="text" class="form-control" id="Job" value="<?php echo $row['role'];?>" disabled>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="country" type="text" class="form-control" id="Country" value="<?php echo $row['country'];?>" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">ADDRESS</label>
                        <div class="col-md-8 col-lg-9">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Street</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="street" type="text" class="form-control" id="Address" value="<?php echo $row['street'];?>" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Barangay</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="barangay" type="text" class="form-control" id="Address" value="<?php echo $row['barangay'];?>" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">City</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="city" type="text" class="form-control" id="Address" value="<?php echo $row['city'];?>" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">State</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="state" type="text" class="form-control" id="Address" value="<?php echo $row['state'];?>" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Zip Code</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="zip" type="text" class="form-control" id="Address" value="<?php echo $row['zipcode'];?>" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="phone" type="text" class="form-control" id="Phone" value="<?php echo $row['phoneNumber'];?>" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email Address</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="email" type="email" class="form-control" id="Email" value="<?php echo $row['email'];?>" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="twitter" type="text" class="form-control" id="Twitter" value="<?php echo $row['twitter'];?>" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="facebook" type="text" class="form-control" id="Facebook" value="<?php echo $row['facebook'];?>" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="instagram" type="text" class="form-control" id="Instagram" value="<?php echo $row['instagram'];?>" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="linkedin" type="text" class="form-control" id="Linkedin" value="<?php echo $row['linkedin'];?>" required>
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" name="save" class="btn btn-primary">Save Changes</button>
                      </div>
                    </form>
                    <?php }}?>
                    <!-- End Profile Edit Form -->

                  </div>

                  <div class="tab-pane fade pt-3" id="profile-settings">

                    <!-- Settings Form -->
                    <form>

                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                        <div class="col-md-8 col-lg-9">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changesMade" checked>
                            <label class="form-check-label" for="changesMade">
                              Changes made to your account
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="newProducts" checked>
                            <label class="form-check-label" for="newProducts">
                              Information on new products and services
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="proOffers">
                            <label class="form-check-label" for="proOffers">
                              Marketing and promo offers
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                            <label class="form-check-label" for="securityNotify">
                              Security alerts
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                      </div>
                    </form><!-- End settings Form -->

                  </div>

                  <div class="tab-pane fade pt-3" id="profile-change-password">
                    <!-- Change Password Form -->
                    <form>
                    <div class="text-center">
                        <p>Sorry, you can't change your password. Only the superadmin have the rights to change your password. Please contact your super admin for that.</p>
                      </div>
                    </form><!-- End Change Password Form -->

                  </div>

                </div><!-- End Bordered Tabs -->

              </div>
            </div>

          </div>
        </div>
      </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php
    include '../body/footer.php';
    ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
  header("location: ../../Hospital-Template/Hospital-template/index.php");
  session_destroy();
}
unset($_SESSION['prompt']);
mysqli_close($con1);
?>