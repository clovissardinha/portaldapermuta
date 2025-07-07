<?php namespace App\Controllers\UserAdmin;

use App\Models\AtivoModel;
use App\Models\CidadeModel;
use App\Models\DestinoModel;
use App\Models\UsuariosModel;

class CadastraDestino extends BaseController{
    protected $destinoModel;
    protected $usuariosModel;
    protected $ativoModel;
    protected $tb_cidade;

    public function __construct()
    {
        $this->destinoModel=new DestinoModel();
        $this->usuariosModel= new UsuariosModel();
        $this->ativoModel= new AtivoModel();
        $this->tb_cidade = new CidadeModel();
    }
/**
 * Verifica se está logado e envia para a página inicial para informar a cidade
 *
 * @return void
 */
    public function index(){
        $session = \Config\Services::session();  

        if($session->get('logged_in')){
         
        $dados=[
          'nome'=> $session->usuario,
          'id_user'=>$session->id_user,
          'logged_in'=>$session->logged_in,
          'imagem'=>$session->imagem=false,
          'id_inter'=>$session->id_user,
        ];
        //dd($dados);
         echo view('UserAdmin/Destino/form',$dados);
        
        } 
          
        else{
        return redirect()->to('/Login');
         }
    }
    
    /**
     * Caso já exista uma escolha mostra para o usuário escolher mais.
     *
     * @return void
     */
    public function escolheCidade(){
        $session = \Config\Services::session();  
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
         if($session->get('logged_in')){
          $post=$request->getPost();      
          //dd($post);
          $val = $this->validate([
            'id_inter'=>'required|is_natural',
            'fk_cidade'=>'required|is_natural',
            ]                
        );
        if(!$val){
            helper('[old]');
            return redirect()->back()->with('errors', $validation->getErrors());
        }
           $destino=[
              'id_inter'=>$post['id_inter'],
              'id_cidade'=>$post['fk_cidade'],
            ];
              $total= ($this->destinoModel
              ->where('id_inter',$destino['id_inter'])
              ->where('id_cidade',$destino['id_cidade'])
              ->countAllResults()
             );
            //dd($total);
            /** Caso a cidade já tenha sido escolhida, mostra erro */
             if($total>=1){
              echo view('UserAdmin/Destino/avisoErro');
            }
           
            if($this->destinoModel->save($destino)){
              $idUser=$post['id_inter'];
              $cidades=$this->destinoModel->getDestinoById($post['id_inter']);
              $resultCount = $this->destinoModel->where('id_inter',$idUser)->countAllResults('id_inter');
             $dados=[
              'cidades'=>$cidades,
              'total'=>$resultCount,
             ];
            // dd($dados);
              echo view('UserAdmin/Destino/final',$dados);
            }
            else{
                echo " algo deu errado";
            }
          }
          else{
            return redirect()->to('/Login');
           }
    }
    public function alteraDestino(){
      $session = \Config\Services::session();  
      $request = \Config\Services::request();
      
       if($session->get('logged_in')){
        $id_inter=[
          'id_user'=>$session->id_user,
        ];
            $cidades=$this->destinoModel->getDestinoById($id_inter);
            $resultCount = $this->destinoModel->where('id_inter',$id_inter)->countAllResults('id_inter');

           $dados=[
            'cidades'=>$cidades,
            'total'=>$resultCount,
           ];
           //dd($dados);
            echo view('UserAdmin/Destino/final',$dados);
         
        }
        else{
          return redirect()->to('/Login');
         }
  }
    public function deletar($id_destino){
          if($this->destinoModel->delete($id_destino)){
           
            echo '<div class="text-center h2 my-3 text-danger">deletado com sucesso</div>';
          }  
            $session = \Config\Services::session();  
            $id=$session->id_user;
            $cidades=$this->destinoModel->getDestinoById($id);
             $dados=[
              'cidades'=>$cidades
             ];
             //dd($dados);
              echo view('UserAdmin/Destino/final',$dados); 
    }
    
}

