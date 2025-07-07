<?php namespace App\Controllers\UserAdmin;

use App\Libraries\MinhaBiblioteca;
use App\Models\DestinoModel;
use App\Models\UsuariosModel;
use App\Models\OrgaoModel;

Class PesquisaData extends BaseController{ 

  protected $usuariosModel;
  protected $orgaoModel;
  protected $destinoModel;
  protected $minhaBiblicoteca;

  public function __construct()
	{
    $this->usuariosModel= new UsuariosModel();
    $this->orgaoModel= new OrgaoModel();
    $this->destinoModel= new DestinoModel();
    $this->minhaBiblicoteca=new MinhaBiblioteca();

	}
  /**
   * Início da busca por data. 
   *
   * @return void
   */
    public function index(){
        
       $session = \Config\Services::session();  

        if($session->get('logged_in')){
          $data_final=null;
          $data_inicial=null;
          $google=$this->minhaBiblicoteca->getVariavel();
        $dados=[
          'nome'=> $session->usuario,
          'id_user'=>$session->id_user,
          'logged_in'=>$session->logged_in,
          'formDropOrgao'=>$this->orgaoModel->formDropDow(),
          'data_inicial'=> $data_inicial,
          'data_final'=>$data_final,
          'google'=>$google
        ];
        //dd($dados);
         echo view('UserAdmin/Data/index',$dados);
          }    
      else{
        return redirect()->to('/Login');
      }
    }
     
    
    /**
     * recebe os valores do get de datas e busca no bd de usuarios
     *
     * @return void
     */
     public function final(){
        $session = \Config\Services::session();  
        $request = \Config\Services::request();
        $pager = \Config\Services::pager();
         $data_inicial=null;
         $data_final=null;
        $get=$request->getGet();
        if($get){
          $paginas=$get['paginas'];
          $dataIni=$get['data_inicial'];
          $dataFim=$get['data_final'];
          /**se a data inicial for igual ou menor que a data final volta para a página index e mostra o erro   */
          if($get['data_final']<=$get['data_inicial']){
            $erro= "<p class='text-danger'>Data inicial deve ser menor que data final</p>";
          
          $dados=[
            'nome'=> $session->usuario,
            'id_user'=>$session->id_user,
            'logged_in'=>$session->logged_in,
            'formDropOrgao'=>$this->orgaoModel->formDropDow(),
            'data_inicial'=> $data_inicial,
            'data_final'=>$data_final,
            'erro'=>$erro,
          ];
          //dd($dados);
           echo view('UserAdmin/Data/index',$dados);
        //dd($dados);
         }
         /** se as datas estiverem corretas vai para a página final com os dados selecionados */
        else{
          $periodos=$this->usuariosModel->pesquisaData($paginas,$dataIni,$dataFim);
          foreach($periodos as $key=> $periodo){
            $periodos[$key]['id_user']=$this->destinoModel
            ->where('id_inter',$periodo['id_user'])
            ->join('tb_cidades','tb_cidades.cid_id=user_destino.id_cidade')
            ->groupBy('id_inter')
            ->findAll();
           }
           $formDropOrgao=$this->orgaoModel->formDropDow(); 
           //dd($periodos);
          $dados=[
              'pager'=>$this->usuariosModel->pager,  
              'data_inicial'=>$get['data_inicial'],
              'data_final'=>$get['data_final'],
              'periodos'=>$periodos,
              'formDropOrgao'=>$formDropOrgao,
          ];
          echo view('UserAdmin/Data/final',$dados);
          }
        }
      }
      public function finalFiltrado(){
        $session = \Config\Services::session();  
        $request = \Config\Services::request();
        $pager = \Config\Services::pager();
         $data_inicial=null;
         $data_final=null;
        $get=$request->getGet();
        if($get){
          $orgao=$get['orgao'];
          $dataIni=$get['data_inicial'];
          $dataFim=$get['data_final'];
        $periodos=$this->usuariosModel->pesquisaDataOrgao($orgao,$dataIni,$dataFim);
          foreach($periodos as $key=> $periodo){
            $periodos[$key]['id_user']=$this->destinoModel
            ->where('id_inter',$periodo['id_user'])
            ->join('tb_cidades','tb_cidades.cid_id=user_destino.id_cidade')
            ->groupBy('id_inter')
            ->findAll();
           }
           $formDropOrgao=$this->orgaoModel->formDropDow(); 
          // dd($periodos);
          $dados=[
              'pager'=>$this->usuariosModel->pager,  
              'data_inicial'=>$get['data_inicial'],
              'data_final'=>$get['data_final'],
              'periodos'=>$periodos,
              'formDropOrgao'=>$formDropOrgao,
              'get'=>$get,
          ];
          echo view('UserAdmin/Data/final',$dados);
          
        }
        
      }
}