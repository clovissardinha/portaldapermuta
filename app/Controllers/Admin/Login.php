<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserAdmin;

class Login extends BaseController
{
    protected $userAdmin;

    public function __construct()
    {
        $session = \Config\Services::session();
        $this->userAdmin = new UserAdmin();
    }
    /**Página inicial do sistema administrativo - pagina de login */
    public function index()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $session = \Config\Services::session();
        $dados = [
            'titulo' => 'Login Administrativo do Portal da Permuta',
            //'mensagem'=>'senha ou usuario errado'
        ];
        //dd($dados);
        //var_dump($session);
        echo view('Admin/formLogin', $dados);
    }

    /** Inicio da verificação de senha e username */
    public function signIn()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $session = \Config\Services::session();
        if ($post = $request->getPost()) {
            //dd($post);
            $dados = [
                'username' => $post['username'],
                'senha' => $post['password']
            ];
            $usuario = $this->userAdmin->getUsuarioByEmail($post['username']);
            if (!is_null($usuario)) {
                if (password_verify($post['password'], $usuario['senha'])) {
                    $sessionLoginAdm = [
                        'usuario' => $usuario['username'],
                        'logged' => true,
                    ];
                    $session->set($sessionLoginAdm);
                    echo view('Admin/paginaInicial');
                } 
                else {
                    return redirect()->to(base_url('Admin/Login'))->with('mensagem', 'senha ou usuario errado.');
            }
        } else {
            return redirect()->to(base_url('Admin/Login'))->with('mensagem', 'senha ou usuario errado.');
        }
     }
    }
    public function retorno()
    {
        $session = \Config\Services::session();
        if ($session->get('logged')) {
            echo view('Admin/paginaInicial');
        }
    }
    public function logout()
    {
        $session = \Config\Services::session();
        $sessionLoginAdm = [
            'logged' => false
        ];

        $session->set($sessionLoginAdm);

        return redirect()->to('/Admin/Login');
    }
}
