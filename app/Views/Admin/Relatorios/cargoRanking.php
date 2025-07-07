<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 text-center">
<div class="table">
    <div class="table-header mb-3">
        <h3>Participação dos cargos</h3>
    </div>
    <table class="table table-striped">
    <thead class="text-left">
        <tr> 
            <th>ID</th>
            <th>Cargo</th>
            <th>Quantidade</th>
        </tr>
    </thead>
    <tbody class="text-left">
        <?php foreach($ranking as $key=>$rank): ?>
      <tr>
        <td><?php echo $rank['id_cargo'] ?></td>
        <td><?php echo $rank['nome_cargo'] ?></td>
        <td><?php echo $rank['total'] ?></td>
      </tr>
       <?php endforeach ?>
    </tbody>
  </table>
  <?= $pager->links('default','bootstrap_pager') ?>
</div>
</div>