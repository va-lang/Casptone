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
