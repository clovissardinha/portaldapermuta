<?php namespace App\Controllers\UserAdmin;

use App\Models\CargoModel;
use App\Models\DestaquesModel;
use App\Models\UsuariosModel;
use App\Libraries\MinhaBiblioteca;

Class Home extends BaseController{
  protected $destaquesModel;
  protected $cargo;
  protected $usuario;
  protected $minhaBiblicoteca;

  public function __construct()
	{
		$this->destaquesModel = new DestaquesModel();
    $this->cargo=new CargoModel();
    $this->usuario=new UsuariosModel();
    $this->minhaBiblicoteca=new MinhaBiblioteca();
		
	}
    public function index(){
        
       $session = \Config\Services::session();  
       $destaques = $this->destaquesModel->getDestaqueInt();

        if($session->get('logged_in')){
          $usuario=$this->usuario->getUsuarioById($session->id_user);
          $cargos=$this->cargo->buscacargo($usuario[0]['id_cargo']);
          $google=$this->minhaBiblicoteca->getVariavel();
        $dados=[
          'nome'=> $session->usuario,
          'logged_in'=>$session->logged_in,
          'destaques'=>$destaques,
          'ativo'=>$session->ativo,
          'id_user'=>$session->id_user,
          'cargos'=>$cargos,
          'google'=>$google,  
        ];
       //dd($dados);
         echo view('UserAdmin/Home/index',$dados);
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