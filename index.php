<?php
session_start();
require_once 'val/db_connect.php';
?>
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

  <title>Grande Sports</title>

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap"
    rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--Form Validation-->
    <script>
        function validateForm() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const subject = document.getElementById("subject").value;
    const message = document.getElementById("message").value;
  
    if (name === "") {
      alert("Name field cannot be left empty");
      return false;
    }
  
    if (!validateEmail(email)) {
      alert("Email field must contain a valid email address");
      return false;
    }
  
    if (!validatePhone(phone)) {
      alert("Phone field must contain 10 digits and start with 98");
      return false;
    }
  
    if (subject === "") {
      alert("Subject field cannot be left empty");
      return false;
    }
  
    if (message === "") {
      alert("Message field cannot be left empty");
      return false;
    }
  
    return true;
  }
  
  function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
  
  function validatePhone(phone) {
    const phoneRegex = /^98\d{8}$/;
    return phoneRegex.test(phone);
  }
  
  function toggleDropdown() {
      var dropdownMenu = document.getElementById("dropdown-menu");
        if (dropdownMenu.classList.contains("hidden")) {
            dropdownMenu.classList.remove("hidden");
            dropdownMenu.setAttribute("aria-expanded", "true");
        } else {
            dropdownMenu.classList.add("hidden");
            dropdownMenu.setAttribute("aria-expanded", "false");
        }
    }
</script>
</head>

<body>
  
<div class="hero_area">
    <!-- header section starts -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand" href="index.php">
                        <img src="images/logo.png" alt="" />
                        <span>
                            Grande Sports Center
                        </span>
                    </a>
                </nav>
            </div>
        </header>
        <!-- end header section -->
        <!-- starting section --> 
        <?php
    if(isset($_SESSION['user_id'])) {
        // Fetch user details from the database
        $sql = "SELECT first_name FROM users WHERE id = ".$_SESSION['user_id'];
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();

        // Display dropdown menu with user name and links
        echo '
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
                                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="main/aboutus.php">About Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="main/facilities.php">Facilities </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="main/gallery.php">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="user/dashboard.php" role="button"> Dashboard </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="slider_container">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-7 offset-md-6 offset-md-5">
                                    <div class="detail-box">
                                        <h2>
                                            Get Your Boots
                                        </h2>
                                        <h1>
                                            READY!
                                        </h1>
                                        <p>
                                            Play With Purpose We all have the desire to get fit, feel great and have fun. 
                                            Since we started, we’ve been striving to serve the futsal community 
                                            with high class facilities.
                                            Join our community today!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end starting section -->
    ';
    } else {
        // User is not logged in
        echo '
        <section class="starting_section position-relative">
            <div class="container">
                <div class="custom_nav2">
                    <nav class="navbar navbar-expand-lg custom_nav-container">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="d-flex flex-column flex-lg-row align-items-center">
                                <ul class="navbar-nav">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="main/aboutus.php">About Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="main/facilities.php">Facilities </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="main/gallery.php">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="user/user_login.php">Login</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="slider_container">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-7 offset-md-6 offset-md-5">
                                    <div class="detail-box">
                                        <h2>
                                            Get Your Boots
                                        </h2>
                                        <h1>
                                            READY!
                                        </h1>
                                        <p>
                                            Play With Purpose We all have the desire to get fit, feel great and have fun. 
                                            Since we started, we’ve been striving to serve the futsal community 
                                            with high class facilities.
                                            Join our community today!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end starting section -->
    ';
    }
    ?>
