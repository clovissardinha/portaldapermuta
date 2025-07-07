<?php 
namespace App\Controllers;

use App\Models\DestaquesModel;
use App\Models\UsuariosModel;

class Home extends BaseController{

	protected $destaquesModel;
	protected $usuariosModel;

	public function __construct()
	{
		$this->destaquesModel = new DestaquesModel();
		$this->usuariosModel = new UsuariosModel();
	}
	public function index(){

		$destaques = $this->destaquesModel->getDestaque();
		$conteudo="Portal da permuta, permutaaki,permutando,permuta de servidores,universidades federais,institutos federais, professores,prefeituras,receita federal,tjsp,trt.";
		$descricao="Site especializado em facilitar a permuta de funcionários públicos e servidores e especialmente de universidades federais e institutos federais e prefeituras.";
		$canonica='<link rel="canonical" href="https://www.portaldapermuta.com/" />';
	$dados=[
		'destaques'=>$destaques,
		'conteudo'=>$conteudo,
		'descricao'=>$descricao,
		'canonica'=>$canonica
	];
		return view('_common/header', $dados)
		. view('home/index',$dados)
		. view('_common/footer');
	}
}