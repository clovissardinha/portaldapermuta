<?php
namespace App\Models;

class MuralModel extends BaseModel{
    protected $table="mural";
    protected $primaryKey = 'id_mural';
    
    protected $allowedFields = [
        'usuario_id',
        'comentario'
    ];

    public function getUsuario($id_user):array{
        $this->select("
        mural.id_mural,
        mural.usuario_id,
        mural.comentario,
        
        " );
        $this->WHERE('usuario_id',$id_user);
        return $this->findAll();

    }
    public function delete_user($id_user){
        $this->delete("*");
       $this->where('usuario_id',$id_user);
       return $this->delete();
    }
}