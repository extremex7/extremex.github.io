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

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap"
    rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />
  <style>
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
                  <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="myBooking.php">My Bookings</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="user_profile.php">Profile</a>
              <li class="nav-item">
                    <a class="nav-link" href="../user/logout.php">Logout</a>
                  </li>';
            } else {
                header('Location: ../user/user_login.php');
                exit();
            }
            ?>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </section>

<!-- booking section -->

<section class="about_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <h2>Booking</h2>
    </div>
    <div class="box">
    <form id="bookingForm" action="process_booking.php" method="post" onsubmit="return validateForm();">
        <label for="facility">Select Facility:</label>
        <select name="facility" id="facility" onchange="updatePrice()">
          <!-- Options for facility selection -->
          <option value="FC001">Futsal A</option>
          <option value="FC002">Futsal B</option>
          <option value="FC003">Basketball</option>
        </select>
        <br>

        <!-- Display the price here -->
        <label for="price">Price:</label>
        <span id="priceDisplay"></span>
        <br>

        <label for="date">Preferred Date:</label>
        <input type="date" name="date_from" id="date_from">
        <br>
        <label for="time">Preferred Time From:</label>
        <input type="time" name="time_from" id="time_from">
        <br>
        <label for="time">Preferred Time To:</label>
        <input type="time" name="time_to" id="time_to">
        <br>
        <div id="availabilityDisplay"></div> <!-- Display availability here -->
        <br>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
</section>
  <!-- end booking section -->
  <script>
    function validateForm() {
        // Get the selected date and time
        var date_from = document.getElementById("date_from").value;
        var time_from = document.getElementById("time_from").value;

        // Convert the selected date and time to a Date object
        var selectedDateTime = new Date(date_from + " " + time_from);

        // Get the current internet time
        var currentDateTime = new Date();

        // Check if the selected date and time have already passed
        if (selectedDateTime < currentDateTime) {
            alert("Invalid date or time selection. Please choose a future date and time.");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
    function updatePrice() {
  // Get the selected facility
  var facility = document.getElementById("facility").value;

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Configure it: GET-request for the getPrice.php script
  xhr.open('GET', 'getPrice.php?facility=' + facility, true);

  // Set up a callback function to handle the response
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // Update the price display with the received data
      document.getElementById("priceDisplay").innerText = xhr.responseText;
    }
  };

  // Send the request
  xhr.send();
}
function checkAvailability() {
    // Get the selected facility, time_from, and time_to
    var facility = document.getElementById("facility").value;
    var timeFrom = document.getElementById("time_from").value;
    var timeTo = document.getElementById("time_to").value;

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure it: POST request for the checkAvailability.php script
    xhr.open('POST', 'checkAvailability.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Set up a callback function to handle the response
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Update the availability display with the received data
            document.getElementById("availabilityDisplay").innerText = xhr.responseText;
        }
    };

    // Send the request with the form data
    xhr.send('facility=' + encodeURIComponent(facility) + '&time_from=' + encodeURIComponent(timeFrom) + '&time_to=' + encodeURIComponent(timeTo));
}
window.onload = function() {
    updatePrice();
    checkAvailability();
    document.getElementById("bookingForm").addEventListener("input", function () {
    checkAvailability();
});

  };
</script>

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
          <a class="" href="../user/user_login.php">Login</a>
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

<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>

<script>
function openNav() {
  document.getElementById("myNav").classList.toggle("menu_width");
  document
    .querySelector(".custom_menu-btn")
    .classList.toggle("menu_btn-style");
}
</script>
</body>

</html>

