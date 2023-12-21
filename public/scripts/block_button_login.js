// Блокирует нажатие кнопки авторизации, если хотя бы одно из полей не заполнено,
// снимает и устанавливает тип курсора
function toggleButtonState() {
    var loginValue = document.getElementById('login').value;
    var passwordValue = document.getElementById('password').value;
    var loginButton = document.getElementById('btn_login');

    if (loginValue && passwordValue) {
        loginButton.removeAttribute('disabled');
        loginButton.style.cursor = 'pointer';
    } else {
        loginButton.setAttribute('disabled', 'disabled');
        loginButton.style.cursor = 'not-allowed';
    }
}

document.getElementById('login').addEventListener('input', toggleButtonState);
document.getElementById('password').addEventListener('input', toggleButtonState);
