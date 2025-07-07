<?php

namespace App\Controllers\Admin\Gerencial;

use App\Controllers\BaseController;
use App\Models\AtivoModel;
use App\Models\CidadeModel;
use App\Models\DestinoModel;
use App\Models\MuralModel;
use App\Models\UsuariosModel;

class AlteraUsuario extends BaseController
{
    protected $usuarios;
    protected $ativo;
    protected $mural;
    protected $destino;
    protected $tbCidades;

    public function __construct()
    {
        $this->usuarios = new UsuariosModel();
        $this->ativo = new AtivoModel();
        $this->mural = new MuralModel();
        $this->destino = new DestinoModel();
        $this->tbCidades = new CidadeModel();
    }
    /** através da busca de usuário pega o id do usuário e envia para a form  */
    public function alteraUsuario($user_id)
    {
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        if ($session->get('logged')) {
            $get = $request->getGet();
            //dd($user_id);
            $users = $this->usuarios
                ->select('id_user,nome,apelido,cadastro_ativado,email,ativo,mural.id_mural,id,comentario')
                ->join('ativo', 'ativo.usuario_id=usuarios.id_user', 'left')
                ->join('mural', 'mural.usuario_id=usuarios.id_user', 'left')
                ->where('id_user', $user_id)
                ->first();
            //dd($users);

            echo view('Admin/Gerencial/formAlteraUser', $users);
        }
    }
    /** altera os dados do usuário */
    public function alteraUserFinal()
    {
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        if ($post = $request->getPost()) {
            $rules = [
                'ativo' => 'required|integer'
            ];
            if ($this->validate($rules)) {
                //dd($post);
                $dados = [
                    'id_user' => $post['id_user'],
                    'nome' => $post['nome'],
                    'apelido' => $post['apelido'],
                    'email' => $post['email'],
                    'ativo' => $post['ativo'],
                    'id' => $post['id'],
                    'id_mural' => $post['id_mural'],
                    'usuario_id' => $post['id_user'],
                    'comentario' => $post['comentario'],
                ];
                //dd($dados);
                $id = $post['id'];
                if ($this->usuarios->save($dados) && $this->ativo
                    ->save($dados) && $this->mural->save($dados)
                ) {
                    $session->setFlashdata('sucesso', 'alterado com sucesso');
                    //dd($ativo);
                    echo view('Admin/sucesso');
                } else {

                    return redirect()->to('Usuarios');
                }
            } else {
                $dados = [
                    'id_user' => $post['id_user'],
                    'nome' => $post['nome'],
                    'apelido' => $post['apelido'],
                    'email' => $post['email'],
                    'ativo' => $post['ativo'],
                    'id' => $post['id'],
                ];
                $session->setFlashdata('item', 'Esqueceu de lançar o ativo');
                echo view('Admin/Gerencial/formAlteraUser', $dados);
            }
        }
    }
    public function incluirDestino($user_id){
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        if (!$session->get('logged')) {
            return redirect()->to(base_url('Admin/Login'));
        }
        $usuario=$this->usuarios->getUsuarioById($user_id);
        $destino=$this->destino->getDestinoById($user_id);

        $dados=[
            'usuario'=>$usuario,
            'destino'=>$destino,
        ];
        //dd($usuario);
        echo view('Admin/Gerencial/incluirDestino',$dados);
    }

    public function incluiDestFinal(){
        $session = \Config\Services::session();
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        if (!$session->get('logged')) {
            return redirect()->to(base_url('Admin/Login'));
        }
        if ($post = $request->getPost()) {
            //dd($post);
            $dados=[
                'id_inter'=>$post['id_inter'],
                'id_cidade'=>$post['fk_cidade'],
            ];
            //dd($dados);
            if($this->destino->insert($dados)){
                return redirect()->to(base_url('Admin/Gerencial/AlteraUsuario/incluirDestino'."/".$post['id_inter']))->with('mensagem','cidade incluida com sucesso');
            }
        }
        }
    

}
