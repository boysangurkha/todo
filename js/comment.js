document.querySelector("#btnAddComment").addEventListener("click", function(){
    
    let taskId = this.dataset.taskid;
    let comment = document.querySelector("#commentText").value;

    let formData = new FormData();
    formData.append("comment", comment);
    formData.append("taskId", taskId);

    fetch("ajax/savecomment.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            console.log("Succes:", result);
            var ul = document.getElementById("list");
            ul.innerHTML += '<li>'+ result["comment"] +'</li>';
        });
});