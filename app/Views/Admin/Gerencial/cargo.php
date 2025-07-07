<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 text-center m-auto">
    <div class="d-flex justify-content-between bg-light mb-3 p-5">
        <span><a href="<?php echo base_url('Admin/Gerencial/AlteraCargos/cargoIncluir') ?>" class="link" ><?php echo "+ INCLUIR CARGO"?></a></span>
        <span><span><a href="<?php echo base_url('Admin/Gerencial/AlteraCargos/substituirCargo') ?>" class="link" ><?php echo "+ SUBSTITUIR CARGO"?></a></span></span>
        <span><a href="<?php echo base_url('Admin/Gerencial/AlteraCargos/localizar') ?>" class="link" ><?php echo "LOCALIZAR CARGO"?></a></span>
    </div>
<div class="table">
    <div class="table-header mb-3">
        <h3>CARGOS</h3>
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
        <?php foreach($cargos as $key=>$cargo): ?>
      <tr>
        <td><?php echo $cargo['id_cargos'] ?></td>
        <td><?php echo $cargo['nome_cargo'] ?></td>
        <td><a href="<?php echo base_url('Admin/Gerencial/AlteraCargos/alteraCargo')."/".$cargo['id_cargos'] ?>">alterar</a></td>
        <td></td>
       <!--  <td><a class="text-danger" href="<?php echo base_url('Admin/Gerencial/AlteraCargos/excluirCargo')."/".$cargo['id_cargos']."/".$cargo['nome_cargo'] ?>">excluir</a></td> -->
      </tr>
       <?php endforeach ?>
    </tbody>
  </table>
  <?= $pager->links('default','bootstrap_pager') ?>
</div>
</div>