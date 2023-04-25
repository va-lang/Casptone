<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('admin/db_connect.php');
ob_start();
$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
foreach ($query as $key => $value) {
    if (!is_numeric($key))
        $_SESSION['system'][$key] = $value;
}
ob_end_flush();
include('header.php');
?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Your description">
    <meta name="author" content="Your name">


    <!-- Webpage Title -->
    <title>Webpage Title</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="web/css/bootstrap.min.css" rel="stylesheet">
    <link href="web/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="web/css/swiper.css" rel="stylesheet">
    <link href="web/css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="images/favicon.png">
</head>

<body data-bs-spy="scroll" data-bs-target="#navbarExample">

    <!-- Navigation -->
    <nav id="navbarExample" class="navbar navbar-expand-lg fixed-top navbar-dark" aria-label="Main navigation">
        <div class="container">

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="index.php"><img src="web/images/chraj.svg" alt="alternative"></a>



            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


        </div>
    </nav>


    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="h1-large">SPEAKING UP CHANGES LIVES</h1>
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <div class="button-container">
                        <!-- <a class="btn-outline-lg" id="report_crime">Report a Case</a> -->
                        <!--                             
                            <button class="btn btn-primary" type="button" id="report_crime">Report a Case</button> -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="report_crime"> Report Case</button>
                        <!-- <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
                        <!-- <a class="btn-outline-lg"  button class="btn btn-primary" type="button" id="report_crime">Report a Case</button></a>
                            <a class="btn-outline-lg"  button class="btn btn-primary" type="button" id="track_case">Track your Case</button></a> -->

                    </div> <!-- end of button-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of header -->
    <!-- end of header -->



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">M</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save changes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>


    </div>
    <!-- Introduction -->
    <div id="intro" class="basic-1 bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1>VISION || MISSION</h1>
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <div class="text-container">

                        <?php
                        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                        include $page . '.php';

                        ?>



                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-1 -->
    <!-- end of introduction -->




    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-col first">
                        <h6><?php echo $_SESSION['system']['contact'] ?></h6>
                        <p class="p-small">Sit amet facilisis magna etiam felis eget velit aliquet sagittis id. Mauris sit amet massa vitae tortor condimentum lacinia quis</p>
                    </div>

                    <p class="p-small">Ac turpis egestas integer leor <a href="mailto:<?php echo $_SESSION['system']['email'] ?>"><strong><?php echo $_SESSION['system']['email'] ?></strong></a></p>
                </div> <!-- end of footer-col -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright©2023 - <?php echo $_SESSION['system']['name'] ?></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->




    <!-- Scripts -->
    <script src="web/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="web/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="web/js/scripts.js"></script> <!-- Custom scripts -->
</body>
<?php include('footer.php') ?>
<script type="text/javascript">
    // $('#login').click(function(){
    //   uni_modal("Login",'login.php')
    // })
    $('.datetimepicker').datetimepicker({
        format: 'Y-m-d H:i',
    })
    $('#find-car').submit(function(e) {
        e.preventDefault()
        location.href = 'index.php?page=search&' + $(this).serialize()
    })
    $('#report_crime').click(function() {
        uni_modal("Report", 'manage_report.php');
        // if('<?php echo !isset($_SESSION['login_id']) ? 1 : 0 ?>'==1){
        //   uni_modal("Login",'login.php');
        //   return false;
        // }

    })
    $('#manage_my_account').click(function() {
        uni_modal("Manage Account", 'signup.php');
    })
</script>
<?php $conn->close() ?>

</html>