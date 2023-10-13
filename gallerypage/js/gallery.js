function gallery(images){
    let biggerimg = document.getElementById("biggerimg");
    biggerimg.src = images.src;
    biggerimg.parentElement.style.display = "block";

    let img = document.getElementById("img1");
    let closebtn = document.getElementById("closebtn");
    img.addEventListener("click",function(){
        closebtn.style.opacity = "1.0";


    })
}