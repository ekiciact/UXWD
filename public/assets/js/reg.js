$(document).ready(function() {
    M.updateTextFields();
});


//toggle the password fields
let clicked = 0;

function togglePassword(){
let icon = document.querySelectorAll(".toggle-password");
let pass = document.querySelectorAll(".passwords");

    if (clicked == 0) {
        for (let i = 0; i < icon.length; i++) {
            icon[i].innerHTML = "<span class=\"material-icons\">visibility</span >";
            pass[i].type = "text";
        }
        clicked = 1;
        console.log('1')
    } else {
        for (let i = 0; i < icon.length; i++) {
            icon[i].innerHTML = "<span class=\"material-icons\">visibility_off</span >"
            pass[i].type = "password";
            clicked = 0;
        }

        console.log("2")
    }
}