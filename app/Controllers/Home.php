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
}
?>