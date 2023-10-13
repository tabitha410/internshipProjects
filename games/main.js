// function getRandomNumber(min,max){
//     let Num = Math.floor(Math.random()* (max - min + 1)) + min;
//     return Num;
// }
// let randomNum = getRandomNumber(1,100);
// console.log(randomNum);
// wait60secs()
// let interval;
// function wait60secs(){
//     interval = setInterval(message, 6000);
// }
// function message(){
//     // console.log("Time Up!");
//     console.log(randomNum);
//     location.reload()
// }


let time = 0;
let randomNum = getRandomNumber();

function getRandomNumber(){
    return Math.floor(Math.random() * 100) + 1;
}

function changeRandomNum(){
    const currTime = new Date().getTime();

    if (currTime - time >= 60000){
        time = currTime;
        randomNum = getRandomNumber();
        console.log(randomNum);
    }
    requestAnimationFrame(changeRandomNum);
}
changeRandomNum();



let guessButton = document.getElementById("guessButton");
let guessNumber = document.getElementById("guessNumber");
let i = 0
guessNumber.addEventListener("click", () => {
    hint.innerHTML = ""
    let info = document.getElementById("info")
    let guess = document.getElementById("userNumber").value
    let numGuess = parseInt(guess);
    console.log(numGuess)
    if (!isNaN(numGuess)) {
        console.log("You guessed: " + numGuess);
    } else {
        console.log("Invalid input. Please enter a valid number.");
    }

    i++
    if(i<4){
    
        if (randomNum != numGuess){
            // alert("Try again")
            info.innerHTML = "<p>Try again</p><p>Guess a number between 1 and 100:</p>"
            info.innerHTML = "<p>Try again. Chances left:</p>"+ (4-i)

        } else if (randomNum == numGuess){

            info.innerHTML ="<h3>You guessed correctly!</h3><p> Click the start now button to play again</p>"
            clearInterval(thisInterval)
            document.getElementById("timer").value = "0"
        }
    } else {
        info.innerHTML ="<h3>You have used up your chances!</h3><p> Click the start now button to play again</p>"
    }; 
        if (randomNum > numGuess ){
            hint.innerHTML = "<h4><p>hint: the number is higher than your guess</p></h4>"
        }
        if (randomNum < numGuess){
            hint.innerHTML = "<h4><p>hint: the number is less than your guess</p></h4>"

        }
})


let thisInterval = null
guessButton.addEventListener("click", () => {
    let info = document.getElementById("info")
    info.innerHTML = "<p>Guess a number between 1 and 100:</p>"
    i=0
    if(thisInterval!=null){
        clearInterval(thisInterval)
    }
    thisInterval = setInterval(function(){
        let inputtimer = document.getElementById("timer")
        let second = inputtimer.value
        second = parseInt(second)
        second++
        inputtimer.value = second
        if(second == 60){
            clearInterval(thisInterval)
            let info = document.getElementById("info")
            info.innerHTML = "<h4>You Failed! Try Again</h4><p>Guess a number between 1 and 100:</p>"
            inputtimer.value = "0"
            randomNum = getRandomNumber();
        }
    }, 1000);
});

