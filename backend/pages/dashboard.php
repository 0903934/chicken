<?php
//Contains functions for page Re-directions.
require_once($_SERVER["DOCUMENT_ROOT"] . "/backend/resources/functions.php");

//Contains Database connection info.
require_once($_SERVER["DOCUMENT_ROOT"]."/backend/resources/db.php");

//Contains session info
require_once($_SERVER["DOCUMENT_ROOT"]."/backend/resources/sessions.php");

?>




<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie = edge">


    <!--My Style Sheets -->
    <link rel="stylesheet" href="../../css/dashboardstyle.css">

    <title>Admin Dashboard</title>

</head>

<!-- Connecting to BootStrap CDN -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
      integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
      crossorigin="anonymous">

<!-- Connecting to JQUERY DataTable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>


<link rel="stylesheet" type="text/css" href="../../css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.js"></script>






<body>

<div class="container-fluid">  <!--Beginning of bootstrap page Container -->
    <div class="row">  <!--Beginning of rows -->

        <!--Beginning of page side panel area -->
        <div class="col-sm-2 sidenav" >
            <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
            <p>Dashboard</p>
            <p>This is a secure area.</p>
            <p><a href="../../index.html">Home</a></p>
            <p><a href="../logic/logout.php">Logout</a></p>
        </div>
        <!--Ending of page side panel area -->

        <!--Beginning of main  area -->
        <div class="col-sm-10">
            <h1>Detection Report</h1>
            <!-- Outputting all the contents in the Users table -->
            <div class="table-responsive">

                    <!--Getting all the records from the database to form rows on the table. -->
                    <table id="detection-table" class="display">
                    <thead>
                        <tr>
                            <th>Id.</th>
                            <th>CameraId</th>
                            <th>PredatorName</th>
                            <th>DetectionAccuracy</th>
                            <th>PredatorImage</th>
                            <th>DetectionTime</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Camera Id</th>
                            <th>Predator Name</th>
                            <th>Detection Accuracy</th>
                            <th>Predator Image(%)</th>
                            <th>Detection Time</th>
                        </tr>

                    </tfoot>

                    <tbody>

                    </tbody>


                    </table>
                        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>

                        <script type="text/javascript" >

                            $(document).ready(function () {
                                   var table =  $('#detection-table').DataTable({
                                        "processing": false,
                                        "serverSide":true,
                                        "ajax": "../../api/DetectionsData.php",
                                        "columns": [
                                            {"data": "id"},
                                            {"data": "CameraId"},
                                            {"data": "PredatorName"},
                                            {"data": "DetectionAccuracy"},
                                            {"data": "PredatorImage", "render": function ( data, type, row, meta ) {
                                                    if(type === 'display'){
                                                        data = '<a class="link-image" href="'+ data + '">' + data + '</a>';
                                                    }

                                                    return data;
                                                }
                                                },
                                            {"data": "DetectionTime"}
                                        ]

                                    });
                                setInterval( function () {
                                    table.ajax.reload( null, false ); // user paging is not reset on reload
                                }, 30000 );


                            });
                        </script>
            </div>


        </div>  <!--Ending of rows -->

        </div>  <!--Ending of bootstrap page Container -->
    </div>

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



