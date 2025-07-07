<?php namespace App\Controllers\UserAdmin;

use App\Libraries\MinhaBiblioteca;
use App\Models\DestinoModel;
use App\Models\UsuariosModel;
use App\Models\OrgaoModel;
use App\Models\CargoModel;
use App\Models\EstadoModel;

Class PesquisaEstado extends BaseController{ 

  protected $usuariosModel;
  protected $orgaoModel;
  protected $destinoModel;
  protected $cargoModel;
  protected $estadoModel;
  protected $minhaBiblioteca;

  public function __construct()
	{
    $this->usuariosModel= new UsuariosModel();
    $this->orgaoModel= new OrgaoModel();
    $this->destinoModel= new DestinoModel();
    $this->cargoModel= new CargoModel();
    $this->estadoModel= new EstadoModel;
    $this->minhaBiblioteca=new MinhaBiblioteca;


	}
  /**
   * Início da busca por estado.
   *
   * @return void
   */
    public function index(){
        
       $session = \Config\Services::session();  
      

        if($session->get('logged_in')){
            $google=$this->minhaBiblioteca->getVariavel();
        $dados=[
          'nome'=> $session->usuario,
          'id_user'=>$session->id_user,
          'logged_in'=>$session->logged_in,
          'formDropEstado'=>$this->estadoModel->formDropDow(),
          'google'=> $google,
        ];
        //dd($dados);
         echo view('UserAdmin/Estado/index',$dados);
    }    
        else{
        return redirect()->to('/Login');
         }
    }

/**
* Localiza o estado escolhido 
*
* @return void
*/
    public function buscarEstado(){
 
            $session = \Config\Services::session();  
            $request = \Config\Services::request();
            $pager = \Config\Services::pager();

        if($session->get('logged_in')){
        $get=$request->getGet();
        if($get){
            //dd($get);
            $estado=$this->estadoModel->buscaEstadoById($get['estado']);
           //dd($estado);
            $paginas=$get['paginas'];
            $indice=$get['indice'];
            $usuarios=$this->usuariosModel->getUsuarioByEstado($estado[0]['estado_id'],$paginas,$indice);
            //dd($usuarios);
            
            foreach($usuarios as $key=> $usuario){
                $usuarios[$key]['id_user']=$this->destinoModel->getDestinoById($usuario['id_user']);
               }
               //dd($usuarios);
            $formDropCargo=$this->cargoModel->formDropDow();   
        $dados=[
        'pager'=>$this->usuariosModel->pager,   
        'nome'=> $session->usuario,
        'logged_in'=>$session->logged_in,
        'usuarios'=>$usuarios,
        'estado'=>$estado,
        'formDropCargo'=>$formDropCargo,
        ];
        //dd($dados);
    echo view('UserAdmin/Estado/final',$dados);
        }
    }
        else{
        return redirect()->to('/Login');
        }
    }
    public function buscarEstadoFiltrado(){
 
        $session = \Config\Services::session();  
        $request = \Config\Services::request();
        $pager = \Config\Services::pager();

    if($session->get('logged_in')){
    $get=$request->getGet();
    if($get){
        //dd($get);
        $estado=$this->estadoModel->buscaEstadoById($get['estado']);
      // dd($estado);
        $usuarios=$this->usuariosModel->getUsuarioByEstadoFiltrado($estado[0]['estado_id'],$get['cargo']);
        //dd($usuarios);
        foreach($usuarios as $key=> $usuario){
            $usuarios[$key]['id_user']=$this->destinoModel->getDestinoById($usuario['id_user']);
           }
        $formDropCargo=$this->cargoModel->formDropDow();
        $google=$this->minhaBiblioteca->getVariavel();  
    $dados=[
    'pager'=>$this->usuariosModel->pager,   
    'nome'=> $session->usuario,
    'logged_in'=>$session->logged_in,
    'usuarios'=>$usuarios,
    'estado'=>$estado,
    'formDropCargo'=>$formDropCargo,
    'get'=>$get,
    'google'=>$google
    ];
    //dd($dados);
echo view('UserAdmin/Estado/final',$dados);
    }
}
    else{
    return redirect()->to('/Login');
    }
}
}