<?php
namespace App\Models;

class ExclusaoModel extends BaseModel{
    protected $table="exclusao";
    protected $primaryKey = 'id_exclusao';
    
    protected $allowedFields = [
        'nome',
        'email',
        'usuario_id',
        'motivo',
        'indicacao',
        'critica',
        'data_inscricao',
        'data_exclusao',
    ];

    public function getByIdUsuario(){

    }
}