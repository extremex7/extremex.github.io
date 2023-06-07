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
  table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .cancel-button {
      background-color: #f44336;
      color: white;
      border: none;
      padding: 6px 12px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      cursor: pointer;
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
                  <li class="nav-item active">
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
              </li>
              <li class="nav-item">
                    <a class="nav-link" href="../user/logout.php">Logout</a>
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
                          <li class="nav-item active">
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

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Your Bookings
        </h2>
      </div>
      <div class="box">
      <table>
        <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Booked</th>
                    <th>Ref Code</th>
                    <th>Facility</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
        </thead>
        <tbody id="bookingTableBody">
      <!-- The booking rows will be dynamically added here using JavaScript -->
        </tbody>
        </table>
      </div>
    </div>
  </section>
  <!-- end about section -->

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
<script>
    // Assuming you have bookings data in an array called 'bookings'
    var bookings = [
      {
        id: 1,
        date: '2023-06-01',
        bookedBy: 'John Doe',
        refCode: 'ABC123',
        facility: 'Tennis Court',
        schedule: '10:00 AM - 12:00 PM',
        status: 'Booked'
      },
      // Add more booking objects as per your data
    ];

    var tableBody = document.getElementById('bookingTableBody');

    // Loop through the bookings array and dynamically populate the table rows
    for (var i = 0; i < bookings.length; i++) {
      var booking = bookings[i];

      var row = document.createElement('tr');
      row.innerHTML = `
        <td>${i + 1}</td>
        <td>${booking.date}</td>
        <td>${booking.bookedBy}</td>
        <td>${booking.refCode}</td>
        <td>${booking.facility}</td>
        <td>${booking.schedule}</td>
        <td>${booking.status}</td>
        <td><button class="cancel-button" onclick="cancelBooking(${booking.id})">Cancel</button></td>
      `;

      tableBody.appendChild(row);
    }

    // Function to cancel a booking
    function cancelBooking(bookingId) {
      // Implement the logic to cancel the booking
      // You can make an API call to the server to update the booking status
      // and update the table dynamically to reflect the changes
      console.log('Cancel booking with ID: ' + bookingId);
    }
  </script>
</body>

</html>