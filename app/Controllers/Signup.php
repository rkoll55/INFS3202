<?php

namespace App\Controllers;

class Signup extends BaseController
{
    public function index() {
        $data['error']= "";

        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])){
            $model = new \App\Models\User_model();
            if ($model->login(get_cookie('username'),get_cookie('password'))){
                $session = session();
                $session->set('username',get_cookie('username'));
                $session->set('password',get_cookie('password'));
                if (isset($_COOKIE['subject'])){
                    return redirect()->to(base_url('main/'.get_cookie('subject')));
                }else {
                    return redirect()->to(base_url());
                }
            }
        }

        echo view('template/header');
        echo view('signup', $data);
        echo view('template/footer');
    }

    public function check_signUp() {
        
        $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Invalid Names </div> ";

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $first_name = $this->request->getPost('FirstName');
        $last_name = $this->request->getPost('LastName');
        $email = $this->request->getPost('email');
        $confirm_password = $this->request->getPost('confirm-password');
        $is_staff = $this->request->getPost('staff');

        $validation = \Config\Services::validation();
        
        $rules = [
            'username' => [
                'rules' => 'min_length[7]|max_length[15]|alpha_numeric|is_unique[users.username]',
                'errors' => ['min_length' => 'The username field must be at least 7 characters long.',
                'max_length' => 'The username field must not exceed 15 characters.',
                'alpha_numeric' => 'The username field must contain only letters and numbers.'] 
            ],

            'password' => [
                'rules' => 'min_length[7]|max_length[25]',
                'errors' => ['min_length' => 'The password field must be at least 7 characters long.',
                'max_length' => 'The password field must not exceed 25 characters.'] 
            ],
            'confirm-password' => [
                'rules' => 'matches[password]',
                'errors' => ['matches' => 'Confirm Password must match password'] 
            ],
            
            'FirstName' => [],

            'LastName' => [],

            'email' => [
                'rules' => 'valid_email|is_unique[users.email]',
                'errors' => ['valid_email' => 'Must use valid email address'
                ]
            ],

            'staff' => []
        ];
        
        
        if ($this->validate($rules)){

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

            $id = rand(10, 99999);
            $info = array(
                'id' => $id,
                'username' => $username,
                'password' => $hashedPassword,
                'FirstName' => $first_name,
                'LastName' => $last_name,
                'isStaff' =>  $is_staff,
                'email' => $email
            );

            $model = new \App\Models\User_model();
            $check = $model->signUp($info);

            if ($check) {

                $model = new \App\Models\User_model();
                $email = $model->getEmail($username);
                

                $verificationToken = mt_rand(100000, 9999999);
                
            
                $emailSender = new \CodeIgniter\Email\Email();
                $emailConf = [
                    'protocol' => 'smtp',
                    'SMTPHost' => 'mailhub.eait.uq.edu.au',
                    'SMTPPort' => 25
                ];
                $emailSender->initialize($emailConf);
            
                $emailSender->setTo($email);
                $emailSender->setFrom('r.kollambalath@uqconnect.edu.au', 'Rohan');
                $emailSender->setSubject("Account Verification");
                
                $verificationLink = base_url('verify/' . $verificationToken);
            
                $emailSender->setMessage("Click the link below to verify your account: " . $verificationLink);
            
                $emailSender->send();
                $session =session();
                $session->set('verify-token', $verificationToken);

                return redirect()->to(base_url('login'));

            }else {
                echo view('template/header');
                echo view('signup', $data);
                echo view('template/footer');
                echo "database error";
            }

        } else {
            
            if ($validation->getError('username')){
                $data['error']= "<div class=\"alert alert-danger\" role=\"alert\">". $validation->getError('username') ."</div> ";
            } 
            if ($validation->getError('confirm-password')){
                $data['error']= "<div class=\"alert alert-danger\" role=\"alert\">". $validation->getError('password') ."</div> ";
            }
            if ($validation->getError('password')){
                $data['error']= "<div class=\"alert alert-danger\" role=\"alert\">". $validation->getError('confirm-password') ."</div> ";
            }
            if ($validation->getError('email')){
                $data['error']= "<div class=\"alert alert-danger\" role=\"alert\">". $validation->getError('email') ."</div> ";
            }
            echo view('template/header');
            echo view('signup', $data);
            echo view('template/footer');
        }
    }
}
