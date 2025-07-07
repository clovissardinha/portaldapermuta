<?php namespace App\Controllers\UserAdmin;

use App\Libraries\MinhaBiblioteca;
use App\Models\AreaModel;
use App\Models\AreaUsuarioModel;
use App\Models\CargoModel;
use App\Models\CidadeModel;
use App\Models\DestinoModel;
use App\Models\EstadoModel;
use App\Models\UsuariosModel;

Class Cidade extends BaseController{ 
  protected $estadoModel;
  protected $cidadeModel;
  protected $destinoModel;
  protected $usuariosModel;
  protected $cargoModel;
  protected $area;
  protected $areaUsuario;
  protected $minhaBiblicoteca;

  public function __construct()
	{
		$this->estadoModel= new EstadoModel();
    $this->cidadeModel= new CidadeModel();
    $this->destinoModel= new DestinoModel();
    $this->usuariosModel= new UsuariosModel();
    $this->cargoModel= new CargoModel();
    $this->area=new AreaModel();
    $this->areaUsuario=new AreaUsuarioModel();
    $this->minhaBiblicoteca=new MinhaBiblioteca;
	}
  /**
   * Início da busca por cidade de destino do usuário (origem do outro usuário) . 
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
          'formDropEstado'=>$this->estadoModel->formDropDow(),
          'google'=>$google,
        ];
        //dd($dados);
         echo view('UserAdmin/cidade/index',$dados);
       }
       else{
       return redirect()->to('/Login');
      }
    }
  /**
   * Finaliza a busca por cidade, considerando a origem do usuário.
   *
   * @return void
   */
  public function finalizaBusca(){
    $session = \Config\Services::session();  
    $request = \Config\Services::request();

    if($session->get('logged_in')){
      $get=$request->getGet();
      //dd($get);
        if($get){
          $cidade=$get['fk_cidade'];
          $indice=$get['indice'];
          $paginas=$get['paginas'];
          $fk_cargo=$get['fk_cargo'];
          if ( !$this->validate([
            'fk_cidade' => "required|numeric"
        ])) {
           $session->setFlashdata('mensagem', 'Escolha uma cidade');
           
         }
          $usuarios=$this->cidadeModel->cidadeDestino($cidade,$indice,$paginas,$fk_cargo);
          //dd($usuarios);
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
     'pager'=>$this->cidadeModel->pager,
     'usuarios'=>$usuarios,
     'cidade'=>$get['fk_cidade'],
     'paginas'=>$get['paginas'],
     'indice'=>$get['indice'],
     'fk_cargo'=>$get['fk_cargo'],
    ];
    //dd($dados);
    echo view('UserAdmin/cidade/final',$dados);
       }
     } 
    else{
      return redirect()->to('/Login');
    }
  }
  /**
   * Faz um filtro por cargo na cidade de destino escolhida
   *
   * @return void
   */
  public function buscarCidadeFiltrado(){
 
    $session = \Config\Services::session();  
    $request = \Config\Services::request();
    $pager = \Config\Services::pager();

    if($session->get('logged_in')){
    $get=$request->getGet();
    if($get){
          $cidade=$get['cidade'];
          $cargo=$get['cargo'];
      $usuarios=$this->cidadeModel->cidadeDestinoCargo($cidade,$cargo);
    //dd($usuarios);
      foreach($usuarios as $key=> $usuario){
        $usuarios[$key]['destinos']=$this
        ->destinoModel
        ->where('id_inter',$usuario['id_user'])
        ->join('tb_cidades','tb_cidades.cid_id=user_destino.id_cidade')
        ->findAll();
      }
       $formDropCargo=$this->cargoModel->formDropDow();   
        $dados=[
        'pager'=>$this->cidadeModel->pager,
        'nome'=> $session->usuario,
        'logged_in'=>$session->logged_in,
        'usuarios'=>$usuarios,
        'get'=>$get,
        'cidade'=>$get['cidade'],
        'cargo'=>$get['cargo'],
        'formDropCargo'=>$formDropCargo,
        ];
        //dd($dados);
        echo view('UserAdmin/cidade/final',$dados);
    }
    }
    else{
    return redirect()->to('/Login');
    }
  }
  /**
   * Busca todos os usuários que querem ir para a cidade de origem do usuário logado.
   */

  public function origem(){
    $session = \Config\Services::session();  
    $request = \Config\Services::request();
    $pager = \Config\Services::pager();
    if($session->get('logged_in')){
      $user_id=$session->id_user;
      //dd($user_id);
      $origem=$this->usuariosModel
      ->select('nome,cidade_origem,cid_nome,id_user,cid_uf')
      ->join('tb_cidades', 'usuarios.cidade_origem = tb_cidades.cid_id')
      ->where('id_user',$user_id)
      ->where('cadastro_ativado',1)
      ->findAll();
       //dd($origem);
      $origemLogado=$origem[0]['cidade_origem'];
       //dd($origemLogado);
      $destino=$this->destinoModel->destino($origemLogado);
      //dd($destino);
      foreach($destino as $key=> $areas){
        $destino[$key]['area']=$this
        ->area
        ->where('id',$areas['area_id'])
        ->findAll();
       }
      $formDropCargo=$this->cargoModel->formDropDow(); 
       //dd($destino);
       $google=$this->minhaBiblicoteca->getVariavel();
      $dados=[
        'pager'=>$this->destinoModel->pager,
        'destino'=>$destino,
        'origem'=>$origem,
        'formDropCargo'=>$formDropCargo,
        'google'=>$google,
      ];
      //dd($dados);
      echo view('UserAdmin/cidade/origem',$dados);
    }
    else{
      return redirect()->to('/Login');
    }
  }
  public function origemFiltrado(){
    $session = \Config\Services::session();  
    $request = \Config\Services::request();
    
    if($session->get('logged_in')){
      $session = \Config\Services::session();  
      $request = \Config\Services::request();
      $pager = \Config\Services::pager();

      $user_id=$session->id_user;
      $origem=$this->usuariosModel
      ->join('tb_cidades', 'usuarios.cidade_origem = tb_cidades.cid_id')
      ->where('id_user',$user_id)
      ->where('cadastro_ativado',1)
      ->find();
      $origemLogado=$origem[0]['cidade_origem'];
      $get=$request->getGet();
      if($get){ 
        $cargo=$get['cargo'];
        $destino=$this->destinoModel->destinoFiltrado($origemLogado,$cargo);
        
          $formDropCargo=$this->cargoModel->formDropDow(); 
          $dados=[
            'pager'=>$this->destinoModel->pager,
            'destino'=>$destino,
            'origem'=>$origem,
            'formDropCargo'=>$formDropCargo,
            'cargo'=>$get['cargo'],
          ];
         
          echo view('UserAdmin/cidade/origemFiltrado',$dados);
        }
    }
    else{
      return redirect()->to('/Login');
    }
  }
}