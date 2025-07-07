<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 text-center m-auto">
    <div class="d-flex justify-content-between bg-light mb-3 p-5">
        <span><a href="<?php echo base_url('Admin/Gerencial/AlteraArea/areaInicial') ?>" class="link" ><?php echo "+ INCLUIR ÁREA"?></a></span>
        <span><a href="<?php echo base_url('Admin/Gerencial/AlteraArea/localizar') ?>" class="link" ><?php echo "LOCALIZAR ÁREA"?></a></span>
    </div>
<div class="table">
    <div class="table-header mb-3">
        <h3>Areas</h3>
    </div>
    
    <table class="table table-striped">
    <thead class="text-left">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th colspan="2"><div>
    </div></th>
      </tr>
    </thead>
    <tbody class="text-left">
        <?php foreach($areas as $key=>$area): ?>
      <tr>
        <td><?php echo $area['id'] ?></td>
        <td><?php echo $area['nome'] ?></td>
        <td><a href="<?php echo base_url('Admin/Gerencial/AlteraArea/alteraArea')."/".$area['id'] ?>">alterar</a></td>
       <!--  <td><a class="text-danger" href="<?php echo base_url('Admin/Gerencial/Alteraarea/excluirArea')."/".$area['id']."/".$area['nome'] ?>">excluir</a></td> -->
      </tr>
       <?php endforeach ?>
    </tbody>
  </table>
  <?= $pager->links('default','bootstrap_pager') ?>
</div>
</div>