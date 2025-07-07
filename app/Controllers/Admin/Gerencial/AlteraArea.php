<?php namespace App\Controllers\Admin\Gerencial;

use App\Controllers\BaseController;
use App\Models\AreaModel;

class AlteraArea extends BaseController{

protected $area;

    public function __construct()
    {
        $this->area = new AreaModel();

    }
    /** busca todos as áreas para alterar, excluir ou incluir */
    public function index(){
        $session = \Config\Services::session(); 
        $pager = \Config\Services::pager();
        if($session->get('logged')){ 
            $areas=$this->area
            ->orderBy('nome')
            ->paginate(15);
            $dados=[
                'areas'=>$areas,
                'pager'=>$this->area->pager
            ];
            echo view('Admin/Gerencial/area',$dados);
        }
    }
    /** abre o form para incluir nova área */
    public function areaInicial(){
        $session = \Config\Services::session(); 
        
        echo view('Admin/Gerencial/formArea');
    }

    /** salva o nova área */
    public function saveArea(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        $pager = \Config\Services::pager();
        if($session->get('logged')){ 
            if($post=$request->getPost()){
                $validar=$this->validate([
                    'area'=>'required|is_unique[area.nome]',
                ]);
                //dd($validar);
                if($validar){
               $area=[
                'nome'=>$post['area'],
                ];
             if($this->area->save($area)){
                $session->setFlashdata('sucesso', 'Área cadastrada com sucesso'); 
                echo view('Admin/Gerencial/formArea');
                }
                }
                else{
                $session->setFlashdata('erro', 'Área já existe ou foi em branco');
                echo view('Admin/Gerencial/formArea');
                }
                 
            }
        }
    }
    /** busca por nome do órgão para ver se existe */
    public function localizar(){
        echo view('Admin/Gerencial/formLocalizarArea');
    }

    /** localiza o órgão procurado */
    public function localizaFinal(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if($session->get('logged')){ 
            if($post=$request->getPost()){
                //dd($post);
            $areas=$this->area
            ->select('*')
            ->like('nome',$post['area'])
            ->orderBy('nome')
            ->paginate(15);
            $dados=[
                'areas'=>$areas,
                'pager'=>$this->area->pager
            ];
            //dd($dados);
           if($areas){
            echo view('Admin/Gerencial/area',$dados);
        }
        else{
            $session->setFlashdata('erro', 'Área não encontrada');
            echo view('Admin/erro');
        }
          }
        }
    }
    /**busca área para alterar */
    public function alteraArea($id){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if($get=$session->get('logged')){ 
            $get=$request->getGet();
               $area= $this->area
                ->where('id',$id)
                ->first();
            $dados=[
                'area'=>$area,
            ];
             echo view('Admin/Gerencial/formAlteraArea',$dados);
            
        }
    }
    public function alteraAreaFinal(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if($session->get('logged')){ 
            if($post=$request->getPost()){
               // dd($post);
               $insere=[
                'id'=>$post['id_area'],
                'nome'=>$post['area'],
               ];
                if($this->area->save($insere)){
                    $session->setFlashdata('sucesso', 'Área alterada com sucesso');
                   echo view('Admin/sucesso');
                }
            }     
        }
    }
    public function excluirArea($id){
        $session = \Config\Services::session(); 
        if($session->get('logged')){ 
            //dd($id);
            $insere=[
                'id'=>$id,
            ];
            if($this->area->delete($id)){
                $session->setFlashdata('sucesso', 'Área excluido com sucesso');
                echo view('Admin/sucesso');
            }
        }
    }
}