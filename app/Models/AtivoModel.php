<?php namespace App\Models;

use Kint\CallFinder;

class AtivoModel extends BaseModel{

    protected $table      = 'ativo';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    
    protected $useTimestamps='true';
    protected $beforeInsert   = [];
    
    protected $beforeDelete = [];
    
    protected $allowedFields = [
       'usuario_id',
       'ativo',
       'created_at'
    ];
    /** busca o usuario para ver se está ativo */
    public function getUserAtivo($user){
        $this->select("
        ativo.usuario_id,
        ativo.ativo,
        ativo.id,
        ");
        $this->where('usuario_id',$user);
        return $this->find();
    }

    public function delete_user($id_user){
        $this->delete("
        ativo.usuario_id,
        ativo.ativo,
        ativo.id,
        "
        );
       $this->where('usuario_id',$id_user);
       return $this->delete();
    }
}