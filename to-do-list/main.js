function addTask(){
    let taskInput = document.getElementById("tasks");
    let getTask = taskInput.value;

    if (getTask == ""){
        let info = document.getElementById("info");
        info.innerHTML = "Please enter a task!";
        return;
    } else {
        info.innerHTML = "";
    }

    let to_doList = document.getElementById("to_do_list");
    let taskItem = document.createElement("li");
    taskItem.className = "to_do_item";

    let getTaskElement = document.createElement("span");
    getTaskElement.innerText = getTask;

    let checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.addEventListener("click",() => {
        if(checkbox.checked){
            getTaskElement.style.textDecoration = "line-through";
        } else{
            getTaskElement.style.textDecoration = "none";
        }
    })

    let closebtn = document.createElement("button");
    closebtn.innerText = "X";
    closebtn.addEventListener("click", () => {
        to_doList.removeChild(taskItem);
    })

    taskItem.appendChild(checkbox);
    taskItem.appendChild(getTaskElement);
    taskItem.appendChild(closebtn);

    to_doList.appendChild(taskItem);
    taskInput.value = "";
}