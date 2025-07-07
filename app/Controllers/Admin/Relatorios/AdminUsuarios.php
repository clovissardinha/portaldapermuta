<?php namespace App\Controllers\Admin\Relatorios;

use App\Controllers\BaseController;
use App\Models\CargoModel;
use App\Models\ExclusaoModel;
use App\Models\MuralModel;
use App\Models\OrgaoModel;
use App\Models\UsuariosModel;
use CodeIgniter\HTTP\Request;

/** controle geral dos usuarios do Portal */

class AdminUsuarios extends BaseController{
protected $usuarios;
protected $exclusao;
protected $mural;
protected $orgaoModel;
protected $cargo;

    public function __construct()
    {
        $this->usuarios=new UsuariosModel();
        $this->exclusao=new ExclusaoModel();
        $this->mural=new MuralModel();
        $this->orgaoModel=new OrgaoModel();
        $this->cargo = new CargoModel();
    }

    public function index(){
        
        $session = \Config\Services::session();
        if($session->get('logged')){
        echo view('Admin/Relatorios/formUsuario');
        }
    }
    /** Busca o usuário através do email ou parte do nome */
    public function buscaUsuario(){
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $validation = \Config\Services::validation(); 
        if($post=$request->getPost()){
            $user=$this->usuarios
            ->select('id_user,nome,email,email_alternativo,usuarios.created_at,cadastro_ativado,ativo,plus')
            ->join('ativo','ativo.usuario_id=usuarios.id_user','left')
            ->join('contato','contato.usuario_id=usuarios.id_user','left')
            ->where('email',trim($post['usuario']) )
            ->orlike('nome', $post['usuario'],'both')
            ->groupBy('email')
            ->findAll();
            $dados=[
                'user'=>$user,
            ];
            
            echo view('Admin/Relatorios/usuarios',$dados);
      }
    }
    /** Faz o relatório com os motivos de exclusão do cadastro pelo usuário */
    public function exclusao(){
        $session = \Config\Services::session();
        $pager =  \Config\Services::pager();
        if($session->get('logged')){
            $excluidos=$this->exclusao
            ->orderBy('data_exclusao','DESC')
            ->paginate(20);
            //dd($excluidos);
            $data=[
                'excluidos'=>$excluidos,
                'pager'=>$this->exclusao->pager,
            ];
            echo view('Admin/Relatorios/excluidos',$data);
        }
    }
    /** Faz o relatório com os últimos 15 cadastrados para mandar para o twitter ou no e-mail semanal */
    public function twitter(){
        
        $session = \Config\Services::session();
        if($session->get('logged')){
            $novosCadastros =$this->usuarios->getLastFive($limit=15);
            //dd($novosCadastros);
            $dados=[
                'novos'=>$novosCadastros,
            ];
        echo view('Admin/Relatorios/twitter',$dados);
        }
      }
    /** Faz o relatório com o mural para verificar se não há irregularidades */ 
    public function mural(){
        
        $session = \Config\Services::session();
        if($session->get('logged')){
            $murais =$this->mural
            ->join('usuarios','usuarios.id_user=mural.usuario_id')
            ->where('comentario !=',null)
            ->orderBy('id_mural','DESC')
            ->paginate(20);
            //dd($novosCadastros);
            $dados=[
                'murais'=>$murais,
                'pager'=>$this->mural->pager,
            ];
           // dd($dados);
        echo view('Admin/Relatorios/mural',$dados);
        }
      }
      public function orgaoRanking(){
        
        $session = \Config\Services::session();
        if($session->get('logged')){
            $ranking =$this->orgaoModel
            ->select('id_user,count(id_org)AS total,id_org,nome_orgao,orgao_empresa.created_at')
            ->join('usuarios','usuarios.id_orgao=orgao_empresa.id_org')
            ->groupBy('id_org')
            ->orderBy('total','DESC')
            ->paginate(15);
            //dd($ranking);
            $dados=[
                'ranking'=>$ranking,
                'pager'=>$this->orgaoModel->pager,
            ];
        echo view('Admin/Relatorios/ranking',$dados);
        }
      }
      public function cargoRanking(){
        
        $session = \Config\Services::session();
        if($session->get('logged')){
            $ranking =$this->cargo
            ->select('count(id_cargo)AS total,nome_cargo,id_cargo')
            ->join('usuarios','usuarios.id_cargo=cargo.id_cargos')
            ->groupBy('id_cargo')
            ->orderBy('count(id_cargo)','DESC')
            ->paginate(15);
        //dd($ranking);
            $dados=[
                'ranking'=>$ranking,
                'pager'=>$this->cargo->pager,
            ];
        echo view('Admin/Relatorios/cargoRanking',$dados);
        }
      }
      public function crescimentoPortal(){
        
        $session = \Config\Services::session();
        if($session->get('logged')){
            $crescimentos =$this->usuarios
            ->select('count(created_at) as total')
        	->select('created_at')
        	->groupBy('extract(month FROM created_at), extract(year FROM created_at)')
            ->find();
            //dd($crescimentos);
            $dados=[
                'crescimentos'=>$crescimentos,
               
            ];
        echo view('Admin/Relatorios/crescimento',$dados);
        }
      }

}