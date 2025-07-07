<?php
namespace App\Models;

class CargoModel extends BaseModel{

    protected $table="cargo";
    protected $primaryKey = 'id_cargos';
    
    protected $allowedFields = [
        'nome_cargo'
    ];
    /**
     * Cria um array para o dropdow do cargo
     *
     * @param array|null $params
     * @return void
     */
        public function formDropDow(){
            $this->Select("
            cargo.id_cargos,
            cargo.nome_cargo,
            ");
            $this->orderBy('nome_cargo');
            $orgaoArray= $this->findAll();  
            $optionSelecione = [
                '' => '...selecione'];
           $optionscargo = $optionSelecione + array_column($orgaoArray,'nome_cargo','id_cargos');
           
           return $optionscargo;
        }
       /** busca o cargo para alterar */ 
       public function buscacargoById($cargos){
        $this->Select("
        cargo.id_cargos,
        cargo.nome_cargo,
        usuarios.id_user,
        usuarios.nome,
        orgao_empresa.nome_orgao,
        usuarios.created_at,
        ");
        $this->join('usuarios','usuarios.id_cargo=cargo.id_cargos');
        $this->join('orgao_empresa','usuarios.id_orgao=orgao_empresa.id_org');
        $this->where('id_cargos',$cargos);
        return $this->findAll();
        
       }
       /** busca o cargo para pagina inicial */ 
       public function buscacargo($cargos){
        $this->Select("
        cargo.id_cargos,
        cargo.nome_cargo,
        usuarios.id_user,
        usuarios.nome,
        usuarios.created_at,
        orgao_empresa.nome_orgao,
        usuarios.created_at,
        tb_cidades.cid_nome,
        tb_cidades.cid_uf
        ");
        $this->join('usuarios','usuarios.id_cargo=cargo.id_cargos');
        $this->join('orgao_empresa','usuarios.id_orgao=orgao_empresa.id_org');
        $this->join('tb_cidades','tb_cidades.cid_id=usuarios.cidade_origem','left');
        $this->where('id_cargos',$cargos);
        $this->orderBy('created_at','DESC');
        $this->limit(50);
        return $this->find();
        
       }
       public function getcargoById($cargos){
        $this->Select("
        cargo.id_cargos,
        cargo.nome_cargo,
        ");
        $this->where('id_cargos',$cargos);
        return $this->findAll();
        
       }
       public function buscaCargoPesquisa($cargo,$area,$indice,$numero,$orgao){
                $this->select("
                usuarios.id_user,
                usuarios.nome,
                usuarios.cadastro_ativado,
                usuarios.id_cargo,
                usuarios.created_at,
                cargo.id_cargos,
                cargo.nome_cargo,
                orgao_empresa.id_org,
                orgao_empresa.nome_orgao,
                tb_cidades.cid_nome,
                tb_cidades.cid_uf,
                ativo.ativo,
                area_usuario.usuario_id,
                area_usuario.area_id,
                area.id,
                area.nome as name,
                ");
                $this->join('usuarios','usuarios.id_cargo=cargo.id_cargos','left');
                $this->join('orgao_empresa','usuarios.id_orgao=orgao_empresa.id_org','left');
                $this->join('tb_cidades','tb_cidades.cid_id=usuarios.cidade_origem','left');
                $this->join('ativo', 'usuarios.id_user = ativo.usuario_id','left');
                $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
                $this->join('area','area.id = area_usuario.area_id','left');
                $this->where('id_cargos',$cargo);
                if($area !=''){ 
                $this->where('area_usuario.area_id',$area);}
                if($orgao !=''){ 
                    $this->where('orgao_empresa.id_org',$orgao);}
                $this->where('ativo =',1);
                $this->orderBy($indice,'DESC');
                return $this->paginate($numero);
    }
     
      
    public function getCargo($cargo){
            $this->like('nome_cargo',$cargo);
            $this->orderBy('nome_cargo');
            return $this->paginate(100);
    } 
//busca a cidade pelo cidade.js
public function getCargoByName($cargo){
    $this->like('nome_cargo', $cargo);
    $this->orderBy('nome_cargo');
    return $this->findAll(10);
}
}