const userSelected = document.getElementById("selectUsers");
const divUsersSelected = document.getElementById("divUserSearch");
const listSelectedUsers = document.getElementById("listSelectedUsers");

const userSelectedUpdate = document.getElementById("selectUsersUpdate");
const divUsersSelectedUpdate = document.getElementById("divUserSearchUpdate");
const listSelectedUsersUpdate = document.getElementById("listSelectedUsers");


//const buttonValidForm = document.getElementsByClassName("cta-button-compose-project");
let userChecked = null;

//CREATE PROJECT
selectEvent(userSelected, divUsersSelected, listSelectedUsers);

//UPDATE PROJECT
selectEvent(userSelectedUpdate, divUsersSelectedUpdate, listSelectedUsersUpdate);

//validFormProject(buttonValidForm);

//display selected user
function selectEvent(userSelected, divUsersSelected, listSelectedUsers) {
    userSelected.addEventListener("change", () => {
        let userSelectedIndex = userSelected.selectedIndex;
        let userSelectedOption = userSelected.options[userSelectedIndex];
        let userSelectedName = userSelected.options[userSelectedIndex].text;
        let liUser = document.createElement("li");
        let checkBoxUser = document.createElement("input");

        checkBoxUser.type = "checkbox";
        checkBoxUser.name = "check-" + userSelectedOption.value;
        checkBoxUser.value = userSelectedOption.value;
        checkBoxUser.className = "user-check";
        checkBoxUser.checked = true;
        checkBoxUser.setAttribute("onchange", `onClickCheckbox(this, ${userSelected.id})`);

        liUser.setAttribute("class", "li-user-selected");
        liUser.setAttribute("value", userSelectedOption.value);
        liUser.innerHTML = userSelectedName;

        if (listSelectedUsers === null) {
            listSelectedUsers = document.createElement("ul");
            listSelectedUsers.setAttribute("id", "listSelectedUsers");
            divUsersSelected.appendChild(listSelectedUsers);
        }

        liUser.appendChild(checkBoxUser);
        listSelectedUsers.appendChild(liUser);
        userChecked = document.getElementsByClassName("user-check");
        userSelectedOption.hidden = true;

    }, false);
}
//undisplay user deselected
function onClickCheckbox(item, userSelected){
    let li = item.parentNode;
    for (let i = 0; i < userSelected.length; i++){
        if (userSelected.options[i].value == li.value) {
            userSelected.options[i].hidden = false;
        }
    }
    li.remove();
}

/*function validFormProject(buttonValidForm) {
    buttonValidForm.addEventListener("click", () => {

        let uri = url + "project/compose/";
        let titleProject = document.getElementById("title").value;
        let descProject = document.getElementById("description").value;
        let userInputs = document.getElementsByClassName("user-check");
        let dataString = `title=` + encodeURIComponent(titleProject) + `&description=` + encodeURIComponent(descProject) + `&users=`;

        for (let i = 0; i < userInputs.length; i++) {
            if (i !== 0)
                dataString += ",";
            dataString += encodeURIComponent(userInputs[i].value);
        }

        ajaxRequest(uri, "POST", dataString, displayUserSearch, true);
    });
}

function displayUserSearch(req){
    document.write(req.responseText);
}*/

/*function getUsers(element){
    let tabId = '';
    if(element.length > 0){
        let list = element[0].childNodes;
        for (let i = 0; i < list.length; i++){
            if(i != 0)
                tabId += ',';
            tabId += list[i].value;
    }
   return tabId;
}*/


$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-project", function () {

        let formContainer = $(this).parent().children(0);

        $.ajax({
            url:"/project/compose/",
            type:"POST",
            data:
                {
                    title:$(this).parent().find('[name=title]').val(),
                    description:formContainer.find('[name=description]')[0].value
                    //user: usersId
                },
            success:function(answer)
            {
                if (answer.includes('<section id="back-office-container">')){
                    $($('main')[0]).html(answer);
                    alertMessage('Project created!');
                }else{
                    $(formContainer).html(answer);
                }
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

    $(document).on("click", ".cta-button-delete-projet", function () {
        var projetContainer = $(this);
        $.ajax({
            url:"/project/delete",
            type:"POST",
            data:
                {
                    id:$(this).attr('data-projet-id')
                },
            success:function()
            {
                $(projetContainer).parent().parent().remove();
                alertMessage('Project deleted!');
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })
});
