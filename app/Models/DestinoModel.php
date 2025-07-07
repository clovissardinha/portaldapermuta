<?php
namespace App\Models;

class DestinoModel extends BaseModel{

    protected $table="user_destino";
    protected $primaryKey = 'id_destino';
    
    protected $allowedFields = [
        'id_inter',
        'id_cidade',
        'created_at'
    ];
/**
 * busca a cidade de destino escolhida pelo usuário para ver quem está lá e 
 * para onde está indo e ver se coincide.
 *
 * @param [type] $id_inter
 * @return array
 */
    public function getDestinoById($id_inter):array{
            $this->select("
            user_destino.id_cidade,
            user_destino.id_inter,
            tb_cidades.cid_nome,
            tb_cidades.cid_uf,
            user_destino.id_destino,
            user_destino.created_at as created,
            area.id,
            area.nome,
            area_usuario.usuario_id,
            area_usuario.area_id,
            ");
            $this->where('id_inter',$id_inter);
            $this->join('tb_cidades','tb_cidades.cid_id=user_destino.id_cidade');
            $this->join('area_usuario' , 'user_destino.id_inter=area_usuario.usuario_id','left');
            $this->join('area','area.id = area_usuario.area_id','left');
          return $this->findAll();
           
    }
/**
 * Busca quem quer ir para a cidade do usuário que está logado.
 *
 * @param [type] $origemLogado
 * @return void
 */
    public function destino($origemLogado){
            $this->select("
            user_destino.id_cidade,
            usuarios.id_user,
            usuarios.nome,
            user_destino.id_destino,
            cargo.nome_cargo,
            orgao_empresa.nome_orgao,
            orgao_empresa.id_org,
            usuarios.cidade_origem,
            usuarios.created_at,
            tb_cidades.cid_nome,
            user_destino.created_at as created,
            tb_cidades.cid_uf,
            area_usuario.usuario_id,
            area_usuario.area_id,
            ");
            $this->join('usuarios','usuarios.id_user=user_destino.id_inter');
            $this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
            $this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
            $this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
            $this->join('tb_cidades','tb_cidades.cid_id=usuarios.cidade_origem');
            $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
            $this->where('cadastro_ativado',1);
            $this->where('id_cidade',$origemLogado);
            $this->orderBy('nome_orgao');
            $this->groupBy('id_inter');
            return $this->paginate(50);

    }
    public function destinoFiltrado($origemLogado,$cargo){
        $this->select("
        user_destino.id_cidade,
        usuarios.id_user,
        usuarios.nome,
        user_destino.id_destino,
        cargo.nome_cargo,
        orgao_empresa.nome_orgao,
        orgao_empresa.id_org,
        usuarios.cidade_origem,
        tb_cidades.cid_nome,
        user_destino.created_at as created,
        tb_cidades.cid_uf,
        area_usuario.usuario_id,
        area_usuario.area_id,
        area.nome as name,
        ");
        $this->join('usuarios','usuarios.id_user=user_destino.id_inter');
        $this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
        $this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
        $this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
        $this->join('tb_cidades','tb_cidades.cid_id=usuarios.cidade_origem');
        $this->join('area_usuario' , 'user_destino.id_inter=area_usuario.usuario_id','left');
        $this->join('area','area.id = area_usuario.area_id','left');
        $this->where('cadastro_ativado',1);
        $this->where('id_cidade',$origemLogado);
        $this->where('id_cargos',$cargo);
        $this->orderBy('nome_orgao');
        $this->groupBy('id_inter');
        return $this->paginate(10);

}
    public function destinoTerc($origemLogado){
        $this->select("
        user_destino.id_cidade,
        usuarios.id_user,
        usuarios.nome,
        user_destino.id_destino,
        cargo.nome_cargo,
        orgao_empresa.nome_orgao,
        orgao_empresa.id_org,
        usuarios.cidade_origem,
        tb_cidades.cid_nome,
        user_destino.created_at as created,
        tb_cidades.cid_uf,
        ");
        $this->join('usuarios','usuarios.id_user=user_destino.id_inter');
        $this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
        $this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
        $this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
        $this->join('tb_cidades','tb_cidades.cid_id=usuarios.cidade_origem');
        $this->where('cadastro_ativado',1);
        $this->where('id_cidade',$origemLogado);
        $this->orderBy('nome_orgao');
        $this->groupBy('cidade_origem');
        return $this->findAll();

}
    /**
     * Busca quem quer ir para a cidade do usuário tem interesse na cidade de quem quer ir para o destino final(cidade do logado)
     *
     * @param [type] $origemTerceiro
     * @param [type] $id_org
     * @return array
     */
    public function destinoTerceiro($origemTerc){
            $this->select("
            user_destino.id_cidade,
            usuarios.id_user,
            usuarios.nome,
            user_destino.id_destino,
            cargo.nome_cargo,
            orgao_empresa.nome_orgao,
            orgao_empresa.id_org,
            usuarios.cidade_origem,
            tb_cidades.cid_nome,
            user_destino.created_at as created,
            tb_cidades.cid_uf,
            ");
            $this->join('usuarios','usuarios.id_user=user_destino.id_inter');
            $this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
            $this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
            $this->join('ativo', 'usuarios.id_user = ativo.usuario_id');
            $this->join('tb_cidades','tb_cidades.cid_id=usuarios.cidade_origem');
            $this->where('cadastro_ativado',1);
            $this->where('id_cidade',$origemTerc);
            $this->groupBy('cidade_origem');
            return $this->findAll();
    }
    public function delete_user($id_user){
        $this->delete("*");
       $this->where('id_inter',$id_user);
       return $this->delete();
    }
    public function triangulacao($origem,$orgao){
        $this->select("
        user_destino.id_cidade,
        usuarios.id_user,
        usuarios.nome,
        user_destino.id_destino,
        cargo.nome_cargo,
        orgao_empresa.nome_orgao,
        orgao_empresa.id_org,
        usuarios.cidade_origem,
        tb_cidades.cid_nome,
        user_destino.created_at as created,
        tb_cidades.cid_uf,
        area_usuario.id,
        area_usuario.area_id,
        area.nome as name,
        ");
        $this->select('id_destino,id_inter,id_cidade');
        $this->join('usuarios','usuarios.id_user=user_destino.id_inter');
        $this->join('orgao_empresa', 'usuarios.id_orgao = orgao_empresa.id_org');
        $this->join('cargo', 'usuarios.id_cargo = cargo.id_cargos');
        $this->join('tb_cidades','tb_cidades.cid_id=usuarios.cidade_origem');
        $this->join('ativo','ativo.usuario_id = usuarios.id_user');
        $this->join('area_usuario' , 'usuarios.id_user=area_usuario.usuario_id','left');
        $this->join('area','area.id = area_usuario.area_id','left');
        $this->where('user_destino.id_cidade',$origem);
        $this->where('id_org',$orgao);
        $this->where('ativo','1');
        return $this->paginate(10);
    }
    
}