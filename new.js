document.querySelector(".slider").oninput = function(){
    console.log("change");
    document.querySelector(".slider-value").innerHTML = this.value;
}