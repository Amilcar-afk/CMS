
function searchUser(){
    let uri = url + "searchUser/";
    let inputText = document.getElementById("userSearch").value;
    let data = '?str='+inputText;
    ajaxRequest(uri, "GET", data, displayUserSearch, true);
}

function displayUserSearch(req){
    alertMessage(req.responseText);
}