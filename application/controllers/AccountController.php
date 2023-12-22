<?php

    namespace application\controllers;

    use application\core\Controller;

    class AccountController extends Controller{
        public function loginAction(){

            // Авторизация и регистрация
            if(isset($_POST['login']) && isset($_POST['password'])){

                //Данные из формы
                $login = $_POST['login'];
			    $password =$_POST['password'];
                $hash_password = md5($password);

                //Поиск пользователя в БД
                $result = $this->model->getAccount($login,$hash_password);

                if (!empty($result)) {

                    //Авторизация
                    $id = $result[0]['id'];
                    $_SESSION['id'] = $id;

                } else {

                    // Проверка: существует ли аккаунт с введенным логином
                    $check = $this->model->checkAccount($login);
                    if (!$check) {
                        //Если аккаунта не существет, то происходит регистрация и авторизация
                        $id = $this->model->newAccount($login, $hash_password);
                        $_SESSION['id'] = $id;

                    } else{
                        $this->view->render('Авторизация', ['css' => 'login', 'password' => 'incorrect']);
                        die;
                    }
                }

                header ('Location: /tasks');

            }

            // Вывод формы аутентификации
            $this->view->render('Аутентификация', ['css' => 'login']);
        }
    }
?>