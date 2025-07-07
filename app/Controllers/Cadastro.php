<?php

namespace App\Controllers;

use App\Models\AreaModel;
use App\Models\AreaUsuarioModel;
use App\Models\AtivoModel;
use App\Models\CargoModel;
use App\Models\CidadeModel;
use App\Models\ContatoModel;
use App\Models\DestinoModel;
use App\Models\EstadoModel;
use App\Models\ExclusaoModel;
use App\Models\MuralModel;
use App\Models\OrgaoModel;
use Config\Email;
use Config\Validation;

use App\Models\UsuariosModel;

class Cadastro extends BaseController

{

	protected $UsuariosModel;
	protected $estadoModel;
	protected $tb_cidade;
	protected $orgaoModel;
	protected $cargoModel;
	protected $contatoModel;
	protected $muralModel;
	protected $ativo;
	protected $exclusao;
	protected $destinoModel;
	protected $areaModel;
	protected $areaUsuarioModel;

	public function __construct()
	{
		$this->UsuariosModel = new UsuariosModel();
		$this->estadoModel = new EstadoModel();
		$this->tb_cidade = new CidadeModel();
		$this->orgaoModel = new OrgaoModel();
		$this->cargoModel = new CargoModel();
		$this->contatoModel = new ContatoModel();
		$this->muralModel = new MuralModel();
		$this->ativo = new AtivoModel();
		$this->exclusao = new ExclusaoModel();
		$this->destinoModel = new DestinoModel();
		$this->areaModel = new AreaModel();
		$this->areaUsuarioModel = new AreaUsuarioModel();
	}

	/**
	 * mostra a form inicial do cadastro de novos usuários
	 *
	 * @return void
	 */
	public function index()
	{	$titulo='login';
        $conteudo="Portal da permuta, permutaaki,permutando,permuta de servidores,universidades federais,institutos federais, professores,prefeituras,receita federal,tjsp,trt.";
		$descricao="Nossos cadastros são sempre atualizados e é possivel ao participante suspende-lo por tempo indeterminado. Toda a eficiência das buscas dependem de um cadastro completo e bem feito";
		$canonica='<link rel="canonical" href="https://www.portaldapermuta.com/Cadastro" />';

		
	$dados=[
		'conteudo'=>$conteudo,
		'descricao'=>$descricao,
        'titulo'=>$titulo,
		'canonica'=>$canonica
	];
    return view('cadastro/index',$dados);
	}
	/** retorna da página index para iniciar o cadastro e receber o email */
	public function inicial()
	{
		$data = [];
		$email = \Config\Services::email();
		$request = \Config\Services::request();
		if ($post = $request->getPost()) {
			$rules = [
				'nome' => 'required|min_length[10]|max_length[30]',
				'email'    => 'required|valid_email',
				'confirma_email' => 'required|matches[email]',
			];
			if ($this->validate($rules)) {
				if ($this->UsuariosModel->cadastro($post['email'])) {
					$mensagem = "Email já cadastrado";
					$titulo='login';
       				$conteudo="Portal da permuta, permutaaki,permutando,permuta de servidores,universidades federais,institutos federais, professores,prefeituras,receita federal,tjsp,trt.";
					$descricao="Nossos cadastros são sempre atualizados e é possivel ao participante suspende-lo por tempo indeterminado. Toda a eficiência das buscas dependem de um cadastro completo e bem feito";
					$canonica='<link rel="canonical" href="https://www.portaldapermuta.com/Cadastro" />';
					$dados = [
						'mensagem' => $mensagem,
						'conteudo'=>$conteudo,
						'descricao'=>$descricao,
						'titulo'=>$titulo,
						'canonica'=>$canonica
					];
					echo view('/cadastro/avisoemailexiste', $dados);
				} else {
					$post_Hash['senha'] = password_hash($post['senha'], PASSWORD_DEFAULT);
					$user = [
						'nome' => $post['nome'],
						'email' => $post['email'],
						'senha' => $post_Hash['senha'],
					];
					//dd($user);
					if ($this->UsuariosModel->save($user)) {
						/**
						 * inicio do procedimento de envio de email
						 */
						$msg = view(
							'cadastro/boasVindas',
							[
								'senha' => $post['senha'],
								'nome' => $post['nome'],
							]
						);
						$email->setFrom('atendimento@portaldapermuta.com');
						$email->setTo($post['email']);
						$email->setBCC('clovis.sardinha@gmail.com');
						$email->setSubject("Bem vindo ao Portal da Permuta");
						$email->setMessage($msg);
						if ($email->send()) {
							$conteudo="Portal da permuta, permutaaki,permutando,permuta de servidores,universidades federais,institutos federais, professores,prefeituras,receita federal,tjsp,trt.";
							$descricao="Nossos cadastros são sempre atualizados e é possivel ao participante suspende-lo por tempo indeterminado. Toda a eficiência das buscas dependem de um cadastro completo e bem feito";
							$canonica='<link rel="canonical" href="https://www.portaldapermuta.com/Cadastro" />';
							$dados=[
								'conteudo'=>$conteudo,
								'descricao'=>$descricao,
								'canonica'=>$canonica
							];
							return view('contato/boasVindas',$dados);
						}
						echo view('/cadastro/index');
					} else {
						$msg = "algo deu errado, tente mais tarde.";
						$conteudo="Portal da permuta, permutaaki,permutando,permuta de servidores,universidades federais,institutos federais, professores,prefeituras,receita federal,tjsp,trt.";
						$descricao="Nossos cadastros são sempre atualizados e é possivel ao participante suspende-lo por tempo indeterminado. Toda a eficiência das buscas dependem de um cadastro completo e bem feito";
						$canonica='<link rel="canonical" href="https://www.portaldapermuta.com/Cadastro" />';
						$dados = [
							$msg => $msg,
							'conteudo'=>$conteudo,
							'descricao'=>$descricao,
							'canonica'=>$canonica
						];
						echo view('/cadastro/index', $dados);
					}
				}
			} else {
				$titulo='login';
       			$conteudo="Portal da permuta, permutaaki,permutando,permuta de servidores,universidades federais,institutos federais, professores,prefeituras,receita federal,tjsp,trt.";
				$descricao="Nossos cadastros são sempre atualizados e é possivel ao participante suspende-lo por tempo indeterminado. Toda a eficiência das buscas dependem de um cadastro completo e bem feito";
				$canonica='<link rel="canonical" href="https://www.portaldapermuta.com/Cadastro" />';	
				echo view('cadastro/index', [
					'validation' => $this->validator,
					'conteudo'=>$conteudo,
					'descricao'=>$descricao,
					'titulo'=>$titulo,
					'canonica'=>$canonica
				]);
			}
		}
	}
	//função para buscar a cidade pelo javascript public/assets/js/cidade.js

