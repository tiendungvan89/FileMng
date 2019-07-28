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

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"/>
    <link href="css/login.css" rel="stylesheet"/>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
   
    <!-- Page title -->
    <title>【FILE MNG】CHANGE PASSWORD</title>
</head>

<body>
<div class="bg_load"></div>
        
    <?php
            require 'vendor/autoload.php';
            use App\SQLiteConnection;
            use App\UserDAO;

            $msg = '';
            
            if (isset($_POST['change_password']) 
                && !empty($_POST['current_password']) 
                && !empty($_POST['new_password']) 
                && !empty($_POST['password_confirm'])) {
                
                $userId = $_SESSION['username'];
                $currentPassword = $_POST['current_password'];
                $password = $_POST['new_password'];
                $passwordConfirm = $_POST['password_confirm'];

                $pdo = (new SQLiteConnection())->connect();
                $users = (new UserDAO($pdo))->getUser($userId);

                if (!empty($users) && strcmp($currentPassword, $users[0]->getPassword()) == 0) {
                    if (strcmp($password, $passwordConfirm) == 0) {
                        $result = (new UserDAO($pdo))->changePassword($userId, $password);
                        if (!$result) {
                            $msg = 'An error has occured, contact your administrator to get support';
                        } else {
                            header("Location: index.php"); 
                            exit;
                        }
                    } else {
                        $msg = 'password is not matched';
                    }
                } else {
                    $msg = 'Current password was wrong';
                }
            }
         ?>
    </div>

    <div class="container">
        <div class="card card-container">
            <span><a href="index.php">HOME</a></span>
            <br/>
            <br/>
            <form class="form-signin" autocomplete="off" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
                <input type="password" class="form-control" autocomplete="new-password" placeholder="Current Password" name="current_password" value="" required autofocus>
                <input type="password" class="form-control" autocomplete="new-password" placeholder="New Password" name="new_password" value="" required autofocus>
                <input type="password" class="form-control" autocomplete="new-password" placeholder="Confirm Password" name="password_confirm" value="" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="change_password">CHANGE PASSWORD</button>
                <span class="text-danger"><?php echo $msg; ?></span>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script>
        $(document).ready(function(){ 
            $("input").attr("autocomplete", "off"); 
        });
    </script>
</body>