<?php
session_start();
require_once '../val/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        form {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <header>
        <h1>Edit User Information</h1>
    </header>

    <div class="container">

    <?php
// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user details from the database
    $userSql = "SELECT * FROM users WHERE ID = $userId";
    $userResult = $conn->query($userSql);

    // Check if the user exists
    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();

        // Display user information
        echo '<div class="container">';
        echo '<form method="post" action="update_user.php">';
        echo '<input type="hidden" name="userId" value="' . $userId . '">';

        echo '<label>First Name:</label>';
        echo '<input type="text" name="new_first_name" value="' . $userRow['First_Name'] . '" required><br>';

        echo '<label>Last Name:</label>';
        echo '<input type="text" name="new_last_name" value="' . $userRow['Last_Name'] . '" required><br>';

        echo '<label>Gender:</label>';
        echo '<select name="new_gender" required>';
        echo '<option value="male" ' . ($userRow['Gender'] === 'male' ? 'selected' : '') . '>Male</option>';
        echo '<option value="female" ' . ($userRow['Gender'] === 'female' ? 'selected' : '') . '>Female</option>';
        echo '<option value="other" ' . ($userRow['Gender'] === 'other' ? 'selected' : '') . '>Other</option>';
        echo '</select><br>';

        echo '<label>Phone Number:</label>';
        echo '<input type="text" name="new_phone_number" value="' . $userRow['Phone'] . '" required><br>';

        echo '<button type="submit" name="save_edit">Save</button>';
        echo '</form>';

        // Add a separate form for removing the user
        echo '<form method="post" action="remove_user.php">';
        echo '<input type="hidden" name="userId" value="' . $userId . '">';
        echo '<button type="submit" name="remove_user" style="background-color: red; color: white;">Remove User</button>';
        echo '</form>';
        echo '</div>';
    } else {
        echo '<p>User not found.</p>';
    }
} else {
    echo '<p>User ID not provided.</p>';
}
?>

    </div>

    <footer>
        &copy; Grande Sports Center
    </footer>

</body>

</html>
