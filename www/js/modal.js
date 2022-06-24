let parentModal = document.getElementById('overlay');
let modal = document.getElementById('modal-element');

function OpenModal() {
    parentModal.style.display = 'block';
    modal.style.transition = 'visibility 0s, opacity 0.5s linear';

}
function CloseModal() {
    parentModal.style.display = 'none';
}
