<?php

    namespace application\controllers;

    use application\core\Controller;

    class AccountController extends Controller{
        public function loginAction(){
            if (!empty($_POST)){
                exit;
            }
            $this->view->render('Авторизация');
        }
    }
?>