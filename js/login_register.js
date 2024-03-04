function errorMessage(message) {
    var errorMessage = $('#login-error-messages'),
        errorArea = $('#login-error-area');

    errorMessage.html(message);
    errorArea.addClass("show");

    setTimeout(() => {
        errorArea.removeClass("show");
    }, 3000);
}

function switchForm() {
    console.log("switchForm");

    let registerForm = $('.register_form'),
        loginForm = $('.login_form'),
        loginErrorArea = $('#login-error-area'),
        signupErrorArea = $('#signup-error-area');

    registerForm.toggleClass("d-none");
    loginForm.toggleClass("d-none");
    if(loginForm.attr('class').indexOf('d-none') !== -1)
    {
        loginErrorArea.removeClass("show");
        if(signupErrorArea.html().trim() === '')
        {
            signupErrorArea.addClass("show");
        }
    }
    else
    {
        if(loginErrorArea.html().trim() === '')
        {
            loginErrorArea.addClass("show");
        }
        signupErrorArea.removeClass("show");
    }
}

function validateLoginForm() {
    console.log("validateLoginForm");

    var username = $('#username'),
        password = $('#password');

    if (!username.val()) {
        errorMessage("Please enter a username.");
        return false;
    }

    else if (!password.val()) {
        errorMessage("Please enter a password.");
        return false;
    }

    return true;
}

function validateRegisterForm() {
    console.log("validateRegisterForm");

    var rusername = $('#reg_username'),
        email = $('#email'),
        rpassword = $('#reg_password'),
        cpassword = $('#cpassword'),
        agreement = $('#agree');

    if (!rusername.val()) {
        errorMessage("Please enter a username.");
        return false;
    }

    else if (!email.val()) {
        errorMessage("Please enter a email.");
        return false;
    }

    else if (!rpassword.val()) {
        errorMessage("Please enter a password.")
        return false;
    }

    else if (!cpassword.val()) {
        errorMessage("Please confirm your password.");
        return false;
    }

    else if (rpassword.val() !== cpassword.val()) {
        errorMessage("Password and confirm password do not match.");
        return false;
    }

    else if (!agreement.prop("checked")) {
        errorMessage("Please agree to the terms and policy.");
        return false;
    }
    
    return true; 
}
