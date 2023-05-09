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
        header('location:index.php');
        echo "Form submitted Successfully";
    }


}
$this->assertNotNull($html->getElementsByTagName('textarea')->item(0));
//     $this->assertNotNull($html->getElementsByTagName('textarea')->item(1));
//     $this->assertNotNull($html->getElementsByTagName('input')->item(0));
//     $this->assertNotNull($html->getElementsByTagName('input')->item(1));
//     $this->assertNotNull($html->getElementsByTagName('select')->item(0));
//     $this->assertNotNull($html->getElementsByTagName('input')->item(2));
    

// }
protected $client;

protected function setUp(): void
{
    $this->client = new \Symfony\Component\HttpKernel\Client(require __DIR__.'/../public/index.php', [
        'HTTP_HOST' => 'localhost',
        'REMOTE_ADDR' => '127.0.0.1',
    ]);
}

public function testFormSubmission()
{
    // ...

    $crawler = $this->client->request('POST', 'Crime_Complaint_Management_System/save.php', $formData);

    // ...
}
public function testFormInputs(){

    $crawler = $this->client->request('GET', 'Crime_Complaint_Management_System/index.php');

    $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

    $form = $crawler->filter('#complaint-frm')->form();

    $form['message'] = $formData['message'];
    $form['address'] = $formData['address'];
    $form['dateincident'] = $formData['dateincident'];
    $form['timeincident'] = $formData['timeincident'];
    $form['statusincident'] = $formData['statusincident'];
    $form['tracking'] = $formData['tracking'];

    $crawler = $this->client->submit($form);

    $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

    $this->assertEquals($formData['message'], $crawler->filter('textarea[name="message"]')->attr('value'));

    $this->assertEquals($formData['address'], $crawler->filter('textarea[name="address"]')->attr('value'));

    $this->assertEquals($formData['dateincident'], $crawler->filter('input[name="dateincident"]')->attr('value'));

    $this->assertEquals($formData['timeincident'], $crawler->filter('input[name="timeincident"]')->attr('value'));

    $this->assertEquals($formData['statusincident'], $crawler->filter('select[name="statusincident"] option[selected]')->attr('value'));

    $this->assertEquals($formData['tracking'], $crawler->filter('input[name="tracking"]')->attr('value'));
}


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

            $sql = "INSERT INTO complaints (message, address, dateincident,timeincident,statusincident,tracking) VALUES ('$message', '$address', '$dateincident', '$timeincident', '$statusincident', '$tracking')";
           
        
            if(mysqli_query($conn, $sql)){
              $lastInsertedId = mysqli_insert_id($conn);
            
              echo '<div style="background-color: #d4edda; color: #155724; padding: 1rem; border: 1px solid #c3e6cb; border-radius: 0.25rem;">';
              echo 'Form submitted successfully! Tracking ID: ' . $tracking . '<br>';
              echo 'Please take note of your tracking case ID and come back in 24 hours to check on your case. Thank you.</div>';
              echo 'THIS PAGE WOULD BE REDIRECT BACK TO THE HOMEPAGE IN 15 SECS  FOR PRIVACY CONTEXT.</div>';
              header("Refresh:30; url=index.php");

            } else {
              // Show an error message to the user using a popup or alert
              echo '<script>alert("Error: Could not submit form.");</script>';
            }

            $sql2= "INSERT INTO verification(complaint_id,status)VALUES('$lastInsertedId',0)";
            $resp = mysqli_query($conn, $sql2);
            
            $query = "INSERT INTO complaints(file_upload) VALUES ('$file_upload')";
            $run = mysqli_query($conn,$query);
            
            if($run){
                move_uploaded_file($fileTmpName,$path);
                echo "success";
            }
            else{
                echo "error".mysqli_error($conn);
            }
          }
        // Display the form to the user
        ?>
        </p>
      
      </div>
      </div>
    </div>
  
  </body>
  </html>