document.addEventListener("DOMContentLoaded", function () {

    const loginLink2 = document.getElementById("login-link2");
    const registerLink2 = document.getElementById("register-link2");
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const profileForm = document.getElementById("profile-form");



    loginLink2.addEventListener("click", () => {

        loginForm.style.display = "block";
        registerForm.style.display = "none";

    });


    registerLink2.addEventListener("click", () => {

        registerForm.style.display = "block";
        loginForm.style.display = "none";

    });


    //////////* Global Variables *//////////

    var errorMsg0 = "Please enter characters only";
    var errorMsg1 = "Please enter 3 letters at least";
    var errorMsg2 = "Please enter valid Email";
    var errorMsg3 = "Password must be at least 8 characters";
    var errorMsg4 = "Password must contain at least 1 character & 1 digit";
    var errorMsg5 = "Doesn't Match";
    var errorMsg6 = "Please check your inputs";

    var strfirst ;
    var strlast ;
    var stremail ;
    var strpass ;
    var strcon ;

    // var globalErr = false ;

    var firstError = false ;
    var lastError = false ;
    var emailError = false ;
    var passError = false ;
    var confirmError = false ;

    //////////* Regix *//////////

    ///* Characters Only Regix *///

    function onlyLettersAndSpaces(str) {
        return /^[A-Za-z\s]{1,200}$/.test(str);
    }

    ///* Email Regix *///

    function validateEmail(email){
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return mailformat.test(email);
    }

    ///* Password Regix *///

    function validatePasswordLength(password) {
        const minLength = 8; // Minimum password length

        const isLengthValid = password.length >= minLength;

        // Return true if all length >= 8
        return (
            isLengthValid
        );


    }

    function validatePassword(password) {
        // Define the regular expressions for password validation
        // const uppercaseRegex = /[A-Z]/; // At least one uppercase letter
        // const lowercaseRegex = /[a-z]/; // At least one lowercase letter
        // const digitRegex = /[0-9]/; // At least one digit
        // const specialCharRegex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/; // At least one special character
        const digitRegex = /\d/; // At least one digit
        const charRegex = /[A-Za-z!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/; // At least one character (uppercase, lowercase, or special)

        // Check if the password meets all criteria
        // const hasUppercase = uppercaseRegex.test(password);
        // const hasLowercase = lowercaseRegex.test(password);
        // const hasDigit = digitRegex.test(password);
        // const hasSpecialChar = specialCharRegex.test(password);

        // Return true if all criteria are met, otherwise return false
        // return (
        //     hasUppercase &&
        //     hasLowercase &&
        //     hasDigit
        //     // && hasSpecialChar
        // );

        const containsDigit = digitRegex.test(password);
        const containsChar = charRegex.test(password);

        return containsDigit && containsChar;


    }



    // ///* Phone Number Regix *///

    // function validatePhone(phone){
    //     return /^010[0-9]*$/.test(phone);
    // }




    //////////////////////////////////////
    ///* First Name Validation *///

    var firstname = document.querySelector('#first');
    var firstlabel = document.querySelector('#firstlabel');

    var fnameErr = document.createElement('p');
    fnameErr.classList.add('errMsg');

    firstname.addEventListener('focusout' , (e) => {
        strfirst = e.target.value;

        if(!onlyLettersAndSpaces(strfirst)){
            firstError = true ;
            fnameErr.textContent = errorMsg0 ;
            firstname.after(fnameErr);
            if(firstname.classList.contains('myinput-success'))
                firstname.classList.remove('myinput-success');
            if(!firstname.classList.contains('myinput-err'))
                firstname.classList.add('myinput-err');
        }
        else if(Array.from(strfirst).length < 3){
            firstError = true ;
            fnameErr.textContent = errorMsg1 ;
            firstname.after(fnameErr);
            if(firstname.classList.contains('myinput-success'))
                firstname.classList.remove('myinput-success');
            if(!firstname.classList.contains('myinput-err'))
                firstname.classList.add('myinput-err');
        }
        else {
            firstError = false ;
            if(firstname.classList.contains('myinput-err')){
                firstname.classList.remove('myinput-err');
            }
            firstname.classList.add('myinput-success');
            firstname.parentNode.removeChild(fnameErr);
        }

    })

    firstname.addEventListener('focusin' , (e) => {

        firstname.classList.remove('myinput-success');
        firstname.classList.remove('myinput-err');
        firstname.parentNode.removeChild(fnameErr);

    })

    firstname.addEventListener("input", function () {
        if (firstname.value.trim() !== "") {
            if(document.body.classList.contains("dark-mode")){
                firstlabel.classList.remove("upp");
                firstlabel.classList.add("upp-dark");
            }
            else {
                firstlabel.classList.remove("upp-dark");
                firstlabel.classList.add("upp");
            }
        }
    })


    ///* End of First Name Validation *///
    //////////////////////////////////////



    //////////////////////////////////////
    ///* Last Name Validation *///

    var lastname = document.querySelector('#last');
    var lastlabel = document.querySelector('#lastlabel');


    var lnameErr = document.createElement('p');
    lnameErr.classList.add('errMsg');

    lastname.addEventListener('focusout' , (e) => {
        strlast = e.target.value;

        if(!onlyLettersAndSpaces(strlast)){
            lastError = true ;
            lnameErr.textContent = errorMsg0 ;
            lastname.after(lnameErr);
            if(lastname.classList.contains('myinput-success'))
                lastname.classList.remove('myinput-success');
            if(!lastname.classList.contains('myinput-err'))
                lastname.classList.add('myinput-err');

        }
        else if(Array.from(strlast).length < 3){
            lastError = true ;
            lnameErr.textContent = errorMsg1 ;
            lastname.after(lnameErr);
            if(lastname.classList.contains('myinput-success'))
                lastname.classList.remove('myinput-success');
            if(!lastname.classList.contains('myinput-err'))
                lastname.classList.add('myinput-err');

        }
        else {
            lastError = false ;
            if(lastname.classList.contains('myinput-err')){
                lastname.classList.remove('myinput-err');
            }
            lastname.classList.add('myinput-success');
            lastname.parentNode.removeChild(lnameErr);
        }

    })

    lastname.addEventListener('focusin' , (e) => {

            lastname.classList.remove('myinput-success');
            lastname.classList.remove('myinput-err');
            lastname.parentNode.removeChild(lnameErr);

    })

    lastname.addEventListener("input", function () {
        if (lastname.value.trim() !== "") {
            if(document.body.classList.contains("dark-mode")){
                lastlabel.classList.remove("upp");
                lastlabel.classList.add("upp-dark");
            }
            else {
                lastlabel.classList.remove("upp-dark");
                lastlabel.classList.add("upp");
            }
        }
    })


    ///* End of Last Name Validation *///
    //////////////////////////////////////

    ///////////////////////////
    ///* Email Validation *///

    var email = document.querySelector('#remail');
    var emaillabel = document.querySelector('#emaillabel');


    var emailErr = document.createElement('p');
    emailErr.classList.add('errMsg');


    email.addEventListener('focusout' , (e) => {
        stremail = e.target.value;

        if(!validateEmail(stremail)){
            emailError = true ;
            emailErr.textContent = errorMsg2 ;
            email.after(emailErr);
            if(email.classList.contains('myinput-success'))
                email.classList.remove('myinput-success');
            if(!email.classList.contains('myinput-err'))
                email.classList.add('myinput-err');

        }
        else{
            emailError = false ;
            if(email.classList.contains('myinput-err')){
                email.classList.remove('myinput-err');
            }
            email.classList.add('myinput-success');
            email.parentNode.removeChild(emailErr);
        }

    })

    email.addEventListener('focusin' , (e) => {
        email.classList.remove('myinput-success');
        email.classList.remove('myinput-err');
        email.parentNode.removeChild(emailErr);
    })

    email.addEventListener("input", function () {
        if (email.value.trim() !== "") {
            if(document.body.classList.contains("dark-mode")){
                emaillabel.classList.remove("upp");
                emaillabel.classList.add("upp-dark");
            }
            else {
                emaillabel.classList.remove("upp-dark");
                emaillabel.classList.add("upp");
            }
        }
    })

    /* End of Email Validation *///
    ///////////////////////////////

    //////////////////////////////////////
    ///* Password Validation *///

    var password = document.querySelector('#rpassword');
    var passlabel = document.querySelector('#passlabel');

    var confirm = document.querySelector('#confirm');
    var conlabel = document.querySelector('#conlabel');

    var passErr = document.createElement('p');
    passErr.classList.add('errMsg');

    var conErr = document.createElement('p');
    conErr.classList.add('errMsg');

    password.addEventListener('focusout' , (e) => {
        strpass = e.target.value;

        if(!validatePasswordLength(strpass)){
            passError = true ;
            passErr.textContent = errorMsg3 ;
            password.after(passErr);
            if(password.classList.contains('myinput-success'))
                password.classList.remove('myinput-success');
            if(!password.classList.contains('myinput-err'))
                password.classList.add('myinput-err');

        }
        else if(!validatePassword(strpass)){
            passError = true ;
            passErr.textContent = errorMsg4 ;
            password.after(passErr);
            if(password.classList.contains('myinput-success'))
                password.classList.remove('myinput-success');
            if(!password.classList.contains('myinput-err'))
                password.classList.add('myinput-err');

        }

        else if(strpass != strcon){
            confirmError = true ;
            conErr.textContent = errorMsg5 ;
            confirm.after(conErr);
            if(confirm.classList.contains('myinput-success'))
                confirm.classList.remove('myinput-success');
            if(!confirm.classList.contains('myinput-err'))
                confirm.classList.add('myinput-err');

        }
        else {
            passError = false ;
            if(password.classList.contains('myinput-err')){
                password.classList.remove('myinput-err');
            }
            password.classList.add('myinput-success');
            password.parentNode.removeChild(passErr);
        }

    })

    password.addEventListener('focusin' , (e) => {
        password.classList.remove('myinput-success');
        password.parentNode.removeChild(passErr);
        password.classList.remove('myinput-err');

    })

    password.addEventListener("input", function () {
        if (password.value.trim() !== "") {
            if(document.body.classList.contains("dark-mode")){
                passlabel.classList.remove("upp");
                passlabel.classList.add("upp-dark");
            }
            else {
                passlabel.classList.remove("upp-dark");
                passlabel.classList.add("upp");
            }
        }
    })


    ///* End of Password Validation *///
    //////////////////////////////////////


    //////////////////////////////////////
    ///* Confirm Password Validation *///



    confirm.addEventListener('focusout' , (e) => {
        strcon = e.target.value;
        // console.log(strpass);

        if(strcon != strpass){
            confirmError = true ;
            conErr.textContent = errorMsg5 ;
            confirm.after(conErr);
            if(confirm.classList.contains('myinput-success'))
                confirm.classList.remove('myinput-success');
            if(!confirm.classList.contains('myinput-err'))
                confirm.classList.add('myinput-err');

        }
        else {
            confirmError = false ;
            if(confirm.classList.contains('myinput-err')){
                confirm.classList.remove('myinput-err');
            }
            confirm.classList.add('myinput-success');
            confirm.parentNode.removeChild(conErr);
        }

    })

    confirm.addEventListener('focusin' , (e) => {
        confirm.classList.remove('myinput-success');
        confirm.parentNode.removeChild(conErr);
        confirm.classList.remove('myinput-err');

    })

    confirm.addEventListener("input", function () {
        if (confirm.value.trim() !== "") {
            if(document.body.classList.contains("dark-mode")){
                conlabel.classList.remove("upp");
                conlabel.classList.add("upp-dark");
            }
            else {
                conlabel.classList.remove("upp-dark");
                conlabel.classList.add("upp");
            }
        }
    })


    ///* End of Confirm Password Validation *///
    //////////////////////////////////////

    ///* Show Password Toggle *///
    //////////////////////////////

    // const passwordField = document.getElementById("passwordField");
    const togglePassword = document.getElementById("togglePassword");

    let isMouseDown = false;

    togglePassword.addEventListener("mousedown", function () {
      isMouseDown = true;
      password.type = "text";
    });

    togglePassword.addEventListener("mouseup", function () {
      isMouseDown = false;
      password.type = "password";
    });

    // Additional event to handle cases when the mouse leaves the icon while it's down
    togglePassword.addEventListener("mouseout", function () {
      if (isMouseDown) {
        isMouseDown = false;
        password.type = "password";
      }
    });

    ///* End of Show Password Toggle *///
    /////////////////////////////////////

    ///* Show Confirm Password Toggle *///
    //////////////////////////////

    // const passwordField = document.getElementById("passwordField");
    const toggleConPassword = document.getElementById("toggleConPassword");

    let isMouseDownCon = false;

    toggleConPassword.addEventListener("mousedown", function () {
      isMouseDownCon = true;
      confirm.type = "text";
    });

    toggleConPassword.addEventListener("mouseup", function () {
      isMouseDownCon = false;
      confirm.type = "password";
    });

    // Additional event to handle cases when the mouse leaves the icon while it's down
    toggleConPassword.addEventListener("mouseout", function () {
      if (isMouseDownCon) {
        isMouseDownCon = false;
        confirm.type = "password";
      }
    });

    ///* End of Show Confirm Password Toggle *///
    ////////////////////////////////////////////


    ////////////////////////////
    ///* Register Validation *///

    const register = document.getElementById('reg-btn');
    var regErr = document.createElement('p');
    regErr.classList.add('errMsg');

    register.addEventListener('click' , (e) => {

        // console.log(globalErr);
        console.log(fnameErr);

        if(firstError == true || lastError == true || emailError == true || passError == true || confirmError == true) {
            e.preventDefault();
            regErr.textContent = errorMsg6 ;
            registerForm.after(regErr);
            // alert("Please check your inputs ! ");
        }
        // else {


        // }
    })

    ///* End of Register Validation *///
    /////////////////////////////////


    /////////////////////
    ///* Login Form *///

    ////////////////
    ///* Email *///

    var lemail = document.querySelector('#lemail');
    var lemaillabel = document.querySelector('#lemlabel');

    lemail.addEventListener("input", function () {
        if (lemail.value.trim() !== "") {
            if(document.body.classList.contains("dark-mode")){
                lemaillabel.classList.remove("upp");
                lemaillabel.classList.add("upp-dark");
            }
            else {
                lemaillabel.classList.remove("upp-dark");
                lemaillabel.classList.add("upp");
            }
        }
    })

    /* End of Email *///
    ///////////////////

    ///////////////////
    ///* Password *///

    var lpassword = document.querySelector('#lpassword');
    var lpasslabel = document.querySelector('#lpasslabel');

    lpassword.addEventListener("input", function () {
        if (lpassword.value.trim() !== "") {
            if(document.body.classList.contains("dark-mode")){
                lpasslabel.classList.remove("upp");
                lpasslabel.classList.add("upp-dark");
            }
            else {
                lpasslabel.classList.remove("upp-dark");
                lpasslabel.classList.add("upp");
            }
        }
    })

    /* End of Password *///
    //////////////////////

    // // Read the dark mode cookie
    // const cookies = document.cookie.split("; ");
    // for (const cookie of cookies) {
    //     const [name, value] = cookie.split("=");
    //     if (name === "darkMode") {
    //         if (value === "true") {
    //             body.classList.add("dark-mode");
    //         }
    //         // break;
    //     }
    // }

});
