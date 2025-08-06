<?php
session_start();
include_once 'setup.php';
$username = isset($_COOKIE["username"]) ? $_COOKIE["username"] : "";
$password = isset($_COOKIE["password"]) ? $_COOKIE["password"] : "";
?>

<!DOCTYPE html>
<html class="login">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <title>Synrgise - Innovate Learning</title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/core.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/components.css" rel="stylesheet" type="text/css">
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
        <link href="assets/css/elements.css" rel="stylesheet" type="text/css">

        <script src="assets/js/modernizr.min.js"></script>


        
    </head>
    <body>


        <div class="wrapper-page">
            <div class="panel-pages login">
                <div class="panel-body">
                    <div class="logo text-center m-b-20"> 
                        <a href="#"><img src="assets/images/synrgise-logo-white.png"></a>
                    </div> 
                    <form class="form-horizontal m-t-20" action="login.php" method="POST">
                        
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" type="text" name="username" required placeholder="Username" value="<?php echo $username; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" type="password" name="password" required placeholder="Password" value="<?php echo $password; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-md-8">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-signup" type="checkbox" name="remember_me">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <button class="btn btn-black btn-block waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>

                        <div class="form-group m-t-30">
                            <div class="col-sm-7">
                                <a href="forgot_password.html"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                            </div>
                            <div class="col-sm-5 text-right">
                                <a href="register.html">Create an account</a>
                            </div>
                        </div>
                    </form> 
                </div>     
            </div>
        </div>

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- Main  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

	
	</body>
</html>