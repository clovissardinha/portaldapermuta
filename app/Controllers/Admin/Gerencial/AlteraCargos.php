<?php namespace App\Controllers\Admin\Gerencial;

    use App\Controllers\BaseController;
    use App\Models\CargoModel;
use App\Models\UsuariosModel;

class AlteraCargos extends BaseController{
    protected $cargoModel;
    protected $usuarios;
    public function __construct()
    {
       $this->cargoModel=new CargoModel();
       $this->usuarios=new UsuariosModel();
    }
    /**PAGINA MOSTRA TODOS OS CARGOS CADASTRADOS E ABRE PARA INCLUIR, EXCLUIR, ALTERAR E LOCALIZAR */
    public function index(){
        $session = \Config\Services::session(); 
        $pager = \Config\Services::pager();
        if($session->get('logged')){ 
            $cargos=$this->cargoModel
            ->orderBy('nome_cargo')
            ->paginate(15);
            $dados=[
                'cargos'=>$cargos,
                'pager'=>$this->cargoModel->pager
            ];
            echo view('Admin/Gerencial/cargo',$dados);
        }
    }
    /** abre o form para incluir novo órgao */
    public function cargoInicial(){
        $session = \Config\Services::session(); 
        
        echo view('Admin/Gerencial/formCargo');
    }
    /** form inicial para alterar cargo */
    public function alteraCargo($cargo){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if($get=$session->get('logged')){ 
            $get=$request->getGet();
               $cargos= $this->cargoModel
                ->where('id_cargos',$cargo)
                ->first();
            $dados=[
                'cargos'=>$cargos,
            ];
            //dd($dados);
             echo view('Admin/Gerencial/formAlteraCargo',$dados);
            
        }
    }
    public function alteraCargoFinal(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if($session->get('logged')){ 
            if($post=$request->getPost()){
                //dd($post);
               $insere=[
                'id_cargos'=>$post['id_cargo'],
                'nome_cargo'=>$post['cargo'],
               ];
                if($this->cargoModel->save($insere)){
                    $session->setFlashdata('sucesso', 'Órgao alterado com sucesso');
                   echo view('Admin/sucesso');
                }
                else{
                    $session->setFlashdata('erro', 'Órgao não foi alterado');
                   echo view('Admin/erro');
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
            if($this->cargoModel->delete($id_org)){
                $session->setFlashdata('sucesso', 'Órgao excluido com sucesso');
                echo view('Admin/sucesso');
            }
        }
    }
    public function excluirCargo($id_cargo){
        $session = \Config\Services::session(); 
        if($session->get('logged')){ 
            //dd($id_cargo);
            $insere=[
                'id_cargos'=>$id_cargo,
            ];
            if($this->cargoModel->delete($insere)){
                $session->setFlashdata('sucesso', 'Órgao excluido com sucesso');
                echo view('Admin/sucesso');
            }
            else{
                $session->setFlashdata('erro', 'Órgao não foi excluido');
                echo view('Admin/erro');
            }
        }
    }
    /**abre o form para incluir novo cargo */
    public function cargoIncluir(){
        $session = \Config\Services::session(); 
        
        echo view('Admin/Gerencial/formCargo');
    }

    /** salva o novo cargo */
    public function saveCargo(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if($session->get('logged')){ 
            if($post=$request->getPost()){
                $validar=$this->validate([
                    'cargo'=>'required|is_unique[cargo.nome_cargo]',
                ]);
                //dd($validar);
                if($validar){
               $cargo=[
                'nome_cargo'=>$post['cargo'],
                ];
             if($this->cargoModel->save($cargo)){
                $session->setFlashdata('sucesso', 'Cargo cadastrado com sucesso'); 
                echo view('Admin/sucesso');
                }
                }
                else{
                $session->setFlashdata('erro', 'Cargo já existe ou foi em branco');
                echo view('Admin/erro');
                }
                 
            }
        }
    }
    public function localizar(){
        echo view('Admin/Gerencial/formLocalizarCargo');
    }

    /** localiza o órgão procurado */
    public function localizaFinal(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if($session->get('logged')){ 
            if($post=$request->getPost()){
                //dd($post);
            $cargos=$this->cargoModel->getCargo($post['cargo']);
            $dados=[
                'cargos'=>$cargos,
                'pager'=>$this->cargoModel->pager
            ];
           // dd($orgaos);
           if($cargos){
            echo view('Admin/Gerencial/cargo',$dados);
        }
        else{
            $session->setFlashdata('erro', 'Cargo não encontrado');
            echo view('Admin/erro');
        }
          }
        }
    }
    /**
     * Busca o cargo que vai permanecer e o cargo que se quer deletar
     */
    public function substituirCargo(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if (!isset($_SESSION['logged']))
        {
        return redirect()->to(base_url());
        }
        $formDropCargo=$this->cargoModel->formDropDow(); 
        $dados=[
            'cargos'=>$formDropCargo,
        ];
        echo view('Admin/Gerencial/substituirCargo',$dados);
    }
    /**
     * substitui o cargo do usuário pelo cargo definitivo e exclui o cargo substituido
     */
    public function substituirFinal(){
        $session = \Config\Services::session(); 
        $request = \Config\Services::request();
        if (!isset($_SESSION['logged']))
        {
        return redirect()->to(base_url());
        }
        if($post=$request->getPost()){
            //dd($post);
            $validar=$this->validate([
                'cargo'=>'required|is_unique[cargo.nome_cargo]',
                'cargoExcluido'=>'required|is_unique[cargo.nome_cargo]',
            ]);
            if(!$validar){
                return redirect()->back()->with('erro','dados errados');
            }
            if(
            $this->usuarios->substituir($post['cargo'],$post['cargoExcluido'])){
                if($this->cargoModel->delete($post['cargoExcluido'])){
                return redirect()->back()->with('sucesso','Cargo Alterado com Sucesso');
                }
            }
        }
    }
}