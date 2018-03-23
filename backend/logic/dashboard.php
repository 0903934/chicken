<?php

require('db.php');
include("auth.php");

?>


<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard - Secured Page</title>
    <link rel="stylesheet" href="../../css/style4registrationloginforms.css" />
</head>

<body>

<div class="form">
    <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
    <p>Dashboard</p>
    <p>This is a secure area.</p>
    <p><a href="../../index.html">Home</a></p>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>