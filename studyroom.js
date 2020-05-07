// If height of announcement smaller than 50px, add extra space before functionalities
if (document.querySelector(".info").clientHeight <= 120) {
    document.getElementById("info-space").classList.remove("not-visible");
}
else{
    document.getElementById("info-space").classList.add("not-visible");
}