document.addEventListener("DOMContentLoaded", () => {
    calcContentItem();
});

function allowDrop(ev) {
    ev.preventDefault();
}
  
function drag(ev) {
    ev.dataTransfer.setData("MyTodo", ev.target.id);
    resetStyle(ev, "drag");
    document.getElementById(ev.target.id).style.cursor = "-webkit-grabbing";
    calcContentItem();
}
  
function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("MyTodo");
    
    if(ev.target.className == "content"){
        ev.target.appendChild(document.getElementById(data));
    }
    resetStyle(data, "drop");
    calcContentItem();
}

function calcContentItem() {
    document.getElementById("counter_todo").innerHTML = document.querySelectorAll("#mainBox_todo .todoBox").length;
    document.getElementById("progress_todo").innerHTML = document.querySelectorAll("#mainBox_progress .todoBox").length;
    document.getElementById("completed_todo").innerHTML = document.querySelectorAll("#mainBox_completed .todoBox").length;
}

function resetStyle(target, status) {
    if(status == "drag") {
        target.target.style.boxShadow = "0rem 0rem 0.5rem 0.5rem grey";
    } else if(status == "drop") {
        document.getElementById(target).style.boxShadow = "0rem 0rem 0.5rem 0.2rem lightgrey";
    }
    document.querySelectorAll(".todoBox").forEach(element => {
        element.style.cursor = "-webkit-grab";
    });
}