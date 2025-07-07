<?php

namespace App\Controllers;

class SobreNos extends BaseController
{
	public function index()
	{   $titulo='Sobre Nós';
        $conteudo="Portal da permuta, permutaaki,permutando,permuta de servidores,universidades federais,institutos federais, professores,prefeituras,receita federal,tjsp,trt.";
		$descricao="Um relato da importância da permuta para os servidores públicos, unindo familia e qualidade de vida.";		
		$canonica='<link rel="canonical" href="https://www.portaldapermuta.com/SobreNos" />';
	$dados=[
		'conteudo'=>$conteudo,
		'descricao'=>$descricao,
        'titulo'=>$titulo,
		'canonica'=>$canonica
	];
    return view('_common/header', $dados)
    . view('sobrenos/index',$dados)
    . view('_common/footer');
	}	
}