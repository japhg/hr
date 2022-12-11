<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/hrlogo.png" type="image/x-icon">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="https://kit.fontawesome.com/494d8a5cb9.js" crossorigin="anonymous"></script> -->
    <script src="https://kit.fontawesome.com/f63d53b14e.js" crossorigin="anonymous"></script>
  
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&family=Inter:wght@300;400;600;800&family=Poppins&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="jquery-2.1.3.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    
    <link rel="stylesheet" href="css/style/style.css">
    <link rel="stylesheet" href="css/style/loader.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Job Portal</title>
</head>
<body id="home">
  <?php include 'loader.php';?>
      <header class="top-nav">
        <div>
        <img src="img/hrlogo.png" alt="HR Logo" class="img-responsive" width="45%" id="logo" style="margin-top: 2rem;">
        </div>
        <input id="menu-toggle" type="checkbox" />
        <label class='menu-button-container' for="menu-toggle">
        <div class='menu-button'></div>
      </label>
        <ul class="menu">
        <li><a class="active" href="#home">HOME</a></li>
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#contact">CONTACT</a></li>
        <li><a href="s-signup.php">SIGN UP</a></li>
        <li><a href="s-login.php">LOG IN</a></li>
        </ul>
        <div class="icons" id="icons">
          <a href="#" class="fa fa-facebook-square"></a>
          <a href="#" class="fa fa-instagram"></a>
          <a href="#" class="fa fa-twitter"></a>
          <a href="#" class="fa fa-google"></a>
        </div>
      </header>

      <div class="img">
        <img src="img/Girl in Chair.png" alt="Girl in Chair" width="500rem">
      </div>
      <div class="text">
        <h1>Creatives for  <br> Revolutionary Arts <br> and Branding</h1>
        <p>Wield the Web with the Right Digital Marketing Strategy</p>
        <br><br>
        <button type="button" id="button" onclick="parent.location='special_features.php'">Find Jobs Now</button>
      </div>
      <br><br><br><br><br><br><br><br><br><br><br>
      <div class="about" id="about" style="background-image: url('img/galax.jpg');"><br><br><br><br><br><br><br><br><br><br><br>
        <div class="img2">
          <img src="img/Man with laptop.gif" alt="Man with Laptop" >
        </div>
        <div class="description">
          <h3>Who Are We?</h3>
          <h1>About Us</h1>
          <h5>Lorem ipsum dolor sit amet consectetur</h5>
          <br>
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Soluta vel eligendi pariatur esse voluptatum, corporis dolorem aliquam commodi recusandae vitae fuga quaerat necessitatibus corrupti exercitationem, quae quasi laboriosam! Iure, necessitatibus? Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, fugiat sed perferendis aliquid dolore animi fugit dolores nihil vel, maxime totam reprehenderit incidunt sint! Adipisci natus beatae sint quasi ipsam. <br><br> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit neque deserunt similique consequatur explicabo modi totam impedit ea pariatur. Doloribus repudiandae laborum illo beatae aliquid eveniet recusandae fuga natus vitae? Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi praesentium iure quam harum ad itaque iste odit, reiciendis voluptatum eveniet, rerum explicabo consectetur temporibus possimus libero aliquid in quas sequi?Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia dolore quaerat excepturi qui sequi optio, eum sunt placeat enim voluptate nobis asperiores nostrum deleniti quibusdam accusamus neque aliquam esse rerum? </p>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique minima error iure excepturi commodi! Dolorem voluptates nostrum corrupti voluptas impedit debitis reprehenderit magnam distinctio accusamus. Deserunt dolor officia voluptatem iste? Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni exercitationem, impedit quaerat repellat sint vel voluptates mollitia alias perspiciatis id tenetur? Minima amet tempora sed, consequatur obcaecati corrupti deleniti <cumque class="lorem"></cumque></p>
          <br>
          <button type="button" id="button">View More</button>
      </div>
      

      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <div class="contact" id="contact">
        <div class="contact_info">
          <h3>Contact Us</h3>
          <h1>Get In Touch</h1><br><br>
            <div class="icons" id="icons2">
              <i class="fa-sharp fa-solid fa-location-dot"></i><p>1071 Brgy. Kaligayahan <br>Quirino Highway, Novaliches, Quezon City <br>Metro Manila, Philippines</p>
              <i class="fa-solid fa-phone"></i><p>1234-5678 <br>1122-3344</p>
              <i class="fa-solid fa-envelope"></i><p>DummyEmail@gmail.com</p><br>
              <a href="#" class="fa fa-facebook-square"></a>
              <a href="#" class="fa fa-instagram"></a>
              <a href="#" class="fa fa-twitter"></a>
              <a href="mailto:DummyEmail@gmail.com" class="fa fa-google"></a>
            </div>
        </div>
        <div class="img3">
          <img src="img/Shakehands.png" alt="Shakehands" width="350rem">
        </div>
      </div>

      <div class="footer" id="footer">
          <img src="img/logo.png" alt="BORA Logo" class="img-responsive" id="logo">
      </div>

   
      <script src="js/bootstrap.js"></script>
</body>

</html>