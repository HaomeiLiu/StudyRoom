var displayError = function() {
    document.getElementById("to-login").classList.remove("not-visible");
}

avatarBtns = document.querySelectorAll(".pic-btn");
avatarBtns[0].onclick = function(){
    avatarBtns[0].
    classList.add("selected");
    avatarBtns[1].classList.remove("selected");
    $("#avatar-num").val(1);
}
avatarBtns[1].onclick = function(){
    avatarBtns[1].classList.add("selected");
    avatarBtns[0].classList.remove("selected");
    $("#avatar-num").val(2);
    console.log($("#avatar-num").val());
}
