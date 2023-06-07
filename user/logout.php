<?php
session_start();
session_unset();
session_destroy();
header("location: ../index.php"); // redirect the user to the home page
exit();
?>
