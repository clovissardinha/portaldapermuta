<?php

namespace App\Controllers;

use App\Models\AtivoModel;
use App\Models\ContatoModel;
use App\Models\UsuariosModel;
use Config\Email;

class Login extends BaseController
{
	protected $UsuariosModel;
    protected $ativoModel;
    protected $contatoModel;
	
	public function __construct()
	{
		$this->UsuariosModel = new UsuariosModel();
        $this->ativoModel = new AtivoModel();
        $this->contatoModel = new ContatoModel();
	}
	public function index()
	{
        
        $titulo='login';
        $canonica='<link rel="canonical" href="https://www.portaldapermuta.com/Login" />';
        $dados=[
            'titulo'=>$titulo,
            'canonica'=>$canonica
        ];
		return view('Login/index',$dados);
	}
    /**
     * Recebe dados do form e verifica se usuário é cadastrado.
     *
     * @return void
     */
    public function login(){
        $request = \Config\Services::request();
        $session = \Config\Services::session(); 
        $validation = \Config\Services::validation(); 
       
        if($post=$request->getPost()) {
                $rules=[
                'email'=>'required|valid_email',
                'senha'=>'required',
                    ];
                /**
                * Se foi postado o email  correto, então valida e busca no bd o usuario.
                */        
            if($this->validate($rules)){
                $usuario=$this->UsuariosModel->getUsuarioByEmail($post['email']);
                   // dd($usuario);
                /**
                 * verifica se a senha está correta
                 */
                if(!empty($usuario)){
                    if(password_verify($post['senha'],$usuario[0]['senha'])){
                        
                    /**
                     * Se o usuário já tiver com o cadastro completo (destino, etc) vai para a pagina inicial do sistema do Usuário
                    */
                        if($usuario[0]['cadastro_ativado']==1){
                            $ativo=$this->ativoModel->getUserAtivo($usuario[0]['id_user']);
                           // dd($ativo);
                            if($ativo){
                                $sessionLogin=[
                                'usuario'=>$usuario[0]['nome'],
                                'email'=>$usuario[0]['email'],
                                'apelido'=>$usuario[0]['apelido'],
                                'id_user'=>$usuario[0]['id_user'],
                                'imagem'=>$usuario[0]['imagem'],
                                'logged_in'=>true,
                                'ativo'=>$ativo[0]['ativo'],
                            ];
                            $session->set($sessionLogin);
                            }
                            else{
                                $sessionLogin=[
                                    'usuario'=>$usuario[0]['nome'],
                                    'email'=>$usuario[0]['email'],
                                    'apelido'=>$usuario[0]['apelido'],
                                    'id_user'=>$usuario[0]['id_user'],
                                    'imagem'=>$usuario[0]['imagem'],
                                    'logged_in'=>true,
                                    
                                ];
                                $session->set($sessionLogin);
                            }
                        return redirect()->to('/UserAdmin/home');
                        }
                    
                        /**
                         * Se o usuario existe, mas ainda não confirmou os dados, vai para a página de confirmação e preenchimento dos dados.
                         */    
                        if($usuario[0]['cadastro_ativado']==0){
                            $sessionLogin=[
                                'usuario'=>$usuario[0]['nome'],
                                'email'=>$usuario[0]['email'],
                                'id_user'=>$usuario[0]['id_user'],
                                'e_confirmado'=>$usuario[0]['cadastro_ativado'],
                                'logged_in'=>true,
                            ];
                            $session->set($sessionLogin);
                            //dd($sessionLogin);
                            return redirect()->to('/Cadastro/retorno');
                        }
                        
                    }  
                }
                
            $titulo='login';
            $dados= [
                    'titulo'=>$titulo,
                    'mensagem'=>'senha ou usuario errado',
                    'canonica'=>'<link rel="canonical" href="https://www.portaldapermuta.com/Login" />',
                    ];
            return view('Login/index',$dados);   
            }
            else{
                $canonica='<link rel="canonical" href="https://www.portaldapermuta.com/Login" />';
                    $dados=[
                            'validation' => $this->validator,
                            'titulo'=>'Login',
                            'mensagem'=>'senha ou usuario errado',
                            'canonica'=>$canonica
                    ];
                
                echo view('/Login/index',$dados);
            }
        } 
        $titulo='login';
        $dados=[
            'titulo'=>$titulo,
            'canonica'=>$canonica
        ];
		return view('Login/index',$dados); 
    }
   
