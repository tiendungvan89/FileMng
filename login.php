<?php
    ob_start();
    session_start();
    if(isset($_SESSION['username'])) {
        header("Location: index.php"); 
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
    <title>【FILE MNG】SIGN IN</title>
</head>

<body>
<div class="bg_load"></div>
        
    <?php
            require 'vendor/autoload.php';
            use App\SQLiteConnection;
            use App\UserDAO;

            $msg = '';
            if (isset($_POST['signup'])) {
                header("Location: register.php"); 
                exit;
            }

            if (isset($_POST['signin']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
                
                $userId = $_POST['username'];
                $password = $_POST['password'];

                $pdo = (new SQLiteConnection())->connect();
                $users = (new UserDAO($pdo))->getUser($userId);

                if (!empty($users) && strcmp($password, $users[0]->getPassword()) == 0) {
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = time();
                    $_SESSION['username'] = $userId;

                    $_SESSION['upload_dir'] = $users[0]->getUploadDir();
                    $_SESSION['thumbs_upload_dir'] = $users[0]->getUploadTbumbDir();

                    header("Location: index.php"); 
                    exit;

                } else {
                    $msg = 'Wrong username or password';
                }

            }
         ?>
    </div>

    <div class="container">
        <div class="card card-container">
            <p id="profile-name" class="profile-name-card">SIGN IN</p>
            <br/>
            <?php if(!empty($msg)) { ?>
                <span class="text-danger"><?php echo $msg; ?></span>
            <?php } ?>
            <form class="form-signin" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                <button class="btn btn-lg btn-success btn-block btn-signin" type="submit" name="signin">SIGN IN</button>
                <hr/>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="signup">SIGN UP</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->

</body>