<?php echo view('Views/Admin/header')?>
<div class="container col-md-10 text-center">
<div class="table">
    <div class="table-header mb-3">
        <h3>LISTAGEM DE CADASTRADOS</h3>
    </div>
    <table class="table table-striped">
    <thead class="text-left">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Estado Origem</th>
        <th>Cidade Origem</th>
        <th>Orgão</th>
        <th>Cargo</th>
        <th>c.ativado</th>
        <th>Plus</th>
        <th>Ativo</th>
        <th>Cadastrado em:</th>
        <th>Atualizado em:</th>

      </tr>
    </thead>
    <tbody class="text-left">
        <?php foreach($usuarios as $key=>$usuario): ?>
      <tr>
        <td><?php echo $usuario['id_user'] ?></td>
        <td><?php echo $usuario['nome'] ?></td>
        <td><?php echo $usuario['email'] ?></td>
        <td><?php echo $usuario['cid_uf'] ?></td>
        <td><?php echo $usuario['cid_nome'] ?></td>
        <td><?php echo $usuario['nome_orgao'] ?></td>
        <td><?php echo $usuario['nome_cargo'] ?></td>
        <td><?php echo $usuario['cadastro_ativado'] ?></td>
        <td><?php echo $usuario['plus'] ?></td>
        <td><?php echo $usuario['ativo'] ?></td>
        <td><?php echo date('d/m/Y', strtotime($usuario['created_at'])) ?></td>
        <td><?php echo date('d/m/Y', strtotime($usuario['updated_at'])) ?></td>
      </tr>
       <?php endforeach ?>
    </tbody>
  </table>
  <?= $pager->links('default','bootstrap_pager') ?>
</div>
</div>