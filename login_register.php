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
        <div class="login_form animate__animated animate__zoomIn">
            <div class="form_box text-white">
                <form action="" method="POST" onsubmit="return validateLoginForm()">
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
                                <input type="text" id="password" name="password" placeholder="Password">
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
        <div class="register_form d-none animate__animated animate__bounceInUp">
            <div class="form_box register text-white">
                <form action="" method="POST" id="registrationForm" onsubmit="return validateRegisterForm()">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form_block col-12">
                                <h1>Registration</h1>
                                <p>First User? Don't worry, you can now create your own</p>
                            </div>
                            <div class="form_block col-12 col-lg-6 pe-1">
                                <input type="text" id="reg_username" name="username" placeholder="Username">
                            </div>
                            <div class="form_block col-12 col-lg-6 ps-1">
                                <input type="text" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="form_block col-12 col-lg-6 pe-1">
                                <input type="text" id="reg_password" name="password" placeholder="Password">
                            </div>
                            <div class="form_block col-12 col-lg-6 ps-1">
                                <input type="text" id="cpassword" name="cpassword" placeholder="Confirm Password">
                            </div>
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
        <div id="error-area" class="alert alert-danger fade d-flex align-items-center" role="alert">
            <i class="fa fa-exclamation-triangle me-2" aria-hidden="true"></i>
            <div class="error-message"></div>
        </div>  
    </div>
    <script src="js/login_register.js"></script>
</body>
</html>