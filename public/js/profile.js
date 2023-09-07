document.addEventListener("DOMContentLoaded", function () {
    ///* Show Password Toggle *///
    //////////////////////////////

    const password = document.getElementById("new_pass");
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
    // //////////////////////////////

    // const confirm = document.getElementById("confirm");
    // const toggleConPassword = document.getElementById("toggleConPassword");

    // let isMouseDownCon = false;

    // toggleConPassword.addEventListener("mousedown", function () {
    //   isMouseDownCon = true;
    //   confirm.type = "text";
    // });

    // toggleConPassword.addEventListener("mouseup", function () {
    //   isMouseDownCon = false;
    //   confirm.type = "password";
    // });

    // // Additional event to handle cases when the mouse leaves the icon while it's down
    // toggleConPassword.addEventListener("mouseout", function () {
    //   if (isMouseDownCon) {
    //     isMouseDownCon = false;
    //     confirm.type = "password";
    //   }
    // });

    // ///* End of Show Confirm Password Toggle *///
    // ////////////////////////////////////////////

});
