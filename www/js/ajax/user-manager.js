let htmlParent = null;

function deleteUser(parent) {
    let uri = url + "userdelete/";
    let id = parent.getAttribute("data-id-user");
    let data = '?id='+id;

    htmlParent = parent.parentNode.parentNode; //get the <tr> of the user

    ajaxRequest(uri, "DELETE", data, deleteUserAnswer, true);
}

function updateRank(parent) {
    let uri = url + "updaterank/";
    let id = parent.getAttribute("data-id-user");
    let data = `id=` + encodeURIComponent(id);

    htmlParent = parent.parentNode.parentNode; //get the <tr> line of the user

    ajaxRequest(uri, "POST", data, updateRankAnswer, true);
}

function deleteUserAnswer(req) {
    alertMessage(req.responseText);
    if(req.responseText === "user deleted successfully"){
        htmlParent.remove();
    }
}

function updateRankAnswer(req) {
    let childHtml = htmlParent.children;
    alertMessage(req.responseText);

    if(req.responseText === "rank updated"){
        let rankLine = childHtml[4].children;

        if(rankLine[0].innerHTML === "user")
            rankLine[0].innerHTML = "admin";
        else
            rankLine[0].innerHTML = "user";
    }
}

