<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sapkotaaayush17@gmail.com';
        $mail->Password   = 'gpvynznzqiabhwnm';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->SMTPAutoTLS = false;

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('sapkotaaayush17@gmail.com', 'Aayush Sapkota');

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = '<p><strong>Name: </strong>' . $name . '</p><p><strong>Email: </strong>' . $email . '</p><p><strong>Phone: </strong>' . $phone . '</p><p><strong>Address: </strong>' . $address . '</p><p><strong>Message: </strong>' . $message . '</p>';

        $mail->send();
        echo '<!DOCTYPE html>
        <html>
        <head>
          <meta charset="utf-8">
          <title>Login Form</title>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css">
        </head>
        <body class="bg-gray-100">
        
                <!-- Section 1 -->
            <div class="flex justify-between items-center bg-white px-8 py-4">
                <div class="flex items-center">
                    <div class="h-12 w-12 bg-gray-300 rounded-full mr-4">
                        <img src="../img/logo/Logo.jpg" class="h-12 w-12 rounded-full" alt="Logo">
                    </div>
                    <h1 class="text-2xl font-bold">Grande Futsal</h1>
                </div>
            </div>
            
            <!-- Section 2 -->
            <nav class="flex justify-center items-center bg-gray-200 py-4">
                <ul class="flex space-x-4">
                    <li><a href="../index.php" class="text-gray-600 hover:text-gray-800">Home</a></li>
                    <li><a href="../main/aboutus.php" class="text-gray-600 hover:text-gray-800">About</a></li>
                    <li><a href="../main/book.php" class="text-gray-600 hover:text-gray-800">Book</a></li>
                    <li><a href="../main/competition.php" class="text-gray-600 hover:text-gray-800">Competition</a></li>
                    <li><a href="../main/gallery.php" class="text-gray-600 hover:text-gray-800">Gallery</a></li>
                </ul>
            </nav>
        
            <!--Section 3-->
            <div class="bg-white-200 py-10">
                <div class="max-w-4xl mx-auto px-4 flex items-center justify-center h-full">
                  <div class="text-center">
                    <h2 class="text-3xl font-bold mb-4">Message sent Successfully!</h2>
                    <p class="text-gray-700" style="font-size:24px; color:green;">
                        <a href="../index.php">Click Here to return to Homepage</a>
                    </p>
                </div>
            </div>
        </div>
        </body>
        </html>
        ';
    } catch (Exception $e) {
    echo '<p><!DOCTYPE html>
    <html>
    <head>
      <meta charset="utf-8">
      <title>Login Form</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css">
    </head>
    <body class="bg-gray-100">
    
            <!-- Section 1 -->
        <div class="flex justify-between items-center bg-white px-8 py-4">
            <div class="flex items-center">
                <div class="h-12 w-12 bg-gray-300 rounded-full mr-4">
                    <img src="../img/logo/Logo.jpg" class="h-12 w-12 rounded-full" alt="Logo">
                </div>
                <h1 class="text-2xl font-bold">Grande Futsal</h1>
            </div>
        </div>
        
        <!-- Section 2 -->
        <nav class="flex justify-center items-center bg-gray-200 py-4">
            <ul class="flex space-x-4">
                <li><a href="../index.php" class="text-gray-600 hover:text-gray-800">Home</a></li>
                <li><a href="../main/aboutus.php" class="text-gray-600 hover:text-gray-800">About</a></li>
                <li><a href="../main/book.php" class="text-gray-600 hover:text-gray-800">Book</a></li>
                <li><a href="../main/competition.php" class="text-gray-600 hover:text-gray-800">Competition</a></li>
                <li><a href="../main/gallery.php" class="text-gray-600 hover:text-gray-800">Gallery</a></li>
            </ul>
        </nav>
    
        <!--Section 3-->
        <div class="bg-white-200 py-10">
            <div class="max-w-4xl mx-auto px-4 flex items-center justify-center h-full">
              <div class="text-center">
                <h2 class="text-3xl font-bold mb-4">Message could not be sent!</h2>
                <p class="text-gray-700" style="font-size:24px; color:green;">
                    <a href="../index.php">Click Here to return to Homepage</a>
                </p>
            </div>
        </div>
    </div>
    </body>
    </html>' . $mail->ErrorInfo . '</p>';
    }
    }
    ?>