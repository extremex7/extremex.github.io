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
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

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
  .nav-tabs {
      margin-bottom: 20px; /* Adjust as needed */
    }

    .nav-tabs .nav-link {
      padding: 10px 20px; /* Adjust as needed */
    }

    .nav-tabs .nav-link.active {
      background-color: #f0f0f0; /* Adjust as needed */
    }

    .tab-content {
      padding: 20px;
    }

    /* Style for user/admin list item */
    .list-item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px; /* Adjust as needed */
    }
</style>
</head>

<body class="sub_page about_page">
  <div class="hero_area">
    <!-- header section strats -->
    <?php
session_start();
require_once '../val/db_connect.php';
?>
<?php 
function removeUser($userId) {
    global $conn;
    
    // Your removal logic here
    // ...
}

// Function to add a new user or admin
function addUser($name, $email, $password, $isAdmin) {
    global $conn;
    
    // Your addition logic here
    // ...
}

// Fetch all users from the database
$userSql = "SELECT * FROM users";
$userResult = $conn->query($userSql);

// Fetch all admins from the database
$adminSql = "SELECT * FROM admin";
$adminResult = $conn->query($adminSql);


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
                    <a class="nav-link" href="../index.php">Home<span class="sr-only">(current)</span></a>
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
    

 <!-- admin users and admins management section -->
 <section class="about_section layout_padding">
 <div class="container">
  <div class="heading_container">
    <h2>Users and Admins Management</h2>
  </div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="admins-tab" data-toggle="tab" href="#admins" role="tab" aria-controls="admins" aria-selected="false">Admins</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="add-tab" data-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="false">Add New User/Admin</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Users Tab -->
    <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
      <ul>
        <?php
        // Display list of users
        while ($userRow = $userResult->fetch_assoc()) {
          // Check if the keys 'id', 'first_name', and 'last_name' exist in $userRow
          if (isset($userRow['ID']) && isset($userRow['First_Name']) && isset($userRow['Last_Name'])) {
            $fullName = $userRow['First_Name'] . ' ' . $userRow['Last_Name'];
            echo '<li>' . $fullName . ' <button onclick="removeUser(' . $userRow['ID'] . ')">Remove</button></li>';
          } else {
            echo '<li>Invalid user data</li>';
          }
        }
        ?>
      </ul>
    </div>

    <!-- Admins Tab -->
    <div class="tab-pane fade" id="admins" role="tabpanel" aria-labelledby="admins-tab">
      <ul>
        <?php
        // Display list of admins
        while ($adminRow = $adminResult->fetch_assoc()) {
          echo '<li>' . $adminRow['name'] . ' <button onclick="removeUser(' . $adminRow['id'] . ')">Remove</button></li>';
        }
        ?>
      </ul>
    </div>

    <!-- Add New User/Admin Tab -->
    <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">
      <form method="post">
        <label>Name:</label>
        <input type="text" name="new_name" required><br>
        <label>Email:</label>
        <input type="email" name="new_email" required><br>
        <label>Password:</label>
        <input type="password" name="new_password" required><br>
        <label>Is Admin:</label>
        <input type="checkbox" name="is_admin"><br>
        <button type="submit" name="add_user">Add</button>
      </form>
    </div>
  </div>
</div>
      </section>
      <?php
      // Handle adding a new user/admin
      if (isset($_POST['add_user'])) {
          $newName = $_POST['new_name'];
          $newEmail = $_POST['new_email'];
          $newPassword = $_POST['new_password'];
          $isAdmin = isset($_POST['is_admin']) ? 1 : 0;
          
          addUser($newName, $newEmail, $newPassword, $isAdmin);
          // Redirect to refresh the page
          header('Location: admin_users.php');
          exit();
      }
      ?>
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

<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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