<?php namespace App\Controllers\UserAdmin;

use App\Models\AreaModel;
use App\Models\AreaUsuarioModel;

class DadosArea extends BaseController{
    protected $areaModel;
    protected $areaUsuarioModel;

    public function __construct()
    {
       $this->areaModel= new AreaModel();
       $this->areaUsuarioModel=new AreaUsuarioModel();
    }

    public function alteraArea(){
        $session = \Config\Services::session();  
            if($session->get('logged_in')){
                $areas=$this->areaUsuarioModel->getUserArea($_SESSION['id_user']);
                //dd($areas);
                $dados=[
                    'usuario'=>$session->usuario,
                    'id_user'=>$session->id_user,
                    'areas'=>$areas,
                ];
                //dd($dados);
                 echo view('UserAdmin/Area/formArea',$dados);
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
      public function deletar($id){
       
        if(
          $this->areaUsuarioModel
          ->where('area_id',$id)
          ->delete()
        ){
         
           return redirect()->to(base_url('UserAdmin/DadosPessoais/index'));
          }
        }  
      public function cadastrar(){
        $session = \Config\Services::session(); 
        if($session->get('logged_in')){ 
                $formDropDown= $this->areaModel->formDropDow(); 
          $dados=[
            'formDropDown'=>$formDropDown,
            'usuario'=>$_SESSION['id_user'],
          ];
          //dd($dados);
          echo view('UserAdmin/Area/formIncluiArea',$dados);
        }
      }
      public function salvarDados(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if($session->get('logged_in')){ 
          if($post=$request->getPost()){
          //dd($post);
          $dados=[
            'usuario_id'=>$post['usuario_id'],
            'area_id'=>$post['area_id'],
          ];
          //dd($dados);
        if($dados['area_id']!=''){
        if($this->areaUsuarioModel->save($dados)) {          
         return redirect()->to(base_url('UserAdmin/DadosPessoais/index'));
          }
        }
        else 
          return redirect()->to(base_url('UserAdmin/DadosPessoais/index'));
        }
      } 
    } 
}