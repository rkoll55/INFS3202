<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index() {
        $data['error']= "";
        $session = session();
        if ((isset($_COOKIE['username']) && isset($_COOKIE['password'])) || $session->has('username')){
            $model = new \App\Models\User_model();
            if ($model->login(get_cookie('username'),get_cookie('password'))){
                $session = session();
                $session->set('username',get_cookie('username'));
                $session->set('password',get_cookie('password'));
                $session->set('staff',get_cookie('staff'));
                $session->set('subject',get_cookie('subject'));

                if ($session->has('subject')){
                    return redirect()->to(base_url('main/'.$session->get('subject')));
                } else {
                    return redirect()->to(base_url());
                }
            } else if ($session->has('username')){
                if ($session->has('subject')){
                    return redirect()->to(base_url('main/'.$session->get('subject')));
                } else {
                    return redirect()->to(base_url());
                }
            }
        }

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
            session_set_cookie_params(0);
			$session = session();
            $session->set('username',$username);
            $session->set('password',$password);
            $staff = $model->checkStaff($username);
            $session->set('staff',$staff);


            if ($if_remember)
            {
                setcookie('username', $username, time() + 9200, "/");
                setcookie('password', $password, time() + 9200, "/");
                setcookie('staff', $staff, time() + 9200, "/");
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

            setcookie('username', '', time() - 3600, '/');
            setcookie('password', '', time() - 3600, '/');
            setcookie('subject', '', time() - 3600, '/');

            return redirect()->to(base_url('login'));
        }
    }
}
