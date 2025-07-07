<?php echo view('Views/Admin/header')?>
<div class="container col-md-4 text-center">
<div class="table">
    <div class="table-header mb-3">
        <h3>Evolução dos Casdastros do Portal da Permuta</h3>
    </div>
    <table class="table table-striped">
    <thead class="text-left">
      <tr>
        <th>Mês/Ano</th>
        <th>Quantidade</th>
      </tr>
    </thead>
    <tbody class="text-left">
        <?php foreach($crescimentos as $key=>$crescimento): ?>
      <tr>
        <td><?php echo $crescimento['total'] ?></td>
        <td><?php echo date('m/Y', strtotime($crescimento['created_at'])) ?></td>
        
      </tr>
       <?php endforeach ?>
    </tbody>
  </table>
 
</div>
</div>