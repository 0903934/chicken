
<?php

require($_SERVER["DOCUMENT_ROOT"]."/backend/resources/db.php");
include($_SERVER["DOCUMENT_ROOT"] . "/backend/resources/auth.php");

?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie = edge">

    <!--BootStrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!--My Style Sheets -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/adminstyles.css">

    <title>Admin Dashboard</title>

</head>

<!-- Connecting to BootStrap CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Unable to save the local library for this link Popper.js-->
<!-- <script src="https://cdnjs.cloudfare.com/ajax/libs/pooper.js/1.12.9/umd/popper.min.js"></script> -->

<!-- Had to use this link instead to save the local library for this Popper.js link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<body>

<div class="container-fluid">  <!--Beginning of bootstrap page Container -->
    <div class="row">  <!--Beginning of rows -->

        <!--Beginning of page side panel area -->
        <div class="col-sm-2">
            <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
            <p>Dashboard</p>
            <p>This is a secure area.</p>
            <p><a href="../../index.html">Home</a></p>
            <a href="../logic/logout.php">Logout</a>

        </div>
        <!--Ending of page side panel area -->

        <!--Beginning of main  area -->
        <div class="col-sm-10">
            <h1>Detection Report</h1>
            <!-- Outputting all the contents in the Users table -->
            <div class="table-responsive">
                <table class="table table-striped teble-hover">
                    <!-- Header for the table. -->
                    <tr>
                        <th>SN.</th>
                        <th>Camera Id</th>
                        <th>Predator Name</th>
                        <th>Detection accuracy</th>
                        <th>Predator image</th>
                        <th>Detection time</th>
                    </tr>

                    <!--Getting all the records from the database to form rows on the table.
                    <?php
                    global $conn;
                    $viewReport = "SELECT * FROM detectionreport ORDER BY DetectionTime DESC ";
                    $result = mysqli_query($conn, $viewReport);

                    $SrNo = 0;
                    while ($rows=mysqli_fetch_assoc($result)){
                    // $Id = $rows["id"];
                    $CameraId = $rows["CameraId"];
                    $PredatorName = $rows["PredatorName"];
                    $DetectionAccuracy = $rows["DetectionAccuracy"];
                    $PredatorImage = $rows["PredatorImage"];
                    $DetectionTime = $rows["DetectionTime"];
                    //This will help maintain correct numbering of the SN. field
                    $SrNo++;

                    ?>

                        <!-- New Row -->
                    <tr>
                        <td><?php echo $SrNo; ?> </td>
                        <td><?php echo $CameraId; ?> </td>
                        <td><?php echo $PredatorName ?> </td>
                        <td><?php echo $DetectionAccuracy ?> </td>
                        <td><?php echo "<a href='". $PredatorImage ."'><u>Image Link</u></a>" ?> </td>
                        <td><?php echo $DetectionTime ?> </td>
                    </tr>

                    <?php } ?>
                </table>

            </div>



        </div>
        <!--Ending of page main area -->

    </div>  <!--Ending of rows -->

</div>  <!--Ending of bootstrap page Container -->

<!--Footer Begins -->
<div id="Footer">

    <hr>
    <p> Designed by | Temple Okosun | &copy;2018-2020 --- All rights reserved.</p>
    <a style="color: white; text-decoration: none; cursor: pointer; font-weight: bold;" href="https://www.rgu.ac.uk">
        <p>
            This site is an assessed project for the Web Development Module in the M.Sc.
            IT program at Robert Gordon University Aberdeen. No one is allowed copies other than <br>
            &trade; Robert Gordon University Aberdeen, &trade; learnITCMSblog.com
        </p>
    </a>
    <hr>

</div>

<div style="height: 10px; background: #27AAE1; "></div>

</body>

</html>

