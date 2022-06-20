
//import {affiche} from '/httpRequest.js';

const url = location.protocol + "//" + location.host + "/";

function deleteUser(parent) {
    let uri = url + "userdelete/";
    let id = parent.getAttribute("data-id-user");
    //let data = `id=${id}`;
    let data = '?id='+id;
    console.log(data);
    ajaxRequest(uri, "DELETE", data, true);
}

function ajaxRequest(uri ,method, data, success, async = true) {
    let request = new XMLHttpRequest();

    if (method === "GET" || method === "DELETE"){
        request.open(method, uri + data, async);

        request.onreadystatechange = function () {
            if(request.readyState === 4 && request.status === 200){
                console.log(request.responseText);
            }
        };

        request.send();

    }else if (method === "POST" || method === "PUT") {
        request.open(method, uri, async);

        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                console.log(request.responseText);
            }
        };
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send(data);

    }
}