	/** Após fazer o login o usuário é direcionado para o cadastro se o campo email_confirmado é 0*/
	public function retorno()
	{
		$session = \Config\Services::session();
		if ($session->get('logged_in')) {
			$dados = [
				'usuario' => $session->usuario,
				'email' => $session->email,
				'id_user' => $session->id_user,
				'e_confirmado' => $session->e_confirmado,
				'logged_in' => $_SESSION['logged_in'],
				'formDropDow' => $this->orgaoModel->formDropDow(),
				'formDropDowCargo' => $this->cargoModel->formDropDow(),
				'formDropDowArea' => $this->areaModel->formDropDow(),
			];
			//dd($dados);
			echo view('cadastro/form', $dados);
		} else {
			$titulo = 'login';
			$data = [
				'titulo' => $titulo,
			];
			$data['validation'] = $this->validator;
			echo view('/Login/index', $data);
		}
	}
	/** São cadastrados os dados pessoais  nas tabelas usuarios,contato,ativo e mural  */
	public function dadosPessoais()
	{

		$session = \Config\Services::session();
		$request = \Config\Services::request();
		$validation = \Config\Services::validation();
		if ($session->get('logged_in')) {
			if ($post = $request->getPost()) {
				$val = $this->validate(
					[
						'orgao' => 'required|is_natural',
						'cargo' => 'required|is_natural',
						'fk_cidade' => 'required|is_natural',
						'celular'=>'required',
					],
					[
						'orgao'=>[
							'required'=>'O Campo órgão é obrigatório',
							'is_natural'=>'preencha o campo órgão'
						],
						'cargo'=>[
							'required'=>'O Campo cargo é obrigatório',
							'is_natural'=>'preencha o campo cargo'
						],
						'fk_cidade'=>[
							'required'=>'O Campo cidade é obrigatório',
							'is_natural'=>'preencha o campo cidade'
						],
						'celular'=>[
							'required'=>'O Campo celular é obrigatório',
						]

					],

				);
				//Se não passar na validação retorna para a página anterior (back) com os erros.
				if (!$val) {
					helper('[old]');
					return redirect()->back()->withInput()->with('errors', $validation->getErrors());
				}
				$id_user = $session->id_user;
				//prepara os dados para serem salvos no cadastro
				$estado = $this->tb_cidade->buscaEstadoByFk($post['fk_cidade']);

				$usuario = [
					'id_orgao' => $post['orgao'],
					'id_cargo' => $post['cargo'],
					'cadastro_ativado' => $post['cadastro_ativado'],
					'cidade_origem' => $post['fk_cidade'],
					'estado_origem' => $estado['cid_estado'],
				];
				//dd($usuario);
				$contato = [
					'celular' => $post['celular'],
					'usuario_id' => $session->id_user,
				];
				$mural = [
					'usuario_id' => $session->id_user,
					'comentario' => $post['comentario'],
				];
				$ativo = [
					'ativo' => $post['ativo'],
					'usuario_id' => $session->id_user,
				];
				//salva os dados do cadastro, exceto as cidades de origem.
				if (
					($this->UsuariosModel->update($id_user, $usuario) and
						($this->contatoModel->save($contato)) and
						($this->ativo->save($ativo)) and
						($this->muralModel->save($mural)))

				) {
					return redirect()->to('/UserAdmin/CadastraDestino');
				};
			}
		} else {
			return redirect()->to('/Login');
		}
	}

