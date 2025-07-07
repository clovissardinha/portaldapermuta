<?php
namespace App\Models;

class DestaquesModel extends BaseModel{

    protected $table="destaque";
    protected $primaryKey = 'id_destaque';
    
    
    protected $useTimestamps='true';
    protected $useSoftDeletes = false; 
    protected $beforeInsert = [];
    protected $beforeDelete = [];
    
    protected $allowedFields = [
        'usuario_id',
        'data_pgto',
        'data_inicio',
        'data_fim',
        'tipo',
    ];
    protected $validationRules = [
            'tipo' =>[
            'label'=>'Tipo',
            'rules'=>'required'
            ]
            ];

     /**
     * Busca os destaques entre o dia inicial e dia final
     * busca os destaques ativos e coloca na página principal tipo 1
     *
     * @return array
     */
    public function getDestaque():array
		{	
            $date=date('Y-m-d');
			$this->select( "
           destaque.usuario_id, 
           destaque.data_pgto,
           destaque.data_inicio, 
           destaque.data_fim ,
           destaque.tipo ,
           usuarios.id_user,  
           usuarios.nome, 
           tb_cidades.cid_uf,
           tb_cidades.cid_nome, 
           orgao_empresa.nome_orgao,
           cargo.nome_cargo, 
           cargo.id_cargos,
           usuarios.id_cargo
             ");
            $this->join('usuarios', 'usuarios.id_user = destaque.usuario_id','left');
            $this->join('tb_cidades', 'usuarios.cidade_origem=tb_cidades.cid_id','left'); 
            $this->join('orgao_empresa','usuarios.id_orgao= orgao_empresa.id_org','left');  
			$this->join('cargo','usuarios.id_cargo = cargo.id_cargos','left');
            $this->where("data_inicio <= '$date' AND data_fim >= '$date' " );
            $this->where('tipo',1);
            $this->orderBy('data_inicio');
            return $this->findAll();
         
	}
    /**
     * Busca os destaques entre o dia inicial e dia final
     * busca os destaques ativos e coloca na página interna - todos os tipos
     *
     * @return array
     */
    public function getDestaqueInt():array
		{	
            $date=date('Y-m-d');
			$this->select( "
           usuario_id`, 
           data_pgto`,
           data_inicio`, 
           data_fim` ,
           tipo` ,
           id_user`,  
           nome`, 
           foto`,
           cid_uf`,
           cid_nome`, 
           nome_orgao`,
           nome_cargo`, 
           id_cargos`,
           id_cargo`
             ");
            $this->join('usuarios', 'usuarios.id_user = destaque.usuario_id','left');
            $this->join('tb_cidades', 'usuarios.cidade_origem=tb_cidades.cid_id','left'); 
            $this->join('orgao_empresa','usuarios.id_orgao= orgao_empresa.id_org','left');  
			$this->join('cargo','usuarios.id_cargo = cargo.id_cargos','left');
            $this->where("data_inicio <= '$date' AND data_fim >= '$date' ");
            $this->orderBy('data_inicio');


            
            return $this->findAll();
	}
}