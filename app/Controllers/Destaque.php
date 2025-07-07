<?php

namespace App\Controllers;

class Destaque extends BaseController
{
	public function index()
	{
		$titulo='login';
        $conteudo="Portal da permuta, permutaaki,permutando,permuta de servidores,universidades federais,institutos federais, professores,prefeituras,receita federal,tjsp,trt.";
		$descricao="O Portal da permuta é um portal online que facilita a permuta e redistribuição entre servidores públicos. Os Destaques são uma forma dos participantes aparecerem em primeiro lugar no site. Isto ajuda a conseguir a permuta";
		
	$dados=[
		'conteudo'=>$conteudo,
		'descricao'=>$descricao,
        'titulo'=>$titulo
	];
    return view('_common/header', $dados)
    . view('destaque/index',$dados)
    . view('_common/footer');
	}
}