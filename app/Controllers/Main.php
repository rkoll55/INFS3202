<?php
namespace App\Controllers;
class Main extends BaseController
{
	
	public function index($subject = null)
 	{

	$session = session();
	if (!$session->has('username')){
		return redirect()->to(base_url());
	}
	if ($subject == null){
		return redirect()->to(base_url());
	}

	setcookie('subject', $subject, time() + 3600, "/");
	$session->set('subject',$subject);
	
	$data['questions'] = $this->display_questions($subject);
	$data['subject'] = $subject;
	echo view('template/header');
	echo view('/board_page', $data);
	echo view('template/footer');
 }

 	public function display_questions($subjectId){
	
		$model = new \App\Models\subject_model();
        $data = $model->getQuestions($subjectId);

		return $data;
	} 

	public function submit_form(){
		$request = $this->request;
		if($request->isAJAX()){
			$title = $this->request->getVar('title');
			$description = $this->request->getVar('description');
			$subject = $this->request->getVar('subject');
			
			$session = session();	
			$username = $session->get('username');
			
			$time = new \CodeIgniter\I18n\Time();
			$timestamp = $time->now()->toDateTimeString();
			
			$model = new \App\Models\User_model();
            $userId = $model->getUserId($username);
			
			$info = array(
                'user_id' => $userId,
                'title' => $title,
                'description' => $description,
                'subjectID' => $subject,
				'likes' => 0,
				'time' => $timestamp
            );
			
			$model = new \App\Models\subject_model();
            echo $model->addQuestion($info);
		}
		
	}
	
	public function answer_question(){
		$request = $this->request;

		if($request->isAJAX()){
			
			$description = $this->request->getVar('user_answer');
			$questionId = $this->request->getVar('question_id');
			
			$info = array(
                'description' => $description,
				'likes' => 0,
				'question_id' => $questionId
            );
			
			$model = new \App\Models\subject_model();
            echo $model->addAnswer($info);

		}
	}
	
	public function get_answers($questionId){

		$model = new \App\Models\subject_model();
		return $model->getAnswers($questionId);
	} 
}
