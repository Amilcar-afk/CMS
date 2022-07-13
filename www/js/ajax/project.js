let userSelect = document.getElementsByClassName("inputSelect");
let userChecked = null;

//ADD USERS ON CREATE OR UPDATE PROJECT
window.onload = function (){
    for(let i = 0; i < userSelect.length; i++)
        selectEvent(userSelect[i], userSelect[i].nextElementSibling, userSelect[i].nextElementSibling.childNodes[i]);
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

        let formContainer = $(this).parent().children(0);
        let title = $(this).parent().parent().find('[name=title]');
        console.log(formContainer);
        $.ajax({
            url:"/project/compose/",
            type:"POST",
            data:
                {
                    id:formContainer[0].parentElement.parentElement.parentElement.getAttribute('id').split('-')[3], //get The section of the form
                    title:title[0].value,
                    description:formContainer[1].value,
                    users: getUsers(formContainer.parent().parent().find('[id=divUserSearch]').children())

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
