
//import {affiche} from '/httpRequest.js';

const url = location.protocol + "//" + location.host + "/";
let htmlParent = null;

function deleteUser(parent) {
    let uri = url + "userdelete/";
    let id = parent.getAttribute("data-id-user");
    htmlParent = parent.parentNode.parentNode; //get the <tr> of the user

    //let data = `id=${id}`;
    let data = '?id='+id;
    ajaxRequest(uri, "DELETE", data, deleteUserAnswer, true);
}

function deleteUserAnswer(req) {
    alertMessage(req.responseText);
    htmlParent.remove();
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
                success(null, request);
            }
        };
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send(data);

    }
}