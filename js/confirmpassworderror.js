function passwordValidate(form){
    let password1=form.password.value;
    let password2=form.confirmPassword.value;

    if(password1!=password2){
        document.getElementById("errorMessage1").textContent = "Passwords are different";
        setTimeout(() => {
            document.getElementById("errorMessage1").textContent = "";
        }, 3000);
        return false;
    }else{
        return true;
    }
}