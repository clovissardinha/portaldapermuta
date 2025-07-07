<?php

namespace App\Controllers\UserAdmin;

use App\Models\AreaUsuarioModel;
use App\Models\CidadeModel;
use App\Models\DestinoModel;
use App\Models\UsuariosModel;
use App\Libraries\MinhaBiblioteca;
class Usuario extends BaseController
{
	protected $UsuariosModel;
    protected $DestinoModel;
	protected $CidadeModel;
    protected $areaUsuario;
    protected $minhaBiblicoteca;
	public function __construct()
	{
		$this->UsuariosModel = new UsuariosModel();
        $this->DestinoModel = new DestinoModel();
        $this->CidadeModel = new CidadeModel();
        $this->areaUsuario=new AreaUsuarioModel();
        $this->minhaBiblicoteca=new MinhaBiblioteca();
	}
    /**
     * Recebe o id do usuario pesquisado e retorna para a página com seus dados
     * Serve na pesquisa de destino. 
     *
     * @return void
     */
    public function getUsuarioById($user_id){
        $session = \Config\Services::session();  
        if($session->get('logged_in')){
        $request = \Config\Services::request();
        $session = \Config\Services::session(); 
       
       
        $usuario=$this->UsuariosModel->buscaOrigem($user_id);
        //dd($usuario);
        $destino=$this->DestinoModel->getDestinoById($user_id);
        //dd($destino);
        $area=$this->areaUsuario->getUserArea($user_id);
        $google=$this->minhaBiblicoteca->getVariavel();
        
        $dados=[
            'usuarios'=>$usuario,
            'destino'=>$destino,
            'area' =>$area,
            'google'=>$google,  
        ];
        //dd($dados);
        return view('UserAdmin/Usuario/Ficha',$dados);
    }
    else{
        return redirect()->to('/Login');
    }
        
    }
  /**
   * Mesma função de buscar usuario, porém, para voltar para a consulta de origem
   */


    public function getUsuarioByIdOrigem($user_id){
        $session = \Config\Services::session();  
        if($session->get('logged_in')){
        $request = \Config\Services::request();
        $session = \Config\Services::session(); 
        
        $usuario=$this->UsuariosModel->buscaOrigem($user_id);
        $destino=$this->DestinoModel->getDestinoById($user_id);
        $google=$this->minhaBiblicoteca->getVariavel();
        $dados=[
            'usuarios'=>$usuario,
            'destino'=>$destino,
            'google'=>$google
        ];

        return view('UserAdmin/Usuario/FichaOrigem',$dados);
    }
    else{
        return redirect()->to('/Login');
    }
        
    }
     /**
   * Mesma função de buscar usuario, porém, para voltar para a consulta de órgão
   */
    public function getUsuarioByIdOrgao($user_id){
        $session = \Config\Services::session();  
        if($session->get('logged_in')){
        $request = \Config\Services::request();
      
        $usuario=$this->UsuariosModel->getUsuarioById($user_id);
        $destino=$this->DestinoModel->getDestinoById($user_id);
        $google=$this->minhaBiblicoteca->getVariavel();
        $dados=[
            'usuarios'=>$usuario,
            'destino'=>$destino,
            'google'=>$google,
        ];
        return view('UserAdmin/Usuario/FichaOrgao',$dados);
    }
    else{
        return redirect()->to('/Login');
    }
        
    }
     /**
   * Mesma função de buscar usuario, porém, para voltar para a consulta de cargo
   */
    public function getUsuarioByIdCargo($user_id){
        $session = \Config\Services::session();  
        if($session->get('logged_in')){
        $request = \Config\Services::request();
        $session = \Config\Services::session(); 
      
        $usuario=$this->UsuariosModel->getUsuarioById($user_id);
        $destino=$this->DestinoModel->getDestinoById($user_id);
        $google=$this->minhaBiblicoteca->getVariavel();
        $dados=[
            'usuarios'=>$usuario,
            'destino'=>$destino,
            'google'=>$google
        ];
        return view('UserAdmin/Usuario/FichaCargo',$dados);
    }
    else{
        return redirect()->to('/Login');
    }
        
    }
     /**
   * Mesma função de buscar usuario, porém, para voltar para a consulta de estado
   */
    public function getUsuarioByIdEstado($user_id){
        $session = \Config\Services::session();  
        if($session->get('logged_in')){
        $request = \Config\Services::request();
        $session = \Config\Services::session(); 
      
        $usuario=$this->UsuariosModel->getUsuarioById($user_id);
        $destino=$this->DestinoModel->getDestinoById($user_id);
        $google=$this->minhaBiblicoteca->getVariavel();
        $dados=[
            'usuarios'=>$usuario,
            'destino'=>$destino,
            'google'=>$google
        ];
        return view('UserAdmin/Usuario/FichaEstado',$dados);
    }
    else{
        return redirect()->to('/Login');
    }
        
    }
     /**
   * Mesma função de buscar usuario, porém, para voltar para a  triangulacao
   */
  public function getUsuarioByIdTriangulacao($user_id){
    $session = \Config\Services::session();  
    if($session->get('logged_in')){
    $request = \Config\Services::request();
    $session = \Config\Services::session(); 
  
    $usuario=$this->UsuariosModel->getUsuarioById($user_id);
    $destino=$this->DestinoModel->getDestinoById($user_id);
    $google=$this->minhaBiblicoteca->getVariavel();
    $dados=[
        'usuarios'=>$usuario,
        'destino'=>$destino,
        'google'=>$google
    ];
    //dd($dados);
    return view('UserAdmin/Usuario/FichaTriangulacao',$dados);
}
else{
    return redirect()->to('/Login');
}
    
}
  /**
   * Mesma função de buscar usuario, porém, para voltar para a  pesquisaData
   */
  public function getUsuarioByIdData($user_id){
        $session = \Config\Services::session();  
            if($session->get('logged_in')){
            $request = \Config\Services::request();
            $session = \Config\Services::session(); 
        
            $usuario=$this->UsuariosModel->getUsuarioById($user_id);
            $destino=$this->DestinoModel->getDestinoById($user_id);
            $google=$this->minhaBiblicoteca->getVariavel();

            $dados=[
                'usuarios'=>$usuario,
                'destino'=>$destino,
                'google'=>$google,
            ];
            //dd($dados);
            return view('UserAdmin/Usuario/FichaData',$dados);
            }
        else{
            return redirect()->to('/Login');
        }
    
    }
}