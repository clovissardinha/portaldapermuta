<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
    <div class="text-center text-uppercase my-3">
      <div class="h3"> Período pesquisado :  <?php echo !empty($data_inicial)?date('d/m/Y', strtotime( $data_inicial ))." a ".date('d/m/Y', strtotime( $data_final )) :'Nenhum registro encontrado'?><?php echo !empty($periodos)?"" :"<p>Nenhum registro encontrado</p>"?></div>
      <?php if (!isset($get['data_inicial'])):?>
      <div class="text-left">    
        <form class="form-inline my-4  " action="<?php echo base_url('UserAdmin/PesquisaData/finalFiltrado') ?>", method="get">
                  
          <label class="" for="orgao"><h4>Filtrar por orgão :</h4></label>
          <?php echo form_dropdown('orgao',$formDropOrgao,null,['class'=>'form-control col-md-4 ml-3']) ?>
                    
          <input class="ml-3" type="hidden" id="data_inicial" name="data_inicial" value="<?php echo isset($data_inicial)?$data_inicial:''?>">
          <input class="ml-3" type="hidden" id="data_final" name="data_final" value="<?php echo isset($data_final)?$data_final:''?>">
                    
          <input class="ml-3 btn btn-primary" type="submit" class="btn btn-primary" value="Pesquisar">
                  
        </form>
      </div>
  <?php endif ?>
    </div>
<table class="table table-striped table-bordered  my-5">
    </tr>
    <div class="container">
      <?php if(!empty($periodos)): ?>
    <tr class="text-left">
      <th >nome</th>
      <th >cargo</th>
      <th >área</th>
      <th >orgão</th>
      <th >origem</th>
      <th >destino</th>
      
      <th></th>
    </tr>
    
    <?php foreach ($periodos as $periodo) : ?>
     
    <tr>
        <td class="text-left text-uppercase"><?php echo $periodo['nome'] ?></td>
        <td class="text-left text-uppercase"><?php echo $periodo['nome_cargo'] ?></td>
        <td class="text-left text-uppercase"><?php echo $periodo['name'] ?></td>
        <td class="text-left text-uppercase"><?php echo $periodo['nome_orgao'] ?></td>
        <td class="text-left text-uppercase"><?php echo $periodo['cid_nome'] ?></td>
        <td class="text-left"><?php foreach($periodo['id_user'] as $key=>$cidade):?><?php echo $cidade['cid_nome']." e outros"  ?> <?php endforeach ?></td>
        
        <td>
          <?php foreach($periodo['id_user'] as $key=>$user): ?>
            
          <a href="<?php echo base_url('UserAdmin/Usuario/getUsuarioByIdData')."/".  $user['id_inter'] ?>" target="_blank">DETALHES </a>
          <?php endforeach ?>
        </td>
    </tr>
    <?php endforeach ?>
        
        <?php endif ?>
    </div>
</table>
<?= $pager->links('default','bootstrap_pager') ?>
</div>