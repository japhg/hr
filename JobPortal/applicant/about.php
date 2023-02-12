<?php
include '../database/connection.php';
include '../body/function.php';
session_start();


if (isset($_SESSION['email'], $_SESSION['password'])) {
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <!-- Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="alegario cure, alegario, Job Portal, JOB PORTAL, SEARCH JOB PORTAL, ALEGARIO CURE HOSPITAL JOB PORTAL">
    <meta name="description" content="Start your Journey here. Find a Job that is suitable to you. <br> We offer a variety of job opportunities for job seekers of all experience levels.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../img/hrlogo.png" type="image/x-icon">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="assets/fontawesome/css/brands.css">
    <link rel="stylesheet" href="assets/fontawesome/css/solid.css">
    <script src="https://kit.fontawesome.com/f63d53b14e.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Barlow+Condensed:wght@400;600&family=Comfortaa:wght@500&family=Heebo:wght@100;200;300;400;500;600;700;800;900&family=Hind&family=Inter:wght@300;400;600;800&family=Poiret+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:wght@500;600&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Script -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="../css/style/style.css">
    <link rel="stylesheet" href="../css/style/header.css">
    <link rel="stylesheet" href="../css/bootstrap.css">

    <title>About Us | Job Portal</title>

    <style>
        .text p {
            text-align: justify !important;
        }

        @media screen and (min-width: 769px) and (max-width: 1668px) {
            .text p {
                font-size: 14px;
                margin: 1rem 5rem;
            }
        }

        @media screen and (max-width: 768px) {
            .text p {
                font-size: 12px;
                margin: 1rem 5rem;
            }
        }
    </style>
</head>

<body id="about">
    <?php include '../body/loader.php';
    include 'page/header.php';
    ?>


    <div class="about-homepages">
        <div class="about-home">

            <div class="about-text">
                <h1>About US</h1><br>
                <p style="text-indent: 3rem;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Soluta vel eligendi pariatur esse voluptatum, corporis dolorem aliquam commodi recusandae vitae fuga quaerat necessitatibus corrupti exercitationem, quae quasi laboriosam! Iure, necessitatibus? Lorem ipsum dolor sit amet consectetur adipisicing elit. <br> Nostrum, fugiat sed perferendis aliquid dolore animi fugit dolores nihil vel, maxime totam reprehenderit incidunt sint! Adipisci natus beatae sint quasi ipsam. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit neque deserunt similique consequatur explicabo modi totam impedit ea pariatur. Doloribus repudiandae laborum illo beatae aliquid eveniet recusandae fuga natus vitae? Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi praesentium iure quam harum ad itaque iste odit, reiciendis voluptatum eveniet, rerum explicabo consectetur temporibus possimus libero aliquid in quas sequi?Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia dolore quaerat excepturi qui sequi optio, eum sunt placeat enim voluptate nobis asperiores nostrum deleniti quibusdam accusamus neque aliquam esse rerum? </p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique minima error iure excepturi commodi! Dolorem voluptates nostrum corrupti voluptas impedit debitis reprehenderit magnam distinctio accusamus. Deserunt dolor officia voluptatem iste? Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni exercitationem, impedit quaerat repellat sint vel voluptates mollitia alias perspiciatis id tenetur? Minima amet tempora sed, consequatur obcaecati corrupti deleniti <cumque class="lorem"></cumque>
                </p>
                <br><br>
            </div>

            <div class="home-image">
                <div class="row justify-content-end" style="width: 100vh;"></div>
                <img src="../img/About us page-bro.svg" width="40%" class="rounded" alt="..." id="img">
            </div>

        </div>

        <div class="faq-home" id="faq">
            <div class="faq-title">
                <h1>FAQ</h1>
                <h2>How can I create an account on your website?</h2>
                <p>To create an account on our website, simply click on the "Sign Up" button on the home page, enter your email address, create a password, and fill out the necessary information. Once completed, click on the "Create Account" button.</p>

                <h2>How do I change my account information?</h2>
                <p>To change your account information, log in to your account and click on the "Profile" button. From there, you can edit your personal information and make any necessary changes.</p>

                <h2>How do I search for job postings on your website?</h2>
                <p>To search for job postings on our website, simply use the search bar on the home page to enter keywords related to the job you're looking for, or browse through the different categories and locations to find the right job for you.</p>
            
                <h2>What should I do if I forgot my password?</h2>
                <p>If you have forgotten your password, simply click on the "Forgot Password" link on the login page, enter your email address, and follow the instructions provided to reset your password.</p>
              
                <h2>What type of file format should I use for submitting my resume?</h2><br>
                <p>For the best and most compatible experience, we recommend that you submit your resume in PDF format. This will ensure that the formatting and layout of your resume is preserved and easily viewable for our hiring team. Please make sure to convert your resume to PDF before submitting it to our job portal.</p>

                <h2>What should I do if I don't have a PDF version of my resume?</h2>
                <p>You can easily convert your resume to a PDF format using online conversion tools or using a PDF printer. Simply upload your resume to the online converter or print it using the PDF printer option and save the output as a PDF file.</p>

            </div>

        </div>
<br><br><br><br><br>
        <div class="tc-home" id="tc">
            <div class="tc-title">
                <h1>Terms & Conditions</h1>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quod delectus eum, esse optio quae quas inventore voluptates consequatur animi dolorum explicabo tempora vitae recusandae natus iure? Rem nobis suscipit dicta.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero laudantium mollitia accusantium, reiciendis illo eos esse ipsum ducimus minima? Dolor cupiditate eos praesentium deleniti libero non qui, voluptatibus quia et?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem fuga deserunt reprehenderit vero sit, dicta pariatur alias atque nam. Laboriosam nostrum libero nam hic suscipit omnis nulla ut velit explicabo.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, saepe? Cupiditate doloribus ipsa velit eius delectus, nisi laudantium culpa animi perferendis nostrum, sint atque quaerat fuga veritatis. Consequatur, sed delectus.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat quia odit praesentium illum, inventore nobis ex totam porro optio suscipit minus minima, incidunt consequatur officiis hic nesciunt expedita aliquid! Ipsam?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci enim fugit placeat maxime quam voluptatem aliquid suscipit recusandae dicta natus repudiandae ex mollitia nisi eius amet, sed nesciunt id tenetur.
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto alias delectus, sit maiores vitae aliquid illo. Hic optio provident accusantium itaque consequuntur veniam eaque ratione odio enim nemo. Molestiae, sapiente?
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa, iusto iste? Non voluptatem inventore ipsam, earum cupiditate modi quos, sunt sit possimus accusantium voluptatum in, debitis eligendi beatae minus harum.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea expedita quisquam facere dicta, laboriosam aliquam earum placeat saepe iusto reiciendis accusamus, quasi commodi ipsam odio a, provident ipsa dolorem neque?

                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusamus similique neque magni, ad fuga iusto, aspernatur exercitationem laboriosam dolorem nostrum illum nam consequuntur animi aut modi tempore quia magnam sapiente!
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi, provident, ullam assumenda nobis quod, nesciunt veritatis possimus sequi fugiat molestias alias omnis. Blanditiis dicta, numquam quasi dolore totam recusandae cupiditate!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident nulla omnis delectus vitae ipsa quis quasi quod, labore possimus, asperiores architecto accusantium non nemo ab. Accusantium doloremque eligendi repellendus! Laboriosam.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Error, aspernatur, sed architecto delectus, quod fuga libero ea sit cupiditate magnam perspiciatis. Soluta perferendis saepe eius impedit! Explicabo cumque dolores molestias.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non natus fugiat fugit quam beatae doloremque harum assumenda ad in eaque? A beatae accusamus iure quidem recusandae commodi nostrum? Sint, eligendi!
                </p>
                <br>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quod delectus eum, esse optio quae quas inventore voluptates consequatur animi dolorum explicabo tempora vitae recusandae natus iure? Rem nobis suscipit dicta.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero laudantium mollitia accusantium, reiciendis illo eos esse ipsum ducimus minima? Dolor cupiditate eos praesentium deleniti libero non qui, voluptatibus quia et?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem fuga deserunt reprehenderit vero sit, dicta pariatur alias atque nam. Laboriosam nostrum libero nam hic suscipit omnis nulla ut velit explicabo.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, saepe? Cupiditate doloribus ipsa velit eius delectus, nisi laudantium culpa animi perferendis nostrum, sint atque quaerat fuga veritatis. Consequatur, sed delectus.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat quia odit praesentium illum, inventore nobis ex totam porro optio suscipit minus minima, incidunt consequatur officiis hic nesciunt expedita aliquid! Ipsam?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci enim fugit placeat maxime quam voluptatem aliquid suscipit recusandae dicta natus repudiandae ex mollitia nisi eius amet, sed nesciunt id tenetur.
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto alias delectus, sit maiores vitae aliquid illo. Hic optio provident accusantium itaque consequuntur veniam eaque ratione odio enim nemo. Molestiae, sapiente?
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa, iusto iste? Non voluptatem inventore ipsam, earum cupiditate modi quos, sunt sit possimus accusantium voluptatum in, debitis eligendi beatae minus harum.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea expedita quisquam facere dicta, laboriosam aliquam earum placeat saepe iusto reiciendis accusamus, quasi commodi ipsam odio a, provident ipsa dolorem neque?

                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusamus similique neque magni, ad fuga iusto, aspernatur exercitationem laboriosam dolorem nostrum illum nam consequuntur animi aut modi tempore quia magnam sapiente!
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi, provident, ullam assumenda nobis quod, nesciunt veritatis possimus sequi fugiat molestias alias omnis. Blanditiis dicta, numquam quasi dolore totam recusandae cupiditate!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident nulla omnis delectus vitae ipsa quis quasi quod, labore possimus, asperiores architecto accusantium non nemo ab. Accusantium doloremque eligendi repellendus! Laboriosam.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Error, aspernatur, sed architecto delectus, quod fuga libero ea sit cupiditate magnam perspiciatis. Soluta perferendis saepe eius impedit! Explicabo cumque dolores molestias.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non natus fugiat fugit quam beatae doloremque harum assumenda ad in eaque? A beatae accusamus iure quidem recusandae commodi nostrum? Sint, eligendi!
                </p>
                <br>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quod delectus eum, esse optio quae quas inventore voluptates consequatur animi dolorum explicabo tempora vitae recusandae natus iure? Rem nobis suscipit dicta.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero laudantium mollitia accusantium, reiciendis illo eos esse ipsum ducimus minima? Dolor cupiditate eos praesentium deleniti libero non qui, voluptatibus quia et?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem fuga deserunt reprehenderit vero sit, dicta pariatur alias atque nam. Laboriosam nostrum libero nam hic suscipit omnis nulla ut velit explicabo.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, saepe? Cupiditate doloribus ipsa velit eius delectus, nisi laudantium culpa animi perferendis nostrum, sint atque quaerat fuga veritatis. Consequatur, sed delectus.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat quia odit praesentium illum, inventore nobis ex totam porro optio suscipit minus minima, incidunt consequatur officiis hic nesciunt expedita aliquid! Ipsam?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci enim fugit placeat maxime quam voluptatem aliquid suscipit recusandae dicta natus repudiandae ex mollitia nisi eius amet, sed nesciunt id tenetur.
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto alias delectus, sit maiores vitae aliquid illo. Hic optio provident accusantium itaque consequuntur veniam eaque ratione odio enim nemo. Molestiae, sapiente?
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa, iusto iste? Non voluptatem inventore ipsam, earum cupiditate modi quos, sunt sit possimus accusantium voluptatum in, debitis eligendi beatae minus harum.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea expedita quisquam facere dicta, laboriosam aliquam earum placeat saepe iusto reiciendis accusamus, quasi commodi ipsam odio a, provident ipsa dolorem neque?

                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusamus similique neque magni, ad fuga iusto, aspernatur exercitationem laboriosam dolorem nostrum illum nam consequuntur animi aut modi tempore quia magnam sapiente!
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi, provident, ullam assumenda nobis quod, nesciunt veritatis possimus sequi fugiat molestias alias omnis. Blanditiis dicta, numquam quasi dolore totam recusandae cupiditate!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident nulla omnis delectus vitae ipsa quis quasi quod, labore possimus, asperiores architecto accusantium non nemo ab. Accusantium doloremque eligendi repellendus! Laboriosam.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Error, aspernatur, sed architecto delectus, quod fuga libero ea sit cupiditate magnam perspiciatis. Soluta perferendis saepe eius impedit! Explicabo cumque dolores molestias.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non natus fugiat fugit quam beatae doloremque harum assumenda ad in eaque? A beatae accusamus iure quidem recusandae commodi nostrum? Sint, eligendi!
                </p>
            </div>

        </div>
        <br><br><br><br>
        <?php include '../body/footer.php'; ?>     
    </div>
    


    <script src="../js/bootstrap.js"></script>
    <script>
        $(window).scroll(function() {
            $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
        });
    </script>
</body>

</html>
<?php
} else {
  header("location:../applicant/login_applicant.php");
  session_destroy();
}
unset($_SESSION['prompt']);
mysqli_close($con);
?>