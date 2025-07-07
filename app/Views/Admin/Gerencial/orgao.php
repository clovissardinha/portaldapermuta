<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 text-center m-auto">
    <div class="d-flex justify-content-between bg-light mb-3 p-5">
        <span><a href="<?php echo base_url('Admin/Gerencial/AlteraOrgao/orgaoInicial') ?>" class="link" ><?php echo "+ INCLUIR ORGÃO"?></a></span>
        <span><a href="<?php echo base_url('Admin/Gerencial/AlteraOrgao/localizar') ?>" class="link" ><?php echo "LOCALIZAR ÓRGÃO"?></a></span>
    </div>
<div class="table">
    <div class="table-header mb-3">
        <h3>Órgãos</h3>
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
        <?php foreach($orgaos as $key=>$orgao): ?>
      <tr>
        <td><?php echo $orgao['id_org'] ?></td>
        <td><?php echo $orgao['nome_orgao'] ?></td>
        <td><a href="<?php echo base_url('Admin/Gerencial/AlteraOrgao/alteraOrgao')."/".$orgao['id_org'] ?>">alterar</a></td>
       <!--  <td><a class="text-danger" href="<?php echo base_url('Admin/Gerencial/AlteraOrgao/excluirOrgao')."/".$orgao['id_org']."/".$orgao['nome_orgao'] ?>">excluir</a></td> -->
      </tr>
       <?php endforeach ?>
    </tbody>
  </table>
  <?= $pager->links('default','bootstrap_pager') ?>
</div>
</div>