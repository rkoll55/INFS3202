<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){
	    $session = session();
	    if (!$session->has('username')){
		    return redirect()->to(base_url('login'));
	    }

        $model = new \App\Models\subject_model();
        $subjects = $model->getAllSubjects();
        $questions = $model->getUserQuestions(session()->get('username'));

        $data['subjects'] = $subjects;
        $data['questions'] = $questions;

        $session->remove('subject');
        setcookie('subject', '', time() - 3600, '/');

        $data['error']= "";
        echo view('template/header');
        echo view('home',$data);
        

    }  

    public function updateProfile() {
        $session = session();
	    if (!$session->has('username')){
		    return redirect()->to(base_url('login'));
	    }

        $data['username'] = session()->get('username');

        echo view('template/header');
        echo view('update_profile', $data);
        echo view('template/footer');

    }

    public function updateUsername() {

        $username = session()->get('username');
        $password = $this->request->getPost("password");
        $new = $this->request->getPost("username");

        $model = new \App\Models\User_model();
        $check = $model->login($username,$password);

        if($check) {
            $data = "username";
            $model->updateCredentials($data, $username, $new);
            return redirect()->to(base_url());
        } else {
            $data['username'] = session()->get('username');
            $data['error'] = true;
            echo view('template/header');
            echo view('update_profile', $data);
            echo view('template/footer');
    
        }
    }
    public function updateEmail() {

        $username = session()->get('username');
        $password = $this->request->getPost("password");
        $new = $this->request->getPost("email");

        $model = new \App\Models\User_model();
        $check = $model->login($username,$password);

        if($check) {
            $data = "email";
            $model->updateCredentials($data, $username, $new);

            return redirect()->to(base_url());
        } else {
            $data['username'] = session()->get('username');
            $data['error'] = true;
            echo view('template/header');
            echo view('update_profile', $data);
            echo view('template/footer');
    
        }
    }
    public function updatePassword() {

        $username = session()->get('username');
        $password = $this->request->getPost("password");
        $new = $this->request->getPost("newPassword");

        $hashedPassword = password_hash($new, PASSWORD_DEFAULT); 


        $model = new \App\Models\User_model();
        $check = $model->login($username,$password);

        if($check) {   
            $data = "password";
            $model->updateCredentials($data, $username, $hashedPassword);
            return redirect()->to(base_url());
        } else {
            $data['username'] = session()->get('username');
            $data['error'] = true;
            echo view('template/header');
            echo view('update_profile', $data);
            echo view('template/footer');
    
        }

    }
}
?>