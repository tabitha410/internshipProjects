function getRandomNumber(min,max){
    let Num = Math.floor(Math.random()* (max - min + 1)) + min;
    return Num;
}
let randomNum = getRandomNumber(1,100);
console.log(randomNum);
wait60secs()
let interval;
function wait60secs(){
    interval = setInterval(message, 6000);
}
function message(){
    // console.log("Time Up!");
    console.log(randomNum);
    location.reload()
}
            // const hint = document.querySelector("hint");
            // hint.replaceChildren()
            // hint.innerHTML = "";