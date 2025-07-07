<?php namespace App\Controllers\Admin\Gerencial;

use App\Controllers\BaseController;
use App\Models\OrgaoModel;

class AlteraOrgao extends BaseController{

protected $orgaoEmpresa;

    public function __construct()
    {
        $this->orgaoEmpresa = new OrgaoModel();

    }
    /** busca todos os órgão para alterar, excluir ou incluir */
    public function index(){
        $session = \Config\Services::session(); 
        $pager = \Config\Services::pager();
        if($session->get('logged')){ 
            $orgaos=$this->orgaoEmpresa
            ->orderBy('nome_orgao')
            ->paginate(15);
            $dados=[
                'orgaos'=>$orgaos,
                'pager'=>$this->orgaoEmpresa->pager
            ];
            echo view('Admin/Gerencial/orgao',$dados);
        }
    }
    /** abre o form para incluir novo órgao */
    public function orgaoInicial(){
        $session = \Config\Services::session(); 
        
        echo view('Admin/Gerencial/formOrgao');
    }

    /** salva o novo órgão */
    public function saveOrgao(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        $pager = \Config\Services::pager();
        if($session->get('logged')){ 
            if($post=$request->getPost()){
                $validar=$this->validate([
                    'orgao'=>'required|is_unique[orgao_empresa.nome_orgao]',
                ]);
                //dd($validar);
                if($validar){
               $orgao=[
                'nome_orgao'=>$post['orgao'],
                ];
             if($this->orgaoEmpresa->save($orgao)){
                $session->setFlashdata('sucesso', 'Órgão cadastrado com sucesso'); 
                echo view('Admin/Gerencial/formOrgao');
                }
                }
                else{
                $session->setFlashdata('erro', 'Órgão já existe ou foi em branco');
                echo view('Admin/Gerencial/formOrgao');
                }
                 
            }
        }
    }
    /** busca por nome do órgão para ver se existe */
    public function localizar(){
        echo view('Admin/Gerencial/formLocalizar');
    }

    /** localiza o órgão procurado */
    public function localizaFinal(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if($session->get('logged')){ 
            if($post=$request->getPost()){
                //dd($post);
            $orgaos=$this->orgaoEmpresa
            ->select('*')
            ->like('nome_orgao',$post['orgao'])
            ->orderBy('nome_orgao')
            ->paginate(15);
            $dados=[
                'orgaos'=>$orgaos,
                'pager'=>$this->orgaoEmpresa->pager
            ];
           // dd($orgaos);
           if($orgaos){
            echo view('Admin/Gerencial/orgao',$dados);
        }
        else{
            $session->setFlashdata('erro', 'Órgao não encontrado');
            echo view('Admin/erro');
        }
          }
        }
    }
    /**busca órgão para alterar */
    public function alteraOrgao($id_org){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if($get=$session->get('logged')){ 
            $get=$request->getGet();
               $orgao= $this->orgaoEmpresa
                ->where('id_org',$id_org)
                ->first();
            $dados=[
                'orgao'=>$orgao,
            ];
             echo view('Admin/Gerencial/formAlteraOrgao',$dados);
            
        }
    }
    public function alteraOrgaoFinal(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if($session->get('logged')){ 
            if($post=$request->getPost()){
               // dd($post);
               $insere=[
                'id_org'=>$post['id_orgao'],
                'nome_orgao'=>$post['orgao'],
               ];
                if($this->orgaoEmpresa->save($insere)){
                    $session->setFlashdata('sucesso', 'Órgao alterado com sucesso');
                   echo view('Admin/sucesso');
                }
            }     
        }
    }
    public function excluirOrgao($id_org){
        $session = \Config\Services::session(); 
        if($session->get('logged')){ 
            //dd($id_org);
            $insere=[
                'id_org'=>$id_org,
            ];
            if($this->orgaoEmpresa->delete($id_org)){
                $session->setFlashdata('sucesso', 'Órgao excluido com sucesso');
                echo view('Admin/sucesso');
            }
        }
    }
}