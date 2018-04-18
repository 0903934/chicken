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

    <title>Foxy Snap</title>

</head>

<!-- Connecting to BootStrap CDN -->
<!-- BootStrap CDN -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Connecting to JQUERY DataTable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.2.1/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.2.1/dt-1.10.16/datatables.min.js"></script>

<!-- jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />



<style>
    body{
        background-color: #2f4050;
    }

</style>


<body>
<div style="height: 10px; background: #27AAE1; "></div>

<div class="container-fluid">  <!--Beginning of bootstrap page Container -->
    <div class="row">  <!--Beginning of rows -->

        <!--Beginning of page side panel area -->
        <div class="col-sm-2" id="Side_Menu" >
            <div id="welcome">
                <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
            </div>

            <div id="Side_Menu_links">
                <p><a class="button special active" href="dashboard.php">Dashboard</a></p>
                <p><a class="button" href="../../index.html">Home</a></p>
                <p><a class="button"href="../logic/logout.php">Logout</a></p>
            </div>

        </div>
        <!--Ending of page side panel area -->

        <!--Beginning of main  area -->
        <div class="col-sm-10">
            <h1>Detection Report</h1>

            <!-- Modal -->
            <!-- The Modal -->
            <div id="myModal" class="modal">

                <!-- The Close Button -->
                <span class="close">&times;</span>

                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="img01">

                <!-- Modal Caption (Image Text) -->
                <div id="caption"></div>
            </div>
            <!-- Modal -->

            <!-- Outputting all the contents in the Users table -->
            <div class="table-responsive">
                    <!--Getting all the records from the database to form rows on the table. -->
                    <table id="detection-table" class="display">
                    <thead>
                        <tr>
                            <th>Id.</th>
                            <th>Camera Id</th>
                            <th>Predator Name</th>
                            <th>Detection Accuracy(%)</th>
                            <th>Predator Image</th>
                            <th>Detection Time</th>
                        </tr>
                    </thead>


                    <tfoot>
                    <tr>
                        <th>Id.</th>
                        <th>Camera Id</th>
                        <th>Predator Name</th>
                        <th>Detection Accuracy(%)</th>
                        <th>Predator Image</th>
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
                                                        data = '<a href="'+ data + '">' + data + '</a>';
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

        </div>

        </div>  <!--Ending of rows -->

        </div>  <!--Ending of bootstrap page Container -->
    </div>

<!--Footer Begins -->
<div id="Footer">

    <hr>
    <p> Designed by | Group D | &copy;2018-2020 --- All rights reserved.</p>
    <a style="color: white; text-decoration: none; cursor: pointer; font-weight: bold;" href="https://www.rgu.ac.uk">
        <p>
            This site is an assessed group project for the Software Engineering Module in the M.Sc.
            IT program at Robert Gordon University Aberdeen. No one is allowed copies other than <br>
            &trade; Robert Gordon University Aberdeen, &trade; Group Members: Stuart Cossar, Temple Okosun, Ejiro Okogu, Peter Clarke, Muhammed Aljuwaiser.
        </p>
    </a>
    <hr>

</div>

<div style="height: 10px; background: #27AAE1; "></div>

</body>

</html>



