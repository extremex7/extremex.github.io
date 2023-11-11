<?php
session_start();
require_once '../val/db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit();
}
// Fetch user details from the database
$sql = "SELECT * FROM users WHERE id = " . $_SESSION['user_id'];
$result = $conn->query($sql);
$userData = $result->fetch_assoc();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate and update user data
    $errors = [];

    // Check if the old password matches the database password
    if (!password_verify($old_password, $userData['Password'])) {
        $errors[] = "Invalid old password.";
    }

    // Check if the new password and confirm password match
    if (!empty($new_password) && $new_password !== $confirm_password) {
        $errors[] = "New password and confirm password do not match.";
    }

    // If there are no errors, update the user data
    if (empty($errors)) {
        // Update user data in the database
        $updateSql = "UPDATE users SET First_Name = '$first_name', Last_Name = '$last_name', Email = '$email', Phone = '$phone', Gender = '$gender'";

        // Update the password if a new password is provided
        if (!empty($new_password)) {
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            $updateSql .= ", Password = '$hashedPassword'";
        }

        $updateSql .= " WHERE id = " . $_SESSION['user_id'];

        if ($conn->query($updateSql) === TRUE) {
            echo "Profile updated successfully.";
            // Redirect to the profile page or any other desired page
            header('Location: user_profile.php');
            exit();
        } else {
            echo "Error updating profile: " . $conn->error;
        }
    }
}

// Display the user profile form
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
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </section>

  <!-- form section -->

  <section class="about_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Manage Account
        </h2>
      </div>
      <div class="box">
      <form method="POST" action="user_profile.php">
  <div class="form-group">
    <label for="first_name">First Name:</label>
    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $userData['First_Name']; ?>" required>
  </div>

  <div class="form-group">
    <label for="last_name">Last Name:</label>
    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $userData['Last_Name']; ?>" required>
  </div>

  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $userData['Email']; ?>" required>
  </div>

  <div class="form-group">
    <label for="phone">Phone:</label>
    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $userData['Phone']; ?>" required>
  </div>

  <div class="form-group">
    <label for="gender">Gender:</label>
    <select class="form-control" id="gender" name="gender" required>
      <option value="Male" <?php if ($userData['Gender'] === 'Male') echo 'selected'; ?>>Male</option>
      <option value="Female" <?php if ($userData['Gender'] === 'Female') echo 'selected'; ?>>Female</option>
      <option value="Other" <?php if ($userData['Gender'] === 'Other') echo 'selected'; ?>>Other</option>
    </select>
  </div>

  <div class="form-group">
    <label for="old_password">Old Password:</label>
    <input type="password" class="form-control" id="old_password" name="old_password" autocomplete="off" required>
  </div>

  <div class="form-group">
    <label for="new_password">New Password:</label>
    <input type="password" class="form-control" id="new_password" name="new_password">
  </div>

  <div class="form-group">
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
  </div>

  <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
</form>
</div>
</div>
</section>
  <!-- end form section -->

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
</body>

</html>