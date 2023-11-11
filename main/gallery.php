<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Grande Sports Center</title>

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap"
    rel="stylesheet" />
    
  <!-- Add Tailwind CSS CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />
  
  
  <!--lightbox slider -->
  <link rel="stylesheet" href="../dist/css/lightbox.min.css">
  <style>
    .custom_nav-container {
    position: relative;
    z-index: 9999;
  }
  .navbar-brand {
    display: flex;
    align-items: center;
  }

  .navbar-brand img {
    margin-right: 10px;
  }

  .custom_nav-container {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  </style>

</head>
<body class="sub_page about_page">
  <div class="hero_area">
    <!-- header section strats -->
    <?php
session_start();
require_once '../val/db_connect.php';

if(isset($_SESSION['user_id'])) {
    // Fetch user details from the database
    $sql = "SELECT first_name FROM users WHERE id = ".$_SESSION['user_id'];
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    // Display dropdown menu with user name and links
    echo '
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="../index.php">
            <img src="../images/logo.png" alt="" />
            <span>
              Grande Sports Center
            </span>
          </a>
        </nav>
      </div>

    </header>
    <!-- end header section -->
    <!-- starting section --> 
    <section class=" starting_section position-relative">
      <div class="container">
        <div class="custom_nav2">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="d-flex  flex-column flex-lg-row align-items-center">
                <ul class="navbar-nav  ">
                  <li class="nav-item ">
                    <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../main/aboutus.php">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../main/facilities.php">Facilities </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../main/gallery.php">Gallery</a>
                  </li>
              <li class="nav-item">
              <a class="nav-link" href="../user/dashboard.php" role="button"> Dashboard </a>
              </li>';
            } else {
              // User is not logged in
              echo '
              <header class="header_section">
              <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                  <a class="navbar-brand" href="../index.php">
                    <img src="../images/logo.png" alt="" />
                    <span>
                      Grande Sports Center
                    </span>
                  </a>
                </nav>
              </div>
            </header>
            <!-- end header section -->
            <!-- starting section -->            
            <section class=" starting_section position-relative">
              <div class="container">
                <div class="custom_nav2">
                  <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>       
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <div class="d-flex  flex-column flex-lg-row align-items-center">
                        <ul class="navbar-nav  ">
                          <li class="nav-item ">
                            <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../main/aboutus.php">About Us</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../main/facilities.php">Facilities </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../main/gallery.php">Gallery</a>
                          </li>
              <li class="nav-item">
                <a class="nav-link" href="../user/user_login.php">Login</a>
              </li>';
            }
            ?>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>
  
  <!-- gallery section -->
  <section class="contact_section layout_padding">
  <div class="container">
      <div class="heading_container">
        <h2>
            Gallery
        </h2>
      </div>
    <div class="-m-1 flex flex-wrap md:-m-2">
      <div class="flex w-1/3 flex-wrap">
        <div class="w-full p-1 md:p-2">
        <a href="../img/gallery/Pic1.jpg" data-lightbox="gallery">
          <img
            alt="gallery"
            class="block h-full w-full rounded-lg object-cover object-center"
            src="../img/gallery/Pic1.jpg" />
        </a>
      </div>
      </div>
      <div class="flex w-1/3 flex-wrap">
        <div class="w-full p-1 md:p-2">
        <a href="../img/gallery/One.jpg" data-lightbox="gallery">
          <img
            alt="gallery"
            class="block h-full w-full rounded-lg object-cover object-center"
            src="../img/gallery/One.jpg" />
        </a>
      </div>
      </div>
      <div class="flex w-1/3 flex-wrap">
        <div class="w-full p-1 md:p-2">
        <a href="../img/gallery/Two.jpg" data-lightbox="gallery">
          <img
            alt="gallery"
            class="block h-full w-full rounded-lg object-cover object-center"
            src="../img/gallery/Two.jpg" />
        </a>
      </div>
      </div>
      <div class="flex w-1/3 flex-wrap">
        <div class="w-full p-1 md:p-2">
        <a href="../img/gallery/Three.jpg" data-lightbox="gallery">
          <img
            alt="gallery"
            class="block h-full w-full rounded-lg object-cover object-center"
            src="../img/gallery/Three.jpg" />
        </a>
      </div>
      </div>
      <div class="flex w-1/3 flex-wrap">
        <div class="w-full p-1 md:p-2">
        <a href="../img/gallery/Four.jpg" data-lightbox="gallery">
          <img
            alt="gallery"
            class="block h-full w-full rounded-lg object-cover object-center"
            src="../img/gallery/Four.jpg" />
        </a>  
      </div>
      </div>
      <div class="flex w-1/3 flex-wrap">
        <div class="w-full p-1 md:p-2">
        <a href="../img/gallery/BBall.jpg" data-lightbox="gallery">
          <img
            alt="gallery"
            class="block h-full w-full rounded-lg object-cover object-center"
            src="../img/gallery/BBall.jpg" />
        </a>
      </div>
      </div>
  </div>
</div>
  </section>
  <!-- end gallery section -->

   <!-- info section -->

<section class="info_section layout_padding2-top">

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <h6>
        About Grande Sports Center
      </h6>
      <p>
        Our facilities include two outdoor, all-weather 
        artificial turf futsal courts available for hire in Kathmandu! 
        The best place to spend your time getting fit and healthy!
      </p>
    </div>
    <div class="col-md-2 offset-md-1">
      <h6>
        Menus
      </h6>
      <ul>
        <li class=" active">
          <a class="" href="../index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="">
          <a class="" href="../main/aboutus.php">About </a>
        </li>
        <li class="">
          <a class="" href="../main/facilities.php">Facilities </a>
        </li>
        <li class="">
          <a class="" href="../main/gallery.php">Gallery</a>
        </li>
        <li class="">
          <a class="" href="#">Login</a>
        </li>
      </ul>
    </div>

    <div class="col-md-3">
      <h6>
        Contact Us
      </h6>
      <div class="info_link-box">
        <a href="">
          <img src="../images/location-white.png" alt="">
          <span> Dhapasi, Tokha</span>
        </a>
        <a href="">
          <img src="../images/call-white.png" alt="">
          <span>+01 51592901</span>
        </a>
        <a href="">
          <img src="../images/mail-white.png" alt="">
          <span> grandesportscenter@gmail.com</span>
        </a>
      </div>
      <div class="info_social">
        <div>
          <a href="">
            <img src="../images/facebook-logo-button.png" alt="">
          </a>
        </div>
        <div>
          <a href="">
            <img src="../images/twitter-logo-button.png" alt="">
          </a>
        </div>
        <div>
          <a href="">
            <img src="../images/linkedin.png" alt="">
          </a>
        </div>
        <div>
          <a href="">
            <img src="../images/instagram.png" alt="">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- end info section -->


<!-- footer section -->
<section class="container-fluid footer_section ">
<p>
  &copy; 2019 All Rights Reserved. Grande Sports Center</a>
</p>
</section>
<!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

  <script>
    function openNav() {
      document.getElementById("myNav").classList.toggle("menu_width");
      document
        .querySelector(".custom_menu-btn")
        .classList.toggle("menu_btn-style");
    }
  </script>
  <script src="../dist/js/lightbox-plus-jquery.min.js"></script>
</body>

</html>