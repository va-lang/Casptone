<!DOCTYPE html>
<html lang="en" title="Coding design">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Case Progress</title>
    <link rel="stylesheet" href="web/style.css">
</head>
<body>
    <main class="table">
        <section class="table__header">
            <h1>Case Progress    ||<a href="index.php">Back To Home</a> </h1>
           
        </section>
        <section class="table__body">
        <?php
         // get id from the form
            $id = $_POST['trackingid'];

            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'crms_db';

            $conn = mysqli_connect($host, $user, $password, $database);

            if(!$conn){
                die('Could not connect to the database: ' .mysqli_connect_error());
            }

            $qry = $conn->query("SELECT * FROM complaints WHERE tracking = '$id' ORDER BY date_created DESC");

            if(mysqli_num_rows($qry) > 0){
                // Start generating the HTML table
                echo '<table style="margin: auto; width: 50%;">';
                echo '<tr><th>Tracking ID</th><th>Report</th><th>Address</th><th>Case Status</th></tr>';
                $status_options = array("","Pending","Received","Action Made");
                while($row = $qry->fetch_array()){
                    $status = $status_options[$row["status"]];
                    echo '<tr><td>' . $row["tracking"] . '</td><td>' . $row["message"] . '</td><td>' . $row["address"] . '</td><td>' . $status . '</td></tr>';
                }
                echo '</table>';
            }else{
                echo "No results found.";
            }

            mysqli_close($conn);
        ?>

        </section>
    </main>
</body>
</html>


