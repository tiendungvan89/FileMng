<?php
    if (session_id() == '') {
        session_start();
    }

    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    unset($_SESSION["upload_dir"]);
    unset($_SESSION["thumbs_upload_dir"]);

    header("Location: login.php"); 
?>
<!doctype html>
<html>

<head runat="server">
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
   
    <!-- Page title -->
    <title>UPLOAD FILE</title>
    <style>
        /*
        * Specific styles of signin component
        */
        /*
        * General styles
        */
        body, html {
            height: 100%;
            background-repeat: no-repeat;
            background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
        }
    </style>
</head>

<body>
<div class="bg_load"></div>
<div class="wrapper"></div>
</body>