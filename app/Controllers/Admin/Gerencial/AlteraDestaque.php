<?php namespace App\Controllers\Admin\Gerencial;

use App\Controllers\BaseController;
use App\Models\DestaquesModel;
use App\Models\ExclusaoModel;
use App\Models\MuralModel;
use App\Models\OrgaoModel;
use App\Models\UsuariosModel;
use CodeIgniter\HTTP\Request;

/** controle geral dos usuarios do Portal */

class alteraDestaque extends BaseController{
    protected $usuarios;
    protected $exclusao;
    protected $mural;
    protected $orgaoModel;
    protected $destaque;

    public function __construct()
    {
        $this->usuarios=new UsuariosModel();
        $this->exclusao=new ExclusaoModel();
        $this->mural=new MuralModel();
        $this->orgaoModel=new OrgaoModel();
        $this->destaque=new DestaquesModel();
    }
    /** relaciona todos os destaques contratados por ordem cronológica  */
    public function destaques(){
        
        $session = \Config\Services::session(); 
        $pager = \Config\Services::pager();

        if($session->get('logged')){
          $destaques=  $this->destaque
          ->select('nome,id_user,id_destaque,usuario_id,data_pgto,data_inicio,data_fim,tipo')
          ->join('usuarios','usuarios.id_user=destaque.usuario_id')
          ->orderBy('data_pgto','DESC')
          ->paginate(15);
        //dd($destaques);
        $data=[
            'destaques'=>$destaques,
            'pager'=>$this->destaque->pager
        ];

        echo view('Admin/Gerencial/destaques',$data);
        }
        else{
            echo view('');
        }
    }
    /**Abre o form para localizar o usuário e lançar novo destaque */
    public function destaqueInicial(){
        $session = \Config\Services::session();
        if($session->get('logged')){

        echo view('Admin/Gerencial/formDestaque');
        }
    }
    public function localizaUserDestaque(){
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        if($post=$request->getPost()){
            //dd($post);
        $user=$this->usuarios
        ->select('id_user,nome,email,email_alternativo,usuarios.created_at,cadastro_ativado,ativo,plus')
        ->join('ativo','ativo.usuario_id=usuarios.id_user')
        ->join('contato','contato.usuario_id=usuarios.id_user')
        ->where('email',$post['usuario'])
        ->groupBy('email')
        ->first();
        $dados=[
            'user'=>$user,
        ];
        echo view('Admin/Gerencial/formDestaqueFinal',$dados);
        }
    }
    /**salva o novo destaque */
    public function saveDestaque(){
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        if($post=$request->getPost()){
            //dd($post);
            $insere=[
                'usuario_id'=>$post['id_user'],
                'data_pgto'=>$post['data_pgto'],
                'data_inicio'=>$post['data_inicial'],
                'data_fim'=>$post['data_final'],
                'tipo'=>$post['tipo'],
            ];
            //dd($insere);
            if($post['data_final']<=$post['data_inicial']){
                $dados=[
                    'msg'=>'Data inicial deve ser menor que data final',
                ];
               echo view('Admin/Gerencial/formDestaque',$dados);
            }
            if($this->destaque->save($insere)){
                return redirect()->to('destaques');
            }
        }
    }
    /** busca formulário para alterar data e tipo de destaque */
    public function alteraDestaque($id_destaque,$nome){
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        $get=$request->getGet();
        if($id_destaque){
           $destaque=$this->destaque
           ->where('id_destaque',$id_destaque)
           ->first();
           //dd($destaque);
           $dados=[
            'nome'=>$nome,
            'destaque'=>$destaque,
           ];
            echo view('Admin/Gerencial/formAlteraDestaque',$dados);
        }
    }
    /** salva as informações alteradas e emite alerta se esquecer de alterar tipo */
    public function saveAlteraDestaque(){
        $session = \Config\Services::session();
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();
        if($post=$request->getPost()){
            //dd($post);
            $rules=[
                'tipo'=>'required|integer'
            ];
            if ( $this->validate($rules)) {
            $insere=[
                'id_destaque'=>$post['id_destaque'],
                'data_pgto'=>$post['data_pgto'],
                'data_inicio'=>$post['data_inicial'],
                'data_fim'=>$post['data_final'],
                'tipo'=>$post['tipo'],
            ];
           // dd($insere);
           
            if($this->destaque->save($insere)){
                $session->setFlashdata('sucesso', 'Destaque alterado com sucesso');
                return redirect()->to('destaques');
                }
            }
            else{
                $session->setFlashdata('erro', 'Esqueceu de lançar o tipo');
                return redirect()->back();
            }
        }
    }
    /** exclui o destaque do bd. */
    public function excluirDestaque($id_destaque,$nome){
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        $get=$request->getGet();
        if($id_destaque){
           $destaque=$this->destaque
           ->where('id_destaque',$id_destaque)
           ->first();
           //dd($destaque);
           $dados=[
            'nome'=>$nome,
            'destaque'=>$destaque,
           ];
            echo view('Admin/Gerencial/confirmaExcluir',$dados);
        }
    }
    /**exclui definitivamente o registro do destaque */
    public function excluirDestaqueFinal(){
       
        $request = \Config\Services::request();
        $session = \Config\Services::session();
         if($session->get('logged')){
            if($post=$request->getPost()){
                //dd($post);
               if($this->destaque->delete($post['id_destaque'])){
                $session->setFlashdata('sucesso', 'excluido com sucesso');
                return redirect()->to('destaques');
               }
        }
        } else{
            return redirect('Admin');
        }
    }
}