	/** mostra informação sobre a condição atual do cadastro. */
	public function suspenso()
	{
		$session = \Config\Services::session();

		echo view('cadastro/infoCadSuspenso');
	}
	/**
	 * Exclui totalmente o cadastro do usuário e inclui seus dados na tabela exclusao.
	 *
	 * @return void
	 */
	public function excluir()
	{
		$session = \Config\Services::session();
		if ($session->get('logged_in')) {
			$dados = [
				'usuario' => $session->usuario,
				'email' => $session->email,
				'apelido' => $session->apelido,
				'id_user' => $session->id_user,
				'e_confirmado' => $session->e_confirmado,
				'logged_in' => $session->true,
			];
			echo view('cadastro/excluirIndex');
		}
	}
	/**
	 * Termina a exclusão do usuario logado!
	 *
	 * @return void
	 */
	public function exclueFinal()
	{
		$session = \Config\Services::session();
		$request = \Config\Services::request();

		if ($session->get('logged_in')) {
			if ($post = $request->getPost()) {;
				$rules = [
					'motivo' => 'required',
					'indica'    => 'required',
				];
				//dd($post);
				if ($this->validate($rules)) {
					$usuario = $this->UsuariosModel->find($post['id_user']);
					//dd($usuario);
					$dados = [
						'nome' => $session->usuario,
						'email' => $session->email,
						'id_user' => $session->id_user,
						'motivo' => $post['motivo'],
						'indicacao' => $post['indica'],
						'critica' => $post['comentario'],
						'data_inscricao' => $usuario['created_at'],
					];
					//dd($dados);
					if ($this->exclusao->save($dados)) {
						$this->ativo->delete_user($session->id_user) && $this->contatoModel->delete_user($session->id_user) &&
							$this->muralModel->delete_user($session->id_user) &&
							$this->destinoModel->delete_user($session->id_user) &&
							$this->UsuariosModel->delete_user($session->id_user);
					}

					return redirect()->to('../Login/logout');
				} else {
					echo view('cadastro/excluirIndex', [
						'validation' => $this->validator,
					]);
				}
			}
		}
	}
	public function hashSenha()
	{
		$session = \Config\Services::session();
		if ($session->get('logged_in')) {
			$senhas = $this->UsuariosModel
				->select("id_user,nome,senha")
				->where('id_user>1')
				->where('id_user<10')
				->findAll();
			foreach ($senhas as $senha) {
				$dados = [
					'id_user' => $senha['id_user'],
					'senha' => $senha['senha'] = password_hash($senha['senha'], PASSWORD_DEFAULT),
				];
				$this->UsuariosModel->save($dados);
				set_time_limit(0);
			}
		} else {
			return redirect()->to('/Login');
		}
	}
}
