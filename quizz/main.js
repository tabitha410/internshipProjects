let answer = document.querySelectorAll('[data-ans]');
let doneBtn = document.getElementById("submitBtn");
let displayScore = document.getElementById("display");
let textDisplay = document.getElementById("text");
let viewbtnDisplay = document.getElementById("viewBtn");

let displayCheck = document.querySelectorAll('.checkmark');
let displayCross = document.querySelectorAll('.crossmark');
let radioBtn = document.querySelectorAll("input[type='radio']");

let score = 0;
let answersClicked = {};

answer.forEach(radiobtn => {
    radiobtn.addEventListener('click',() =>{

        let question = radiobtn.getAttribute('name');

        if (!answersClicked[question]){     
            score += 1;
            console.log(score);
            answersClicked[question] = true;
        }
    })
})

doneBtn.addEventListener('click', () => {
    displayScore.innerHTML = "Score: " + score + "/10";

    if(score>=0 && score<=4){
        textDisplay.innerHTML = "Better luck next time!";
        displayScore.style.color = "red";
    } else if(score>=5 && score<=7){
        textDisplay.innerHTML = "Good job!";
        displayScore.style.color = "blue";
    } else{
        textDisplay.innerHTML = "Excellent!";
        displayScore.style.color = "green";
    }

    let viewBtn = document.createElement("button");
    viewBtn.textContent = "view results";
    viewBtn.className = "view";
    viewbtnDisplay.appendChild(viewBtn);

    viewBtn.addEventListener('click', () => {
        displayCheck.forEach(displayCheck => {
            displayCheck.style.display = "inline";
        });
        // radioBtn.forEach(Button => {
        //     if(Button.checked && !answer){
        //         console.log("wrong");
        //     }
        // });
    });
    
    doneBtn.disabled = true;
})

$(document).ready(function() {
    $('#doneBtn').click(function() {
        $('#displayScore').html("Score: " + score + "/10");

        if (score >= 0 && score <= 4) {
            $('#textDisplay').html("Better luck next time!");
            $('#displayScore').css('color', 'red');
        } else if (score >= 5 && score <= 7) {
            $('#textDisplay').html("Good job!");
            $('#displayScore').css('color', 'blue');
        } else {
            $('#textDisplay').html("Excellent!");
            $('#displayScore').css('color', 'green');
        }

        let viewBtn = $("<button></button>").text("view results").addClass("view");
        $('#viewbtnDisplay').append(viewBtn);

        viewBtn.click(function() {
            $('.displayCheck').css('display', 'inline');
            
        });

        $('#doneBtn').prop('disabled', true);
    });
});




