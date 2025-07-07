<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
<table class="table table-striped table-bordered  my-5">
    <tr>
    <td colspan="5" class="text-center text-uppercase"><h3> Cidades de Destino </h3></td>
    </tr>
    <div class="container">
      
        <tr class="text-left">
          <th >cidade</th>
          <th >Estado</th>
          <th >cadastrado em:</th>
          <th ></th>
        </tr>
        <?php foreach ($cidades as $cidade) : ?>
          
        <tr>
            <td class="text-left text-uppercase"><?php echo $cidade['cid_nome'] ?></td>
            <td class="text-left"><?php echo $cidade['cid_uf']  ?></td>
            <td class="text-left"><?php  echo date('d/m/Y', strtotime ($cidade['created']) ) ?></td>
              <?php if(isset($total)&&($total >1 )) :?>
            <td class="text-left"><a href="<?php echo base_url('UserAdmin/CadastraDestino/deletar')."/".$cidade['id_destino'] ?>">Excluir</a></td>
             <?php endif ?>
        </tr>
        <?php endforeach ?>
        <tr colspan="2" class="between">
          <?php if(isset($total)&&($total <=10 )) :?>
				<th  ><a class="btn btn-primary " href="<?php echo base_url('UserAdmin/CadastraDestino')?>"><strong>CADASTRAR MAIS</strong></a>
				</th>
         <?php endif ?>
				<th ><a class="btn btn-success" href="<?php echo base_url('UserAdmin/DadosPessoais')?>"><strong>DADOS PESSOAIS</strong></a>
				</th>
				</tr>
        
    </div>
</table>
<div class="text-danger">Máximo de 10 cidades. </br> Se precisar use o mural para colocar regiões ou estados.</div>
</div>