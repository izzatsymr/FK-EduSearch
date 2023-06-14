var clients = document.getElementById('clients');
var services = document.getElementById('services');

clients.addEventListener('click', function () {
    $(clients).toggleClass("active");
    $(".parent:not(#clients)").toggleClass("invisible");
}, false);

services.addEventListener('click', function () {
    $(services).toggleClass("active");
    $(".parent:not(#services)").toggleClass("invisible");
}, false);

function displayEditPopup(id, answerId, questionId, username, type, description, createdAt, status) {
    var editPopup = document.getElementById("editPopup");
    editPopup.style.display = "block";

    var editPageUrl = "complaint-edit-view.php?id=" + id + "&answer_id=" + answerId + "&question_id=" + questionId + "&username=" + username + "&type=" + type + "&description=" + description + "&created_at=" + createdAt + "&status=" + status;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", editPageUrl, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var editPopupContent = document.querySelector(".edit-popup-content");
            editPopupContent.innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function closeEditPopup() {
    var editPopup = document.getElementById("editPopup");
    editPopup.style.display = "none";
}
