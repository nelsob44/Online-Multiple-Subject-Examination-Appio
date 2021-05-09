function checkValidity() {
    alert('Clicked here');
}


function toggleSignup() {
    if($('#loginButton').val() == 0) {
        $('#firstnameDiv').show();
        $('#lastnameDiv').show();
        $('#confirmPasswordDiv').show();
        $('#loginButton').val('1');
        $('#loginButton').html('Sign Up');
        $('#toggleMessage').html('<a href="#">Click here to revert to Login if you are already registered</a>');
    }
    else
    {
        $('#firstnameDiv').hide();
        $('#lastnameDiv').hide();
        $('#confirmPasswordDiv').hide();
        $('#loginButton').val('0');
        $('#loginButton').html('Log In');
        $('#toggleMessage').html('<a href="#">If you don\'t already have an account, click here to sign up</a>');
    }
}


function isValidProductCode(product_code) {
    

}

