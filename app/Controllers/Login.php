<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index() {
        $data['error']= "";
        echo view('template/header');
        echo view('login', $data);
        echo view('template/footer');
    }

    public function check_login() {
        $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or password!! </div> ";
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        if ( $username == "Rohan" && $password == "3202" ) {
			echo view("welcome_message");
		} else {
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
		}

    }
}
