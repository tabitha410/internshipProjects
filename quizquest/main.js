$(document).ready(function(){
    let examquestions = [
        {"question":"In which continent is Nigeria located?",
        "answers":[{answer:"Africa",score:1},{answer:"Europe",score:0},{answer:"Asia",score:0},{answer:"Ekosodin",score:0}]},
        {"question": "How many states does Nigeria comprise?",
        "answers":[{answer:34,score:0},{answer:35,score:0},{answer:36,score:1},{answer:37,score:0}]},
        {"question":"When did Nigeria become independent?",
        "answers":[{answer:"1945",score:0},{answer:"1948",score:0},{answer:"1955",score:0},{answer:"1960",score:1}]},
        {"question":"What is the official language of Nigeria?",
        "answers":[{answer:"English",score:1},{answer:"Igbo",score:0},{answer:"Hausa",score:0},{answer:"Chinese",score:0}]},
        {"question":"What is the capital city of Nigeria?",
        "answers":[{answer:"Benue",score:0},{answer:"Abuja",score:1},{answer:"Kano",score:0},{answer:"Abia",score:0}]},
        {"question":"Due to its large population and economy, what is Nigeria often referred to as?",
        "answers":[{answer:"The Giant of Africa",score:1},{answer:"The Capital of Africa", score:0},{answer:"The Big Country", score:0},{answer:"The Mighty Continent",score:0}]},
        {"question":"What is the largest city of Nigeria?",
        "answers":[{answer:"Ibadan",score:0},{answer:"Jos",score:0},{answer:"Dakar",score:0},{answer:"Lagos",score:1}]},
        {"question":"What is the currency of Nigeria?",
        "answers":[{answer:"Rand",score:0},{answer:"Pound",score:0},{answer:"Naira",score:1},{answer:"Dollar",score:0}]},
        {"question": "When is National Day in Nigeria?",
        "answers":[{answer:"7 June",score:0},{answer:"1 October",score:1},{answer:"2 May",score:0},{answer:"14 June",score:0}]},
        {"question": "Which region declared its independence from Nigeria in 1967 and was unsuccessful?",
        "answers":[{answer:"Biafra",score:1},{answer:"Calabar",score:0},{answer:"Sapele",score:0},{answer:"Oredo",score:0}]},
    
    ];
    
    console.log(examquestions)
    let questions = ``
    let title = ``
    let submitBtn = ``
    

    $.each(examquestions, function(key, val){
        console.log(val.question)
        console.log(val.answers)
        questions += "<p>" + (key + 1) + ". " + val.question + "</p><ul style='list-style-type: none'>"
        let counter = 0
        val.answers.forEach(element => {
            console.log(element)
            questions += `<li><input type="radio" class="answertext"  id="answer_` + key + "_" + counter + `"name="answer_` + key + `" value="` + element.score + `"> ` + element.answer + `</li>`
            counter++
        });
        questions += "</ul><br>"
    }) 

    title += "<h1>Quiz!</h1>"
    submitBtn += "<button id='submit'>Submit</button>"
    console.log(questions)
    console.log(title)
    $("#questions").html(questions)
    $("#info").html(title)
    $("#submitBtn").html(submitBtn)

    $("#submitBtn").click(function() {
        let score = 0;

        $(".answertext:checked").each(function() {
            score += parseInt($(this).val());
        });

        $("#displayscore").html("Score: " + score + "/10");
        
        if (score >= 0 && score <= 4){
            $("#textdisplay").html("Better luck next time!");
            $("#displayscore").css("color","red");
        } else if(score >= 5 && score <=7){
            $("#textdisplay").html("Good job!");
            $("#displayscore").css("color","blue");
        }else{
            $("#textdisplay").html("Excellent!");
            $("#displayscore").css("color","green");
        }

    });

});



