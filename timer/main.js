let totalSecs;
let countdownInterval;
let currentCountdownTime;
let currentTime_stopbtn;


let hourInput = document.getElementById("hours");
let minutesInput = document.getElementById("minutes");
let secInput = document.getElementById("seconds");
let startButton = document.getElementById("startButton");
let stopButton = document.getElementById("stopButton");
let countdownDisplay = document.getElementById("display");
let display_stopbtn = document.getElementById("info");
let pauseButton = document.getElementById("pauseButton");
let resumebtnDisplay = document.getElementById("resumebtn");


function startCountdown(){
    let hours = parseInt(hourInput.value) || 0;
    let minutes = parseInt(minutesInput.value) || 0;
    let seconds = parseInt(secInput.value) || 0;

    totalSecs = hours*3600 + minutes * 60 + seconds;
    
    countdownInterval = setInterval(updateCountdown, 1000);
    toggleInputs(true);
    resumebtnDisplay.innerText = "";
    countdownDisplay.style.color = "black";
    display_stopbtn.style.color = "white";
    pauseButton.disabled = false;
}

function stopTimer(){
    clearInterval(countdownInterval);
    toggleInputs(false);
    currentTime_stopbtn = countdownDisplay.innerText;
    console.log(currentTime_stopbtn);
    
    display_stopbtn.innerText = "00:00:00";
    display_stopbtn.style.color = "black";
    
    resumebtnDisplay.innerText = "";
    pauseButton.disabled = false;
}

function pauseTimer(){
    clearInterval(countdownInterval);
    toggleInputs(true);
    pauseButton.disabled = true;

    countdownDisplay.style.color = "black";
    display_stopbtn.style.color = "white";

    let resumebtn = document.createElement("button");
    resumebtn.innerText = "Resume";
    resumebtn.addEventListener("click", function() {
        resumeCountdown();
        resumebtnDisplay.innerText = "";
        toggleInputs(true);
        pauseButton.disabled = false;
    })
    resumebtnDisplay.appendChild(resumebtn);

    function resumeCountdown(){
        countdownInterval = setInterval(updateCountdown, 1000);
        countdownDisplay.style.color = "black";
        display_stopbtn.style.color = "white";
    }
}

function updateCountdown(){
    if (totalSecs <= 0){
        stopTimer();
        countdownDisplay.textContent = "Countdown Completed!";
    } else {
        let remHours = Math.floor(totalSecs / 3600);
        let remMins = Math.floor((totalSecs % 3600) / 60);
        let remSecs = totalSecs % 60;

        countdownDisplay.textContent = `${timeDisplay(remHours)}:${timeDisplay(remMins)}:${timeDisplay(remSecs)}`;
        totalSecs--;
    }
}

function timeDisplay(time){
    return time < 10 ? `0${time}`: time;
}

function toggleInputs(disabled){
    hourInput.disabled = disabled;
    minutesInput.disabled = disabled;
    secInput.disabled = disabled;
    stopButton.disabled = !disabled;
    startButton.disabled = disabled;
}

pauseButton.addEventListener("click",() =>{
    pauseTimer();
    currentCountdownTime = countdownDisplay.innerText;
    console.log(currentCountdownTime);
})

stopButton.addEventListener("click", ()=> {
    stopTimer();
    
    countdownDisplay.style.color = "white"

})

startButton.addEventListener("click", startCountdown);