</div>



  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          About Grande Sports Center
        </h2>
      </div>
      <div class="box">
        <div class="img-box">
          <img src="images/about-img.png" alt="">
        </div>
        <div class="detail-box">
          <p>
            Our facilities include two outdoor, all-weather 
            artificial turf futsal courts available for hire in Kathmandu! 
            Our courts are perfect for teams, schools or even individuals up for social games.
            ​We also facilitate many competitions, coaching programs and community events 
            all year round! Enquire now for more information.
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->

  <!-- Facilities section -->

  <section class="Facilities_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Our Facilities
        </h2>
      </div>
      <div class="Facilities_container">
        <div class="box">
          <img src="images/s-3.jpg" alt="">
          <h6 class="visible_heading">
            Futsal A
          </h6>
          <div class="link_box">
            <a href="booking.php">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              Book
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="images/s-3.jpg" alt="">
          <h6 class="visible_heading">
            Futsal B
          </h6>
          <div class="link_box">
            <a href="booking.php">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              Book
            </h6>
          </div>
        </div>
        <div class="box">
          <img src="images/s-4.jpg" alt="">
          <h6 class="visible_heading">
            BasketBall Court
          </h6>
          <div class="link_box">
            <a href="booking.php">
              <img src="images/link.png" alt="">
            </a>
            <h6>
              Book
            </h6>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end Facilities section -->


  <!-- Us section -->

  <section class="us_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Why Choose Us
        </h2>
      </div>
      <div class="us_container">
        <div class="box">
          <div class="img-box">
            <img src="images/u-1.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              QUALITY EQUIPMENTS
            </h5>
            <p>
              We regularly change our Balls, carpets, courts and other equipments
              to the best standards.
            </p>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/u-2.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              SAFETY
            </h5>
            <p>
              We provide a fun and safe environment that is perfect for fun, practice or competitive matches. 
            </p>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/u-3.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              PRICE FRIENDLY
            </h5>
            <p>
            Our Facilities are not only good but also takes some load off your pockets. Great Experience at a low price.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end us section -->


  <!-- client section -->

  <section class="client_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          What Our Customers say
        </h2>
      </div>
      <div id="carouselExample2Indicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExample2Indicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExample2Indicators" data-slide-to="1"></li>
          <li data-target="#carouselExample2Indicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="box">
              <div class="img-box">
                <img src="images/client1.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Aayush
                </h5>
                <p>
                  Have been coming here every week for some years now. 
                  Awesome turf and very convenient location. Super easy booking 
                  process, I highly recommend coming here for a kick around with 
                  friends or a game against other teams.
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="box">
              <div class="img-box">
                <img src="images/client2.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Raj
                </h5>
                <p>
                  Well run complex and friendly staff. 
                  Court is well lit at night. Astroturf fields are always open, 
                  plenty of parking and very cheap rates compared to other places.
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="box">
              <div class="img-box">
                <img src="images/client3.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Shreya
                </h5>
                <p>
                  Great basketball courts, plenty of free parking. 
                  Highly recommend bringing your friends down and having a game!
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- end client section -->

  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          <span>
            Get In Touch
          </span>
        </h2>
      </div>
      <div class="layout_padding2-top">
        <div class="row">
          <div class="col-md-6 ">
            <form action="val/form_handler_index.php" method="POST" enctype="multipart/form-data">
              <div class="contact_form-container">
                <div>
                  <div>
                    <input type="text" placeholder="Name" name="name" />
                  </div>
                  <div>
                    <input type="email" placeholder="Email" name="email"/>
                  </div>
                  <div>
                    <input type="tel" placeholder="Phone Number" name="phone"/>
                  </div>
                  <div>
                    <input type="text" placeholder="Address" name="address"/>
                  </div>
                  <div>
                    <input type="text" placeholder="Subject" name="subject">
                  </div>
                  <div>
                    <input type="text" placeholder="Your Message here." name="message">
                  </div>
                  <div class="mt-5">
                    <button type="submit" value="Submit">
                      Send
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <div class="map_container">
              <div class="map-responsive">
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14124.17924591482!2d85.32481785688475!3d27.746763810751382!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1ecb64632329%3A0xea525cc9bdf62d35!2sGrande%20Sports%20Center!5e0!3m2!1sen!2snp!4v1681711740423!5m2!1sen!2snp"
                  width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%"
                  allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->


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
              <a class="" href="index.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="">
              <a class="" href="about.html">About </a>
            </li>
            <li class="">
              <a class="" href="Facilities.html">Facilities </a>
            </li>
            <li class="">
              <a class="" href="#contactSection">Contact Us</a>
            </li>
            <li class="">
              <a class="" href="/user/user_login.php">Login</a>
            </li>
          </ul>
        </div>

        <div class="col-md-3">
          <h6>
            Contact Us
          </h6>
          <div class="info_link-box">
            <a href="">
              <img src="images/location-white.png" alt="">
              <span> Dhapasi, Tokha</span>
            </a>
            <a href="">
              <img src="images/call-white.png" alt="">
              <span>+01 51592901</span>
            </a>
            <a href="">
              <img src="images/mail-white.png" alt="">
              <span> grandesportscenter@gmail.com</span>
            </a>
          </div>
          <div class="info_social">
            <div>
              <a href="">
                <img src="images/facebook-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/twitter-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/linkedin.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/instagram.png" alt="">
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

  const form = document.querySelector('form');

  form.addEventListener('submit', (event) => {
    // prevent form submission
    event.preventDefault();

    // get form field values
    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const phone = form.phone.value.trim();
    const subject = form.subject.value.trim();
    const message = form.message.value.trim();

    // validate fields
    if (name === '') {
      alert('Name field cannot be left empty');
      return;
    }

    alert('Name field cannot be left empty');
  return;
}

if (/\d/.test(name)) {
  alert('Name field cannot contain numbers');
  return;
}

if (name.length < 3) {
  alert('Name field must have at least 3 letters');
  return;
}

    if (!isValidEmail(email)) {
      alert('Email field must contain a valid email address');
      return;
    }

    if (!isValidPhone(phone)) {
      alert('Phone field must contain 10 digits and start with 98');
      return;
    }

    if (subject === '') {
      alert('Subject field cannot be empty');
      return;
    }

    if (message === '') {
      alert('Message field cannot be empty');
      return;
    }

    // if all fields are valid, submit form
    form.submit();
  });

  function isValidEmail(email) {
    // regular expression for validating email format
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  function isValidPhone(phone) {
    // regular expression for validating phone number format
    const phoneRegex = /^98\d{8}$/;
    return phoneRegex.test(phone);
  }
</script>
  </script>
</body>

</html>