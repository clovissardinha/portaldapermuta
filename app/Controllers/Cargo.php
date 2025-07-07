<?php

namespace App\Controllers;

use App\Models\AreaModel;
use App\Models\AreaUsuarioModel;
use App\Models\AtivoModel;
use App\Models\CargoModel;
use App\Models\CidadeModel;
use App\Models\ContatoModel;
use App\Models\DestinoModel;
use App\Models\EstadoModel;
use App\Models\ExclusaoModel;
use App\Models\MuralModel;
use App\Models\OrgaoModel;
use Config\Email;
use Config\Validation;

use App\Models\UsuariosModel;

class Cargo extends BaseController

{
	
	protected $UsuariosModel;
	protected $estadoModel;
	protected $tb_cidade;
	protected $orgaoModel;
	protected $cargoModel;
	protected $contatoModel;
	protected $muralModel;
	protected $ativo;
	protected $exclusao;
	protected $destinoModel;
	protected $areaModel;
	protected $areaUsuarioModel;
	
	public function __construct()
	{
		$this->UsuariosModel=new UsuariosModel();
		$this->estadoModel = new EstadoModel();
		$this->tb_cidade = new CidadeModel();
		$this->orgaoModel = new OrgaoModel();
		$this->cargoModel = new CargoModel();
		$this->contatoModel = new ContatoModel();
		$this->muralModel = new MuralModel();
		$this->ativo= new AtivoModel();
		$this->exclusao= new ExclusaoModel();
		$this->destinoModel= new DestinoModel();
		$this->areaModel=new AreaModel();
		$this->areaUsuarioModel=new AreaUsuarioModel();
	}
    public function cargo(){
		$request = \Config\Services::request();
		$client = \Config\Services::curlrequest();
		  if($get=$request->getGet()){
			$cargoFiltrado=$this->cargoModel->getCargoByName($get['cargo']);
			return $this->response->setStatusCode(200)
			->setContentType('application/json')
			->setJSON($cargoFiltrado);
		}
	}

}