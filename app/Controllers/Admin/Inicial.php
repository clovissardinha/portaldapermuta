<?php namespace App\Controllers\Admin;

use App\Controllers\UserAdmin\BaseController;

class Inicial extends BaseController{

    public function index(){
        $session = \Config\Services::session(); 
        if($session->get('logged')){
            $dados=[
                'titulo'=>'Administrativo'
            ];
            echo view('Admin/paginaInicial',$dados);
        }
        else{
            $dados=[
                'titulo'=>'Administrativo'
            ];
            echo view('Admin/formLogin',$dados);
        }

    }

}