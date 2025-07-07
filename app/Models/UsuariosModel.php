<?php namespace App\Models;

use Kint\CallFinder;

class UsuariosModel extends BaseModel{

    protected $table      = 'usuarios';
    protected $primaryKey = 'id_user';

    protected $useAutoIncrement = true;
    
    protected $useTimestamps='true';
    protected $beforeInsert   = [];
    
    protected $beforeDelete = [];
    
    protected $allowedFields = [
       'nome',
       'apelido',
       'email',
       'foto',
       'senha',
       'estado_origem',
       'cidade_origem',
       'id_orgao',
       'id_cargo',
       'cadastro_ativado',
       'plus',
       'created_at',
       'updated_at',
       'deleted_at',

    ];
    
/**
 * Trás os cinco ultimos cadastros confirmados e mostra na página inicial
 *
 * @return array
 */
    public function getLastFive($limit): array {
      $this-> SELECT("
      usuarios.id_user,
      usuarios.created_at as created_at_usuarios,
      usuarios.updated_at as updated_at_usuarios,
      usuarios.cidade_origem,
      usuarios.id_orgao,
      cargo.id_cargos,
      tb_cidades.cid_uf,
      tb_cidades.cid_nome,
      orgao_empresa.id_org,
      orgao_empresa.nome_orgao,
      cargo.nome_cargo,
      usuarios.cadastro_ativado
      ") ;
     
       $this->JOIN ('tb_cidades', 'usuarios.cidade_origem=tb_cidades.cid_id','right');
       $this->JOIN ( 'orgao_empresa', 'usuarios.id_orgao=orgao_empresa.id_org' ); 
       $this->JOIN ('cargo','usuarios.id_cargo=cargo.id_cargos');  
       $this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
       $this->where("usuarios.cadastro_ativado=1"); 
       $this->where("ativo.ativo=1"); 
       $this->where('usuarios.updated_at >= usuarios.created_at');
       $this->orderBy('updated_at_usuarios','DESC'); 
            
     return $this->findAll($limit);
        
    }
    /**
     * busca o usuário pelo e-mail e senha e vê se tem cadastro no bd
     *
     * @param [type] $senha
     * @param [type] $email
     * @return void
     */
    public function getUsuarioByEmail($email=null)
    {
        $this->SELECT("
        usuarios.nome,
        usuarios.apelido,
        usuarios.id_user,
        usuarios.email,
        usuarios.senha,
        usuarios.cadastro_ativado,
        contato.imagem
        ");
        $this->join('contato', 'usuarios.id_user =contato.usuario_id','left');
        $this->where('email',$email );
        return $this->find();
        
    }
   /**
    * 
    *Verifica se o email já existe
    * @return void
    */ 
    public function cadastro($email){
        $this->SELECT("
        `email`");
        $this->where('email',$email );
        return $this->find();
    }
    
    /**
     * busca a cidade de origem do usuario
     *
     * @param [type] $user_id
     * @return array
     */
    public function buscaOrigem($user_id):array{
        $this->SELECT("
        usuarios.id_user,
        usuarios.nome,
        usuarios.email,
        contato.email_alternativo,
        usuarios.created_at,
        usuarios.cidade_origem,
        usuarios.id_orgao,
        cargo.id_cargos,
        tb_cidades.cid_nome,
        tb_cidades.cid_uf,
        orgao_empresa.nome_orgao,
        cargo.nome_cargo,
        mural.comentario,
        contato.celular,
        contato.fone,
        usuarios.cadastro_ativado,
        area.nome as name,
        ");
        $this->join('tb_cidades', 'usuarios.cidade_origem = tb_cidades.cid_id');
    	$this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
    	$this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
        $this->join('contato', 'usuarios.id_user = contato.usuario_id');
        $this->join('mural', 'usuarios.id_user = mural.usuario_id');
        $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
        $this->join('area','area.id = area_usuario.area_id','left');
        $this->where('id_user',$user_id);
        $this->where('cadastro_ativado',1);
        return $this->find();
    }
    /**
     * Busca o usuário pelo id
     *
     * @param [type] $user_id
     * @return void
     */
    public function getUsuarioById($user_id):array{
        $this->SELECT("
        usuarios.id_user,
        usuarios.nome,
        usuarios.apelido,
        usuarios.cidade_origem,
        usuarios.estado_origem,
        usuarios.id_orgao,
        usuarios.id_cargo,
        usuarios.email,
        usuarios.cadastro_ativado,
        usuarios.created_at,
        orgao_empresa.nome_orgao,
        cargo.nome_cargo,
        contato.usuario_id as usuario,
        contato.fone,
        contato.celular,
        contato.email_alternativo,
        contato.id_contato,
        contato.whatsapp,
        mural.comentario,
        tb_cidades.cid_nome,
        tb_cidades.cid_uf,
        area.nome as name,
        ");
        $this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org','left');
    	$this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos','left');
        $this->join('contato', 'usuarios.id_user = contato.usuario_id','left');
        $this->join('mural', 'usuarios.id_user = mural.usuario_id','left');
        $this->join('tb_cidades', 'usuarios.cidade_origem = tb_cidades.cid_id','left');
        $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
        $this->join('area','area.id = area_usuario.area_id','left');
        $this->where('id_user',$user_id);
        $this->where('cadastro_ativado',1);
        return $this->findAll();
    }
    /**
     * busca o usuário pelo id do estado
     *
     * @param [type] $estado_id
     * @return array
     */
    public function getUsuarioByEstado($estado_id,$paginas,$ordem):array{
        $this->SELECT("
        usuarios.id_user,
        usuarios.nome,
        usuarios.email,
        usuarios.cidade_origem,
        usuarios.estado_origem,
        usuarios.id_orgao,
        cargo.id_cargos,
        tb_cidades.cid_nome,
        tb_cidades.cid_uf,
        orgao_empresa.nome_orgao,
        cargo.nome_cargo,
        contato.fone,
        contato.email_alternativo,
        mural.comentario,
        contato.celular,
        usuarios.cadastro_ativado,
        usuarios.created_at as created,
        area_usuario.id,
        area_usuario.area_id,
        area.nome as name,
        ");
        $this->join('tb_cidades', 'usuarios.cidade_origem = tb_cidades.cid_id');
    	$this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
    	$this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
    	$this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
        $this->join('contato', 'usuarios.id_user = contato.usuario_id');
        $this->join('mural', 'usuarios.id_user = mural.usuario_id');
        $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
        $this->join('area','area.id = area_usuario.area_id','left');
        $this->where('estado_origem',$estado_id);
        $this->where('ativo',1);
        $this->groupBy('id_user');
        $this->orderBy($ordem,'DESC');
        return $this->paginate($paginas);
    }
    public function getUsuarioByEstadoFiltrado($estado_id,$idCargo):array{
        $this->SELECT("
        usuarios.id_user,
        usuarios.nome,
        usuarios.email,
        usuarios.cidade_origem,
        usuarios.estado_origem,
        usuarios.id_orgao,
        cargo.id_cargos,
        tb_cidades.cid_nome,
        tb_cidades.cid_uf,
        orgao_empresa.nome_orgao,
        cargo.nome_cargo,
        contato.fone,
        contato.email_alternativo,
        mural.comentario,
        contato.celular,
        usuarios.cadastro_ativado,
        usuarios.created_at as created,
        area_usuario.id,
        area_usuario.area_id,
        area.nome as name,
        ");
        $this->join('tb_cidades', 'usuarios.cidade_origem = tb_cidades.cid_id');
    	$this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
    	$this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
    	$this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
        $this->join('contato', 'usuarios.id_user = contato.usuario_id');
        $this->join('mural', 'usuarios.id_user = mural.usuario_id');
        $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
        $this->join('area','area.id = area_usuario.area_id','left');
        $this->where('estado_origem',$estado_id);
        $this->where('id_cargos',$idCargo);
        $this->where('ativo',1);
        $this->groupBy('id_user');
        $this->orderBy('nome_orgao');
        return $this->paginate(10);
    }
    /**
     * busca o email para remeter a senha ao usuario esquecido
     */
    public function getByEmail($email){
        $this->select(
            "
            usuarios.id_user,
            usuarios.email,
            usuarios.nome,
            usuarios.senha,
            "
        );
        $this->where('email',$email);
        return $this->find();
    }
    public function buscaUsuarioByData($data_ini,$data_fim){
       $this-> SELECT("
        usuarios.id_user,
        usuarios.nome,
        usuarios.created_at,
        usuarios.cidade_origem,
        usuarios.id_orgao,
        cargo.id_cargos,
        tb_cidades.cid_uf,
        tb_cidades.cid_nome,
        orgao_empresa.id_org,
        orgao_empresa.nome_orgao,
        cargo.nome_cargo,
        usuarios.cadastro_ativado
      ") ;
        $this->JOIN ('tb_cidades', 'usuarios.cidade_origem=tb_cidades.cid_id','left');
        $this->JOIN ( 'orgao_empresa', 'usuarios.id_orgao=orgao_empresa.id_org','left' ); 
        $this->JOIN ('cargo','usuarios.id_cargo=cargo.id_cargos','left');  
        $this->where('created_at >=',$data_ini);
        $this->where('created_at <=',$data_fim);
        $this->where('cadastro_ativado',1);
        $this->orderBy('created_at','desc'); 
        return $this->findAll();
    }
    
    
    public function delete_user($id_user){
        $this->delete("*");
       $this->where('id_user',$id_user);
       return $this->delete();
    }
    /**Busca o intervalo de datas para pesquisa */
    public function pesquisaData($paginas,$dataIni,$dataFim){
        $this->SELECT("
        usuarios.id_user,
        usuarios.nome,
        usuarios.email,
        usuarios.cidade_origem,
        usuarios.estado_origem,
        usuarios.id_orgao,
        cargo.id_cargos,
        tb_cidades.cid_nome,
        tb_cidades.cid_uf,
        orgao_empresa.nome_orgao,
        cargo.nome_cargo,
        usuarios.cadastro_ativado,
        usuarios.created_at as created,
        area_usuario.id,
        area_usuario.area_id,
        area.nome as name,
        ");
        $this->JOIN ('tb_cidades', 'usuarios.cidade_origem=tb_cidades.cid_id');
        $this->JOIN ('orgao_empresa', 'usuarios.id_orgao=orgao_empresa.id_org'); 
        $this->JOIN ('ativo', 'usuarios.id_user = ativo.usuario_id');
        $this->JOIN ('cargo','usuarios.id_cargo=cargo.id_cargos');
        $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
        $this->join('area','area.id = area_usuario.area_id','left');  
        $this->where('usuarios.created_at >=',$dataIni);
        $this->where('usuarios.created_at <=',$dataFim);
        $this->where('ativo',1);
        $this->where('cadastro_ativado',1);
        $this->orderBy('created','DESC');
        return $this->paginate($paginas);
    }
    public function pesquisaDataOrgao($orgao,$dataIni,$dataFim){
        $this->SELECT("
        usuarios.id_user,
        usuarios.nome,
        usuarios.email,
        usuarios.cidade_origem,
        usuarios.estado_origem,
        usuarios.id_orgao,
        cargo.id_cargos,
        tb_cidades.cid_nome,
        tb_cidades.cid_uf,
        orgao_empresa.nome_orgao,
        cargo.nome_cargo,
        usuarios.cadastro_ativado,
        usuarios.created_at as created,
        area_usuario.id,
        area_usuario.area_id,
        area.nome as name,
        ");
        $this->JOIN ('tb_cidades', 'usuarios.cidade_origem=tb_cidades.cid_id','left');
        $this->JOIN ( 'orgao_empresa', 'usuarios.id_orgao=orgao_empresa.id_org','left' ); 
        $this->JOIN('ativo', 'usuarios.id_user = ativo.usuario_id');
        $this->JOIN ('cargo','usuarios.id_cargo=cargo.id_cargos','left');  
        $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
        $this->join('area','area.id = area_usuario.area_id','left');  
        $this->where('id_org',$orgao);
        $this->where('usuarios.created_at >=',$dataIni);
        $this->where('usuarios.created_at <=',$dataFim);
        $this->where('ativo',1);
        return $this->paginate(50);
    }
    //pega todos os usuarios inativos no bd
    public function getInativos(){
    $this->select('id_user,nome,email,estado_origem,cidade_origem,id_orgao,id_cargo,cadastro_ativado,plus,usuarios.created_at,ativo,contato.usuario_id,contato.fone,contato.email_alternativo');
    $this->join('user_destino','user_destino.id_inter=usuarios.id_user','left');
    $this->join('ativo','ativo.usuario_id=usuarios.id_user','left');
    $this->join('contato','contato.usuario_id=usuarios.id_user','left');
    $this->where('cadastro_ativado',0);
    //$this->groupBy('id_user');
    $this->orderBy('created_at','DESC');
    return $this->paginate(50);
    }
    /**
     * Busca por vários termos no topo da header
     */
    public function search($termo){
         $this->SELECT("
        usuarios.id_user,
        usuarios.nome,
        usuarios.email,
        usuarios.cidade_origem,
        usuarios.estado_origem,
        usuarios.id_orgao,
        cargo.id_cargos,
        tb_cidades.cid_nome,
        tb_cidades.cid_uf,
        orgao_empresa.nome_orgao,
        cargo.nome_cargo,
        contato.fone,
        contato.email_alternativo,
        mural.comentario,
        contato.celular,
        usuarios.cadastro_ativado,
        usuarios.created_at as created,
        area_usuario.id,
        area_usuario.area_id,
        area.nome as name,
        ");
        $this->join('tb_cidades', 'usuarios.cidade_origem = tb_cidades.cid_id');
    	$this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
    	$this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
    	$this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
        $this->join('contato', 'usuarios.id_user = contato.usuario_id');
        $this->join('mural', 'usuarios.id_user = mural.usuario_id');
        $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
        $this->join('area','area.id = area_usuario.area_id','left');
        $this->havingLike('tb_cidades.cid_nome',$termo);
        $this->orHavingLike('cargo.nome_cargo',$termo);
        $this->orHavingLike('orgao_empresa.nome_orgao',$termo);
        $this->orHavingLike('name',$termo);
        $this->where('ativo',1);
        $this->groupBy('id_user');
        return $this->findAll(100);
    }
    public function contarSearch($termo){
        $this->SELECT("
       usuarios.id_user,
       usuarios.nome,
       usuarios.email,
       usuarios.cidade_origem,
       usuarios.estado_origem,
       usuarios.id_orgao,
       cargo.id_cargos,
       tb_cidades.cid_nome,
       tb_cidades.cid_uf,
       orgao_empresa.nome_orgao,
       cargo.nome_cargo,
       contato.fone,
       contato.email_alternativo,
       mural.comentario,
       contato.celular,
       usuarios.cadastro_ativado,
       usuarios.created_at as created,
       area_usuario.id,
       area_usuario.area_id,
       area.nome as name,
       ");
       $this->join('tb_cidades', 'usuarios.cidade_origem = tb_cidades.cid_id');
       $this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
       $this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
       $this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
       $this->join('contato', 'usuarios.id_user = contato.usuario_id');
       $this->join('mural', 'usuarios.id_user = mural.usuario_id');
       $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
       $this->join('area','area.id = area_usuario.area_id','left');
       $this->havingLike('tb_cidades.cid_nome',$termo);
       $this->orHavingLike('cargo.nome_cargo',$termo);
       $this->orHavingLike('orgao_empresa.nome_orgao',$termo);
       $this->orHavingLike('name',$termo);
       $this->where('ativo',1);
       $this->groupBy('id_user');
       return $this->countAllResults();
   }
   public function substituir($id , $data)
   {
    
    $this->set('id_cargo',$id);
    $this->where('id_cargo',$data);
    $this->update();
    return $this;
   }
}
