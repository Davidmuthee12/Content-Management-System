<?php

namespace App\Admin\Controller;

class LoginController extends AbstractAdminController {

    public function login() {
        var_dump("LoginController::login() has been called!");
        $this->render('login/login', []);
    }
}