<?php 
    ob_start();
    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: login.php"); 
        exit;
    }
    
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

    <link href="css/style.css" rel="stylesheet"/>
    
    <!-- Page title -->
    <title>【FILE MNG】</title>
</head>

<body>
    <div class="bg_load"></div>
    <div class="wrapper">
        <div class="inner">
            <span>L</span>
            <span>o</span>
            <span>a</span>
            <span>d</span>
            <span>i</span>
            <span>n</span>
            <span>g</span>
        </div>
    </div>

    <script type="text/javascript">
        $(window).load(function () {
            $(".bg_load").fadeOut("slow");
            $(".wrapper").fadeOut("slow");
        });

        $(document).ready(function() {
            window.location="filemanager/dialog.php?type=0&amp;editor=mce_0"
        })
    </script>

</body>