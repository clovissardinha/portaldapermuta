<?php
namespace App\Controllers\UserAdmin;
use Config\Email;
use Config\Validation;

class ContatoUser extends BaseController{
    public function index(){
		$session = \Config\Services::session();  

        if($session->get('logged_in')){
		$rules=[
			'nome'=>'required',
			'email'=>'required|valid_email',
			'mensagem'=>'required',
		];
		$data=[];
		$email= \Config\Services::email();
		$request = \Config\Services::request();
    	if($post=$request->getPost()){
			if($this->validate($rules)){
		$email->setFrom('atendimento@portaldapermuta.com');
		$email->setTo('clovis.sardinha@gmail.com');
		$email->setSubject($post['assunto']);
		$email->setMessage("<!DOCTYPE html>
		<html lang='en' dir='ltr'>
		  <head>
			<meta charset='utf-8'>
			<title>contato do Portal</title>
		  </head>
		  <body>
		  <strong>" . $post['nome'] . "</strong><br/>" .
		   "<strong>E-mail:</strong> " . $post['email'] . "<br/>" .
		   "<strong>Mensagem:</strong> <br/>" . $post['mensagem'] .
		"</body>
	  </html>");
	   		if($email->send()){
				$msg='ENVIADO COM SUCESSO !!';
							$dados=[
								'msg'=>$msg,
							];
				return view('UserAdmin/Home/ContatoUser',$dados);
				}
			}
		else{
			$data['validation']=$this->validator;
			}
		}
		return view('UserAdmin/Home/ContatoUser',$data);
		}
	}
}