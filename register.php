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
    <title>【FILE MNG】SIGN UP</title>
</head>

<body>
<div class="bg_load"></div>
        
    <?php
            require 'vendor/autoload.php';
            use App\SQLiteConnection;
            use App\UserDAO;

            $msg = '';
            $userId = ''; 
            $password = '';
            $passwordConfirm = '';

            if (isset($_POST['signup']) 
                && !empty($_POST['username']) 
                && !empty($_POST['password'])
                && !empty($_POST['password_confirm'])) {
                
                $userId = $_POST['username'];
                $password = $_POST['password'];
                $passwordConfirm = $_POST['password_confirm'];

                $pdo = (new SQLiteConnection())->connect();
                $userDAO = new UserDAO($pdo); 
                $users = $userDAO->getUser($userId);
                if (!empty($users)) {
                    $msg = 'username have been used';
                } else {
                    if (strcmp($password, $passwordConfirm) == 0) {
                        // register user
                        $user = $userDAO->registerUser($userId, $password);
                        if (is_null($user)) {
                            $msg = 'An error has occured, contact your administrator to get support';
                            exit;
                        }

                        // store user info into session
                        $_SESSION['valid'] = true;
                        $_SESSION['timeout'] = time();
                        $_SESSION['username'] = $userId;
                        $_SESSION['upload_dir'] = $user->getUploadDir();
                        $_SESSION['thumbs_upload_dir'] = $user->getUploadTbumbDir();

                        // go to home page
                        header("Location: index.php"); 
                        exit;

                    } else {
                        $msg = 'Password is not matched';
                    }
                }
            }
         ?>
    </div>

    <div class="container">
        <div class="card card-container">
            <p id="profile-name" class="profile-name-card">SIGN UP</p>
            <br/>
            
            <?php if(!empty($msg)) { ?>
            <span class="text-danger"><?php echo $msg; ?></span>
            <?php } ?>

            <form class="form-signin" autocomplete="off" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" value="<?php echo $userId ?>" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                <input type="password" id="inputPassword" class="form-control" placeholder="Confirm Password" name="password_confirm" required>
                <button class="btn btn-lg btn-success btn-block btn-signin" type="submit" name="signup">SIGN UP</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script>
        $(document).ready(function(){ 
            $("input").attr("autocomplete", "off"); 
        });
    </script>
</body>