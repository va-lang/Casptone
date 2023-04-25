<?php 
require_once __DIR__.'/../vendor/autoload.php';
require_once 'Crime_Complaint_Management_System/admin/complainants.php';
require_once 'Crime_Complaint_Management_System/admin/db_connect.php';
require_once 'Crime_Complaint_Management_System/admin/ajax.php';


use GuzzleHttp\Client;

class ReportTblTest extends \PHPUnit\Framework\TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = new mysqli('localhost', 'username', 'password', 'database_name');
    }

    public function testVerificationTableHasExpectedColumns()
    {
        $result = $this->conn->query('DESCRIBE verification');
        $columns = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $columns[] = $row['Field'];
        }

        $expected_columns = array('id', 'complaint_id', 'status', 'created_at', 'updated_at');
        sort($expected_columns);

        sort($columns);

        $this->assertEquals($expected_columns, $columns);
    }

    public function testVerificationTableHasData()
    {
        $result = $this->conn->query('SELECT * FROM verification');
        $this->assertGreaterThan(0, mysqli_num_rows($result));
    }

    public function testVerificationTableJoinComplaintsTable()
    {
        $result = $this->conn->query('SELECT * FROM verification v INNER JOIN complaints c ON c.id = v.complaint_id');
        $this->assertGreaterThan(0, mysqli_num_rows($result));
    }

}