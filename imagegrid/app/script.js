
$(document).ready(function () {
    let readfile = "readfile";
    $.post("api/read.php", { readfile: readfile }, function (data) {
      console.log(data);
  
      let files = JSON.parse(data);
      console.log(files);
      let display_images_first = '';
      let display_images_second = '';
      let display_images_third = '';
      let display_images_fourth = '';
      let count = 0;
  
      for (let i = 0; i < files.length; i++) {
        const element = files[i];
  
        if (element != "." && element != "..") {
          console.log(element);
  
          if (count < 10) {
        
            display_images_first += `
              <img src="images/${element}" class="img-fluid">`;
          } else if (count >= 10 && count < 21) {
        
            display_images_second += `
              <img src="images/${element}" class="img-fluid">`;
          } else if(count >= 21 && count < 32){

            display_images_third += `
            <img src="images/${element}" class="img-fluid">`;
          } else if (count >= 32 && count < 43){

            display_images_fourth += `
            <img src="images/${element}" class="img-fluid">`;
          }
  
          count++;
  
          if (count === 44) {
            break;
          }
        }
      }
  
      console.log(display_images_first);
      console.log(display_images_second);
  
      $(".firstimages").html(display_images_first);
      $(".secondimages").html(display_images_second);
      $(".thirdimages").html(display_images_third);
      $(".fourthimages").html(display_images_fourth);
    });
  });
  
// let img = document.getElementById("images");
// let onebtn = document.getElementById("btn");
// onebtn.addEventListener("click",function(){
//     img.style.height = "500px";
//     img.style.width = "500px";

// })


