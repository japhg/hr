
<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="#" class="logo d-flex align-items-center">
      <img src="assets/img/alegario_logo.png" alt="Alegario Cure Hospital Logo" class="img-responsive">
      <span class="d-none d-lg-block" style="font-family: 'Poiret One', sans-serif !important;"><b style="color: #03989e">ALEGARIO CURE</b> <b style="color: #66CC33">HOSPITAL</b></span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div><!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->



      <?php 
       $query = "SELECT user.*, admin.*, SUBSTRING(firstname, 1, 1) as first_letter FROM users user, admins admin WHERE admin.user_id = user.id AND username = '" . $_SESSION['username'] . "'";
       $result = mysqli_query($con, $query);
      if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $image = $row['image'];
        ?>
      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img alt="Profile Picture" class="img-small-circle" <?php echo '<img src="imageStorage/' . $image . '" />'; ?>
          <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $row['first_letter']; ?>. <?php echo $row['lastname'];?></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo $row['firstname'], " ", $row['lastname'];?></h6>
            <span><?php echo $row['role'];?></span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="user/profile.php">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="user/profile.php">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
              <i class="bi bi-question-circle"></i>
              <span>Need Help?</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="body/logout.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
    
      </li><!-- End Profile Nav -->
      <?php }?>
    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

