
document.querySelector(".btn-sign").onclick = function(){
    document.getElementById("login-title").innerHTML = "Sign Up Today for Free!";
    document.getElementById("sign-form").classList.remove("not-visible");
    document.getElementById("log-container").classList.add("not-visible");
}

document.querySelector(".btn-login").onclick = function(){
    document.getElementById("login-title").innerHTML = "Welcome Back!";
    document.getElementById("log-container").classList.remove("not-visible");
    document.getElementById("sign-form").classList.add("not-visible");
}

let sign_form = document.getElementById("sign-submit");

sign_form.onclick = function(event){
    if($("#password").val() != $("#passconf").val()){
        event.preventDefault();
        alert("Two password entries not identical.");
    }
}
