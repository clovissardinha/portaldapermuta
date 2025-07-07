<?php namespace App\Controllers\UserAdmin;


use App\Models\DestinoModel;
use App\Models\UsuariosModel;
use App\Models\CidadeModel;
use App\Models\OrgaoModel;

Class Triangulacao extends BaseController{ 
  protected $destinoModel;
  protected $usuariosModel;
  protected $cidadeModel;
  protected $orgaoModel;

  public function __construct(){
    $this->destinoModel= new DestinoModel();
    $this->usuariosModel= new UsuariosModel();
    $this->cidadeModel = new CidadeModel();
    $this->orgaoModel = new OrgaoModel();
	}
  /**
   * Início da busca por cidade de origem. 
   *
   * @return void
   */
  public function index(){
    $session = \Config\Services::session();  
    $request = \Config\Services::request();
    $pager = \Config\Services::pager();
    
    if($session->get('logged_in')){
      /**
       * busca a cidade de origem do usuario logado
       */
      $origem=$this->usuariosModel
      ->select('cidade_origem,id_orgao,cid_nome')
      ->join('tb_cidades','tb_cidades.cid_id=usuarios.cidade_origem')
      ->where('id_user',$session->id_user) 
      ->find();
      //dd($origem);
     /** com a cidade de origem do usuario logado descobre quais os usuarios que tem a cidade de destino igual a cidade de origem do usuário logado e o mesmo órgão.
      */
      $cid_destinos=$this->destinoModel->triangulacao($origem[0]['cidade_origem'],$origem[0]['id_orgao']);     
      $formDropOrgao=$this->orgaoModel->formDropDow();  
      $dados=[
        'pager'=>$this->destinoModel->pager,
        'usuarios'=>$cid_destinos,
        'origem'=>$origem,
        'formDropOrgao'=>$formDropOrgao,
      ];
      //dd($dados);
      echo view('UserAdmin/Triangulacao/index',$dados);
    }
    else{
      return redirect()->to('/Login');
    }
  }
  
}