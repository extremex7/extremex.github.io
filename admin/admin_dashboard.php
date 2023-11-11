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

  <!-- Include Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    /* CSS for colored info boxes */
.info_box {
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    text-align: center;
    color: white;
    font-weight: bold;
}

.gray {
    background-color: #cccccc; /* gray color for Users Registered */
}

.blue {
    background-color: #3498db; /* Blue color for Pending */
}

.green {
    background-color: #2ecc71; /* Green color for Confirmed */
}

.red {
    background-color: #e74c3c; /* Red color for Canceled */
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

if(isset($_SESSION['admin_id'])) {
    // Fetch user details from the database
    $sql = "SELECT `name` FROM `admin` WHERE id = ".$_SESSION['admin_id'];
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
                    <a class="nav-link" href="admin_dashboard.php">Dashboard<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="view_bookings.php">View Bookings</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="manage_users.php">Manage Users</a>
              <li class="nav-item">
                    <a class="nav-link" href="../user/logout.php">Logout</a>
                  </li>';
            } else {
                header('Location: admin_login.php');
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

 <!-- about section -->
<section class="about_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>Dashboard Statistics</h2>
        </div>

        <!-- Display statistics boxes -->
        <div class="row">
            <!-- Box: Number of users registered -->
            <div class="col-md-3">
                <div class="info_box gray">
                    <h6>Users Registered</h6>
                    <?php
                        // Fetch and display the number of users registered
                        $userCountSql = "SELECT COUNT(*) AS user_count FROM users";
                        $userCountResult = $conn->query($userCountSql);
                        $userCount = $userCountResult->fetch_assoc()['user_count'];
                        echo '<p>'.$userCount.'</p>';
                    ?>
                </div>
            </div>

            <!-- Box: Number of bookings pending -->
            <div class="col-md-3">
                <div class="info_box blue">
                    <h6>Bookings Pending</h6>
                    <?php
                        // Fetch and display the number of bookings with status 'Pending'
                        $pendingBookingsSql = "SELECT COUNT(*) AS pending_count FROM booking WHERE status = 'Pending'";
                        $pendingBookingsResult = $conn->query($pendingBookingsSql);
                        $pendingCount = $pendingBookingsResult->fetch_assoc()['pending_count'];
                        echo '<p>'.$pendingCount.'</p>';
                    ?>
                </div>
            </div>

            <!-- Box: Number of bookings confirmed -->
            <div class="col-md-3">
                <div class="info_box green">
                    <h6>Bookings Confirmed</h6>
                    <?php
                        // Fetch and display the number of bookings with status 'Confirmed'
                        $confirmedBookingsSql = "SELECT COUNT(*) AS confirmed_count FROM booking WHERE status = 'Confirmed'";
                        $confirmedBookingsResult = $conn->query($confirmedBookingsSql);
                        $confirmedCount = $confirmedBookingsResult->fetch_assoc()['confirmed_count'];
                        echo '<p>'.$confirmedCount.'</p>';
                    ?>
                </div>
            </div>

            <!-- Box: Number of bookings canceled -->
            <div class="col-md-3">
                <div class="info_box red">
                    <h6>Bookings Canceled</h6>
                    <?php
                        // Fetch and display the number of bookings with status 'Cancelled'
                        $cancelledBookingsSql = "SELECT COUNT(*) AS cancelled_count FROM booking WHERE status = 'Cancelled'";
                        $cancelledBookingsResult = $conn->query($cancelledBookingsSql);
                        $cancelledCount = $cancelledBookingsResult->fetch_assoc()['cancelled_count'];
                        echo '<p>'.$cancelledCount.'</p>';
                    ?>
                </div>
            </div>
        </div>

        <!-- Bar graph for monthly statistics -->
        <div class="row">
            <div class="col-md-12">
                <div id="monthlyStatisticsGraph">
                <canvas id="monthlyStatisticsChartCanvas" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

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
          <a class="" href="../user/login.php">Login</a>
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
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script>
    const monthlyStatisticsData = {
        labels: [],
        datasets: [
            {
                label: 'Bookings Confirmed',
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Change the background color here
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: []
            },
            {
                label: 'Bookings Canceled',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: []
            },
            {
                label: 'Bookings Pending',
                backgroundColor: 'rgba(75, 192, 192, 0.5)', // Change the background color here
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                data: []
            }
        ]
    };

    const ctx = document.getElementById('monthlyStatisticsChartCanvas').getContext('2d');

    const monthlyStatisticsChart = new Chart(ctx, {
        type: 'bar',
        data: monthlyStatisticsData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function fetchMonthlyStatistics() {
        fetch('fetch_booking_data.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const chartData = {
                    labels: data.labels,
                    datasets: [
                        {
                            label: 'Bookings Confirmed',
                            backgroundColor: 'rgba(54, 162, 235, 0.5)', // Change the background color here
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            data: data.datasets[0].data
                        },
                        {
                            label: 'Bookings Canceled',
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            data: data.datasets[1].data
                        },
                        {
                            label: 'Bookings Pending',
                            backgroundColor: 'rgba(75, 192, 192, 0.5)', // Change the background color here
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            data: data.datasets[2].data
                        }
                    ]
                };

                monthlyStatisticsChart.data = chartData;
                monthlyStatisticsChart.update();
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    fetchMonthlyStatistics();

    setInterval(fetchMonthlyStatistics, 5 * 60 * 1000);
</script>

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