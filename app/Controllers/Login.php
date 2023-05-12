<?php

namespace App\Controllers;

use CodeIgniter\Email\Email;
use Exception;

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

    public function forgot_password() {
        echo view('template/header');
        echo view('forgot');
        echo view('template/footer');
    }
    public function change_password() {
        $session = session();
        $random = mt_rand(1000, 9999);
        $session->set('code', $random);

        $model = new \App\Models\User_model();
        $username = $this->request->getPost('username');
        $session->set('change-user', $username);


        try {
            $email = $model->getEmail($username);
        } catch (Exception $e) {
            return redirect()->to(base_url());
        }

        $emailSender = new Email();
        $emailConf = [
            'protocol' => 'smtp',
            'wordWrap' => true,
            'SMTPHost' => 'mailhub.eait.uq.edu.au',
            'SMTPPort' => 25
        ];
        $emailSender->initialize($emailConf);

        $emailSender->setTo($email);
        $emailSender->setFrom('r.kollambalath@uqconnect.edu.au', 'Rohan');
        $emailSender->setSubject("Change Password");
        $emailSender->setMessage("Your code is ".$random);

        $emailSender->send();
            


        echo view('template/header');
        echo view('change_pass');
        echo view('template/footer');
    }

    public function confirm_pass() {
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm-password');
        $code = $this->request->getPost('code');

        $validation = \Config\Services::validation();
        $rules = [
            'password' => [
                'rules' => 'min_length[7]|max_length[25]',
                'errors' => ['min_length' => 'The password field must be at least 7 characters long.',
                'max_length' => 'The password field must not exceed 25 characters.'] 
            ],
            'confirm-password' => [
                'rules' => 'matches[password]',
                'errors' => ['matches' => 'Confirm Password must match password'] 
            ]
        ];
        
        if ($this->validate($rules)){
            $session = session();
            $emailCode = $session->get('code');
            $username = $session->get('change-user');
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

            if ($emailCode == $code) {
                $model = new \App\Models\User_model();
                $model->updateCredentials('password',$username, $hashedPassword);
                return redirect()->to(base_url('login'));
            } 
        }     
        echo("Update Email Failed, Try again");
    }
}
