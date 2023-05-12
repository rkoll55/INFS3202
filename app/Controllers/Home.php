<?php

namespace App\Controllers;
use CodeIgniter\Email\Email;

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

        $usermodel = new \App\Models\User_model();
        $data['verified'] = $usermodel->getVerified(session()->get('username'));

        $data['subjects'] = $subjects;
        $data['questions'] = $questions;
        $data['bookmarks'] = $this->getBookmarks();
        $data['staff'] = $session->get('staff'); 


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

    public function unbookmark($num) {
        $session = session();
        $model = new \App\Models\subject_model();
        $userModel = new \App\Models\User_model();

        $userId = $userModel->getUserId($session->get('username'));
        $model->bookmarkQuestion($num, $userId,0);
        echo($num);
       return redirect()->to(base_url());
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

    public function newSubject() {

        $model = new \App\Models\subject_model();

        $name = $this->request->getPost("name");
        $description = $this->request->getPost("description");

        $model->addSubject($name, $description);
     
    
        return redirect()->to(base_url());
    }

    public function verifyEmail() {
        $session = session();
        $username = session()->get('username');

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

        $session->set('verify-token', $verificationToken);


        $model = new \App\Models\subject_model();
        $subjects = $model->getAllSubjects();
        $questions = $model->getUserQuestions(session()->get('username'));

        $usermodel = new \App\Models\User_model();
        $data['verified'] = 2;

        $data['subjects'] = $subjects;
        $data['questions'] = $questions;
        $data['bookmarks'] = $this->getBookmarks();
        $data['staff'] = $session->get('staff'); 

        $session->remove('subject');
        setcookie('subject', '', time() - 3600, '/');

        $data['error']= "";
        echo view('template/header');
        echo view('home',$data);
    }

    public function checkEmail($token) {
        $session = session();
        $session_token = session()->get('verify-token');
        $username = session()->get('username');

        if ($token == $session_token) {
            $model = new \App\Models\User_model();
            $model->updateCredentials('verified', $username, 1);
            echo "email successfully verified";
        } else {
            echo "link has expired try again";
        }
    }

    private function getBookmarks() {
        $session = session();
        $userModel = new \App\Models\User_model();
        $model = new \App\Models\subject_model();

        $userId = $userModel->getUserId($session->get('username'));

        return $model->getBookmarks($userId);
    }
}
?>