<!DOCTYPE html>
<html>
<head>
  <title>Loading...</title>
  <meta name="description" content="A gallery of pure CSS spinners and loading indicators" />
  <meta name="keywords" content="css spinner loading indicator 3d" />
  <link rel="stylesheet" type="text/css" href="css/style/loader.css">
  <link rel="stylesheet" href="css/bootstrap.css">


  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="jquery-2.1.3.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>

</head>
<body>
<div class="loader-position" id="loader">
  <div class="loader">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </div>
</div>
  <script>
    $(window).on('load',function(){
      $(".loader-position").fadeOut(3000);
    });
  </script>
  <!-- <script>
        window.onload = function() {
        // document.getElementById("loader").style.display = "none";
        $(".loader").fadeOut(1000);
      }
      </script> -->
      <!-- <script>setTimeout(function(){
        $('.loader').fadeToggle();
      }, 1500);</script> -->
</body>
</html>