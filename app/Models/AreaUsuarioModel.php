<?php
namespace App\Models;
class AreaUsuarioModel extends BaseModel{
    protected $table="area_usuario";
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'usuario_id',
        'area_id',
    ];
    protected $beforeDelete = [];

    public function getUserArea($user){
        $this->select("
        area_usuario.usuario_id,
        area_usuario.area_id,
        area_usuario.id,
        area.id,
        area.nome,
        ");
        $this->join('usuarios','usuarios.id_user=area_usuario.usuario_id','left');
        $this->join('area','area.id=area_usuario.area_id','left');
        $this->where('area_usuario.usuario_id',$user);
        return $this->findAll();
    }
}