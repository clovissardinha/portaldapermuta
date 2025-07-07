<?php
namespace App\Controllers\UserAdmin;

use App\Models\UsuariosModel;

class Search extends BaseController{


protected $usuario;

public function __construct()
{
    $this->usuario = new UsuariosModel();
}

public function index()
{
    $session = \Config\Services::session(); 
    $request = \Config\Services::request();
	$validation = \Config\Services::validation(); 
        if($session->get('logged_in')){
            if ($post = $request->getPost())
        {
            $val = $this->validate([
                'busca'=>'required|max_length[50]|min_length[3]',
                ]                
            );
            if(!$val){
                $dados=[
                    'errors'=>$validation->getErrors()
                ];
                echo view('UserAdmin/_common/header',$dados);
            }
            else{
            $termo=$post['busca'];
            $busca=$this->usuario->search($termo);
            $quantidade=$this->usuario->contarSearch($termo);   
            //dd($quantidade);
            $dados=[
                'buscas'=>$busca,
                'termo'=>$termo,
                'quantidade'=>$quantidade
            ];
            //dd($dados);
            echo view('UserAdmin/search',$dados);
        }
        }
        }
        else{
            return redirect()->to(base_url());
        }
}
    
}