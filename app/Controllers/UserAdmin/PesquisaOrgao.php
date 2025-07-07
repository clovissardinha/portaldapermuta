<?php namespace App\Controllers\UserAdmin;

use App\Libraries\MinhaBiblioteca;
use App\Models\CargoModel;
use App\Models\DestinoModel;
use App\Models\UsuariosModel;
use App\Models\OrgaoModel;

Class PesquisaOrgao extends BaseController{ 

  protected $usuariosModel;
  protected $orgaoModel;
  protected $destinoModel;
  protected $cargoModel;
  protected $minhaBiblicoteca;

  public function __construct()
	{
    $this->usuariosModel= new UsuariosModel();
    $this->orgaoModel= new OrgaoModel();
    $this->destinoModel= new DestinoModel();
    $this->cargoModel= new CargoModel();
    $this->minhaBiblicoteca= new MinhaBiblioteca;

	}
  /**
   * Início da busca por órgão. 
   *
   * @return void
   */
    public function index(){
       $session = \Config\Services::session();  
        if($session->get('logged_in')){
            $google=$this->minhaBiblicoteca->getVariavel();
        $dados=[
          'nome'=> $session->usuario,
          'id_user'=>$session->id_user,
          'logged_in'=>$session->logged_in,
          'google'=>$google,
        ];
        //dd($dados);
         echo view('UserAdmin/Orgao/index',$dados);
    }    
        else{
        return redirect()->to('/Login');
         }
    }

/**
* Localiza o órgão escolhido 
*
* @return void
*/
    public function buscarOrgao(){
            $session = \Config\Services::session();  
            $request = \Config\Services::request();
            $pager = \Config\Services::pager();
        if($session->get('logged_in')){
        $get=$request->getGet();
        if($get){
            $orgao=$get['fk_orgao'];
            $paginas=$get['paginas'];
            $indice=$get['indice'];
            $cargo=$get['fk_cargo'];            
            $orgaos=$this->orgaoModel->pesquisaOrgao($orgao,$indice,$paginas,$cargo);
            foreach($orgaos as $key=> $orgao){
                $orgaos[$key]['id_user']=$this->destinoModel->getDestinoById($orgao['id_user']);
               }
        $dados=[
        'pager'=>$this->orgaoModel->pager,
        'nome'=> $session->usuario,
        'logged_in'=>$session->logged_in,
        'orgaos'=>$orgaos,
        'get'=>$get,
        'paginas'=>$get['paginas'],
        'fk_orgao'=>$get['fk_orgao'],
        'indice'=>$get['indice'],
        ];
    echo view('UserAdmin/Orgao/final',$dados);
        }
    }
        else{
        return redirect()->to('/Login');
        }
    }

}