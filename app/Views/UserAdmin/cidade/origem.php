<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
  
    <div class="text-center text-uppercase my-3"><h3> DESTINO DOS USUARIOS PESQUISADOS:  <?php echo !empty($origem)? $origem[0]['cid_nome']."-".$origem[0]['cid_uf'] :'Nenhum registro encontrado' ?></h3></div>
   
    <?php if (!isset($cargo)):?>
      <div class="text-left">    
        <form class="form-inline my-4  " action="<?php echo base_url('UserAdmin/Cidade/origemFiltrado') ?>", method="get">
                  
          <label class="" for="cargo"><h4>Filtrar por cargo :</h4></label>
          <?php echo form_dropdown('cargo',$formDropCargo,null,['class'=>'form-control col-md-4 ml-3']) ?>
                    
          <input class="ml-3 btn btn-primary" type="submit" class="btn btn-primary" value="Pesquisar">
                  
        </form>
      </div>
      <?php endif ?>
<table class="table table-striped table-bordered  my-5">
    
    <div class="container">
      <?php if(!empty($origem)& !empty($destino)) :?>
    <tr class=" text-left">
      <th >nome</th>
      <th >órgão</th>
      <th >cargo</th>
      <th >area</th>
      <th >origem</th>
      <th >cadastrado em:</th>
    </tr>
    <?php foreach ($destino as $destino) : ?>
      
    <tr>
        <td class="text-left text-uppercase"><?php echo $destino['nome'] ?></td>
        <td class="text-left"><?php echo $destino['nome_orgao']  ?></td>
        <td class="text-left"><?php echo $destino['nome_cargo']  ?></td>
       
        <td class="text-left"> <?php foreach($destino['area'] as $key=>$areas) :?><?php echo $areas['nome']?><?php endforeach ?></td>
        
        <td class="text-left"><?php echo $destino['cid_nome']."-".$destino['cid_uf']  ?> </td>
        <td><?php echo date('d/m/Y', strtotime( $destino['created'])) ?></td>
        <td class="text-left"><a href="<?php echo base_url('UserAdmin/Usuario/getUsuarioByIdOrigem')."/".$destino['id_user'] ?>"target="_blank">DETALHES</a></td>
    </tr>
    <?php endforeach ?>
    <?php endif ?>
    </div>
  </table>
  <?= $pager->links('default','bootstrap_pager') ?>
</div>