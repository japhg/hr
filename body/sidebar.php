
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link active" href="index.php" style="color: #57d8cd;">
      <i class="bi bi-grid"></i>
      <span>HR Analytics</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="Recruitment and Applicant Management/recruitment.php">
      <i class="bi bi-person"></i>
      <span>Recruitment and Applicant Management</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Learning and Training Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="Training and Leaning Management/learning.php">
          <i class="bi bi-circle"></i><span>Learning Management</span>
        </a>
      </li>
      <li>
        <a href="Training and Leaning Management/training.php">
          <i class="bi bi-circle"></i><span>Training Management</span>
        </a>
      </li>
    </ul>
  </li><!-- End Forms Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="Competency Management/competency.php">
      <i class="bi bi-person"></i>
      <span>Competency Management</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="user.php">
      <i class="bi bi-person"></i>
      <span>New Hired Onboard</span>
    </a>
  </li><!-- End new hired Onboard Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="user.php">
      <i class="bi bi-person"></i>
      <span>Performance Management</span>
    </a>
  </li>

  
  <li class="nav-item">
    <a class="nav-link collapsed" href="user.php">
      <i class="bi bi-person"></i>
      <span>Succession Planning</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="user.php">
      <i class="bi bi-person"></i>
      <span>Social Recognition</span>
    </a>
  </li> <br><br><br>

  <?php 
   $query = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
   $result = mysqli_query($con, $query);
   $row = mysqli_fetch_assoc($result);

  if($row['role'] === "SUPER ADMIN"){
  ?>
  <li class="nav-item">
      <a class="btn btn-secondary" href="../subsystem.php">
        <span>Back</span>
      </a>
   
  </li>
  <?php }?>















</ul>

</aside><!-- End Sidebar-->
<script>
  $(document).ready(function() {
  // Get the current URL
  var currentUrl = window.location.href;

  // Loop through each link in the dropdown
  $("#forms-nav a").each(function() {
    // Check if the link matches the current URL
    if (currentUrl === this.href) {
      // Add the active class to the parent li element
      $(this).parent().addClass("active");
    }
  });
});
</script>

