<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $message = $_POST['message'];
    $address = $_POST['address'];
    $dateincident = $_POST['dateincident'];
    $timeincident = $_POST['timeincident'];
    $statusincident = $_POST['statusincident'];
    $tracking = $_POST['tracking'];

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'crms_db';

    $conn = mysqli_connect($host, $user, $password, $database);

    if(!$conn){
        die('Could not connect to the database: ' .mysqli_connect_error());
    }

    $sql = "INSERT INTO complaints (message, address, dateincident,timeincident,statusincident,tracking) VALUES ('$message', '$address', '$dateincident', '$timeincident', '$statusincident', '$tracking')";

    if(mysqli_query($conn, $sql)){
        // Show a success message to the user using a popup or alert
        // echo '<script>alert("Form submitted successfully! Tracking ID: ' . $tracking . '"); window.location.href = "index.php";</script>';
        echo '<div style="background-color: #d4edda; color: #155724; padding: 1rem; border: 1px solid #c3e6cb; border-radius: 0.25rem;">';
        echo 'Form submitted successfully! Tracking ID: ' . $tracking . '<br>';
        echo 'Please take note of your tracking case ID and come back in 24 hours to check on your case. Thank you.</div>';
        echo 'THIS PAGE WOULD BE REDIRECT BACK TO THE HOMEPAGE IN 15 SECS  FOR PRIVACY CONTEXT.</div>';
        header("Refresh:15; url=index.php");

    } else {
        // Show an error message to the user using a popup or alert
        echo '<script>alert("Error: Could not submit form.");</script>';
    }
}

// Display the form to the user
?>


