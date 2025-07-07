<?php namespace App\Controllers\Admin\Relatorios;

use App\Controllers\UserAdmin\BaseController;
use App\Models\AtivoModel;
use App\Models\CargoModel;
use App\Models\ContatoModel;
use App\Models\DestinoModel;
use App\Models\UsuariosModel;
use CodeIgniter\Debug\Toolbar\Collectors\BaseCollector;

class NovosUsuarios extends BaseController{
    protected $usuarios;
    protected $userDestino;
    protected $userContato;
    protected $ativo;
    protected $cargo;
    
public function __construct(){
    $this->usuarios=new UsuariosModel();
    $this->userDestino=new DestinoModel();
    $this->userContato=new ContatoModel();
    $this->ativo=new AtivoModel();
    $this->cargo=new CargoModel();
    
}
/**lista os ultimos usuários inscritos com os detalhes */

public function listaUsuarios(){
    $session = \Config\Services::session();
    $pager = \Config\Services::pager();
    $usuarios=$this->usuarios
    ->select('id_user,nome,email,estado_origem,cidade_origem,id_orgao,id_cargo,cadastro_ativado,plus,usuarios.created_at,usuarios.updated_at,id_destino,ativo,cid_uf,cid_nome,estado_uf,estado_nome,nome_orgao,nome_cargo')
    ->join('user_destino','user_destino.id_inter=usuarios.id_user')
    ->join('ativo','ativo.usuario_id=usuarios.id_user')
    ->join('tb_cidades','tb_cidades.cid_id=usuarios.cidade_origem')
    ->join('tb_estados','tb_estados.estado_id=usuarios.estado_origem')
    ->join('orgao_empresa','orgao_empresa.id_org=usuarios.id_orgao')
    ->join('cargo','cargo.id_cargos=usuarios.id_cargo')
    ->groupBy('id_inter')
    ->orderBy('updated_at','DESC')
    ->paginate(50);
//dd($usuarios);
    $dados=[
        'usuarios'=>$usuarios,
        'pager'=>$this->usuarios->pager,
    ];
    echo view('Admin/Relatorios/listaUsuarios',$dados);
}
public function inativos()  {
    $session = \Config\Services::session();
    $pager = \Config\Services::pager();
    $usuarios=$this->usuarios->getInativos();
    $dados=[
        'usuarios'=>$usuarios,
        'pager'=>$this->usuarios->pager,
    ];
    echo view('Admin/Relatorios/listaInativos',$dados);
} 

}
