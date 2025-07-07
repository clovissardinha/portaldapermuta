<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 text-center m-auto">
    <div class=" P-4  bg-light text-left my-3">
        <span><a href="<?php echo base_url('Admin/Gerencial/AlteraDestaque/destaqueInicial') ?>" class="link" ><?php echo "+ INCLUIR DESTAQUE"?></a></span>
    </div>
<div class="table">
    <div class="table-header mb-3">
        <h3>Destaques</h3>
    </div>
    <p class="text-uppercase text-primary"><?php if(isset($_SESSION['sucesso'])){echo $item = $_SESSION['sucesso'];}  ?></p>
    <p class="text-uppercase text-danger"><?php if(isset($_SESSION['item'])){echo $item = $_SESSION['item'];}?></p>
    <table class="table table-striped">
    <thead class="text-left">
      <tr>
        <th>ID</th>
        <th>ID interessado</th>
        <th>Nome</th>
        <th>Data Pgto</th>
        <th>Data Inicial</th>
        <th>Data Final</th>
        <th>Tipo</th>
        <th colspan="2"><div class="text-danger">
    </div></th>
      </tr>
    </thead>
    <tbody class="text-left">
        <?php foreach($destaques as $key=>$destaque): ?>
      <tr>
        <td><?php echo $destaque['id_destaque'] ?></td>
        <td><?php echo $destaque['id_user'] ?></td>
        <td><?php echo $destaque['nome']   ?></td>
        <td><?php echo date('d/m/Y', strtotime($destaque['data_pgto'])) ?></td>
        <td><?php echo date('d/m/Y', strtotime($destaque['data_inicio'])) ?></td>
        <td><?php echo date('d/m/Y', strtotime($destaque['data_fim'])) ?></td>
        <td><?php if ( $destaque['tipo']==1){ echo "Principal";} else if( $destaque['tipo']==2){echo "Interior";}?></td>
        <td><a href="<?php echo base_url('Admin/Gerencial/AlteraDestaque/alteraDestaque')."/".$destaque['id_destaque']."/".$destaque['nome'] ?>">alterar</a></td>
        <td><a class="text-danger" href="<?php echo base_url('Admin/Gerencial/AlteraDestaque/excluirDestaque')."/".$destaque['id_destaque']."/".$destaque['nome'] ?>">excluir</a></td>
      </tr>
       <?php endforeach ?>
    </tbody>
  </table>
  <?= $pager->links('default','bootstrap_pager') ?>
</div>
</div>