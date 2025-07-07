<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 text-center">
<div class="table">
    <div class="table-header mb-3">
        <h3>Cadastrados no Portal da Permuta nos últimos dias</h3>
    </div>
    <table class="table table-striped">
    <thead class="text-left">
      <tr>
        <th>Cargo</th>
        <th>Órgão</th>
        <th>Cidade de Origem</th>
        <th>Data de inscrição</th>
      </tr>
    </thead>
    <tbody class="text-left">
        <?php foreach($novos as $key=>$user): ?>
      <tr>
        <td><?php echo $user['nome_cargo'] ?></td>
        <td><?php echo $user['nome_orgao'] ?></td>
        <td><?php echo $user['cid_nome']   ?></td>
        <td><?php echo date('d/m/Y', strtotime($user['created_at_usuarios'])) ?></td>
      </tr>
       <?php endforeach ?>
    </tbody>
  </table>
  <span>Vejam mais em: www.portaldapermuta.com</span>
</div>
</div>