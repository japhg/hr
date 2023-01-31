<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body>
  <nav class="top-nav">
    <div class="nav">
      <div class="d-flex justify-content-start" id="logo" style="width: 100%;">
        <a href="../index.php" class="logo d-flex align-items-center w-auto" style="box-shadow: none;">
          <img src="../img/hrlogo.png" alt="HR Logo" width="20%">
          <span class="d-lg-block small mb-0" style="font-family: 'Poiret One', cursive !important; color: #000000; font-weight: 600;">JOB<b id="animated-text" style="font-family: 'Poiret One', cursive !important;"> PORTAL</b></span>
        </a>
      </div>

      <div class=".menu-page d-flex justify-content-center py-4" style="width: 100%;">
        <input id="menu-toggle" type="checkbox" />
        <label class='menu-button-container' for="menu-toggle">
          <div class='menu-button'></div>
        </label>


        <ul class="menu">
          <li><button class="btn"><a class="active" href="../index.php">HOME</a></button></li>
          <li><button class="btn"><a href="../body/about.php">ABOUT</a></button></li>
          <li><button class="btn"><a href="../body/contact.php">CONTACT</a></button></li>
          <li><button class="btn"><a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">SIGNUP</a></button></li>
          <li><button class="btn" id="login"><a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">LOGIN</a></button></li>
        </ul>
      </div>

      <div class="d-flex justify-content-end py-4" id="icons" style="width: 100%;">
        <div class="icons">
          <a href="#" target="_blank" class="fa fa-facebook-square"></a>
          <a href="#" target="_blank" class="fa fa-instagram"></a>
          <a href="#" target="_blank" class="fa fa-twitter"></a>
          <a href="#" target="_blank" class="fa fa-google"></a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Modal for Sign up -->
  <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background: #FFF;">
        <div class="modal-header">
          <br>
          <h5 style="color: #000; font-family: 'Inter', sans-serif; font-weight: 800;">PLEASE SELECT TO REGISTER</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
          <button type="button" class="button" style="background: #2d2d52; width: 14rem; border: 1px solid #2d2d52; padding: 5px;">
            <i class="fa-solid fa-user-tie" style="color: #fff !important;"></i>
            <a href="../employer/register_employer.php" style="color: #fff !important; font-family: 'Roboto', sans-serif;">EMPLOYER</a>
          </button>
          <button type="button" class="button" style="background: #2d2d52; width: 14rem; border: 1px solid #2d2d52; padding: 5px; margin-top: 1rem;">
            <i class="fa-solid fa-user" style="color: #fff !important;"></i>
            <a href="../applicant/register_applicant.php" style="color: #fff !important; font-family: 'Roboto', sans-serif;">APPLICANT</a>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for login -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background: #FFF;">
        <div class="modal-header">
          <br>
          <h5 style="color: #000; font-family: 'Inter', sans-serif; font-weight: 800;">PLEASE SELECT TO LOGIN</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <button type="button" class="button" style="background: #2d2d52; width: 14rem; border: 1px solid #2d2d52; padding: 5px;">
            <i class="fa-solid fa-user-tie" style="color: #fff !important;"></i>
            <a href="../employer/login_employer.php" style="color: #fff !important; font-family: 'Roboto', sans-serif;">EMPLOYER</a>
          </button>
          <button type="button" class="button" style="background: #2d2d52; width: 14rem; border: 1px solid #2d2d52; padding: 5px; margin-top: 1rem">
            <i class="fa-solid fa-user" style="color: #fff !important;"></i>
            <a href="../applicant/login_applicant.php" style="color: #fff !important; font-family: 'Roboto', sans-serif;">APPLICANT</a>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/bootstrap.js"></script>
</body>

</html>