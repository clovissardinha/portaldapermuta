<?php namespace App\Controllers\Admin\Gerencial;

use App\Controllers\UserAdmin\BaseController;
use App\Models\UsuariosModel;

class EmailReforco extends BaseController{
   protected $usuarioModel;
    public function __construct(){
        $this->usuarioModel = new UsuariosModel();
    }
    public function index(){
        $session = \Config\Services::session(); 
        if($session->get('logged')){
        echo view('Admin/Gerencial/emailInicial');
        }
        else{
            return redirect()->to('../Admin');
        }
    }

    public function enviaReforco(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        $email= \Config\Services::email();
        if($session->get('logged')){
            $get=$request->getGet();
            //dd($get);
            $datas=$this->usuarioModel
            ->where('cadastro_ativado',0)
            ->where('created_at >=',$get['data_inicial'])
            ->where('created_at <=',$get['data_final'])
            ->findAll();
           // dd($datas);
            foreach($datas as &$data){
                $senha=rand(100000,990000);
                $senhaHash=password_hash($senha,PASSWORD_DEFAULT);
                $user=$data['id_user'];
                $valores=[
                    'id_user'=>$user,
                    'senha'=>$senhaHash,
                ];
                //dd($valores);
                $this->usuarioModel->save($valores);
            $msg=view('Admin/reforcaEmail',[
                'nome'=>$data['nome'],
                'senha'=>$senha,
            ]
                                        );
            $email->setFrom('atendimento@portaldapermuta.com');
            $email->setTo($data['email']);
            $email->setBCC('clovis.sardinha@hotmail.com');
            $email->setSubject("Continue seu cadastramento no Portal da Permuta");
            $email->setMessage($msg);
           
                       if($email->send()){
                        $emailsEnviados = false; 
                    }
            }
            if(!$emailsEnviados)	{
                $session->setFlashdata('sucesso', 'enviados com sucesso');        
                return view('Admin/sucesso');
                    }
            else{
                $session->setFlashdata('erro', 'problemas no envio');        
                return view('Admin/erro');
            }
           
        }
    }
}