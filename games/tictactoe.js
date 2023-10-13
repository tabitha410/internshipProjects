$(document).ready(function(){


    // $("#info").text("Welcome Tabitha")
    $("#info").attr("style", "color:green;font-size:28px;font-family:cursive;");
    $("#info").show()

    $(".col-4").attr("style", "height:50px;border:2px solid green;")
    $(".col-4").on("click", function(evt){
        evt.preventDefault()
        $(this).html("<span style='font-size:30'>X</span>")
    })
    // $("#personname").val("Tabitha")        //to put like a placeholder text i guess

    $("#displayname").click(function(){
        let personname = $("#personname").val();
        $("#info").text("Welcome," + " " + personname + "!")
    })

})