<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
  <div class="text-center text-uppercase my-3">
    <h3> Estado Pesquisado :  <?php echo !empty($usuarios)? $estado[0]['estado_nome'] :'Nenhum registro encontrado' ?></h3>
    
  </div>
  <?php if (!isset($get['cargo'])):?>
      <div class="text-left">    
        <form class="form-inline my-4  " action="<?php echo base_url('UserAdmin/PesquisaEstado/buscarEstadoFiltrado') ?>", method="get">
                  
          <label class="" for="cargo"><h4>Filtrar por cargo :</h4></label>
          <?php echo form_dropdown('cargo',$formDropCargo,null,['class'=>'form-control col-md-4 ml-3']) ?>
                    
          <input class="ml-3" type="hidden" id="estado" name="estado" value="<?php echo isset($estado)?$estado[0]['estado_id'] :''?>">
                    
          <input class="ml-3 btn btn-primary" type="submit" class="btn btn-primary" value="Pesquisar">
                  
        <?php echo form_close();?>
      </div>
  <?php endif ?>

  

<table class="table table-striped table-bordered  my-5">
    <div class="container">
      <?php if(!empty($usuarios)): ?>
      <tr class="text-left">
        <th >nome</th>
        <th >cargo</th>
        <th >área</th>
        <th >orgão</th>
        <th >origem</th>
        <th >destino</th>
        <th >cadastrado em:</th>
      </tr>
    <?php foreach ($usuarios as $usuario) : ?>
    <tr>
        <td class="text-left text-uppercase"><?php echo $usuario['nome'] ?></td>
        <td class="text-left text-uppercase"><?php echo $usuario['nome_cargo'] ?></td>
        <td class="text-left text-uppercase"><?php echo $usuario['name'] ?></td>
        <td class="text-left text-uppercase"><?php echo $usuario['nome_orgao'] ?></td>
        <td class="text-left text-uppercase"><?php echo $usuario['cid_nome'] ?></td>
        <td class="text-left"><?php foreach($usuario['id_user'] as $key=>$cidade):?><?php echo $cidade['cid_nome']  ?> <?php endforeach ?></td>
        <td><?php echo date('d/m/Y', strtotime( $usuario['created'])) ?></td>
        <td class="text-align-left"> <?php foreach($usuario['id_user'] as $cliente):?><?php endforeach ?>
          <?php if(isset($cliente)): ?>
          <?php $user= implode(',',$cliente) ?>
        <?php $user= explode(',',$user) ?>
          <a href="<?php echo base_url('UserAdmin/Usuario/getUsuarioByIdEstado')."/".$user[1] ?>"target="_blank">DETALHES
        </a> </td>
        <?php endif ?>
    </tr>
        <?php endforeach ?> 
        <?php endif ?>
    </div>
</table>
<?= $pager->links('default','bootstrap_pager') ?>
</div>