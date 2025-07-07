<?php namespace App\Models;

use Config\Validation;
use Kint\CallFinder;

class UserAdmin extends BaseModel{


   protected $table = 'user_admin';
   protected $primaryKey = 'id_adm';
   protected $allowedFields = [
    'username',
    'senha',
];
    protected $validationRules=[
        'username'=>[
            'label'=>'username',
            'rules'=>'required',
        ],
        'senha'=>[
            'label'=>'senha',
            'rules'=>'required',
        ]
        ];
        /** retorna os dados do usuário */
        public function getUsuarioByEmail($email){
          $this->select('username,senha');
          $this->where('username',$email);
          return $this-> first();
        }

        /**
         * encripta a senha do usuário
         *
         * @param [type] $data
         * @return void
         */
          
}