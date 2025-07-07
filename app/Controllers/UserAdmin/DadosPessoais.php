<?php namespace App\Controllers\UserAdmin;

use App\Libraries\MinhaBiblioteca;
use App\Models\AreaModel;
use App\Models\AreaUsuarioModel;
use App\Models\AtivoModel;
use App\Models\CargoModel;
use App\Models\DestinoModel;
use App\Models\CidadeModel;
use App\Models\ContatoModel;
use App\Models\EstadoModel;
use App\Models\MuralModel;
use App\Models\OrgaoModel;
use App\Models\UsuariosModel;
use Config\Validation;
        

    class DadosPessoais extends BaseController{
        protected $destinoModel;
        protected $estadoModel;
        protected $cidadeModel;
        protected $usuariosModel;
        protected $contatoModel;
        protected $orgaoModel;
        protected $cargoModel;
        protected $muralModel;
        protected $ativoModel;
        protected $areaUsuarioModel;
        protected $areaModel;
        protected $minhaBiblicoteca;
        public function __construct()
        {
            $this->destinoModel=new DestinoModel();
            $this->estadoModel= new EstadoModel();
            $this->cidadeModel= new CidadeModel();
            $this->usuariosModel= new UsuariosModel();
            $this->contatoModel= new ContatoModel();
            $this->orgaoModel= new OrgaoModel();
            $this->cargoModel= new CargoModel();
            $this->muralModel= new MuralModel();
            $this->ativoModel= new AtivoModel();
            $this->areaUsuarioModel = new AreaUsuarioModel();
            $this->areaModel = new AreaModel();
            $this->minhaBiblicoteca=new MinhaBiblioteca();
        }
        /**
         * Encaminha o usuário logado para seus dados pessoais.
         * @return void
         */
    public function index(){
        $session = \Config\Services::session();  

        if($session->get('logged_in')){
            
        $sessao=[
          'nome'=> $session->usuario,
          'id_user'=>$session->id_user,
          'logged_in'=>$session->logged_in,
        ];
       
           $usuarioLog=$this->usuariosModel->getUsuarioById($sessao['id_user']);
           $destinoLog=$this->destinoModel->getDestinoById($sessao['id_user']);
           $contatoLog=$this->contatoModel->getContatoById($sessao['id_user']);
           $ativoLog=$this->ativoModel->getUserAtivo($sessao['id_user']);
           $id_atual=$this->ativoModel-> getUserAtivo($_SESSION['id_user']);
           $area=$this->areaUsuarioModel->getUserArea($_SESSION['id_user']);
           $google=$this->minhaBiblicoteca->getVariavel();
            
           $dados=[
            'usuario'=>$usuarioLog,
            'destinos'=>$destinoLog,
            'contato'=>$contatoLog,
            'ativo' =>$ativoLog,
            'atual'=>$id_atual,
            'area'=>$area,
            'google'=>$google
           ];
         echo view('UserAdmin/Dados/index',$dados);
        }
        else{
          $titulo='login';
          $data=[
            'titulo'=>$titulo
          ];
          echo view('/Login/index',$data);
        }
    }
    /**
     * Altera o nome e o apelido do usuário
     *
     * @return void
     */
    public function alteraNomeApelido(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
		
    	if($post=$request->getPost()){
           
			$rules = [
				'nome' => 'required',
			];
			if ( $this->validate($rules)) {
                $dadosNome=[
                    'nome'=>$post['nome'],
                    'apelido'=>$post['apelido'],
                    'fone'=>$post['fone'],
                    'celular'=>$post['celular'],
                    'whatsapp'=>$post['whatsapp'],
                    'email_alternativo'=>$post['email_alternativo'],
                    
                ];
                //dd($dadosNome);
                $id_user=$post['id_user'];
                $usuario=$post['user'];
                if($this->usuariosModel->update($id_user,$dadosNome) && $this->contatoModel->update($usuario,$dadosNome)) {
                if($session->get('logged_in')){
                  
                    $sessao=[
                      'nome'=> $session->usuario,
                      'id_user'=>$session->id_user,
                      'logged_in'=>$session->logged_in,
                    ];
                   
                       $usuarioLog=$this->usuariosModel->getUsuarioById($sessao['id_user']);
                       $destinoLog=$this->destinoModel->getDestinoById($sessao['id_user']);
                       $ativoLog=$this->ativoModel->getUserAtivo($sessao['id_user']);
                       $area=$this->areaUsuarioModel->getUserArea($sessao['id_user']);

                       $dados=[
                        'usuario'=>$usuarioLog,
                        'destinos'=>$destinoLog,
                        'atual'=>$ativoLog,
                        'area'=>$area,
                        'sucesso'=>"Dados alterados com sucesso",
                       ];
                       //dd($dados);
                echo view('UserAdmin/Dados/index',$dados);
                }
              } 
              else{
                $aviso="algo deu errado, tente novamente";
               
              }
            }
        }
    }
    public function alteraCidade(){
      $session = \Config\Services::session();  
		if($session->get('logged_in')){
			$dados=[
				'usuario'=>$session->usuario,
				'email'=>$session->email,
				'apelido'=>$session->apelido,
				'id_user'=>$session->id_user,
			];
		   //dd($dados);
			 echo view('UserAdmin/Dados/formOrigem',$dados);
		   }
		   else{
			$titulo='login';
			$data=[
				'titulo'=>$titulo
			];
			$data['validation']=$this->validator;
			echo view('/Login/index',$data);
		}
    }

    /** 
     * Pega o id do estado e procura a cidade, mandando para a função de alterar no bd.
     */
    public function alteraCidadeFinal(){
      $session = \Config\Services::session(); 
      $request = \Config\Services::request();
  
        if($post=$request->getPost()){
          //dd($post);
          if($session->get('logged_in')){
            if ( !$this->validate([
              'fk_cidade' => "required|numeric"
          ])) {
             $session->setFlashdata('mensagem', 'Escolha uma cidade');
              return redirect()->back();
           }

            $dados=[
              'usuario'=>$session->usuario,
              'id_user'=>$session->id_user,
              'e_confirmado'=>$session->e_confirmado,
              'logged_in'=>$session->true,
              'estado'=>$post['estado'],
              'nomeEstado'=>$this->estadoModel->buscaEstadoById($post['estado']),
              'formaDropDowCidade'=>$this->cidadeModel->formDropDow($post['estado']),
            ];
            dd($dados);
            echo view('UserAdmin/Dados/formOrigemFinal',$dados);
          }
        else{
          $titulo='login';
          $data=[
            'titulo'=>$titulo
          ];
          $data['validation']=$this->validator;
          echo view('/Login/index',$data);
      }
    }
  }
  /**
   * Recebe o id da cidade e lança no bd de usuarios
   *
   * @return void
   */
  public function salvaCidadeOrigem(){
      $session = \Config\Services::session(); 
      $request = \Config\Services::request();
  
        if($post=$request->getPost()){
          if($session->get('logged_in')){
            $cidade=[
              'cidade_origem'=>$post['fk_cidade'],
            ];
            $id_user=$session->id_user;
        if($this->usuariosModel->update($id_user,$cidade)){
         return redirect()->to(base_url('UserAdmin/DadosPessoais/index'));
         }
        }
        else{
          $titulo='login';
          $data=[
            'titulo'=>$titulo
          ];
          $data['validation']=$this->validator;
          echo view('/Login/index',$data);
        }
     }
  }
    /**
     * recebe o id do órgão
     *
     * @return void
     */
  public function alteraOrgao(){
    $session = \Config\Services::session();  
		if($session->get('logged_in')){
			$dados=[
				'usuario'=>$session->usuario,
				'id_user'=>$session->id_user,
				'e_confirmado'=>$session->e_confirmado,
				'logged_in'=>$session->true,
				'formDropOrgao'=>$this->orgaoModel->formDropDow(),
			];
		   //dd($dados);
			 echo view('UserAdmin/Dados/formOrgao',$dados);
		   }
		   else{
			$titulo='login';
			$data=[
				'titulo'=>$titulo
			];
			$data['validation']=$this->validator;
			echo view('/Login/index',$data);
		}
  }
  /**
   * Salva o id do órgao escolhido
   *
   * @return void
   */
  public function salvaOrgao(){
    $session = \Config\Services::session(); 
    $request = \Config\Services::request();

      if($post=$request->getPost()){
      //dd($post);
        if($session->get('logged_in')){
          $dados=[
            'usuario'=>$session->usuario,
            'id_user'=>$session->id_user,
            'e_confirmado'=>$session->e_confirmado,
            'logged_in'=>$session->true,
          ];
          }
        $orgao=$this->orgaoModel->buscaorgaoById($post['orgao']);
        //dd($orgao);
      }
      $id_user=$post['id_user'];
      $orgao=[
        'id_orgao'=>$post['orgao'],
      ];
     
      if($this->usuariosModel->update($id_user,$orgao)){
       return redirect()->to(base_url('UserAdmin/DadosPessoais/index'));
       }
  }
  /**
   * busca o id do cargo
   *
   * @return void
   */
  public function alteraCargo(){
    $session = \Config\Services::session();  
		if($session->get('logged_in')){
			$dados=[
				'usuario'=>$session->usuario,
				'id_user'=>$session->id_user,
				'e_confirmado'=>$session->e_confirmado,
				'logged_in'=>$session->true,
				'formDropCargo'=>$this->cargoModel->formDropDow(),
			];
		   //dd($dados);
			 echo view('UserAdmin/Dados/formCargo',$dados);
		   }
		   else{
			$titulo='login';
			$data=[
				'titulo'=>$titulo
			];
			$data['validation']=$this->validator;
			echo view('/Login/index',$data);
		}
  }
  /**
   * Salva o id do novo cargo
   *
   * @return void
   */
  public function salvaCargo(){
    $session = \Config\Services::session(); 
    $request = \Config\Services::request();

      if($post=$request->getPost()){
      //dd($post);
        if($session->get('logged_in')){
          $dados=[
            'usuario'=>$session->usuario,
            'id_user'=>$session->id_user,
            'e_confirmado'=>$session->e_confirmado,
            'logged_in'=>$session->true,
          ];
          }
        $cargo=$this->cargoModel->getcargoById($post['cargo']);
      }
      //dd($cargo);
      $id_user=$post['id_user'];
      $id_cargo=[
        'id_cargo'=>$cargo[0]['id_cargos'],
      ];
     
      if($this->usuariosModel->update($id_user,$id_cargo)){
       return redirect()->to(base_url('UserAdmin/DadosPessoais/index'));
       }
  }
  /**
   * Altera os comentarios feitos no mural, na página de dados do usuário
   *
   * @return void
   */
  public function alteraMural(){
    $session = \Config\Services::session(); 
    $request = \Config\Services::request();

    if($post=$request->getPost()){
        //dd($post);
          if($session->get('logged_in')){
            $dados=[
              'usuario'=>$session->usuario,
              'id_user'=>$session->id_user,
              'logged_in'=>$session->logged_in,
              'comentario'=>$post['comentario'],
            ];
            }
          //dd($dados);
          $muralId=$this->muralModel->getUsuario($post['user']);
        }
      //dd($muralId);
      if($muralId=null){
        $comentarios=[
          'usuario_id'=>$post['user'],
          'comentario'=>$post['comentario'],
        ];
        //dd($comentarios);
        if($this->muralModel->save($comentarios)){
          session()->setFlashdata('mural','Mural alterado com sucesso!');
        return redirect()->to(base_url('UserAdmin/DadosPessoais/index'));
        }
        }
        else{
          $id_mural=$this->muralModel->getUsuario($post['user']);
          $dadosMural=[
          'id_mural' =>$id_mural[0]['id_mural'],
          'comentario'=>$post['comentario'],
          ];
          //dd($dadosMural);
          $this->muralModel->save($dadosMural);
          session()->setFlashdata('mural','Mural alterado com sucesso!');
          return redirect()->to(base_url('UserAdmin/DadosPessoais/index'));
          
        }
        
  }
  /**
   * Altera o usuario atual para ativo ou inativo
   *
   * @return void
   */
  public function alteraAtivo(){
    $session = \Config\Services::session(); 
    if($session->get('logged_in')){
    echo view('UserAdmin/Dados/formAtivo');
   }
  }
  /**
   * salva as alterações no ativo
   */
  public function salvaAtivo(){
    $session = \Config\Services::session(); 
    $request = \Config\Services::request();
    $validation = \Config\Services::validation(); 
    if($session->get('logged_in')){
      if($post=$request->getPost()){
        $rules=[
          'ativo' => 'numeric',
        ];
        if($this->validate($rules)){
          //dd($post); 
          $id_ativo=$this->ativoModel-> getUserAtivo($post['id_user']);
          //dd($id_ativo);
            if($id_ativo){
            $id=$id_ativo[0]['id'];
            //dd($id);
            $dadosAtivo=[
              'id'=>$id,
              'usuario_id'=>$post['id_user'],
              'ativo'=>$post['ativo'],
              
            ];
            //dd($dadosAtivo);
            if($this->ativoModel->save($dadosAtivo)){
              $id_atual=$this->ativoModel-> getUserAtivo($post['id_user']);
              //dd($id_atual);
              $dados=[
                'atual'=>$id_ativo[0]['ativo'],
              ];
              return redirect()->to(base_url('UserAdmin/DadosPessoais/index'));
            }
          }
          if(!$id_ativo){
            $dadosAtivo=[
              'usuario_id'=>$post['id_user'],
              'ativo'=>'1',
            ];
            if($this->ativoModel->save($dadosAtivo)){
              return redirect()->to(base_url('UserAdmin/DadosPessoais/index'));
            }
          }
      }
      else{
        $dados=[
                'validation' => $this->validator,
        ];
       //dd($dados);
        echo view('UserAdmin/Dados/formAtivo',$dados);
       }
     } 
     
    }
     else{
        $titulo='login';
      $data=[
        'titulo'=>$titulo
      ];
        echo view('/Login/index',$data);
        }
  }
  /**
   * Altera a senha do usuário logado
   */
  public function alteraSenha(){
    $session = \Config\Services::session(); 
    $request = \Config\Services::request();
    $validation = \Config\Services::validation(); 
    if($session->get('logged_in')){
      if($post=$request->getPost()){
      $rules=[
				'password' => 'required|min_length[5]',
        'passconf' => 'required|matches[password]',
			];
			if($this->validate($rules)) {
        $dados=[
          'id_user'=>$post['id_user'],
          'senha'=>password_hash($post['password'],PASSWORD_DEFAULT),
        ];
            $this->usuariosModel->save($dados);
            session()->setFlashdata('senha','Senha alterada com sucesso!');
            return redirect()->to(base_url('UserAdmin/DadosPessoais/index'));
            }
          else{
            $dados=[
                    'validation' => $this->validator,
            ];
        //dd($dados);
         echo view('UserAdmin/Dados/formAtivo',$dados);
           }
        }
      }
    else{
        $titulo='login';
      $data=[
        'titulo'=>$titulo
      ];
      echo view('/Login/index',$data);
      }
  }
  /**
   * Chama o formulario para upload de fotos de perfil
   *
   * @return void
   */
  public function uploadFoto(){
    
    $session = \Config\Services::session(); 
    $request = \Config\Services::request();
    $validation = \Config\Services::validation(); 
    if($session->get('logged_in')){
     echo view('UserAdmin/Dados/foto');
    }
    else{
          $titulo='login';
        $data=[
          'titulo'=>$titulo
        ];
        echo view('/Login/index',$data);
        }     
  }
  /** salva as fotos de perfil na pasta assets/imagens e no bd*/
  public function storeFoto(){
    
    $session = \Config\Services::session(); 
    $request = \Config\Services::request();
    $validation = \Config\Services::validation(); 
    
    if($session->get('logged_in')){
      $img = $this->request->getFile('userfile');
      if (!$this->validate([
        'userfile'=>'uploaded[userfile]|is_image[userfile]|ext_in[userfile,jpeg,png,jpg]|max_dims[userfile,2000,2000]'],['userfile'=>[
          'uploaded'=>'Escolha uma imagem',
          'is_image'=>'O que você escolheu não é uma imagem',
          'ext_in'=>'A extensão '.$img->getExtension().' não é válida',
          'max_dims'=>'A imagem não pode ter mais que 2000*2000 px.',
        ]
     ])) {
        session()->setFlashdata('errors',$this->validator->getErrors());
        $data = ['errors' =>$this->validator->getErrors() ];
        $data = ['errors' => 'The file has already been moved.']; 
     echo view('UserAdmin/Dados/foto',$data);
     }
     else{
      $name=$img->getRandomName();
      \Config\Services::image('gd')
      ->withFile($img)
      ->resize(130,130,true)
      ->save(FCPATH.'assets/imagens/'.$name);
     // dd($_SESSION['id_user']);
      $id_contato=$this->contatoModel->getContatoById($_SESSION['id_user']);
      //dd($id_contato);
      $dados=[
        'id_contato'=>$id_contato[0]['id_contato'],
        'usuario_id'=>$_SESSION['id_user'],
        'imagem'=>$name,
      ];
      $this->contatoModel->save($dados);
        
      if (!$img->hasMoved()) {
       
        //dd($name);
        $_SESSION['imagem'] = $name;
       // dd($_SESSION);
     
         session()->setFlashdata('uploaded','Arquivo enviado com sucesso.');
         echo view('UserAdmin/Dados/foto');
     } 
    }
    }
    else{
          $titulo='login';
        $data=[
          'titulo'=>$titulo
        ];
        echo view('/Login/index',$data);
    }     
  }
  public function videos(){
    $titulo='videos';
    $data=[
      'titulo'=>$titulo
    ];
    echo view('UserAdmin/videos/index',$data);
  }
}