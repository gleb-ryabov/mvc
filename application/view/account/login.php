<form action = "/login" method = "POST">
    <h3> Авторизация </h3>
    <p>Логин: <input type = "text" name = "login" id = "login"></p>
    <p>Пароль: <input type = "password" name = "password" id = "password"></p>
    <p><button type = "submit" id="btnLogin" disabled> Войти </button>
</form>

<!-- JS -->
<script src = "public\scripts\blockButtonLogin.js"></script>

<!-- Вывод уведомления, в случае ввода некорректного пароля -->
<?php
if (isset($vars['password'])) {
    echo "<script>alert('Вы ввели неправильный пароль. Попробуйте еще раз или войдите с другим логином.');</script>";
}
?>