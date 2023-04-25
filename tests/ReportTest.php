<?php 
require_once __DIR__.'/../vendor/autoload.php';


use GuzzleHttp\Client;

class ReportTest extends \PHPUnit\Framework\TestCase {
    public function testFormFieldsExist() {
        // Create a new DOM document to parse the HTML
        $html = new DOMDocument();
        $html->loadHTMLFile('Crime_Complaint_Management_System/manage_report.php');
        
        // Check if the form fields exist
        $this->assertNotNull($html->getElementById('complaint-frm'));
        $this->assertNotNull($html->getElementById('status-select'));
        $this->assertNotNull($html->getElementsByTagName('textarea')->item(0));
        $this->assertNotNull($html->getElementsByTagName('textarea')->item(1));
        $this->assertNotNull($html->getElementsByTagName('input')->item(0));
        $this->assertNotNull($html->getElementsByTagName('input')->item(1));
        $this->assertNotNull($html->getElementsByTagName('select')->item(0));
        $this->assertNotNull($html->getElementsByTagName('input')->item(2));
        

    }
    public function testFormDataCanBeSubmitted()
    {
        // Create a new HTTP client
        $client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost/Casptone/',
            'http_errors' => false,
        ]);
    
        // Make a POST request to submit form data
        $response = $client->request('POST', 'Crime_Complaint_Management_System/save.php', [
            'form_params' => [
                'message' => 'Test message',
                'address' => '123 Test Street',
                'dateincident' => '2023-04-24',
                'timeincident' => '10:00 AM',
                'statusincident' => 'Pending',
                'tracking' => '123456789',
            ]
        ]);
    
        // Check that the response status code is OK
        $this->assertEquals(200, $response->getStatusCode());
    
        // Check that the response body contains the submitted form data
        $responseBody = $response->getBody()->getContents();
        $this->assertStringContainsString('Form submitted successfully! Tracking ID: 123456789', $responseBody);
        $this->assertStringContainsString('Please take note of your tracking case ID and come back in 24 hours to check on your case. Thank you.', $responseBody);
        $this->assertStringContainsString('THIS PAGE WOULD BE REDIRECT BACK TO THE HOMEPAGE IN 15 SECS  FOR PRIVACY CONTEXT.', $responseBody);
    }
    
    

    
}