    /**
     * Elimina a sessão em uso
     *
     * @return void
     */
    public function logout(){
        $session = \Config\Services::session(); 
        $sessionLogin=[
            'logged_in'=>false
        ];

        $session->set($sessionLogin);

                       return redirect()->to('/Home');
    }
    /**
     * inicio para o reenvio de senha
     *
     * @return void
     */
    public function lembraSenha(){

        $conteudo="Portal da permuta, permutaaki,permutando,permuta de servidores,universidades federais,institutos federais, professores,prefeituras,receita federal,tjsp,trt.";
		$descricao="Site especializado em facilitar a permuta de funcionários públicos e servidores e especialmente de universidades federais e institutos federais e prefeituras.";
        $canonica='<link rel="canonical" href="https://www.portaldapermuta.com/LembraSenha" />';
        $dados=[
            'titulo'=>"Lembrar Senha",
            'conteudo'=>$conteudo,
            'descricao'=>$descricao,
            'canonica'=>$canonica
        ];
        echo view('/Login/spinner',$dados);
    }
    /** 
     * parte final do reenvio de senha
     */
    public function recuperaSenha(){ 
        $data=[];  
        $email= \Config\Services::email(); 
        $request = \Config\Services::request();

        if($post=$request->getPost()) {
            $rules=[
                'email'=>'required|valid_email',
                    ];
            /**
            * Se foi postado o email  correto, então valida e busca no bd o usuario.
            */        
            if($this->validate($rules)){
                
                if($usuario=$this->UsuariosModel->getByEmail($post['email'])){ 
                    //dd($usuario);
                            $canonica='<link rel="canonical" href="https://www.portaldapermuta.com/recuperaSenha" />';
                            $senha=rand(100000,990000);
                            $senhaHash=password_hash($senha,PASSWORD_DEFAULT);
                            $user = [
                                'id_user'=>$usuario[0]['id_user'],
                                'senha'=>$senhaHash,
                            ];
                            //dd($user);
                                if ($this->UsuariosModel->save($user)){ 
                            $msg=view('cadastro/lembrarSenha',[
                                'senha'=>$senha,
                                'nome'=>$usuario[0]['nome'],
                            ]);
                            $email->setFrom('atendimento@portaldapermuta.com');
                            $email->setTo($post['email']);
                            $email->setBCC('clovis.sardinha@gmail.com');
                            $email->setSubject("Recuperação de senha do Portal da Permuta");
                            $email->setMessage($msg);
                                    if($email->send()){
                            $dados=[
                                'titulo'=>"Login",
                                'canonica'=>$canonica
                            ];
                            echo view('/Login/index',$dados);
                                    }
                            else{
                                $aviso = "algo deu errado, tente mais tarde";
                    
                    $dados =[
                        'aviso'=>$aviso,
                        'titulo'=>'Login',
                        'canonica'=>$canonica
                    ];
                    echo view('/Login/index',$dados); 
                            }
                                }
                }
                else{
                    $aviso = "<div class='alert alert-danger'>email não cadastrado</div>";
                    $canonica = '<link rel="canonical" href="https://www.portaldapermuta.com/Login" />';
                    $dados =[
                        'aviso'=>$aviso,
                        'titulo'=>'Login',
                        'canonica'=>$canonica
                    ];
                    echo view('/Login/index',$dados);
                }
            }
        }     
    }
}