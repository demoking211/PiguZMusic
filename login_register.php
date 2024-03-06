<?php

require_once 'includes/config.php';

if(isset($_SESSION["user_id"]))
{
    header('Location: index.php');
    exit;
}
else
{
    require_once 'includes/login_view.inc.php';
    require_once 'includes/signup_view.inc.php';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login_register.css">
    <?php require 'includes/cdn_linker.php';?>
</head>
<body>
    <div class="main_wrapper">
        <?php
        
        if(isset($_GET["signup"]) && $_GET["signup"] == "failed")
        {
            echo '<div class="login_form animate__animated animate__zoomIn d-none">';
        }
        else
        {
            echo '<div class="login_form animate__animated animate__zoomIn">';
        }
        ?>
        
            <div class="form_box text-white">
                <form action="includes/login.inc.php" method="POST" onsubmit="return validateLoginForm()">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form_block col-12">
                                <h1>LOGIN</h1>
                                <p>Welcome Back! Please Log In Here.</p>
                            </div>
                            <div class="form_block col-12">
                                <input type="text" id="username" name="username" placeholder="Username">
                            </div>
                            <div class="form_block col-12">
                                <input type="password" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="form_block col-12">
                                <input class="main_btn" type="submit" name="login" value="LOGIN" onclick="validateLoginForm()">
                            </div>
                            <div class="form_block col-12">
                                <input type="checkbox" id="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container-fluid layout_style_01">
                    <div class="row">
                        <div class="form_block col-12 col-lg-6">
                            <input class="main_btn" type="button" name="switchRegistration" value="REGISTRATION" onclick="switchForm()">
                        </div>
                        <div class="form_block col-12 col-lg-6">
                            <input class="main_btn" type="button" name="forget_password" value="FORGET PASSWORD" onclick="location.href='forgetPassword.php'">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        
        if(isset($_GET["signup"]) && $_GET["signup"] == "failed")
        {
            echo '<div class="register_form animate__animated animate__bounceInUp">';
        }
        else
        {
            echo '<div class="register_form d-none animate__animated animate__bounceInUp">';
        }
        ?>
            <div class="form_box register text-white">
                <form action="includes/signup.inc.php" method="POST" id="registrationForm" onsubmit="return validateRegisterForm()">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form_block col-12">
                                <h1>Registration</h1>
                                <p>First User? Don't worry, you can now create your own</p>
                            </div>
                            <?php echo signup_inputs(); ?>
                            <div class="form_block col-12">
                                <input type="checkbox" id="agree">
                                <label for="agree">I agree to terms and agreement and private policy</label>
                            </div>
                            <div class="form_block col-12">
                                <div class="btn-group gap-3">
                                    <input class="main_btn" type="button" name="switchLogin" value="BACK TO LOGIN" onclick="switchForm()">
                                    <input class="main_btn" type="submit" name="validateRegister" value="REGISTER" onclick="validateRegisterForm()">
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php echo login_errors(); ?>
        <?php echo signup_errors(); ?>
    </div>
    <script src="js/login_register.js"></script>
</body>
</html>