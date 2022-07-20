let userSelect = document.getElementsByClassName("inputSelect");
let userChecked = null;

//ADD USERS ON CREATE OR UPDATE PROJECT
window.onload = function (){
    for(let i = 0; i < userSelect.length; i++)
        selectEvent(userSelect[i], userSelect[i].nextElementSibling, userSelect[i].nextElementSibling.childNodes[0]);
}

//display selected user
function selectEvent(userSelected, divUsersSelected, listSelectedUsers = null) {

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
        console.log(`${userSelected.id}`);
        checkBoxUser.setAttribute("onchange", `onClickCheckbox(this, this.parentElement.parentElement.parentElement.previousElementSibling)`);

        liUser.setAttribute("class", "li-user-selected sticker sticker--cta sticker--cta--selected li-user-selected");
        liUser.setAttribute("value", userSelectedOption.value);
        liUser.innerHTML = userSelectedName;

        if (listSelectedUsers === null) {
            listSelectedUsers = document.createElement("ul");
            listSelectedUsers.setAttribute("id", "listSelectedUsers");
            listSelectedUsers.setAttribute("class", "center-left elements-in");
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
    console.log(li);
    console.log(item);
    for (let i = 0; i < userSelected.length; i++){
        if (userSelected.options[i].value == li.value) {
            userSelected.options[i].hidden = false;
        }
    }
    li.remove();
}

function onClickCheckboxUserOfProject(item, userSelected){
    let li = item.parentNode;
    let newOption = document.createElement('option');
    newOption.value = item.value;
    newOption.className = 'input';
    newOption.innerHTML = li.innerHTML;
    userSelected.appendChild(newOption);
    li.remove();
}

function getUsers(element){
    let tabId = '';
    if(element.length > 0){
        let list = element[0].childNodes;
        for (let i = 0; i < list.length; i++) {
            if (i != 0)
                tabId += ',';
            tabId += list[i].value;
        }
    }
   return tabId;
}


$(document).ready(function(){
    $(document).on("click", ".cta-button-compose-project", function () {

        let formContainer = $(this).parent();
        $.ajax({
            url:"/project/compose/",
            type:"POST",
            data:
                {
                    id:$(this).parent().parent().find('[name=id]').val(),
                    title:$(this).parent().parent().find('[name=title]').val(),
                    users: getUsers($(this).parent().children(0).parent().parent().find('[id=divUserSearch]').children()),
                    description:$(this).parent().parent().find('[name=description]').val(),
                },
            success:function(answer)
            {
                if (answer.includes('<section id="back-office-container">')){
                    $($('main')[0]).html(answer);
                    alertMessage('Project saved!');
                }else{
                    $(formContainer).html(answer);
                }
            },
            error: function (data, textStatus, errorThrown) {
                alertMessage('Error', 'warning');
            }
        });
    })

    $(document).on("click", ".cta-button-delete-project", function () {
        var projetContainer = $(this);
        $.ajax({
            url:"/project/delete",
            type:"POST",
            data:
                {
                    id:$(this)[0].getAttribute('data-project-id')
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
