
const userSelected = document.getElementById("selectUsers");
const divUsersSelected = document.getElementById("divUserSearch");

userSelected.addEventListener("change", () => {

    let userSelectedIndex = userSelected.selectedIndex;
    let userSelectedOption = userSelected.options[userSelectedIndex];
    let userSelectedName = userSelected.options[userSelectedIndex].text;
    let listSelectedUsers = document.getElementById("listSelectedUsers");
    let liUser = document.createElement("li");
    let checkBoxUser = document.createElement("input");
    checkBoxUser.type = "checkbox";
    checkBoxUser.name = "check";
    checkBoxUser.value = userSelectedOption.value;
    checkBoxUser.className = "user-check";
    checkBoxUser.checked = true;

    liUser.setAttribute("class", "li-user-selected");
    liUser.setAttribute("value", userSelectedOption.value);
    liUser.innerHTML = userSelectedName;

    if(listSelectedUsers === null) {
        listSelectedUsers = document.createElement("ul");
        listSelectedUsers.setAttribute("id", "listSelectedUsers");
        divUsersSelected.appendChild(listSelectedUsers);
    }

    listSelectedUsers.appendChild(liUser);
    listSelectedUsers.appendChild(checkBoxUser);

    userSelectedOption.remove();
    console.log(userSelectedName);
}, false);

function searchUser(){
    let uri = url + "searchUser/";
    let inputText = document.getElementById("userSearch").value;
    let data = '?str='+inputText;
    ajaxRequest(uri, "GET", data, displayUserSearch, true);
}

function displayUserSearch(req){
    let divSearch = document.getElementById("divSearchUsers");
    divSearch.innerHTML = req.responseText;
}

