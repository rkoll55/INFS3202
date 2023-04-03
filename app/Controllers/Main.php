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
	
	$data['questions'] = $this->display_questions();
	$data['subject'] = $subject;
	echo view('template/header');
	echo view('/board_page', $data);
	echo view('template/footer');
 }

 	public function display_questions(){
		$data = array(
			array(
				'id' => 1,
				'title' => 'Using Codigniter',
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
			),
			array(
				'id' => 2,
				'title' => 'Course Info',
				'content' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
			),
			array(
				'id' => 3,
				'title' => 'How to verify',
				'content' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
			)
		);
		return $data;
	} 
}
