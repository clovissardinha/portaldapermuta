<?php namespace App\Controllers\UserAdmin;

use App\Models\AreaModel;
use App\Models\AreaUsuarioModel;
use App\Models\DestinoModel;
use App\Models\UsuariosModel;
use App\Models\OrgaoModel;
use App\Models\CargoModel;
use App\Libraries\MinhaBiblioteca;

Class PesquisaCargo extends BaseController{ 

  protected $usuariosModel;
  protected $orgaoModel;
  protected $destinoModel;
  protected $cargoModel;
  protected $area;
  protected $areaUsuario;
  protected $minhaBiblicoteca;

  public function __construct()
	{
    $this->usuariosModel= new UsuariosModel();
    $this->orgaoModel= new OrgaoModel();
    $this->destinoModel= new DestinoModel();
    $this->cargoModel= new CargoModel();
    $this->area=new AreaModel();
    $this->areaUsuario= new AreaUsuarioModel();
    $this->minhaBiblicoteca=new MinhaBiblioteca();
	}
  /**
   * Início da busca por cargo. 
   *
   * @return void
   */
    public function index(){
       $session = \Config\Services::session();  
        if($session->get('logged_in')){
          $google=$this->minhaBiblicoteca->getVariavel();
        $dados=[
          'nome'=> $session->usuario,
          'id_user'=>$session->id_user,
          'logged_in'=>$session->logged_in,
          'formDropArea'=>$this->area->formDropDow(),
          'google'=>$google,  
        ];
        //dd($dados);
         echo view('UserAdmin/Cargo/index',$dados);
    }    
        else{
        return redirect()->to('/Login');
         }
    }

/**
* Localiza o cargo escolhido e o órgão se escolhido
*
* @return void
*/
    public function buscarCargo(){
            $session = \Config\Services::session();  
            $request = \Config\Services::request();
            $pager = \Config\Services::pager();
            $validation = \Config\Services::validation(); 
        if($session->get('logged_in')){
            $get=$request->getGet();
             $numero = (int) $get['paginas'];
               if($get){
                //dd($get);
                 $cargo=$get['fk_cargo'];
                 $indice=$get['indice'];
                 $area=$get['area'];
                 $orgao=$get['fk_orgao'];
                 if ( !$this->validate([
                   'cargo' => "required|numeric"
               ])) {
                  $session->setFlashdata('mensagem', 'Escolha um cargo');
                  
                }
                 $usuarios=$this->cargoModel->buscaCargoPesquisa($cargo,$area,$indice,$numero,$orgao);
                 $google=$this->minhaBiblicoteca->getVariavel();
           foreach($usuarios as $key=> $usuario){
             $usuarios[$key]['destinos']=$this
             ->destinoModel
             ->where('id_inter',$usuario['id_user'])
             ->join('tb_cidades','tb_cidades.cid_id=user_destino.id_cidade')
             ->findAll();
            }
           $dados=[
            'nome'=> $session->usuario,
            'logged_in'=>$session->logged_in,
            'get'=>$get,
            'pager'=>$this->cargoModel->pager,
            'usuarios'=>$usuarios,
            'cargo'=>$get['fk_cargo'],
            'orgao'=>$get['fk_orgao'],
            'numero'=>$numero,
            'indice'=>$indice,
            'area'=>$area,
            'formDropOrgao'=>$this->orgaoModel->formDropDow(),
            'google'=>$google,  
           ];
           //dd($usuarios);
           echo view('UserAdmin/Cargo/final',$dados);
              }
    }
        else{
        return redirect()->to('/Login');
        }
    }
    
}