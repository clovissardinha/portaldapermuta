<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserAdmin;

class Cadastro extends BaseController{
   protected $userAdmin;

    public function __construct()
    {
       $this->userAdmin = new UserAdmin();
    }
    /** busca o form para inclusão de novo administrador */
    public function index(){
        $session = \Config\Services::session();
        if($session->get('logged')){
        echo view('Admin/formCad');
        }
        else{
            return redirect()->to('Inicial');
        }
    }
    /** salva os dados de usuario e senha do administrativo */
    public function save(){
        $request = \Config\Services::request();
        $session = \Config\Services::session();
        $validation = \Config\Services::validation(); 
        if($session->get('logged')){
        if($post=$request->getPost()){

            $validation->setRules([
                'username' => ['label' => 'username', 'rules' => 'required|min_length[10]|is_unique[user_admin.username]'],
                'password' => ['label' => 'senha', 'rules' => 'required|min_length[05]'],
                ]);
                if( $validation->withRequest($this->request)->run()){
                   $post['password']=password_hash($post['password'],PASSWORD_DEFAULT);
                   $dados=[
                    'username'=>$post['username'],
                    'senha'=>$post['password'],
                   ]; 
                   //dd($dados);
                   if($this->userAdmin->save($dados)) {
                    $dados=[
                        'msg'=>'cadastrado com sucesso',
                        'titulo'=>"Pagina Administrativa do Portal",
                    ];
                    echo view('Admin/paginaInicial',$dados);
                   }
                }
                else{
                    $errors=$validation->getErrors();
                    //dd($data);
                     $dados=[
                         'titulo'=>'Página Administrativa do Portal da Permuta',
                         'errors'=>$errors,
                     ];
                    // dd($dados);
                     echo view('Admin/formCad',$dados);
                }
        }
    }
    else{
        return redirect()->to('Inicial');
    }

    }
}
