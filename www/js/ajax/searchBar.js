
const userSelected = document.getElementById("selectUsers");
const divUsersSelected = document.getElementById("divUserSearch");
let buttonValidForm = document.getElementById("buttonSaveProject");
let userChecked = null;

userSelected.addEventListener("change", () => {

    let userSelectedIndex = userSelected.selectedIndex;
    let userSelectedOption = userSelected.options[userSelectedIndex];
    let userSelectedName = userSelected.options[userSelectedIndex].text;
    let listSelectedUsers = document.getElementById("listSelectedUsers");
    let liUser = document.createElement("li");
    let checkBoxUser = document.createElement("input");

    checkBoxUser.type = "checkbox";
    checkBoxUser.name = "check-" + userSelectedOption.value;
    checkBoxUser.value = userSelectedOption.value;
    checkBoxUser.className = "user-check";
    checkBoxUser.checked = true;
    checkBoxUser.setAttribute("onchange", "onClickCheckbox(this)")

    liUser.setAttribute("class", "li-user-selected");
    liUser.setAttribute("value", userSelectedOption.value);
    liUser.innerHTML = userSelectedName;

    if(listSelectedUsers === null) {
        listSelectedUsers = document.createElement("ul");
        listSelectedUsers.setAttribute("id", "listSelectedUsers");
        divUsersSelected.appendChild(listSelectedUsers);
    }

    liUser.appendChild(checkBoxUser);
    listSelectedUsers.appendChild(liUser);
    userChecked = document.getElementsByClassName("user-check");
    userSelectedOption.hidden = true;

}, false);

function onClickCheckbox(item){
    let li = item.parentNode;
    for (let i = 0; i < userSelected.length; i++){
        if (userSelected.options[i].value == li.value) {
            userSelected.options[i].hidden = false;
        }
    }
    li.remove();
}

buttonValidForm.addEventListener("click", () => {

    let uri = url + "project/compose/";
    let titleProject = document.getElementById("title").value;
    let descProject = document.getElementById("description").value;
    let userInputs = document.getElementsByClassName("user-check");
    let dataString = `title=` + encodeURIComponent(titleProject) + `&description=` + encodeURIComponent(descProject) + `&users=`;

    for (let i = 0; i < userInputs.length; i++){
        if(i !== 0)
            dataString += ",";
        dataString += encodeURIComponent(userInputs[i].value);
    }

    ajaxRequest(uri, "POST", dataString, displayUserSearch, true);
});

/*function createProject(){
    let data = document.getElementById("formNewProject");
    let uri = url + "searchUser/";
    let inputText = document.getElementById("userSearch").value;
    let dataForm = new FormData(data);
    console.log(dataForm);
    //ajaxRequest(uri, "POST", data, displayUserSearch, true);
}*/

function displayUserSearch(req){
    document.write(req.responseText);
}

