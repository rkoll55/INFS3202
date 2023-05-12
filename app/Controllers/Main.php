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

	setcookie('subject', $subject, time() + 7200, "/");
	$session->set('subject',$subject);
	
	$data['questions'] = $this->display_questions($subject);
	$data['subject'] = $subject;
	$data['staff'] = $session->get('staff'); 
	
	$header['search'] = true;

	echo view('template/header', $header);
	echo view('/board_page', $data);
	echo view('template/footer');
 	}

	 public function bookmark()
 	{

	$session = session();
	if (!$session->has('username')){
		return redirect()->to(base_url());
	}
	if (!$session->has('subject')){
		return redirect()->to(base_url());
	}

	$subject = $session->get('subject');
	
	$id = $this->request->getVar('question_id');
	
	$userModel = new \App\Models\User_model();
	$userId = $userModel->getUserId($session->get('username'));
	$model = new \App\Models\subject_model();

	$model->bookmarkQuestion($id, $userId, 1);

	$data['questions'] = $this->display_questions($subject);
	$data['subject'] = $subject;
	$data['staff'] = $session->get('staff'); 

	$header['search'] = true;

	

	echo view('template/header', $header);
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
            $questionId =  $model->addQuestion($info);
			echo $questionId;

			if ($files = $this->request->getFiles()) {
				foreach ($files['userfiles'] as $file) {
					if ($file->isValid() && ! $file->hasMoved()) {
						
						$newName = $file->getRandomName();
						$file->move(WRITEPATH . 'uploads', $newName);
						echo $model->addFile($newName, $questionId);
					}
				}
			}
			echo "files uploaded successfully";
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

	public function get_files($questionId){

		$model = new \App\Models\subject_model();
		return $model->getFiles($questionId);
	}
	
	public function endorse(){

		$model = new \App\Models\subject_model();
		$answerId = $this->request->getPost('answerId');
		$likes = $this->request->getPost('answerLikes');

		if ($likes == 0) {
			$model->endorseAnswer($answerId);
		} else {
			$model->unEndorseAnswer($answerId);
		}
		return redirect()->to(base_url().'login');

	} 

	public function boost(){
		$question = $this->request->getPost('question');

		$session = session();
		$subject = $session->get('subject');
		$user = $session->get('username');

		$model = new \App\Models\User_model();
		$model->boost($subject, $user, $question);
	} 

	public function search(){

		$session = session();
		if (!$session->has('subject')){
			return redirect()->to(base_url());
		}

		$subject = $session->get('subject');
		$query = $this->request->getPost('query');

		$header['search'] = true;

		$data['subject'] = $subject;
		$data['staff'] = $session->get('staff');
		
		$model = new \App\Models\subject_model();
		$data['questions'] = $model->getSearch($subject, $query);
		$data['back'] = true;

		echo view('template/header', $header);
		echo view('/board_page', $data);
		echo view('template/footer');	
	} 

	public function download(){
		echo view('/download');
	} 

	public function get_stats(){
		$model = new \App\Models\subject_model();

		$session = session();

		if (!$session->has('username')){
			return redirect()->to(base_url());
		}
		if (!$session->has('subject')){
			return redirect()->to(base_url());
		}

		$session = session();
		$subject = $session->get('subject');

		$stats = $model->getStats($subject);

		$data['traffic'] = count($stats);

		if (!empty($stats)) {

	
			$file = fopen("stat.csv", 'w');

			fputcsv($file, array_keys((array)$stats[0]));
			foreach ($stats as $stat) {
				fputcsv($file, (array)$stat);
			}

			fclose($file);
			$data['link'] = $file;	

			$userIdCounts = array_count_values(array_column($stats, 'username'));
			$questionIdCounts = array_count_values(array_column($stats, 'question_id'));

			$data['num_users'] = count($userIdCounts);
			$data['num_questions'] = count($questionIdCounts);

			if (!empty($userIdCounts)) {
				$data['most_active_user'] = array_search(max($userIdCounts), $userIdCounts);
			} 
			if (!empty($questionIdCounts)) {
				$data['most_active_question'] = $model->getQuestionName(array_search(max($questionIdCounts), $questionIdCounts))->title;
			} 

			$weekAgo = strtotime('-7 days'); 
			$dayAgo = strtotime('-1 days'); 

			$count1 = 0;
			$count2 = 0;
			foreach ($stats as $stat) {
				$timestamp = strtotime($stat->timestamp);

				if ($timestamp >= $weekAgo) {
					$count1++;
				}
				if ($timestamp >= $dayAgo) {
					$count2++;
				}
			}
			$data['last_seven_days'] = $count1; 
			$data['last_day'] = $count2; 
			
		} else {
			$data['none'] = true;
		}


		echo view('/template/header');
		echo view('/stats', $data);
		echo view('/template/footer');
	} 
}
