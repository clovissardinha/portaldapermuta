<?php
namespace App\Models;

class OrgaoModel extends BaseModel{

    protected $table="orgao_empresa";
    protected $primaryKey = 'id_org';

    protected $beforeInsert = [];
    protected $beforeDelete = [];
    
    protected $allowedFields = [
        'nome_orgao',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    /**
     * Cria um array para o dropdow do Estado
     *
     * @param array|null $params
     * @return void
     */
        public function formDropDow(){
            $this->Select("
            orgao_empresa.id_org,
            orgao_empresa.nome_orgao,
            ");
            $this->orderBy('nome_orgao');
            $orgaoArray= $this->findAll(); 
            $optionSelecione = [
                '' => '...selecione'];
            
           $optionsorgao = $optionSelecione+ array_column($orgaoArray,'nome_orgao','id_org');
           
           return $optionsorgao;
        }
        /** busca órgão para alterar */
       public function buscaorgaoById($orgao){
        $this->Select("
        orgao_empresa.id_org,
        orgao_empresa.nome_orgao,
        usuarios.nome,
        usuarios.id_user,
        usuarios.id_cargo,
        usuarios.created_at,
        cargo.nome_cargo,
        ");
        $this->join('usuarios','usuarios.id_orgao=orgao_empresa.id_org');
        $this->join('cargo','cargo.id_cargos=usuarios.id_cargo');
        $this->where('id_org',$orgao);
        return $this->findAll();
       }
    /**
     * busca o órgão a que o usuário pertence
     */
        public function getOrgaoById($id_org){
            $this->select("
            orgao_empresa.id_org,
            orgao_empresa.nome_orgao,
            ");
            $this->where('id_org',$id_org);
            return $this->findAll(); 
    }
    /** busca órgao para a pesquisa por órgaõ */
    public function pesquisaOrgao($orgao,$indice,$paginas,$carg){
       
            $this->select("
                orgao_empresa.id_org,
                orgao_empresa.nome_orgao,
                usuarios.id_user,
                usuarios.nome,
                usuarios.created_at,
                usuarios.cadastro_ativado,
                cargo.id_cargos,
                cargo.nome_cargo,
                tb_cidades.cid_id,
                tb_cidades.cid_uf,
                tb_cidades.cid_nome,
                ativo.usuario_id,
                ativo.ativo,
                area_usuario.id,
                area_usuario.area_id,
                area.id,
                area.nome as name,
            ");
            $this->join('usuarios','usuarios.id_orgao=orgao_empresa.id_org');
            $this->join('cargo','cargo.id_cargos=usuarios.id_cargo');
            $this->join('tb_cidades','tb_cidades.cid_id=usuarios.cidade_origem');
            $this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
            $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
            $this->join('area','area.id = area_usuario.area_id','left');
            $this->where('id_org',$orgao);
            if($carg !=''){ 
                $this->where('cargo.id_cargos',$carg);}
            $this->where('ativo =',1);
            $this->where('cadastro_ativado =',1);
            $this->orderBy($indice,'DESC');
            return $this->paginate($paginas);
    }
    public function pesquisaOrgaoFiltrado($orgao,$cargo,$indice,$paginas){
        $this->select("
                orgao_empresa.id_org,
                orgao_empresa.nome_orgao,
                usuarios.id_user,
                usuarios.nome,
                usuarios.created_at,
                usuarios.cadastro_ativado,
                cargo.id_cargos,
                cargo.nome_cargo,
                tb_cidades.cid_id,
                tb_cidades.cid_uf,
                tb_cidades.cid_nome,
                ativo.usuario_id,
                ativo.ativo,
                area_usuario.id,
                area_usuario.area_id,
                area.id,
                area.nome as name,
                cargo.id_cargos,
                cargo.nome_cargo,
            ");
            $this->join('usuarios','usuarios.id_orgao=orgao_empresa.id_org');
            $this->join('cargo','cargo.id_cargos=usuarios.id_cargo');
            $this->join('tb_cidades','tb_cidades.cid_id=usuarios.cidade_origem');
            $this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
            $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
            $this->join('area','area.id = area_usuario.area_id','left');
            $this->where('id_org',$orgao);
            $this->where('id_cargos',$cargo);
            $this->where('ativo =',1);
            $this->where('cadastro_ativado =',1);
            $this->orderBy($indice,'DESC');
            return $this->paginate($paginas);
    }
    //busca o órgão pelo orgao.js
    public function getOrgaoByName($orgao){
        $this->like('nome_orgao', $orgao);
        $this->orderBy('nome_orgao');
        return $this->findAll(10);
        
    }    

}