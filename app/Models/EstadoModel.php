<?php
namespace App\Models;

class EstadoModel extends BaseModel{

    protected $table="tb_estados";
    protected $primaryKey = 'estado_id';
    
    protected $allowedFields = [
        'estado_uf',
        'estado_nome'
    ];
    /**
     * Cria um array para o dropdow do Estado
     *
     * @param array|null $params
     * @return void
     */
        public function formDropDow(){
            $this->Select("
            tb_estados.estado_id,
            tb_estados.estado_uf,
            tb_estados.estado_nome
            ");
            $estadoArray= $this->findAll();  
            $optionSelecione = [
                '' => '...selecione'];
           $optionsEstado =$optionSelecione+ array_column($estadoArray,'estado_nome','estado_id');
           return $optionsEstado;
        }
       public function buscaEstadoById($post){
        $this->Select("
        tb_estados.estado_id,
        tb_estados.estado_uf,
        tb_estados.estado_nome
        ");
        $this->where('estado_id',$post);
        return $this->find();
       }

}