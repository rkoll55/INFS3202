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


        $if_remember = $this->request->getPost('remember');

        $model = new \App\Models\User_model();
        $check = $model->login($username,$password);

        if ($check) {
			$session = session();
            $session->set('username',$username);
            $session->set('password',$password);

            if ($if_remember)
            {
                setcookie('username', $username, time() + 3600, "/");
                setcookie('password', $password, time() + 3600, "/");
            }

            return redirect()->to(base_url());


        }else {
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
		}

    }

    public function logout(){
        {
            $session = session();
            $session->destroy();

            delete_cookie('username');
            delete_cookie('password');


            return redirect()->to(base_url('login'));
        }
    }
}
