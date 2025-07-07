<?php
namespace App\Controllers;

use App\Models\UsuariosModel;

class Twitter_email extends BaseController{
protected $usuarios;

public function __construct()
{
    $this->usuarios=new UsuariosModel();
}
public function index(){
    
    $novosUsuarios = $this->usuarios->getLastFive($limit=15);
    //dd($novosUsuarios);
    $dados=[
        'novos'=>$novosUsuarios,
    ];
    echo view('Twitter_email/index',$dados);
}
}