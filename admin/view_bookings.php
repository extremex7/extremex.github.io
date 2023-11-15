<?php 
session_start();
require_once '../val/db_connect.php';
// Function to cancel a booking
function cancelBooking($bookingId) {
  // Check if the booking exists
  global $conn; // Add this line to access the $conn variable inside the function

  $bookingCheckSql = "SELECT * FROM booking WHERE id = $bookingId";
  $bookingCheckResult = $conn->query($bookingCheckSql);

  if ($bookingCheckResult->num_rows > 0) {
      // Booking exists, update the status to "Cancelled"
      $cancelBookingSql = "UPDATE booking SET status = 'Cancelled' WHERE id = $bookingId";

      if ($conn->query($cancelBookingSql) === TRUE) {
          echo "Booking with ID $bookingId has been cancelled successfully.";
      } else {
          echo "Error cancelling the booking: " . $conn->error;
      }
  } else {
      echo "Booking with ID $bookingId does not exist.";
  }
}


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

  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Place these after Bootstrap and jQuery imports -->



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
                </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </section>

  <!-- admin bookings data section -->
  <section class="about_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>All Bookings</h2>
      </div>
      <div class="box">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Reference Code</th>
              <th>User</th>
              <th>Facility</th>
              <th>Schedule</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Fetch all bookings from the database
            $bookingSql = "SELECT b.*, f.name AS facility_name, u.first_name, u.last_name
                           FROM booking b
                           INNER JOIN facilities f ON b.facility_id = f.id
                           INNER JOIN users u ON b.client_id = u.id";
            $bookingResult = $conn->query($bookingSql);

            if ($bookingResult->num_rows > 0) {
                $count = 1;
                while ($bookingRow = $bookingResult->fetch_assoc()) {
                    // Extract booking details
                    $dateFrom = $bookingRow['date_from'];
                    $dateTo = $bookingRow['date_to'];
                    $referenceCode = $bookingRow['ref_code'];
                    $facilityName = $bookingRow['facility_name'];
                    $schedule = $bookingRow['time_from'] . ' - ' . $bookingRow['time_to'];
                    $status = $bookingRow['status'];
                    $userName = $bookingRow['first_name'] . ' ' . $bookingRow['last_name'];
                    $bookingId = $bookingRow['id'];
                    ?>
                    <tr>
                      <td><?php echo $count++; ?></td>
                      <td><?php echo $dateFrom; ?></td>
                      <td><?php echo $referenceCode; ?></td>
                      <td><?php echo $userName; ?></td>
                      <td><?php echo $facilityName; ?></td>
                      <td><?php echo $schedule; ?></td>
                      <td><?php echo ucfirst($status); ?></td>
                      <td>
                        <?php if ($status !== 'Cancelled') { ?>
                          <button class="btn btn-primary" data-toggle="modal" data-target="#bookingActionsModal" data-booking-id="<?php echo $bookingId; ?>">
                            Actions
                          </button>
                        <?php } else { ?>
                          Cancelled
                        <?php } ?>
                      </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="8">No bookings found</td></tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <!-- end admin bookings data section -->

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
<!-- Bootstrap Modal for Booking Actions -->
<div class="modal fade" id="bookingActionsModal" tabindex="-1" role="dialog" aria-labelledby="bookingActionsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bookingActionsModalLabel">Choose Action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="actionChoice">Choose an action:</label>
        <select class="form-control" id="actionChoice">
          <option value="cancel">Cancel</option>
          <option value="confirm">Confirm</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="handleBookingAction()">Submit</button>
      </div>
    </div>
  </div>
</div>

<!-- Add this div wrapper with a unique ID -->
<div id="bookingActionsModalWrapper"></div>
<script>
    function cancelBooking(bookingId) {
      if (confirm('Are you sure you want to cancel this booking?')) {
        // Make an AJAX request to cancel the booking
        $.ajax({
          url: 'cancel_booking.php', // Path to your cancellation logic
          type: 'POST',
          data: { bookingId: bookingId },
          success: function (response) {
            if (response === 'success') {
              alert('Booking cancelled successfully');
              // Reload the page to update the booking status
              location.reload();
            } else {
              alert('Failed to cancel booking');
            }
          }
        });
      }
    }
  </script>
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
  $(document).ready(function () {
    $('#bookingActionsModal').on('show.bs.modal', function (event) {
      const modalWrapper = $('#bookingActionsModalWrapper');
      modalWrapper.css('z-index', 1050); // Adjust the z-index value as needed
      modalWrapper.append($('#bookingActionsModal'));
    });
  });
  
  $('#bookingActionsModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget); // Button that triggered the modal
    const bookingId = button.data('booking-id'); // Extract booking ID from data attribute

    // Update the modal with the booking ID
    const modal = $(this);
    modal.find('.modal-title').text('Booking ID: ' + bookingId);
    modal.find('#modalBookingId').text(bookingId);
    modal.find('#actionChoice').data('booking-id', bookingId);
  });

  function handleBookingAction() {
  const bookingId = $('#actionChoice').data('booking-id');
  const actionChoice = $('#actionChoice').val();

  // Log the action and bookingId to the console for debugging
  console.log('Action:', actionChoice, 'for Booking ID:', bookingId);

  // Send an AJAX request to the server to process the action
  $.ajax({
    url: 'process_booking_action.php', // Replace with the actual server-side endpoint
    type: 'POST',
    data: {
      bookingId: bookingId,
      action: actionChoice
    },
    success: function (response) {
      console.log('Response:', response);  // Log the response from the server
      if (response === 'success') {
        alert('Booking ' + actionChoice + 'ed successfully');
        // Reload the page to update the booking status
        location.reload();
      } else {
        alert('Failed to ' + actionChoice + ' booking');
      }
    },
    error: function (error) {
      console.error('Error:', error);  // Log any errors that occur
      alert('An error occurred while processing the action');
    }
  });

  // Close the modal
  $('#bookingActionsModal').modal('hide');
}
</script>

</body>

</html>