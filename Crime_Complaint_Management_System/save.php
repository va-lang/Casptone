
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Feedback</title>
    <link rel="stylesheet" href="web/style1.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="content">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">Old Parliament House</div>
          <div class="text-two">Box AC 489, High Street – Accra</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one"> 0302662150</div>
          
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">complaint@chraj.gov.gh</div>
          
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text">FEEDBACK ||<a href="index.php">Back To Home</a></div>
        <p>
        <?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $message = $_POST['message'];
            $address = $_POST['address'];
            $dateincident = $_POST['dateincident'];
            $timeincident = $_POST['timeincident'];
            $statusincident = $_POST['statusincident'];
            $file_upload = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $path = "web/".$file_upload;
            $tracking = $_POST['tracking'];

            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'crms_db';

            $conn = mysqli_connect($host, $user, $password, $database);

            if(!$conn){
              die('Could not connect to the database: ' .mysqli_connect_error());
            }

            $sql = "INSERT INTO complaints (message, address, dateincident,timeincident,statusincident,file_upload,tracking) VALUES ('$message', '$address', '$dateincident', '$timeincident', '$statusincident', '$file_upload','$tracking')";

            if(mysqli_query($conn, $sql)){
              $lastInsertedId = mysqli_insert_id($conn);
            
              echo '<div style="background-color: #d4edda; color: #155724; padding: 1rem; border: 1px solid #c3e6cb; border-radius: 0.25rem;">';
              echo 'Form submitted successfully! Tracking ID: ' . $tracking . '<br>';
              echo 'Please take note of your tracking case ID and come back in 24 hours to check on your case. Thank you.</div>';
              echo 'THIS PAGE WOULD BE REDIRECT BACK TO THE HOMEPAGE IN 15 SECS  FOR PRIVACY CONTEXT.</div>';
              header("Refresh:60; url=index.php");

            } else {
              // Show an error message to the user using a popup or alert
              echo '<script>alert("Error: Could not submit form.");</script>';
            }
           
            
            if($conn){
                move_uploaded_file($fileTmpName,$path);
                echo "success";
            }
            else{
                echo "error".mysqli_error($conn);
            }
            

            $sql2= "INSERT INTO verification(complaint_id,status)VALUES('$lastInsertedId',0)";
            $resp = mysqli_query($conn, $sql2);
            
          }
        
        // Display the form to the user
        ?>
        </p>
      
      </div>
      </div>
    </div>
  
  </body>
  </html>