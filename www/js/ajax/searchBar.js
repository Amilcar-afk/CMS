
function searchUser(){
    let uri = url + "searchUser/";
    let inputText = document.getElementById("userSearch").value;
    let data = '?str='+inputText;
    ajaxRequest(uri, "GET", data, displayConsole, true);
}

function displayConsole(){
    console.log("lets gooo");
}