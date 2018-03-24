<?php

// session_start();

// Redirecting To Home Page
header("Location: ../../login.html");

session_unset();

session_destroy();

exit();