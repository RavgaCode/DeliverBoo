var password = document.getElementById("password"),
    confirm_password = document.getElementById("password-confirm");

function validatePassword() {
    if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
        confirm_password.setCustomValidity("");
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

function validateCheckboxes() {
    let checkboxes = document.getElementsByName("categories[]");
    let isChecked = false;

    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            isChecked = true;
            break;
        }
    }
    if (isChecked == false) {
        alert("Please select at least one category");
        return false;
    }
    return true;
}
