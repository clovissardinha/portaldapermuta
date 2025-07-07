<?php

namespace App\Controllers;

$validation= \Config\Services::validation();
use Config\Validation;

class Contato extends BaseController
{
	public function index()
	{
		$data = [];
		$validation = \Config\Services::validation();
		$email = \Config\Services::email();
		$request = \Config\Services::request();
		$session = \Config\Services::session();
	
		if ($post = $request->getPost()) {
			//dd($post);
			// Captcha
			$captcha = $request->getPost('g-recaptcha-response');
			$secretKey = "6LcDoAArAAAAAD62HwogzrUwlGPNcK9Mt_aJsNIu";
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
			$responseKeys = json_decode($response, true);
	//dd($responseKeys);
			// Verificar resposta do reCAPTCHA antes de continuar
			if (!isset($responseKeys["success"]) || !$responseKeys["success"]) {
				$session->setFlashdata('erro', 'Falha na verificação do reCAPTCHA. Tente novamente.');
				return redirect()->back();
			}
			$val = $this->validate(
                [
                    'nome' => 'required|min_length[6]|max_length[255]',
					'email' => 'required|valid_email',
					'mensagem' => 'required|min_length[6]|max_length[255]',
                ],
                [
                    // Mensagens de erro personalizadas
                    'nome' => [
                        'required' => 'O campo Nome é obrigatório.',
                        'min_length' => 'O campo Nome deve ter pelo menos 6 caracteres.',
                        'max_length' => 'O campo Nome não pode exceder 255 caracteres.',
                    ],
                    'email' => [
                        'valid_email' => 'Informe um endereço de e-mail válido.'
					],
					
                    'mensagem' => [
                        'required' => 'O campo Mensagem é obrigatório.',
                        'min_length' => 'O campo Mensagem deve ter pelo menos 10 caracteres.',
                        'max_length' => 'O campo Mensagem não pode exceder 255 caracteres.',
                    ],
                    ]
            );
			//dd($val);
            // Verificar se a validação falhou
            if (!$val) {
                helper('[old]');
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
	
			// Configuração do e-mail
			$email->setFrom('atendimento@portaldapermuta.com');
			$email->setTo('clovis.sardinha@gmail.com');
			$email->setBCC('portaldapermuta@portaldapermuta.com');
			$email->setSubject($post['assunto']);
			$email->setMessage("
				<!DOCTYPE html>
				<html lang='pt-br'>
				<head>
					<meta charset='utf-8'>
					<title>Contato do Portal</title>
				</head>
				<body>
					<strong>{$post['nome']}</strong><br/>
					<strong>E-mail:</strong> {$post['email']}<br/>
					<strong>Mensagem:</strong> <br/>{$post['mensagem']}
				</body>
				</html>
			");
	
			// Envio do e-mail
			if ($email->send()) {
				$session->setFlashdata('msg', 'Mensagem enviada com sucesso!');
				return redirect()->back();
			} else {
				// $session->setFlashdata('msg', $email->printDebugger());
				$session->setFlashdata('msg', 'Algo deu errado,tente mais tarde!');
				return redirect()->to(base_url());
			}
	
		
		}
	
		// Dados para a view
		$titulo = 'Contato';
		$conteudo = "Portal da permuta, permutaaki, permutando, permuta de servidores, universidades federais, institutos federais, professores, prefeituras, receita federal, tjsp, trt.";
		$descricao = "Entre em contato com o Portal da Permuta através desse formulário. Tire suas dúvidas sobre permuta e nos informe sobre erros no site ou faça sugestões.";
		$canonica= '<link rel="canonical" href="https://www.portaldapermuta.com/Contato" />';
	
		$dados = [
			'conteudo' => $conteudo,
			'descricao' => $descricao,
			'titulo' => $titulo,
			'canonica'=>$canonica
		];
	
		return view('_common/header', $dados)
			. view('contato/index', $dados)
			. view('_common/footer');
	}
	
	/**
	 * Manda o usuário para o formulário de confirmação dos dados para quem ele quer enviar seus dados.
	 *
	 * @return void
	 */
	public function formConfimaContato(){
		$session = \Config\Services::session(); 
		$email= \Config\Services::email();
		$request = \Config\Services::request();
    	if($post=$request->getPost()){
			//dd($post);
			$dados=[
				'email'=>$post['email'],
				'nome'=>$post['nome'],
				'id_user'=>$post['id_user'],
				'orgao'=>$post['orgao'],
				'cidade'=>$post['cidade'],
				'cargo'=>$post['cargo'],
			];

		return view('UserAdmin/Usuario/confirma',$dados);
		}
	}

    /**
     * envia e-mail de contato ao usuário escolhido em DETALHES
     */
    public function contatoEnviar(){
        $session = \Config\Services::session(); 
		$email= \Config\Services::email();
		$request = \Config\Services::request();
		if($session->get('logged_in')){
			if($post=$request->getPost()){
				//dd($post);
			$email->setFrom('atendimento@portaldapermuta.com');
			$email->setTo($post['email']);
			$email->setBCC('clovis.sardinha@hotmail.com');
			$email->setSubject('Alguém interessado em fazer permuta - entre em contato');
			$msg=view('UserAdmin/Usuario/user_contatos',[
				'email'=>$_SESSION['email'],
				'nome'=>$post['nome'],
				'nome_user'=>$_SESSION['usuario'],
				'telefone'=>$post['telefone'],
				'mensagem'=>$post['mensagem'],
			]);
			$email->setMessage($msg);
				if($email->send()){
					return view('contato/sucessoContato');
					}
				
			else{
				$data['validation']=$this->validator;
				}
				return view('contato/erro',$data);
			}
			
    	}
	}
}

