<?php
namespace App\Models;

class ContatoModel extends BaseModel{
    protected $table="contato";
    protected $primaryKey = 'id_contato';
    
    protected $allowedFields = [
        'usuario_id',
        'fone',
        'celular',
        'email_alternativo',
        'whatsapp',
        'imagem',
        'created_at',
    ];

    public function getContatoById($id_user){
        $this->select("
        contato.id_contato,
        contato.usuario_id,
        contato.fone,
        contato.celular,
        contato.email_alternativo,
        contato.whatsapp,
        contato.imagem,
        ");
        $this->where('usuario_id',$id_user);
    return $this->findAll();
    }
    public function delete_user($id_user){
        $this->delete("*");
       $this->where('usuario_id',$id_user);
       return $this->delete();
    }
}
