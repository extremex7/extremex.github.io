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
// Function to add a new user or admin
function addUser($first_name, $last_name, $email, $password, $phone_number, $gender, $isAdmin) {
  global $conn;

  // Hash the password for security
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Check if it's an admin
  if ($isAdmin) {
      // If it's admin, insert into the admin table
      $fullName = $first_name . ' ' . $last_name;
      $insertAdminSql = "INSERT INTO admin (name, email, password, phone, gender) VALUES (?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($insertAdminSql);
      $stmt->bind_param("sssss", $fullName, $email, $hashedPassword, $phone_number, $gender);
  } else {
      // If it's not admin, insert into the users table
      $insertUserSql = "INSERT INTO users (First_Name, Last_Name, Email, Password, Phone) VALUES (?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($insertUserSql);
      $stmt->bind_param("sssss", $first_name, $last_name, $email, $hashedPassword, $phone_number);
  }

  // Execute the prepared statement
  if ($stmt->execute()) {
      // Inserted successfully
      return true;
  } else {
      // Error in insertion
      echo "Error: " . $stmt->error;
      return false;
  }

  // Close the statement
  $stmt->close();
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
        <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users-content" role="tab" aria-controls="users" aria-selected="true">Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="admins-tab" data-toggle="tab" href="#admins-content" role="tab" aria-controls="admins" aria-selected="false">Admins</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="add-tab" data-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="false">Add New User/Admin</a>
    </li>
</ul>

<!-- Tab content -->
<div class="tab-content">
    <!-- Users Tab Content -->
    <div class="tab-pane fade show active" id="users-content" role="tabpanel" aria-labelledby="users-tab">
        <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Reset the result set pointer to the beginning
            $userResult->data_seek(0);

            // Display list of users in a table
            $count = 1;
            while ($userRow = $userResult->fetch_assoc()) {
                // Check if the keys 'ID', 'First_Name', 'Last_Name', 'Gender', and 'Phone' exist in $userRow
                if (isset($userRow['ID'], $userRow['First_Name'], $userRow['Last_Name'], $userRow['Gender'], $userRow['Phone'])) {
                    $fullName = $userRow['First_Name'] . ' ' . $userRow['Last_Name'];
                    echo '<tr>';
                    echo '<td>' . $count . '</td>';
                    echo '<td>' . $fullName . '</td>';
                    echo '<td>' . $userRow['Gender'] . '</td>';
                    echo '<td>' . $userRow['Phone'] . '</td>';
                    echo '<td><a href="edit_user.php?id=' . $userRow['ID'] . '">Edit</a></td>';
                    echo '</tr>';
                    $count++;
                } else {
                    echo '<tr><td colspan="5"></td></tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>

    <!-- Admins Tab Content -->
    <div class="tab-pane fade" id="admins-content" role="tabpanel" aria-labelledby="admins-tab">
        <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Reset the result set pointer to the beginning
            $adminResult->data_seek(0);

            // Display list of admins in a table
            $count = 1;
            while ($adminRow = $adminResult->fetch_assoc()) {
                // Check if the keys 'id', 'name', 'gender', and 'phone' exist in $adminRow
                if (isset($adminRow['id'], $adminRow['name'], $adminRow['gender'], $adminRow['phone'])) {
                    echo '<tr>';
                    echo '<td>' . $count . '</td>';
                    echo '<td>' . $adminRow['name'] . '</td>';
                    echo '<td>' . $adminRow['gender'] . '</td>';
                    echo '<td>' . $adminRow['phone'] . '</td>';
                    echo '<td>';
                    echo '<a href="edit_admin.php?id=' . $adminRow['id'] . '">Edit</a>';
                    echo '</td>';
                    echo '</tr>';
                    $count++;
                } else {
                    echo '<tr><td colspan="5"></td></tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>


<!-- Add New User/Admin Tab Content -->
<div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">
    <form method="post" class="mt-4">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="new_first_name">First Name:</label>
                <input type="text" class="form-control" id="new_first_name" name="new_first_name" required>
            </div>

            <div class="form-group col-md-6">
                <label for="new_last_name">Last Name:</label>
                <input type="text" class="form-control" id="new_last_name" name="new_last_name" required>
            </div>
        </div>

        <div class="form-group">
            <label for="new_email">Email:</label>
            <input type="email" class="form-control" id="new_email" name="new_email" required>
        </div>

        <div class="form-group">
            <label for="new_password">Password:</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="new_phone_number">Phone Number:</label>
                <input type="text" class="form-control" id="new_phone_number" name="new_phone_number" required>
            </div>

            <div class="form-group col-md-6">
                <label for="new_gender">Gender:</label>
                <select class="form-control" id="new_gender" name="new_gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin">
            <label class="form-check-label" for="is_admin">Is Admin</label>
        </div>

        <button type="submit" class="btn btn-primary mt-3" name="add_user">Add</button>
    </form>
</div>

      </section>
      <?php
// Handle adding a new user/admin
if (isset($_POST['add_user'])) {
  $newFirstName = $_POST['new_first_name'];
  $newLastName = $_POST['new_last_name'];
  $newEmail = $_POST['new_email'];
  $newPassword = $_POST['new_password'];
  $newPhoneNumber = $_POST['new_phone_number'];
  $newGender = $_POST['new_gender'];

  $isAdmin = isset($_POST['is_admin']) ? 1 : 0;

  // Check if required fields are not empty
  if (empty($newFirstName) || empty($newLastName) || empty($newEmail) || empty($newPassword) || empty($newPhoneNumber) || empty($newGender)) {
      echo '<script>alert("Please fill in all required fields.");</script>';
  } else {
      // Call the function to add user/admin
      if (addUser($newFirstName, $newLastName, $newEmail, $newPassword, $newPhoneNumber, $newGender, $isAdmin)) {
          echo '<script>alert("User/Admin added successfully.");</script>';
      } else {
          echo '<script>alert("Error adding User/Admin. Please try again.");</script>';
      }
  }
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