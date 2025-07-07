<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 text-center">
<div class="table">
    <div class="table-header mb-3">
        <h3>Mural</h3>
    </div>
    <table class="table table-striped">
    <thead class="text-left">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Mural</th>
        <th>Data de inscrição</th>

      </tr>
    </thead>
    <tbody class="text-left">
        <?php foreach($murais as $key=>$mural): ?>
      <tr>
        <td><?php echo $mural['id_mural'] ?></td>
        <td><?php echo $mural['nome'] ?></td>
        <td><?php echo $mural['email'] ?></td>
        <td><?php echo $mural['comentario']   ?></td>
        <td><?php echo date('d/m/Y', strtotime($mural['created_at'])) ?></td>
        
      </tr>
       <?php endforeach ?>
    </tbody>
  </table>
  <?= $pager->links('default','bootstrap_pager') ?>
</div>
</div>