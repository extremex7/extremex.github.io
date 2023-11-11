<!DOCTYPE html>
<html>
<head>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <style>
    /* Add your custom styles here */

    /* Adjust the padding and margin as needed */
    .tab-content {
      padding: 20px;
    }
  </style>
</head>
<body>

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

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Your custom script for user removal -->
<script>
  function removeUser(userId) {
    // Your removal logic here
    // ...
  }
</script>

</body>
</html>
