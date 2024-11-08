function changeMainImage(src) {
    document.getElementById("main-img").src = src;
}

function goBack() {
    window.history.back();
}

window.goBack = goBack; 
window.changeMainImage = changeMainImage;