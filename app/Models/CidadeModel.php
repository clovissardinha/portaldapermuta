<?php
namespace App\Models;

class CidadeModel extends BaseModel{

    protected $table="tb_cidades";
    protected $primaryKey = 'cid_id';
    
    protected $allowedFields = [
        'cid_uf',
        'cid_nome',
        'cid_estado'
    ];
    public function formDropDow($post){
        $this->Select("
        tb_cidades.cid_id,
        tb_cidades.cid_nome
        
        ");
        $this->where('cid_estado',$post);
        $cidadeArray= $this->findAll();  
        $optionSelecione = [
            '' => '...selecione'];
        $optionsCidade = $optionSelecione + array_column($cidadeArray,'cid_nome','cid_id');
       
        return $optionsCidade; 
    }

    public function formDropDowTotal(){
        $this->Select("
        tb_cidades.cid_id,
        tb_cidades.cid_nome,
        tb_cidades.cid_estado,
        tb_cidades.cid_uf,
        ");
        $cidadeArray= $this->findAll();  
        
        $optionsCidade = array_column($cidadeArray,'cid_nome','cid_id');
        
        return $optionsCidade; 
    }
    /**
     * Busca a cidade de origem escolhida pelo usuario no cadastro de usuários
     * para poder buscar todos os destinos que coincidem com a escolha.
     */

    public function buscaOrigem($post){
        $this->Select("
        tb_cidades.cid_id,
        tb_cidades.cid_nome,
        usuarios.nome,
        orgao_empresa.nome_orgao,
        cargo.nome_cargo,
        cargo.id_cargo,
        usuarios.id_user,
        usuarios.created_at as created
        ");
    	$this->join('usuarios', 'usuarios.cidade_origem = tb_cidades.cid_id');
        $this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
        $this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
        $this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
        $this->where('cadastro_ativado',1);
        $this->where('cid_id',$post);
        $this->orderBy('nome_orgao');
        return $this->findAll();
      

    }
    /**
     * busca os usuarios que tem como destino a cidade do usuario interessado na origem do usuario logado.
     *
     * @param [type] $id_cidade
     * @return void
     */
    public function buscaCidadeTerceiro($id_cidade,$id_org) {
        $this->Select("
        tb_cidades.cid_id,
        tb_cidades.cid_nome,
        usuarios.nome,
        orgao_empresa.id_orgao,
        orgao_empresa.nome_orgao,
        cargo.nome_cargo,
        usuarios.id_user,
         ");
        $this->join('usuarios', 'usuarios.cidade_origem = tb_cidades.cid_id');
        $this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
        $this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
        $this->where('cid_id',$id_cidade);
        $this->where('id_orgao',$id_org);
        return $this-> findAll();
    }

    public function buscaCidadeOrgao($id_orgao){
        
        $this->Select("
        tb_cidades.cid_id,
        usuarios.id_org,
        usuarios.nome,
         ");
        $this->join('usuarios', 'usuarios.id_orgao= orgao_empresa.id_org');
        $this->where('id_org',$id_orgao);
        return $this-> findAll();
    }
    
    public function getCidadeById($id_cidade) {
        $this->Select("
        tb_cidades.cid_id,
        tb_cidades.cid_nome,
         ");
        $this->where('cid_id',$id_cidade);
        return $this-> findAll();
    }
    /**busca cidade de destino informada */
    public function cidadeDestino($cidade,$indice,$paginas,$fk_cargo){
        $this->select('cid_id,	cid_estado,	cid_uf,	cid_nome,	id_user,usuarios.nome, estado_origem,	cidade_origem,	id_orgao,	id_cargo,nome_cargo,	cadastro_ativado,	plus, usuarios.created_at,	id_org,	nome_orgao,area_usuario.id,area_usuario.area_id,area.nome as name');
            $this->join('usuarios', 'usuarios.cidade_origem = tb_cidades.cid_id');
            $this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
            $this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
            $this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
            $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
            $this->join('area','area.id = area_usuario.area_id','left');
            $this->where('cadastro_ativado',1);
            $this->where('ativo',1);
            $this->where('cid_id',$cidade);
            if($fk_cargo !=''){ 
                $this->where('cargo.id_cargos',$fk_cargo);}
            $this->orderBy($indice,'DESC');
        return $this->paginate($paginas);
    }
    /** busca por cidade de destino informada, com filtro por cargo */
    public function cidadeDestinoCargo($cidade,$cargo){
        $this->select('cid_id,	cid_estado,	cid_uf,	cid_nome,	id_user,usuarios.nome, estado_origem,	cidade_origem,	id_orgao,	id_cargo,nome_cargo,	cadastro_ativado,	plus, usuarios.created_at,	id_org,	nome_orgao,area_usuario.id,area_usuario.area_id,area.nome as name');
            $this->join('usuarios', 'usuarios.cidade_origem = tb_cidades.cid_id');
            $this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
            $this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
            $this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
            $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
            $this->join('area','area.id = area_usuario.area_id','left');
            $this->where('cadastro_ativado',1);
            $this->where('ativo',1);
            $this->where('cid_id',$cidade);
            $this->where('id_cargo',$cargo);            
        return $this->paginate(20);
    }
    //busca a cidade pelo cidade.js
    public function getCidByName($city){
        $this->like('cid_nome', $city);
        $this->orderBy('cid_nome');
        return $this->findAll(20);
    }
    //busca o estado relativo a cidade
    public function buscaEstadoByFk($post){
        $this->where('cid_id',$post);
        return $this->first();
    }
    
}