const url = location.protocol + "//" + location.host + "/";

function searchUser(){
    let uri = url + "searchUser/";
    ajaxRequest(uri, "GET", data, deleteUserAnswer, true);
}

function ajaxRequest(uri ,method, data, onSuccess, async = true) {
    let request = new XMLHttpRequest();

    if (method === "GET" || method === "DELETE"){
        request.open(method, uri + data, async);

        request.onreadystatechange = function () {
            if(request.readyState === 4 && request.status === 200){
                onSuccess(request);
            }
        };

        request.send();

    }else if (method === "POST" || method === "PUT") {
        request.open(method, uri, async);

        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                onSuccess(request);
            }
        };
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send(data);

    }
}