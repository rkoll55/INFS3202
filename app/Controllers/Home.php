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

        foreach ($subjects as $row){
         //   echo $row->name;
        }
        $data['subjects'] = $subjects;

        $data['error']= "";
        echo view('template/header');
        echo view('home',$data);

    }  
}
?>